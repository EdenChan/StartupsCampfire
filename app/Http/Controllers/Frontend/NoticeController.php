<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\NoticeRepository;


class NoticeController extends CommonController
{
    protected $noticeRepository;

    public function __construct(NoticeRepository $noticeRepository)
    {
        $this->noticeRepository = $noticeRepository;
    }

    public function show($notice_id)
    {
        $notice = $this->noticeRepository->find($notice_id);

        return ViewHelper::frontView('notices.show', compact('notice'));
    }
}