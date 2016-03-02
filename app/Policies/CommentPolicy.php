<?php

namespace StartupsCampfire\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Models\Comment;
use StartupsCampfire\Models\User;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Comment $comment)
    {
        return $comment->user->id === $user->id;
    }

    public function destroy(User $user, Comment $comment)
    {
        $user_id = $user->id;
        $comment_user_id = $comment->user->id;
        return $comment_user_id === $user_id;
    }
}
