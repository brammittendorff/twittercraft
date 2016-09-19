<?php
namespace Craft;

class TwitterCraft_TweetRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'twittercraft_tweet';
    }

    public function defineAttributes()
    {
        return array(
            'id' => AttributeType::String,
            'twitterJson' => AttributeType::Mixed,
        );
    }

    public function defineIndexes()
    {
        return array(
            array('columns' => array('id'), 'unique' => true),
        );
    }
}
