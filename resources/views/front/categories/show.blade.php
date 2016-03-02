@extends('front.layouts.app')

@section('content')
    <h3 class="page-header">热门分类
        <small>Hot Categories</small>
    </h3>
    <div class="row">
        <div class="col-md-8">
            <!-- Current posts -->
            @if (count($posts) > 0)
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $category->content }}
                            <ul class="pull-right list-inline remove-margin-bottom">
                                <li>
                                    <a href="{{ route('frontend::categories.show', ['url_tag' => $category->url_tag]).'?filter=recent' }}">
                                        <i class="fa fa-clock-o"></i> 发表时间
                                    </a>
                                    <span class="divider"></span>
                                </li>
                                <li>
                                    <a href="{{ route('frontend::categories.show', ['url_tag' => $category->url_tag]).'?filter=vote' }}">
                                        <i class="fa fa-thumbs-up"> </i> 广受赞同
                                    </a>
                                    <span class="divider"></span>
                                </li>
                                <li>
                                    <a href="{{ route('frontend::categories.show', ['url_tag' => $category->url_tag]).'?filter=comment' }}">
                                        <i class="fa fa-comment"></i> 热点关注
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend::categories.show', ['url_tag' => $category->url_tag]).'?filter=nocomment' }}">
                                        <i class="fa fa-eye"></i> 人气寥寥
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            @foreach($posts as $post)
                                <div class="media hot-posts-box">
                                    <div class="pull-left">
                                        <a href="{{ url('/users/'.$post->user->id) }}">
                                            <img src="{{ $post->user->profile->avatar_full_path }}" class="img-circle" height="60" width="60">
                                        </a>
                                    </div>
                                    <div class="media-heading">
                                        <p><a href="{{ url('/posts/'.$post->id) }}" class="text-primary">{{ $post->title }}</a></p>
                                    </div>
                                    <div class="media-body meta">
                                        <a href="{{ url('/posts/'.$post->id.'/upvote') }}" class="remove-padding-left">
                                            <span class="fa fa-thumbs-o-up"> {{ $post->vote_count }}</span>
                                        </a>
                                        <span> • </span>作者
                                        <a href="{{ url('/users/'.$post->user->id) }}">
                                            {{ $post->user->name }}
                                        </a>
                                        <span> •  </span>分类
                                        <a href="{{ url('/categories/'.$post->category->url_tag) }}">
                                            {{ $post->category->content }}
                                        </a>
                                        <span> • </span>
                                        <span class="timeago">{{ $post->created_at->diffForHumans() }}</span>
                                        <div class="pull-right">
                                            <span class="badge">{{ count($post->comments) }}</span>
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
@endsection

