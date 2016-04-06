<?php
namespace StartupsCampfire\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Models\User;
use StartupsCampfire\Repositories\FavoriteRepositoryInterface;

class FavoriteRepository extends AbstractRepository implements FavoriteRepositoryInterface
{
    public function model()
    {
        return \StartupsCampfire\Models\Favorite::class;
    }

    public function addFavoritePost($post_id)
    {
        // 用户之前是否添加过收藏同一篇动态
        $check_favorite = $this->checkIsFavoritePost(Auth::id('user'), $post_id);
        if ($check_favorite) {
            Auth::user('user')->favoritePosts()->detach($post_id);
        } else {
            Auth::user('user')->favoritePosts()->attach($post_id);
        }
    }

    public function checkIsFavoritePost($user_id, $post_id)
    {
        if ($this->model->where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->first()
        ) {
            return true;
        }
        return false;
    }

    public function getPaginatedFavoritePosts($user_id, $page_size)
    {
        $user = User::find($user_id);

        return $user->favoritePosts()
            ->orderBy('created_at', 'desc')
            ->paginate($page_size);;
    }
}