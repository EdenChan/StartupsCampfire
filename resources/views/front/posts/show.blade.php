@extends('front.layouts.app')

@section('content')
    <div class="container">
        <h3 class="page-header">{{ $post->title }}
            <small>作者 <a href="{{ route('frontend::user.profile', ['user_id' => $post->user->id]) }}">{{ $post->user->name }}</a> |
                分类 <a href="{{ route('frontend::categories.show', ['url_tag' => $post->category->url_tag]) }}" >{{ $post->category->content }}</a>
            </small>
        </h3>
        <div class="row">
            <div class="col-md-8 post-body">
                <p><i class="fa fa-clock-o"></i> 发布于{{ $post->created_at->diffForHumans() }}</p>
                <div class="empty-row"></div>
                <a href="{{ route('frontend::posts.upvote', ['post_id' => $post->id]) }}"><i class="fa fa-thumbs-up"></i></a>
                ({{ $post->vote_count }}) •
                <a href="{{ route('frontend::posts.downvote', ['post_id' => $post->id]) }}"><i class="fa fa-thumbs-down"></i></a> •
                @if ($is_favorite)
                    <a href="{{ route('frontend::posts.addFavorite', ['post_id' => $post->id]) }}"><i class="fa fa-heart-o"></i> 取消收藏</a>
                @else
                    <a href="{{ route('frontend::posts.addFavorite', ['post_id' => $post->id]) }}"><i class="fa fa-heart"></i> 收藏</a>
                @endif
                @if($post->user->is_auth)
                    • <a href="javascript:void(0)">
                        <i class="fa fa-trash-o" onclick="deleteResource({{ $post->id }}, 'post')"></i>
                    </a>
                    <form id="delete_post_{{ $post->id }}" action="{{ route('frontend::posts.destroy', ['id' => $post->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                @endif
                <span class="pull-right"><small>共被{{ $post->favoritedBy->count() }}位用户收藏</small></span>
                <div class="empty-row"></div>
                <div class="post-content">{!! $post->body_parsed !!}</div>
                @include('front.partials.social_share')
                @define $commentable_model = $post
                @include('front.partials.comments')
            </div>
            <div class="col-md-4">
                @include('front.partials.sidebar_search')
                @include('front.posts.partials.sidebar_hot_posts')
                @include('front.partials.sidebar_notices')
            </div>
        </div>
    </div>
@endsection
