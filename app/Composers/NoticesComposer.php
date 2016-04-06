<?php

namespace StartupsCampfire\Composers;

use Illuminate\Contracts\View\View;

/**
 * 站点公告视图组件
 *
 * Class NoticesComposer
 * @package StartupsCampfire\Composers
 */
class NoticesComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $online_notices = \NoticeRepository::getOnlineNotices();
        $view->with('online_notices', $online_notices);
    }
}