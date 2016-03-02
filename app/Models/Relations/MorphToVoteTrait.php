<?php
namespace StartupsCampfire\Models\Relations;

trait MorphToVoteTrait
{
    public function votable()
    {
        return $this->morphTo();
    }
}