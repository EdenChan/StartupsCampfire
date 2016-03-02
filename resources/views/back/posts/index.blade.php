@extends('back.layouts.app')

@section('admin-content')
    @include('back.posts.partials.post_title')
    <div class="am-g">
        <div class="am-u-sm-12">
            @if (count($posts) > 0)
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">动态作者</th>
                    <th class="table-title">动态标题</th>
                    <th class="table-date am-hide-sm-only">发布时间</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><a href="{{ route('frontend::user.profile', ['user_id' => $post->user->id]) }}" target="_blank">{{ $post->user->name }}</a></td>
                        <td><a href="{{ route('frontend::posts.show', ['id' => $post->id]) }}" target="_blank">{{ $post->title }}</a></td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                        <a href="{{ route('frontend::posts.show', ['id' => $post->id]) }}"
                                           target="_blank">
                                            <span class="am-icon-eye"></span> 查看详情
                                        </a>
                                    </button>
                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                            data-am-modal="{target: '#post-alert-{{ $post->id }}'}">
                                        <span class="am-icon-trash-o"></span>删除
                                    </button>
                                </div>
                            </div>
                        </td>
                        <div class="am-modal am-modal-alert" tabindex="-1" id="post-alert-{{ $post->id }}">
                            <div class="am-modal-dialog">
                                <div class="am-modal-hd">Startups Campfire</div>
                                <div class="am-modal-bd">
                                    亲，确认删除动态:{{ $post->name }}吗？
                                </div>
                                <div class="am-modal-footer">
                                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                    <form action="{{ route('backend::admin.posts.destroy', ['id' => $post->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-post-{{ $post->id }}">
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
                共{{ $posts_count }}条记录
                @include('back.partials.admin_paginator', ['paginator' => $posts]);
            </div>
            @else
                <h3 class="am-text-center">暂无用户动态~</h3>
            @endif
        </div>
    </div>
@endsection

