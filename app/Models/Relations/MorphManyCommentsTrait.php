<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Comment;

trait MorphManyCommentsTrait
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function deleteComments()
    {
        foreach ($this->comments()->get(['id']) as $comment) {
            $comment->delete();
        }
    }
}