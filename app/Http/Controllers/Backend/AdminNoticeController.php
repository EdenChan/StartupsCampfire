<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\NoticeRepository;
use StartupsCampfire\Http\Requests\CreateNoticeRequest;

class AdminNoticeController extends AdminCommonController
{
    protected $noticeRepository;

    public function __construct(NoticeRepository $noticeRepository)
    {
        parent::__construct();

        $this->noticeRepository = $noticeRepository;
    }

    public function index()
    {
        $notices = $this->noticeRepository->getPaginatedModels(15);

        $notices_count = $this->noticeRepository->all()->count();

        return ViewHelper::backView('notices.index', compact('notices', 'notices_count'));
    }

    public function show($notice_id)
    {
        $notice = $this->noticeRepository->find($notice_id);

        return ViewHelper::backView('notices.show', compact('notice'));
    }

    public function create()
    {
        return ViewHelper::backView('notices.create');
    }

    public function store(CreateNoticeRequest $request)
    {
        $input = $request->all();

        $this->noticeRepository->createNotice($input);

        return Redirect::route('backend::admin.notices.index');
    }

    public function edit($notice_id)
    {
        $notice = $this->noticeRepository->find($notice_id);

        return ViewHelper::backView('notices.edit', compact('notice'));
    }

    public function update($notice_id, CreateNoticeRequest $request)
    {
        $this->noticeRepository->updateNotice($notice_id, $request->all());

        return Redirect::back();
    }

    public function destroy($notice_id)
    {
        $this->noticeRepository->deleteNotice($notice_id);

        return Redirect::route('backend::admin.notices.index');
    }

}