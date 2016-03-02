@extends('back.layouts.app')

@section('admin-content')
    @include('back.events.partials.event_title')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-plus"></span>
                        <a href="{{ route('backend::admin.events.create') }}">发布平台活动</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12">
            @if (count($events) > 0)
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">活动标题</th>
                    <th class="table-title">活动地点</th>
                    <th class="table-title">开始时间</th>
                    <th class="table-title">结束时间</th>
                    <th class="table-title">发起人</th>
                    <th class="table-title">活动封面</th>
                    <th class="table-title">审核状态</th>
                    <th class="table-date am-hide-sm-only">修改日期</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td>
                        @if( $event->user_id == 0)
                            <td>{{ $event->event_user_name }}</td>
                        @else
                            <td><a href="{{ route('frontend::user.profile', ['user_id' => $event->user->id]) }}">{{ $event->event_user_name }}</a></td>
                        @endif
                        <td><img src="{{ $event->cover_full_path }}" alt="" width="75" height="50" /></td>
                        <td>{{ $event->is_passed_text }}</td>
                        <td>{{ $event->updated_at }}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <div class="am-dropdown am-dropdown-up" data-am-dropdown>
                                        <button class="am-btn am-btn-xs am-btn-default am-dropdown-toggle" data-am-dropdown-toggle>
                                            审核<span class="am-icon-caret-up"></span>
                                        </button>
                                        <ul class="am-dropdown-content">
                                            <li><a href="{{ route('backend::admin.events.to_state', ['event_id' => $event->id, 'to_state' => 1]) }}">通过</a></li>
                                            <li class="am-divider"></li>
                                            <li><a href="{{ route('backend::admin.events.to_state', ['event_id' => $event->id, 'to_state' => 2]) }}">拒绝</a></li>
                                            <li class="am-divider"></li>
                                            <li><a href="{{ route('backend::admin.events.to_state', ['event_id' => $event->id, 'to_state' => 0]) }}">待定</a></li>
                                        </ul>
                                    </div>
                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                        @if( $event->user_id == 0)
                                        <a href="{{ route('backend::admin.events.edit', ['id' => $event->id]) }}">
                                            <span class="am-icon-pencil-square-o"></span>
                                            编辑事件
                                        </a>
                                        @else
                                        <a href="{{ route('backend::admin.events.show', ['id' => $event->id]) }}">
                                            <span class="am-icon-pencil-square-o"></span>
                                            查看详情
                                        </a>
                                        @endif
                                    </button>
                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                            data-am-modal="{target: '#event-alert-{{ $event->id }}'}">
                                        <span class="am-icon-trash-o"></span>删除
                                    </button>
                                </div>
                            </div>
                        </td>
                        <div class="am-modal am-modal-alert" tabindex="-1" id="event-alert-{{ $event->id }}">
                            <div class="am-modal-dialog">
                                <div class="am-modal-hd">Startups Campfire</div>
                                <div class="am-modal-bd">
                                    亲，确认删除活动:{{ $event->title }}吗？
                                </div>
                                <div class="am-modal-footer">
                                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                    <form action="{{ route('backend::admin.events.destroy', ['id' => $event->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-post-{{ $event->id }}">
                                            确定
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="am-cf">
                共{{ $events_count }}条记录
                @include('back.partials.admin_paginator', ['paginator' => $events]);
            </div>
            @endif
        </div>
    </div>
@endsection

