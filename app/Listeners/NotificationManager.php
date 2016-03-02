<?php

namespace StartupsCampfire\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use StartupsCampfire\Repositories\NotificationRepository;

class NotificationManager
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function onCreateComment($event)
    {
        $this->notificationRepository->createCommentNotification($event);
    }

    public function onMentionUsers($event)
    {
        $this->notificationRepository->createMentionNotification($event);
    }

    public function onFollowUser($event)
    {
        $this->notificationRepository->createFollowNotification($event);
    }

    public function onUnfollowUser($event)
    {
        $this->notificationRepository->deleteFollowNotification($event);
    }

    public function onRemoveFollower($event)
    {
        $this->notificationRepository->removeFollowerNotification($event);
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
