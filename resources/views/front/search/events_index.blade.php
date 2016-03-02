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
                    <li class="active"><a href="{{ route('frontend::search.events').'?q='.Input::get('q') }}">活动结果</a></li>
                    <li class=""><a href="{{ route('frontend::search.users').'?q='.Input::get('q') }}">用户结果</a></li>
                </ul>
                <div class="panel-body remove-padding-vertically remove-padding-horizontal">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <ul class="list-group">
                                @if (count($events) > 0)
                                    @foreach ($events as $event)
                                        <li class="list-group-item">
                                            <a href="{{ route('frontend::events.show', ['id' => $event->id]) }}">
                                                {{ $event->title }}
                                            </a>
                                        <span class="meta">
                                            发起于 {{ $event->created_at->diffForHumans() }} •
                                            评论数 {{ $event->comment_count }} •
                                            点赞数 {{ $event->vote_count }} •
                                            活动地点 {{ $event->location }}
                                        </span>
                                        </li>
                                    @endforeach
                                    <div class="pull-right">
                                        {!! $events->appends(Request::except('page'))->render() !!}
                                    </div>
                                @else
                                    <h6 class="text-center">没有搜到对应的活动~</h6>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('front.partials.sidebar_search')
            @include('front.events.partials.sidebar_hot_events')
            @include('front.partials.sidebar_notices')
            </div>
        </div>
    </div>
@endsection
