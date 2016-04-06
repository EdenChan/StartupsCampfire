<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Http\Requests\CreateEventRequest;

class AdminEventController extends AdminCommonController
{
    public function index()
    {
        $events = \EventRepository::getPaginatedModels(15);

        $events_count = \EventRepository::all()->count();

        return ViewHelper::backView('events.index', compact('events', 'events_count'));
    }

    public function show($event_id)
    {
        $event = \EventRepository::find($event_id);

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

        \EventRepository::createUserEvent($input);

        return Redirect::route('backend::admin.events.index');
    }

    public function edit($event_id)
    {
        $event = \EventRepository::find($event_id);

        return ViewHelper::backView('events.edit', compact('event'));
    }

    public function update($event_id, CreateEventRequest $request)
    {
        \EventRepository::updateEvent($event_id, $request->all());

        return Redirect::back();
    }

    public function destroy($event_id)
    {
        \EventRepository::deleteUserEvent($event_id);

        return Redirect::route('backend::admin.events.index');
    }

    public function getChangeEventState($event_id, $to_state)
    {
        $event = \EventRepository::find($event_id);

        $event->update(['is_passed' => $to_state]);

        return Redirect::back();
    }
}