<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Http\Requests\CreatePostRequest;

class PostController extends CommonController
{

    public function __construct()
    {
        // 中间件设置
        $this->middleware('auth', ['only' => [
            'create',
            'store',
            'destroy',
            'getUpvotePost',
            'getDownvotePost'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = Input::get('filter');

        $posts = \PostRepository::getPaginatedModels(10, $filter);

        $hot_posts = \PostRepository::getHotPosts(10);

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
        $post = \PostRepository::find($post_id);

        $hot_posts = \PostRepository::getHotPosts(10);

        $is_favorite = \FavoriteRepository::checkIsFavoritePost(Auth::id('user'), $post_id);

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

        \PostRepository::createUserPost($input);

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
        $post =\PostRepository::find($post_id);

        $this->authorize('destroy', $post);

        \PostRepository::deleteUserPost($post_id);

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
        \PostRepository::upvoteModel($post_id);

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
        \PostRepository::downvoteModel($post_id);

        return Redirect::back();
    }
}
