<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\User;

trait BelongsToUserTrait
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}