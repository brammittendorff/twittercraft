<?php
namespace Craft;

require_once CRAFT_PLUGINS_PATH.'twittercraft/vendor/autoload.php';

class TwitterCraft_TweetService extends BaseApplicationComponent
{

    private $tmhOAuth = null;
    private $resultJson = '';
    private $twitterHandle = '';

    public function __construct()
    {
        $settings = craft()->plugins->getPlugin('twittercraft')->getSettings();
        $this->tmhOAuth = new \tmhOAuth(array(
          'consumer_key' => $settings['consumer_key'],
          'consumer_secret' => $settings['consumer_secret'],
          'user_token' => $settings['user_token'],
          'user_secret' => $settings['user_secret'],
        ));
        $this->twitterHandle = $settings['twitter_handle'];
    }

    /**
     * Check if we have the latest tweet in our database
     * @return boolean      return true if the resultJson is filled
     */
    public function checkTweets()
    {
        // Parse request
        $url = $this->tmhOAuth->url('1.1/statuses/user_timeline');
        $responseCode = $this->tmhOAuth->request('GET', $url, ['screen_name' => $this->twitterHandle]);

        // Check response
        if ($responseCode == 200) {
            $this->resultJson = json_decode($this->tmhOAuth->response['response'], true);
            return true;
        }

        return false;
    }

    public function checkIfTweetExists($tweetId = 0)
    {
        $record = TwitterCraft_TweetRecord::model()->findByAttributes(array(
            'id' => $tweetId,
        ));
        if ($record) {
            return true;
        }
        return false;
    }

    public function getTweets()
    {
        foreach ($this->resultJson as $tweet) {
            craft()->tasks->createTask('TwitterCraft_Tweet', Craft::t('Downloaden van tweet: ' . $tweet['id']), array(
                'id' => (string)$tweet['id'],
                'twitterJson' => $tweet,
            ));
        }
    }

    public function saveTweet($tweetId = '', $tweetJson = '')
    {
        if (!empty($tweetId) && !empty($tweetJson)) {
            $tweetModel = new TwitterCraft_TweetModel();
            $tweetModel->id = (string)$tweetId;
            $tweetModel->twitterJson = $tweetJson;

            $tweetRecord = new TwitterCraft_TweetRecord();
            $attributes = $tweetModel->getAttributes();
            foreach ($attributes as $key => $value) {
                $tweetRecord->setAttribute($key, $value);
            }

            return $tweetRecord->save();
        }

        return false;
    }
}
