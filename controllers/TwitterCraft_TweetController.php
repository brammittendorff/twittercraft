<?php
namespace Craft;

class TwitterCraft_TweetController extends BaseController
{
    protected $allowAnonymous = array('actionFetchTweets');

    /**
     * Get the tweets from twitter
     */
    public function actionFetchTweets()
    {
        if (craft()->userSession->isLoggedIn()) {
            if (craft()->twitterCraft_tweet->checkTmhOAuthConnection()) {
                craft()->twitterCraft_tweet->getTweets();
            }
        }
    }
}
