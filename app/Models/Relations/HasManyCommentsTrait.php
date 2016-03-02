<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Comment;

trait HasManyCommentsTrait
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function deleteComments()
    {
        foreach ($this->comments()->get(['id']) as $comment) {
            $comment->delete();
        }
    }
}