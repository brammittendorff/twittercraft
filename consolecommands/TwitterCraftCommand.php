<?php
namespace Craft;

class TwitterCraftCommand extends BaseCommand
{
    /**
     * Runs cronjob for twittercraft
     */
    public function actionRun()
    {
        // run the tasks again for stuck tasks
        $tasks = craft()->tasks->getAllTasks();
        foreach ($tasks as $task) {
            craft()->tasks->rerunTaskById($task->id);
        }

        // download tweets into tasks
        if (craft()->twitterCraft_tweet->checkTmhOAuthConnection()) {
            craft()->twitterCraft_tweet->getTweets();
        }
    }
}
