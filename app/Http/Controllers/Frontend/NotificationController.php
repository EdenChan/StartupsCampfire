<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class NotificationController extends CommonController
{
    /**
     * NotificationController constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct()
    {
        // 中间件设置
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id('user');
        $notifications =\NotificationRepository::getPaginatedUserNotifications($user_id, 20);

        return ViewHelper::frontView('notifications.index', [
            'notifications' => $notifications,
        ]);
    }
}
