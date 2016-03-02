<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Repositories\NotificationRepository;
use StartupsCampfire\Helpers\ViewHelper;


class NotificationController extends CommonController
{
    protected $notificationRepository;

    /**
     * NotificationController constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        // 中间件设置
        $this->middleware('auth');

        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $user_id = Auth::id('user');
        $notifications = $this->notificationRepository->getPaginatedUserNotifications($user_id, 20);

        return ViewHelper::frontView('notifications.index', [
            'notifications' => $notifications,
        ]);
    }
}
