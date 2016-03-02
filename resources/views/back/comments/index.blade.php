@extends('back.layouts.app')

@section('admin-content')
    @include('back.comments.partials.comment_title')
    <div class="am-g">
        <div class="am-u-sm-12">
            @if (count($comments) > 0)
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">评论用户</th>
                    <th class="table-title">评论所属</th>
                    <th class="table-title">评论内容</th>
                    <th class="table-date am-hide-sm-only">评论时间</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td><a href="{{ route('frontend::user.profile', ['user_id' => $comment->user->id]) }}" target="_blank">{{ $comment->user->name }}</a></td>
                        <td>@if($comment->commentable_type == \StartupsCampfire\Models\Post::class)
                                <a href="{{ route('frontend::posts.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}" target="_blank">
                                    {{ $comment->commentable->title }}
                                </a>
                            @elseif($comment->commentable_type == \StartupsCampfire\Models\Event::class)
                                <a href="{{ route('frontend::events.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}" target="_blank">
                                    {{ $comment->commentable->title }}
                                </a>
                            @elseif($comment->commentable_type == \StartupsCampfire\Models\Notice::class)
                                <a href="{{ route('frontend::notices.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}" target="_blank">
                                    {{ $comment->commentable->title }}
                                </a>
                            @endif
                        </td>
                        <td>{{ str_limit($comment->body, 100) }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                        @if($comment->commentable_type == \StartupsCampfire\Models\Post::class)
                                            <a href="{{ route('frontend::posts.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}" target="_blank">
                                                <span class="am-icon-eye"></span> 查看详情
                                            </a>
                                        @elseif($comment->commentable_type == \StartupsCampfire\Models\Event::class)
                                            <a href="{{ route('frontend::events.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}" target="_blank">
                                                <span class="am-icon-eye"></span> 查看详情
                                            </a>
                                        @elseif($comment->commentable_type == \StartupsCampfire\Models\Notice::class)
                                            <a href="{{ route('frontend::notices.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}" target="_blank">
                                                <span class="am-icon-eye"></span> 查看详情
                                            </a>
                                        @endif
                                    </button>
                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                            data-am-modal="{target: '#comment-alert-{{ $comment->id }}'}">
                                        <span class="am-icon-trash-o"></span>删除
                                    </button>
                                </div>
                            </div>
                        </td>
                        <div class="am-modal am-modal-alert" tabindex="-1" id="comment-alert-{{ $comment->id }}">
                            <div class="am-modal-dialog">
                                <div class="am-modal-hd">Startups Campfire</div>
                                <div class="am-modal-bd">
                                    亲，确认删除评论:{{ $comment->id }}吗？
                                </div>
                                <div class="am-modal-footer">
                                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                    <form action="{{ route('backend::admin.comments.destroy', ['id' => $comment->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-comment-{{ $comment->id }}">
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
                共{{ $comments_count }}条记录
                @include('back.partials.admin_paginator', ['paginator' => $comments]);
            </div>
            @else
                <h3 class="am-text-center">暂无用户评论~</h3>
            @endif
        </div>
    </div>
@endsection

