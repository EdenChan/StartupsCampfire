<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Http\Requests\CreateEventRequest;

class EventController extends CommonController
{
    public function __construct()
    {
        // 中间件设置
        $this->middleware('auth', ['only' => ['create', 'store', 'destroy', 'getUpvoteEvent', 'getDownvoteEvent']]);
    }

    public function index()
    {
        $filter = Input::get('filter');

        $events = \EventRepository::getPaginatedEvents(10, $filter);

        return ViewHelper::frontView('events.index', compact('events'));
    }

    /**
     * 显示活动详情
     *
     * @param $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($event_id)
    {
        $event = \EventRepository::find($event_id);
        $hot_events = \EventRepository::getHotEvents(10);

        return ViewHelper::frontView('events.show', compact('event', 'hot_events'));
    }

    public function create()
    {
        return ViewHelper::frontView('events.create');
    }

    /**
     * 新增活动操作
     *
     * @param CreateEventRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateEventRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id('user');

        \EventRepository::createUserEvent($input);

        return Redirect::route('frontend::user.authprofile');
    }

    /**
     * 删除活动操作
     *
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($event_id)
    {
        $event = \EventRepository::find($event_id);

        $this->authorize('destroy', $event);

        \EventRepository::deleteUserEvent($event_id);

        return Redirect::route('frontend::user.events', ['user_id' => Auth::id('user')]);
    }

    /**
     * 取用户发布的活动
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserEvents()
    {
        $user_id = Auth::id('user');
        $user_name = Auth::user('user')->name;
        $events = \EventRepository::getPaginatedUserModels($user_id, 10);

        return ViewHelper::frontView('events.index', compact('user_name', 'events'));
    }

    /**
     * 支持活动
     *
     * @param $event_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUpvoteEvent($event_id)
    {
        \EventRepository::upvoteModel($event_id);

        return Redirect::back();
    }

    /**
     * 反对活动
     *
     * @param $event_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDownvoteEvent($event_id)
    {
        \EventRepository::downvoteModel($event_id);

        return Redirect::back();
    }
}
