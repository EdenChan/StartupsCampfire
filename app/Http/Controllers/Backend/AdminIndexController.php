<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class AdminIndexController extends AdminCommonController
{
    public function index()
    {
        $admin = Auth::user('admin');
        $user_count = \UserRepository::all()->count();
        $comment_count = \CommentRepository::all()->count();
        $event_count = \EventRepository::all()->count();
        $post_count = \PostRepository::all()->count();
        return ViewHelper::backView('welcome', compact('admin', 'user_count', 'comment_count', 'event_count', 'post_count'));
    }
}