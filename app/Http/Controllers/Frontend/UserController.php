<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\CommentRepository;
use StartupsCampfire\Repositories\EventRepository;
use StartupsCampfire\Repositories\FavoriteRepository;
use StartupsCampfire\Repositories\FollowerRepository;
use StartupsCampfire\Repositories\PostRepository;
use StartupsCampfire\Repositories\UserRepository;

class UserController extends CommonController
{
    protected $followerRepository;
    protected $userRepository;
    protected $postRepository;
    protected $commentRepository;
    protected $favoriteRepository;
    protected $eventRepository;

    public function __construct(
        UserRepository $userRepository,
        FollowerRepository $followerRepository,
        PostRepository $postRepository,
        CommentRepository $commentRepository,
        FavoriteRepository $favoriteRepository,
        EventRepository $eventRepository
    )
    {
        // 中间件设置
        $this->middleware('auth');

        $this->followerRepository = $followerRepository;
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->favoriteRepository = $favoriteRepository;
        $this->eventRepository = $eventRepository;
    }

    /**
     * 添加关注
     *
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getFollowUser($user_id)
    {
        $this->followerRepository->followUser($user_id);

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
        $this->followerRepository->unfollowUser($user_id);

        return Redirect::back();
    }

    /**
     * 移除粉丝
     *
     * @param $user_id
     */
    public function getRemoveFollower($user_id)
    {
        $this->followerRepository->removeFollower($user_id);

        return Redirect::back();
    }

    public function getUserPosts($user_id)
    {
        $user = $this->userRepository->find($user_id);
        $posts = $this->postRepository->getPaginatedUserModels($user_id, 50);

        return ViewHelper::frontView('users.user_posts', compact('posts', 'user'));
    }

    public function getUserComments($user_id)
    {
        $user = $this->userRepository->find($user_id);
        $comments = $this->commentRepository->getPaginatedUserModels($user_id, 50);

        return ViewHelper::frontView('users.user_comments', compact('comments', 'user'));
    }

    public function getUserEvents($user_id)
    {
        $user = $this->userRepository->find($user_id);
        $events = $this->eventRepository->getPaginatedUserModels($user_id, 50);

        return ViewHelper::frontView('users.user_events', compact('events', 'user'));
    }

    public function getUserFavorites($user_id)
    {
        $user = $this->userRepository->find($user_id);
        $favorites = $this->favoriteRepository->getPaginatedFavoritePosts($user_id, 50);

        return ViewHelper::frontView('users.user_favorites', compact('favorites', 'user'));
    }

    public function getUserFollowers($user_id)
    {
        $user = $this->userRepository->find($user_id);
        $followers = $this->followerRepository->getPaginatedUserFollowers($user_id, 100);

        return ViewHelper::frontView('users.user_followers', compact('followers', 'user'));
    }

    public function getUserFollowings($user_id)
    {
        $user = $this->userRepository->find($user_id);
        $followings = $this->followerRepository->getPaginatedUserFollowings($user_id, 100);

        return ViewHelper::frontView('users.user_followings', compact('followings', 'user'));
    }

    public function getUserFocusPosts()
    {
        $user = Auth::user('user');
        $filter = Input::get('filter');
        $posts = $this->postRepository->getPaginatedFocusPosts(10, $filter);
        $hot_posts = $this->postRepository->getHotPosts(10);

        return ViewHelper::frontView('users.focus_posts', compact('user', 'posts', 'hot_posts'));
    }

}
