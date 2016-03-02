@extends('back.layouts.app')
@section('admin-content')
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>Index</small></div>
    </div>
    @if(!empty(Session::get('flush_message')))
    <div class="am-alert am-alert-success">
        {{ Session::get('flush_message') }}
    </div>
    @endif
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
        <li>
            <a href="{{ route('backend::admin.posts.index') }}" class="am-text-success">
                <span class="am-icon-btn am-icon-file-text"></span>
                <br/>所有动态<br/>{{ $post_count }}
            </a>
        </li>
        <li>
            <a href="{{ route('backend::admin.comments.index') }}" class="am-text-warning">
                <span class="am-icon-btn am-icon-comment"></span>
                <br/>所有评论<br/>{{ $comment_count }}
            </a>
        </li>
        <li><a href="{{ route('backend::admin.events.index') }}" class="am-text-danger">
                <span class="am-icon-btn am-icon-flag"></span>
                <br/>所有活动<br/>{{ $event_count }}
            </a>
        </li>
        <li><a href="{{ route('backend::admin.users.index') }}" class="am-text-secondary">
                <span class="am-icon-btn am-icon-user"></span>
                <br/>所有用户<br/>{{ $user_count }}
            </a>
        </li>
    </ul>
@endsection