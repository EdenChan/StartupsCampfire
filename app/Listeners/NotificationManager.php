<?php

namespace StartupsCampfire\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationManager
{

    public function onCreateComment($event)
    {
        \NotificationRepository::createCommentNotification($event);
    }

    public function onMentionUsers($event)
    {
        \NotificationRepository::createMentionNotification($event);
    }

    public function onFollowUser($event)
    {
        \NotificationRepository::createFollowNotification($event);
    }

    public function onUnfollowUser($event)
    {
        \NotificationRepository::deleteFollowNotification($event);
    }

    public function onRemoveFollower($event)
    {
        \NotificationRepository::removeFollowerNotification($event);
    }

    /**
     * Subscribe Events
     *
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'StartupsCampfire\Events\CreateComment',
            'StartupsCampfire\Listeners\NotificationManager@onCreateComment'
        );
        $events->listen(
            'StartupsCampfire\Events\MentionUsers',
            'StartupsCampfire\Listeners\NotificationManager@onMentionUsers'
        );
        $events->listen(
            'StartupsCampfire\Events\FollowUser',
            'StartupsCampfire\Listeners\NotificationManager@onFollowUser'
        );
        $events->listen(
            'StartupsCampfire\Events\UnfollowUser',
            'StartupsCampfire\Listeners\NotificationManager@onUnfollowUser'
        );
        $events->listen(
            'StartupsCampfire\Events\RemoveFollower',
            'StartupsCampfire\Listeners\NotificationManager@onRemoveFollower'
        );
    }
}
