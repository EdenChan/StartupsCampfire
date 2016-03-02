@extends('front.layouts.app')

@section('content')
    <div class="container user-profile">
        @include('front.profiles.partials.sidebar')
        <div class="col-md-9">
            @if ($user->profile->education)
                <div class="box text-center">{{ $user->profile->description }}</div>
            @endif
            @if(count($followings) > 0)
                <div>用户关注：</div>
                @foreach($followings as $following)
                    <div class="user-avatar-list">
                        <a href="{{ route('frontend::user.profile', ['user_id' => $following->id]) }}">
                            <img src="{{ $following->profile->avatar_full_path }}" class="img-circle user-avatar-list-img">
                        </a>
                        <div class="user-avatar-list-name text-center">
                            <a href="{{ route('frontend::user.profile', ['user_id' => $following->id]) }}">{{ $following->name }}</a>
                        </div>
                        @if($user->is_auth)
                            <a class="btn btn-xs btn-default" href="{{ route('frontend::user.unfollow', ['user_id' => $following->id]) }}">
                                <small>取消关注</small>
                            </a>
                        @endif
                    </div>
                @endforeach
                <div class="clearfix"></div>
                @if(count($followings) == $record_limit)
                    <a class="btn btn-xs btn-default" href="{{ route('frontend::user.followings', ['user_id' => $user->id]) }}">
                        <i class="fa fa-btn fa-angle-right"></i> <small>more</small>
                    </a>
                @endif
                <hr>
            @endif
            @if(count($followers) > 0)
                <div>用户粉丝：</div>
                @foreach($followers as $follower)
                    <div class="user-avatar-list">
                        <a href="{{ route('frontend::user.profile', ['user_id' => $follower->id]) }}">
                            <img src="{{ $follower->profile->avatar_full_path }}" class="img-circle user-avatar-list-img">
                        </a>
                        <div class="user-avatar-list-name text-center">
                            <a href="{{ route('frontend::user.profile', ['user_id' => $follower->id]) }}">{{ $follower->name }}</a>
                        </div>
                        @if($user->is_auth)
                            <a class="btn btn-xs btn-default" href="{{ route('frontend::user.remove_follower', ['user_id' => $follower->id]) }}">
                                <small>移除粉丝</small>
                            </a>
                        @endif
                    </div>
                @endforeach
                <div class="clearfix"></div>
                @if(count($follower) == $record_limit)
                    <a class="btn btn-xs btn-default" href="{{ route('frontend::user.followers', ['user_id' => $user->id]) }}">
                        <i class="fa fa-btn fa-angle-right"></i> <small>more</small>
                    </a>
                @endif
            <hr>
            @endif
            <div class="panel panel-default">
                <ul class="nav nav-tabs user-info-nav" role="tablist">
                    <li class="active"><a href="#recent_replies" role="tab" data-toggle="tab">最新评论</a></li>
                    <li class=""><a href="#recent_posts" role="tab" data-toggle="tab">最近主题</a></li>
                    <li class=""><a href="#recent_events" role="tab" data-toggle="tab">最新活动</a></li>
                    <li class=""><a href="#recent_favorites" role="tab" data-toggle="tab">收藏的动态</a></li>
                </ul>
                <div class="panel-body remove-padding-vertically remove-padding-horizontal">
                    <div class="tab-content">
                        <div class="tab-pane active" id="recent_replies">
                            <ul class="list-group">
                                @if (count($comments) > 0)
                                    @foreach ($comments as $comment)
                                    <li class="list-group-item">
                                        @if($comment->commentable_type == \StartupsCampfire\Models\Post::class)
                                            <a href="{{ route('frontend::posts.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}">
                                                {{ $comment->commentable->title }}
                                            </a>
                                        @elseif($comment->commentable_type == \StartupsCampfire\Models\Event::class)
                                            <a href="{{ route('frontend::events.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}">
                                                {{ $comment->commentable->title }}
                                            </a>
                                        @endif
                                        <span class="meta">
                                           评论于 {{ $comment->created_at->diffForHumans() }}
                                            @if($user->is_auth)
                                                • <a href="javascript:void(0)">
                                                    <i class="fa fa-trash-o" onclick="deleteResource({{ $comment->id }}, 'comment')"></i>
                                                </a>
                                                <form id="delete_comment_{{ $comment->id }}" action="{{ route('frontend::comments.destroy', ['id' => $comment->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @endif
                                        </span>
                                        <div>
                                            <p>{!! $comment->body_parsed !!}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if(count($comments) == $record_limit)
                                        <br>
                                        <a class="btn btn-xs btn-default" href="{{ route('frontend::user.comments', ['user_id' => $user->id]) }}">
                                            <i class="fa fa-btn fa-angle-right"></i> <small>more</small>
                                        </a>
                                    @endif
                                @else
                                    <h6 class="text-center">该用户暂无评论~</h6>
                                @endif
                            </ul>
                        </div>
                        <div class="tab-pane" id="recent_posts">
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
                                            评论数 {{ $post->comment_count }} •
                                            点赞数 {{ $post->vote_count }} •
                                            收藏数 {{ $post->favoritedBy->count() }}
                                            @if($user->is_auth)
                                                • <a href="javascript:void(0)">
                                                    <i class="fa fa-trash-o" onclick="deleteResource({{ $post->id }}, 'post')"></i>
                                                </a>
                                                <form id="delete_post_{{ $post->id }}" action="{{ route('frontend::posts.destroy', ['id' => $post->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @endif
                                        </span>
                                    </li>
                                    @endforeach
                                    @if(count($posts) == $record_limit)
                                        <br>
                                        <a class="btn btn-xs btn-default" href="{{ route('frontend::user.posts', ['user_id' => $user->id]) }}">
                                            <i class="fa fa-btn fa-angle-right"></i> <small>more</small>
                                        </a>
                                    @endif
                                @else
                                    <h6 class="text-center">该用户暂无动态~</h6>
                                @endif
                            </ul>
                        </div>
                        <div class="tab-pane" id="recent_events">
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
                                            @if($user->is_auth)
                                                • <a href="javascript:void(0)">
                                                    <i class="fa fa-trash-o" onclick="deleteResource({{ $event->id }}, 'event')"></i>
                                                </a>
                                                <form id="delete_event_{{ $event->id }}" action="{{ route('frontend::events.destroy', ['id' => $event->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @endif
                                        </span>
                                        </li>
                                    @endforeach
                                    @if(count($events) == $record_limit)
                                        <br>
                                        <a class="btn btn-xs btn-default" href="{{ route('frontend::user.events', ['user_id' => $user->id]) }}">
                                            <i class="fa fa-btn fa-angle-right"></i> <small>more</small>
                                        </a>
                                    @endif
                                @else
                                    <h6 class="text-center">该用户暂未发起过活动~</h6>
                                @endif
                            </ul>
                        </div>
                        <div class="tab-pane" id="recent_favorites">
                            <ul class="list-group">
                                @if (count($favorites) > 0)
                                    @foreach ($favorites as $favorite)
                                        <li class="list-group-item">
                                            <a href="{{ route('frontend::posts.show', ['id' => $favorite->id]) }}">
                                                {{ $favorite->title }}
                                            </a>
                                            <span class="meta">
                                                作者 <a href="{{ route('frontend::user.profile', ['user_id' => $favorite->user->id]) }}">{{ $favorite->user->name }}</a> •
                                                发布于 {{ $favorite->created_at->diffForHumans() }} •
                                                分类 <a href="{{ route('frontend::categories.show', ['url_tag' => $favorite->category->url_tag]) }}">{{ $favorite->category->content }}</a> •
                                                评论数 {{ $favorite->comment_count }} •
                                                点赞数 {{ $favorite->vote_count }} •
                                                收藏数 {{ $favorite->favoritedBy->count() }}
                                                @if($user->is_auth)
                                                    • <a href="javascript:void(0)">
                                                        <i class="fa fa-trash-o" onclick="deleteResource({{ $favorite->id }}, 'favorite')"></i>
                                                    </a>
                                                    <form method="get" id="delete_favorite_{{ $favorite->id }}" action="{{ route('frontend::posts.addFavorite', ['post_id' => $favorite->id]) }}" method="POST">
                                                    </form>
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                    @if(count($favorites) == $record_limit)
                                        <br>
                                        <a class="btn btn-xs btn-default" href="{{ route('frontend::user.favorites', ['user_id' => $user->id]) }}">
                                            <i class="fa fa-btn fa-angle-right"></i> <small>more</small>
                                        </a>
                                    @endif
                                @else
                                    <h6 class="text-center">该用户暂无收藏~</h6>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
