# TwitterCraft

An automatic twitter tweet puller for <a href="https://craftcms.com/" target="_blank">Craft CMS</a> with OAuth.

# Installation

## Composer

You can install this plugin with composer. This will install your plugin automatically in the craft plugins folder.

```composer require brammittendorff/twittercraft```

## Git

You can install this plugin with git to you just need to clone this repo into your craft plugins folder:

```cd craft/plugins/```

```git clone https://github.com/brammittendorff/twittercraft.git```


# Usage

```
<div class="row">
  {% for tweet in craft.twittercraft.showTweets() %}
    {% set json = tweet.twitterJson %}
    {% if json.user.screen_name == 'someuser' %}
      <div class="col-sm-4">
          <div class="block block--twitter">
              {{ json.text }}
          </div>
      </div>
    {% endif %}
  {% endfor %}
</div>
```

# Scheduled tasks

You can use this plugin as a cronjob, or as a schedule in heroku just use/run the following command:

```./craft/app/etc/console/yiic twittercraft run```
