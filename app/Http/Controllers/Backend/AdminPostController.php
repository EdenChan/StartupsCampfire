<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\PostRepository;

class AdminPostController extends AdminCommonController
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        parent::__construct();

        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getPaginatedModels(15);

        $posts_count = $this->postRepository->all()->count();

        return ViewHelper::backView('posts.index', compact('posts', 'posts_count'));
    }

    public function destroy($post_id)
    {
        $this->postRepository->delete($post_id);

        return Redirect::route('backend::admin.posts.index');
    }

}