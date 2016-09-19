<?php
namespace Craft;

class TwitterCraftCommand extends BaseCommand
{
    /**
     * Runs cronjob for twittercraft
     *
     * @return int
     */
    public function actionRun()
    {
        // run the tasks again for stuck tasks
        $tasks = craft()->tasks->getAllTasks();
        foreach ($tasks as $task) {
            craft()->tasks->rerunTaskById($task->id);
        }

        // download tweets into tasks
        if (craft()->twitterCraft_tweet->checkTweets()) {
            craft()->twitterCraft_tweet->getTweets();
        }
    }
}
