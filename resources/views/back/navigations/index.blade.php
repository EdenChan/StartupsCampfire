@extends('back.layouts.app')

@section('admin-content')
    <div class="am-cf am-padding">
        @include('back.navigations.partials.navigation_title')
    </div>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-plus"></span>
                        <a href="{{ route('backend::admin.navigations.create') }}">新增导航</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12">
            @if (count($navigations) > 0)
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">导航内容</th>
                    <th class="table-title">导航层级</th>
                    <th class="table-title">上级导航</th>
                    <th class="table-date am-hide-sm-only">创建日期</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($navigations as $navigation)
                    <tr>
                        <td>{{ $navigation->id }}</td>
                        <td>{{ $navigation->name }}</td>
                        <td>{{ $navigation->nav_depth }}</td>
                        <td>{{ $navigation->parent['name'] ? $navigation->parent['name'] : '无' }}</td>
                        <td>{{ $navigation->created_at }}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{ route('backend::admin.navigations.edit', ['id' => $navigation->id]) }}">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                        <span class="am-icon-pencil-square-o"></span>
                                        编辑
                                    </button>
                                    </a>
                                    <a href="javascript:;">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                            data-am-modal="{target: '#nav-alert-{{ $navigation->id }}'}">
                                        <span class="am-icon-trash-o"></span>删除
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <div class="am-modal am-modal-alert" tabindex="-1" id="nav-alert-{{ $navigation->id }}">
                            <div class="am-modal-dialog">
                                <div class="am-modal-hd">Startups Campfire</div>
                                <div class="am-modal-bd">
                                    亲，确认删除导航{{ $navigation->name }}吗？
                                </div>
                                <div class="am-modal-footer">
                                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                    <form action="{{ route('backend::admin.navigations.destroy', ['id' => $navigation->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit">
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
            @endif
            <hr>
            <div class="am-cf">
                共{{ $navigation_count }}条记录
                @include('back.partials.admin_paginator', ['paginator' => $navigations]);
            </div>
        </div>
    </div>
@endsection

