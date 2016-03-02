@extends('front.layouts.app')

@section('content')
    <h3 class="page-header">搜索结果
        <small>Search Result</small>
    </h3>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <ul class="nav nav-tabs user-info-nav">
                    <li class="active"><a href="{{ route('frontend::search.posts').'?q='.Input::get('q') }}">文章结果</a></li>
                    <li class=""><a href="{{ route('frontend::search.events').'?q='.Input::get('q') }}">活动结果</a></li>
                    <li class=""><a href="{{ route('frontend::search.users').'?q='.Input::get('q') }}">用户结果</a></li>
                </ul>
                <div class="panel-body remove-padding-vertically remove-padding-horizontal">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <ul class="list-group">
                                @if (count($posts) > 0)
                                    @foreach ($posts as $post)
                                        <li class="list-group-item">
                                            <a href="{{ route('frontend::posts.show', ['id' => $post->id]) }}">
                                                {{ $post->title }}
                                            </a>
                                        <span class="meta">
                                            发布于 {{ $post->created_at->diffForHumans() }} •
                                            分类 <a href="{{ route('frontend::categories.show', ['url_tag' => $post->category->url_tag]) }}">{{ $post->category->content }}</a> •
                                            评论数 {{ $post->comments_count }} •
                                            点赞数 {{ $post->vote_count }} •
                                            收藏数 {{ $post->favoritedBy->count() }}
                                        </span>
                                        </li>
                                    @endforeach
                                    <div class="pull-right">
                                        {!! $posts->appends(Request::except('page'))->render() !!}
                                    </div>
                                @else
                                    <h6 class="text-center">没有搜到对应的文章~</h6>
                                @endif
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
