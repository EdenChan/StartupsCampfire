@extends('back.layouts.app')

@section('admin-content')
    @include('back.users.partials.user_title')
    <div class="am-g">
        <div class="am-u-sm-12">
            @if (count($users) > 0)
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">用户名</th>
                    <th class="table-date am-hide-sm-only">用户头像</th>
                    <th class="table-date am-hide-sm-only">注册日期</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}" target="_blank">{{ $user->name }}</a></td>
                        <td><img src="{{ $user->profile->avatar_full_path }}" alt="" width="60" height="60" style="border-radius: 30px;" /></td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                            data-am-modal="{target: '#user-alert-{{ $user->id }}'}">
                                        <span class="am-icon-trash-o"></span>删除
                                    </button>
                                </div>
                            </div>
                        </td>
                        <div class="am-modal am-modal-alert" tabindex="-1" id="user-alert-{{ $user->id }}">
                            <div class="am-modal-dialog">
                                <div class="am-modal-hd">Startups Campfire</div>
                                <div class="am-modal-bd">
                                    亲，确认删除用户:{{ $user->name }}吗？
                                </div>
                                <div class="am-modal-footer">
                                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                    <form action="{{ route('backend::admin.users.destroy', ['id' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-user-{{ $user->id }}">
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
                共{{ $users_count }}条记录
                @include('back.partials.admin_paginator', ['paginator' => $users]);
            </div>
            @else
                <h3 class="am-text-center">暂无注册用户~</h3>
            @endif
        </div>
    </div>
@endsection

