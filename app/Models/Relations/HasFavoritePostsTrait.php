<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Post;

trait HasFavoritePostsTrait
{
    public function favoritePosts()
    {
        return $this->belongsToMany(Post::class, 'favorites')
            ->whereNull('favorites.deleted_at')
            ->withTimestamps();
    }
}