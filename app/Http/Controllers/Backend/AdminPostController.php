<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class AdminPostController extends AdminCommonController
{
    public function index()
    {
        $posts = \PostRepository::getPaginatedModels(15);

        $posts_count = \PostRepository::all()->count();

        return ViewHelper::backView('posts.index', compact('posts', 'posts_count'));
    }

    public function destroy($post_id)
    {
        \PostRepository::delete($post_id);

        return Redirect::route('backend::admin.posts.index');
    }

}