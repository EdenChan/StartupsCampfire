@extends('back.layouts.app')

@section('admin-content')
    @include('back.events.partials.event_title')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <b>当前状态</b>:{{ $event->is_passed_text }}
            <div class="am-dropdown" data-am-dropdown>
                <button class="am-btn am-btn-default am-btn-primary am-btn-sm am-dropdown-toggle" data-am-dropdown-toggle>
                    审核<span class="am-icon-caret-down"></span>
                </button>
                <ul class="am-dropdown-content">
                    <li><a href="{{ route('backend::admin.events.to_state', ['event_id' => $event->id, 'to_state' => 1]) }}">通过</a></li>
                    <li class="am-divider"></li>
                    <li><a href="{{ route('backend::admin.events.to_state', ['event_id' => $event->id, 'to_state' => 2]) }}">拒绝</a></li>
                    <li class="am-divider"></li>
                    <li><a href="{{ route('backend::admin.events.to_state', ['event_id' => $event->id, 'to_state' => 0]) }}">待定</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="am-u-sm-12 am-u-sm-centered">
            <b>活动标题</b>:{{ $event->title }}
            <hr/>
        </div>
        <div class="am-u-sm-12 am-u-sm-centered">
            <b>活动封面</b>:<img src="{{ $event->cover_full_path }}" alt="" width="200" height="120" />
            <hr/>
        </div>
        <div class="am-u-sm-12 am-u-sm-centered">
            <b>开始时间</b>:{{ $event->start_date }} |
            <b>结束时间</b>:{{ $event->end_date }} |
            <b>活动地点</b>:{{ $event->location }}
            <hr/>
        </div>
        <div class="am-u-sm-12 am-u-sm-centered">
            <h6>活动简介</h6>
            <p>{{ $event->brief }}</p>
            <hr/>
        </div>
        <div class="am-u-sm-12 am-u-sm-centered">
            <h6>活动详情</h6>
            <p>{!! $event->content !!}</p>
            <hr/>
        </div>
    </div>

@endsection

