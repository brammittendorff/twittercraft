<?php
namespace Craft;

class TwitterCraftVariable
{
    public function showTweets()
    {
        return craft()->twitterCraft_tweet->showTweets();
    }
}
