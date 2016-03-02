<?php

namespace StartupsCampfire\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Models\Post;
use StartupsCampfire\Models\User;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post)
    {
        return $post->user->id === $user->id;
    }

    public function destroy(User $user, Post $post)
    {
        return $post->user->id === $user->id;
    }
}
