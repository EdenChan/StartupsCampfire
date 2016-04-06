<?php
namespace StartupsCampfire\Repositories;

interface FavoriteRepositoryInterface extends BaseRepositoryInterface
{

    public function addFavoritePost($post_id);

    public function checkIsFavoritePost($user_id, $post_id);

    public function getPaginatedFavoritePosts($user_id, $page_size);
}