<?php

namespace StartupsCampfire\Composers;

use Illuminate\Contracts\View\View;
use StartupsCampfire\Repositories\NoticeRepository;

/**
 * 站点公告视图组件
 *
 * Class NoticesComposer
 * @package StartupsCampfire\Composers
 */
class NoticesComposer
{
    protected $noticeRepository;

    public function __construct(NoticeRepository $noticeRepository)
    {
        $this->noticeRepository = $noticeRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $online_notices = $this->noticeRepository->getOnlineNotices();
        $view->with('online_notices', $online_notices);
    }
}