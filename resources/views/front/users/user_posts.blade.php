@extends('front.layouts.app')

@section('content')
    <div class="empty-row"></div>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">{{ $user->name }}</a>动态列表
                </div>
                <div class="panel-body">
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
                        @else
                            <h6 class="text-center">该用户暂无动态~</h6>
                        @endif
                    </ul>
                    {!! $posts->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
