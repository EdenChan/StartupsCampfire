<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Http\Requests\CreateNoticeRequest;

class AdminNoticeController extends AdminCommonController
{
    public function index()
    {
        $notices = \NoticeRepository::getPaginatedModels(15);

        $notices_count = \NoticeRepository::all()->count();

        return ViewHelper::backView('notices.index', compact('notices', 'notices_count'));
    }

    public function show($notice_id)
    {
        $notice = \NoticeRepository::find($notice_id);

        return ViewHelper::backView('notices.show', compact('notice'));
    }

    public function create()
    {
        return ViewHelper::backView('notices.create');
    }

    public function store(CreateNoticeRequest $request)
    {
        $input = $request->all();

        \NoticeRepository::createNotice($input);

        return Redirect::route('backend::admin.notices.index');
    }

    public function edit($notice_id)
    {
        $notice = \NoticeRepository::find($notice_id);

        return ViewHelper::backView('notices.edit', compact('notice'));
    }

    public function update($notice_id, CreateNoticeRequest $request)
    {
        \NoticeRepository::updateNotice($notice_id, $request->all());

        return Redirect::back();
    }

    public function destroy($notice_id)
    {
        \NoticeRepository::deleteNotice($notice_id);

        return Redirect::route('backend::admin.notices.index');
    }

}