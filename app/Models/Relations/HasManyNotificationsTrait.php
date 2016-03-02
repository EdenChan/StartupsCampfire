<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Notification;

trait HasManyNotificationsTrait
{
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function deleteNotifications()
    {
        foreach ($this->notifications()->get(['id']) as $notification) {
            return $notification->delete();
        }
    }
}