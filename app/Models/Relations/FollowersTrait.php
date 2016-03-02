<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\User;

trait FollowersTrait
{
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follow_id', 'user_id')
            ->whereNull('followers.deleted_at')
            ->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follow_id')
            ->whereNull('followers.deleted_at')
            ->withTimestamps();
    }

}