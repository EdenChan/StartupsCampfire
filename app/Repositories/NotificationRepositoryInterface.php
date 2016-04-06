<?php
namespace StartupsCampfire\Repositories;

interface NotificationRepositoryInterface extends BaseRepositoryInterface
{
    public function getPaginatedUserNotifications($user_id, $page_size = 10);

    public function getUnreadedNotifications($user_id);

    public function createCommentNotification($event);

    public function createMentionNotification($event);

    public function createFollowNotification($event);

    public function deleteFollowNotification($event);

    public function removeFollowerNotification($event);
}