<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Favorite;
use StartupsCampfire\Models\User;

trait FavoritedByTrait
{
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->whereNull('favorites.deleted_at');
    }

    public function deleteFavoritedBy()
    {
        Favorite::where('post_id', $this->id)->delete();
    }
}