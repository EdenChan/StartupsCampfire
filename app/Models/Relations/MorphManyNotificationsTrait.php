<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Notification;

trait MorphManyNotificationsTrait
{
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function deleteNotifications()
    {
        foreach ($this->notifications()->get(['id']) as $notification) {
            return $notification->delete();
        }
    }
}