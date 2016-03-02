<?php
namespace StartupsCampfire\Models\Relations;

trait MorphToCommentTrait
{
    public function commentable()
    {
        return $this->morphTo();
    }
}