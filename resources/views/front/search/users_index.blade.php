@extends('front.layouts.app')

@section('content')
    <h3 class="page-header">搜索结果
        <small>Search Result</small>
    </h3>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <ul class="nav nav-tabs user-info-nav">
                    <li class=""><a href="{{ route('frontend::search.posts').'?q='.Input::get('q') }}">文章结果</a></li>
                    <li class=""><a href="{{ route('frontend::search.events').'?q='.Input::get('q') }}">活动结果</a></li>
                    <li class="active"><a href="{{ route('frontend::search.users').'?q='.Input::get('q') }}">用户结果</a></li>
                </ul>
                <div class="panel-body remove-padding-vertically remove-padding-horizontal">
                    <div class="tab-content">
                        <div class="tab-pane active" id="recent_events">
                            <ul class="list-group">
                                @if(count($users) > 0)
                                    @foreach($users as $user)
                                        <div class="user-avatar-list">
                                            <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">
                                                <img src="{{ $user->profile->avatar_full_path }}" class="img-circle user-avatar-list-img">
                                            </a>
                                            <div class="user-avatar-list-name text-center">
                                                <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">{{ $user->name }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h6 class="text-center">没有搜到对应的用户~</h6>
                                @endif
                                <div class="clearfix"></div>
                                <div class="pull-right">
                                    {!! $users->appends(Request::except('page'))->render() !!}
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('front.partials.sidebar_search')
            @include('front.posts.partials.sidebar_hot_posts')
            @include('front.partials.sidebar_notices')
            </div>
        </div>
    </div>
@endsection
