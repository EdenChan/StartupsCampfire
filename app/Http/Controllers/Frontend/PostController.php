<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Repositories\FavoriteRepository;
use StartupsCampfire\Repositories\PostRepository;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Http\Requests\CreatePostRequest;

class PostController extends CommonController
{
    protected $postRepository;
    protected $favoriteRepository;

    public function __construct(PostRepository $postRepository, FavoriteRepository $favoriteRepository)
    {
        // 中间件设置
        $this->middleware('auth', ['only' => [
            'create',
            'store',
            'destroy',
            'getUpvotePost',
            'getDownvotePost'
        ]]);

        $this->postRepository = $postRepository;
        $this->favoriteRepository = $favoriteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = Input::get('filter');

        $posts = $this->postRepository->getPaginatedModels(10, $filter);

        $hot_posts = $this->postRepository->getHotPosts(10);

        return ViewHelper::frontView('posts.index', compact('posts', 'hot_posts'));
    }

    /**
     * 显示动态详情
     *
     * @param $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($post_id)
    {
        $post = $this->postRepository->find($post_id);

        $hot_posts = $this->postRepository->getHotPosts(10);

        $is_favorite = $this->favoriteRepository->checkIsFavoritePost(Auth::id('user'), $post_id);

        return ViewHelper::frontView('posts.show', compact('post', 'is_favorite', 'hot_posts'));
    }

    public function create()
    {
        return ViewHelper::frontView('posts.create');
    }

    /**
     * 新增动态操作
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id('user');

        $this->postRepository->createUserPost($input);

        return Redirect::route('frontend::user.authprofile');
    }

    /**
     * 删除动态操作
     *
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($post_id)
    {
        $post = $this->postRepository->find($post_id);

        $this->authorize('destroy', $post);

        $this->postRepository->deleteUserPost($post_id);

        return Redirect::route('frontend::user.posts', ['user_id' => Auth::id('user')]);
    }

    /**
     * 支持动态
     *
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUpvotePost($post_id)
    {
        $this->postRepository->upvoteModel($post_id);

        return Redirect::back();
    }

    /**
     * 踩动态
     *
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDownvotePost($post_id)
    {
        $this->postRepository->downvoteModel($post_id);

        return Redirect::back();
    }
}
