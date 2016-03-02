<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\CommentRepository;
use StartupsCampfire\Repositories\EventRepository;
use StartupsCampfire\Repositories\PostRepository;
use StartupsCampfire\Repositories\UserRepository;

class AdminIndexController extends AdminCommonController
{
    protected $userRepository;
    protected $commentRepository;
    protected $postRepository;
    protected $eventRepository;

    public function __construct(
        UserRepository $userRepository,
        CommentRepository $commentRepository,
        EventRepository $eventRepository,
        PostRepository $postRepository
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->eventRepository = $eventRepository;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $admin = Auth::user('admin');
        $user_count = $this->userRepository->all()->count();
        $comment_count = $this->commentRepository->all()->count();
        $event_count = $this->eventRepository->all()->count();
        $post_count = $this->postRepository->all()->count();
        return ViewHelper::backView('welcome', compact('admin', 'user_count', 'comment_count', 'event_count', 'post_count'));
    }
}