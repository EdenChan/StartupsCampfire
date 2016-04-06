<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Helpers\ViewHelper;

class UserController extends CommonController
{
    public function __construct()
    {
        // 中间件设置
        $this->middleware('auth');
    }

    /**
     * 添加关注
     *
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getFollowUser($user_id)
    {
        \FollowerRepository::followUser($user_id);

        return Redirect::back();
    }

    /**
     * 取消关注
     *
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUnfollowUser($user_id)
    {
        \FollowerRepository::unfollowUser($user_id);

        return Redirect::back();
    }

    /**
     * 移除粉丝
     *
     * @param $user_id
     */
    public function getRemoveFollower($user_id)
    {
        \FollowerRepository::removeFollower($user_id);

        return Redirect::back();
    }

    public function getUserPosts($user_id)
    {
        $user = \UserRepository::find($user_id);
        $posts = \PostRepository::getPaginatedUserModels($user_id, 50);

        return ViewHelper::frontView('users.user_posts', compact('posts', 'user'));
    }

    public function getUserComments($user_id)
    {
        $user = \UserRepository::find($user_id);
        $comments = \CommentRepository::getPaginatedUserModels($user_id, 50);

        return ViewHelper::frontView('users.user_comments', compact('comments', 'user'));
    }

    public function getUserEvents($user_id)
    {
        $user = \UserRepository::find($user_id);
        $events = \EventRepository::getPaginatedUserModels($user_id, 50);

        return ViewHelper::frontView('users.user_events', compact('events', 'user'));
    }

    public function getUserFavorites($user_id)
    {
        $user = \UserRepository::find($user_id);
        $favorites = \FavoriteRepository::getPaginatedFavoritePosts($user_id, 50);

        return ViewHelper::frontView('users.user_favorites', compact('favorites', 'user'));
    }

    public function getUserFollowers($user_id)
    {
        $user = \UserRepository::find($user_id);
        $followers = \FollowerRepository::getPaginatedUserFollowers($user_id, 100);

        return ViewHelper::frontView('users.user_followers', compact('followers', 'user'));
    }

    public function getUserFollowings($user_id)
    {
        $user = \UserRepository::find($user_id);
        $followings = \FollowerRepository::getPaginatedUserFollowings($user_id, 100);

        return ViewHelper::frontView('users.user_followings', compact('followings', 'user'));
    }

    public function getUserFocusPosts()
    {
        $user = Auth::user('user');
        $filter = Input::get('filter');
        $posts = \PostRepository::getPaginatedFocusPosts(10, $filter);
        $hot_posts = \PostRepository::getHotPosts(10);

        return ViewHelper::frontView('users.focus_posts', compact('user', 'posts', 'hot_posts'));
    }

}
