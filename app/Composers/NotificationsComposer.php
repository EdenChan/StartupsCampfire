<?php

namespace StartupsCampfire\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Repositories\NotificationRepository;

/**
 * 未读消息
 *
 * Class NotificationCountComposer
 * @package StartupsCampfire\Composers
 */
class NotificationsComposer
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user_id = Auth::id('user');
        if (!empty($user_id)) {
            $notifications = $this->notificationRepository->getUnreadedNotifications($user_id);
            $notifications_count = $notifications->count();
            $view->with('notifications', $notifications);
            $view->with('notifications_count', $notifications_count);
        }
    }
}