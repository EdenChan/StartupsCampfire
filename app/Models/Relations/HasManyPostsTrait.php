<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Post;

trait HasManyPostsTrait
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function deletePosts()
    {
        foreach ($this->posts()->get(['id']) as $post) {
            return $post->delete();
        }
    }
}