<?php
namespace Craft;

class TwitterCraft_TweetTask extends BaseTask
{

    /**
     * Defined settings
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'id' => AttributeType::String,
            'twitterJson' => AttributeType::Mixed,
        );
    }

    /**
     * Return description
     * @return string
     */
    public function getDescription()
    {
        return Craft::t('Twitter download');
    }

    /**
     * Total steps to run
     * @return int
     */
    public function getTotalSteps()
    {
        return 1;
    }

    /**
     * Run each step
     * @param  int  $step
     * @return boolean
     */
    public function runStep($step)
    {
        $settings = $this->getSettings();
        if (!craft()->twitterCraft_tweet->checkIfTweetExists($settings->id)) {
            switch ($step) {
                case 0:
                    return craft()->twitterCraft_tweet->saveTweet($settings->id, $settings->twitterJson);
                break;
            }
        }
        return true;
    }
}
