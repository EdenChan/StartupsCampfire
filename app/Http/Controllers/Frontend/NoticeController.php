<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;


class NoticeController extends CommonController
{
    public function show($notice_id)
    {
        $notice = \NoticeRepository::find($notice_id);

        return ViewHelper::frontView('notices.show', compact('notice'));
    }
}