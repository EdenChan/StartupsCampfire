<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Profile;

trait HasOneProfileTrait
{
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function deleteProfile()
    {
        return $this->profile->delete();
    }
}