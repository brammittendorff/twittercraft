<?php
namespace Craft;

class TwitterCraft_TweetModel extends BaseModel
{
    public function defineAttributes()
    {
        return array(
            'id' => AttributeType::String,
            'twitterJson' => AttributeType::Mixed,
        );
    }
}
