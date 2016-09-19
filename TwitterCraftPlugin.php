<?php
namespace Craft;

/**
 * TwitterCraft
 *
 * @author    Bram Mittendorff <bram@nerds.company>
 * @copyright Copyright (c) 2016, Bram Mittendorff
 * @license   MIT
 *
 * @link      https://github.com/brammittendorff/
 */
class TwitterCraftPlugin extends BasePlugin
{
    /**
     * Get plugin name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('TwitterCraft');
    }

    /**
     * Get plugin description.
     *
     * @return string
     */
    public function getDescription()
    {
        return Craft::t('A plugin for CraftCMS to get the twitter feeds automagicly');
    }

    /**
     * Get plugin version.
     *
     * @return string
     */
    public function getVersion()
    {
        return '0.0.2';
    }

    /**
     * Get plugin developer.
     *
     * @return string
     */
    public function getDeveloper()
    {
        return 'Bram Mittendorff';
    }

    /**
     * Get plugin developer url.
     *
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://www.nerds.company';
    }

    /**
     * Get plugin documentation url.
     *
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/brammittendorff/twittercraft';
    }

    /**
     * Has Control Panel section.
     *
     * @return bool
     */
    public function hasCpSection()
    {
        return true;
    }

    protected function defineSettings()
    {
        return array(
            'consumer_key' => array(AttributeType::String, 'default' => ''),
            'consumer_secret' => array(AttributeType::String, 'default' => ''),
            'user_token' => array(AttributeType::String, 'default' => ''),
            'user_secret' => array(AttributeType::String, 'default' => ''),
            'twitter_handle' => array(AttributeType::String, 'default' => ''),
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('twittercraft/settings', array(
            'settings' => $this->getSettings()
        ));
    }
}
