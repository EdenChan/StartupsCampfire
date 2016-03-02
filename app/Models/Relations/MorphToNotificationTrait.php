<?php
namespace StartupsCampfire\Models\Relations;

trait MorphToNotificationTrait
{
    public function notifiable()
    {
        return $this->morphTo();
    }
}