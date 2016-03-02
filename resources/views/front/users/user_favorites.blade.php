@extends('front.layouts.app')

@section('content')
    <div class="empty-row"></div>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">{{ $user->name }}</a>收藏列表
                </div>
                <div class="panel-body">
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
                                            <form method="GET" id="delete_favorite_{{ $favorite->id }}" action="{{ route('frontend::posts.addFavorite', ['post_id' => $favorite->id]) }}">
                                            </form>
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <h6 class="text-center">该用户暂无收藏~</h6>
                        @endif
                    </ul>
                    {!! $favorites->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
