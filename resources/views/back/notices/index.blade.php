@extends('back.layouts.app')

@section('admin-content')
    @include('back.notices.partials.notice_title')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-plus"></span>
                        <a href="{{ route('backend::admin.notices.create') }}">发布站点公告</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12">
            @if (count($notices) > 0)
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">公告标题</th>
                    <th class="table-date am-hide-sm-only">创建日期</th>
                    <th class="table-date am-hide-sm-only">修改日期</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($notices as $notice)
                    <tr>
                        <td>{{ $notice->id }}</td>
                        <td>{{ $notice->title }}</td>
                        <td>{{ $notice->created_at }}</td>
                        <td>{{ $notice->updated_at }}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                        <a href="{{ route('backend::admin.notices.edit', ['id' => $notice->id]) }}">
                                            <span class="am-icon-pencil-square-o"></span>
                                            编辑公告
                                        </a>
                                    </button>
                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                            data-am-modal="{target: '#notice-alert-{{ $notice->id }}'}">
                                        <span class="am-icon-trash-o"></span>删除
                                    </button>
                                </div>
                            </div>
                        </td>
                        <div class="am-modal am-modal-alert" tabindex="-1" id="notice-alert-{{ $notice->id }}">
                            <div class="am-modal-dialog">
                                <div class="am-modal-hd">Startups Campfire</div>
                                <div class="am-modal-bd">
                                    亲，确认删除公告:{{ $notice->title }}吗？
                                </div>
                                <div class="am-modal-footer">
                                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                    <form action="{{ route('backend::admin.notices.destroy', ['id' => $notice->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-post-{{ $notice->id }}">
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
                共{{ $notices_count }}条记录
                @include('back.partials.admin_paginator', ['paginator' => $notices]);
            </div>
            @else
                <h3 class="am-text-center">暂无站点公告~</h3>
            @endif
        </div>
    </div>
@endsection

