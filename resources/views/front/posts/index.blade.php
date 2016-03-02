@extends('front.layouts.app')

@section('content')
    <h3 class="page-header">社区话题
        <small>We're discussing</small>
    </h3>
    <div class="row">
        <div class="col-md-8">
            @if (count($posts) > 0)
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            最新热点
                            @define $filter_url_segment = 'frontend::posts.index'
                            @include ('front.partials.filter_bar')
                        </div>
                        <div class="panel-body">
                            @foreach($posts as $post)
                            <div class="media hot-posts-box">
                                <div class="pull-left">
                                    <a href="{{ route('frontend::user.profile', ['user_id' => $post->user->id]) }}">
                                        <img src="{{ $post->user->profile->avatar_full_path }}" class="img-circle" height="60" width="60">
                                    </a>
                                </div>
                                <div class="media-heading">
                                    <p><a href="{{ route('frontend::posts.show', ['id' => $post->id]) }}" class="text-primary">{{ $post->title }}</a></p>
                                </div>
                                <div class="media-body meta">
                                    <a href="{{ route('frontend::posts.upvote', ['post_id' => $post->id]) }}" class="remove-padding-left">
                                        <span class="fa fa-thumbs-o-up"> {{ $post->vote_count }}</span>
                                    </a>
                                    <span> • </span>作者
                                    <a href="{{ route('frontend::user.profile', ['user_id' => $post->user->id]) }}">
                                        {{ $post->user->name }}
                                    </a>
                                    <span> •  </span>分类
                                    <a href="{{ route('frontend::categories.show', ['url_tag' => $post->category->url_tag]) }}">
                                        {{ $post->category->content }}
                                    </a>
                                    <span> • </span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                    <div class="pull-right">
                                        <span class="badge">{{ $post->comment_count }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="pull-right">
                                {!! $posts->appends(Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @include('front.partials.category_tree_display')
        </div>
        <div class="col-md-4">
            @include('front.partials.sidebar_search')
            @include('front.posts.partials.sidebar_hot_posts')
            @include('front.partials.sidebar_notices')
            </div>
        </div>
    </div>
@endsection
