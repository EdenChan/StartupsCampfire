<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Post;

trait BelongsToPostTrait
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}