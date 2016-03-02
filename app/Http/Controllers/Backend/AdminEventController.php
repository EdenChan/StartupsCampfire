<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\EventRepository;
use StartupsCampfire\Http\Requests\CreateEventRequest;

class AdminEventController extends AdminCommonController
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        parent::__construct();

        $this->eventRepository = $eventRepository;
    }

    public function index()
    {
        $events = $this->eventRepository->getPaginatedModels(15);

        $events_count = $this->eventRepository->all()->count();

        return ViewHelper::backView('events.index', compact('events', 'events_count'));
    }

    public function show($event_id)
    {
        $event = $this->eventRepository->find($event_id);

        return ViewHelper::backView('events.show', compact('event'));
    }

    public function create()
    {
        return ViewHelper::backView('events.create');
    }

    public function store(CreateEventRequest $request)
    {
        $input = $request->all();
        // 平台活动将发布者id约定设置为0
        $input['user_id'] = 0;
        // 平台活动默认已通过审核
        $input['is_passed'] = 1;

        $this->eventRepository->createUserEvent($input);

        return Redirect::route('backend::admin.events.index');
    }

    public function edit($event_id)
    {
        $event = $this->eventRepository->find($event_id);

        return ViewHelper::backView('events.edit', compact('event'));
    }

    public function update($event_id, CreateEventRequest $request)
    {
        $this->eventRepository->updateEvent($event_id, $request->all());

        return Redirect::back();
    }

    public function destroy($event_id)
    {
        $this->eventRepository->deleteUserEvent($event_id);

        return Redirect::route('backend::admin.events.index');
    }

    public function getChangeEventState($event_id, $to_state)
    {
        $event = $this->eventRepository->find($event_id);

        $event->update(['is_passed' => $to_state]);

        return Redirect::back();
    }
}