@extends('front.layouts.app')

@section('content')
    <div class="empty-row"></div>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">{{ $user->name }}</a>评论列表
                </div>
                <div class="panel-body">
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
                                    @elseif($comment->commentable_type == \StartupsCampfire\Models\Notice::class)
                                        <a href="{{ route('frontend::notices.show', ['id' =>  $comment->commentable->id]).'#scamp_comment_' . $comment->id }}">
                                            {{ $comment->commentable->title }}
                                        </a>
                                    @endif
                                    <span class="meta">
                                       评论于 {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                    <div>
                                        <p>{!! $comment->body_parsed !!}</p>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <h6 class="text-center">该用户暂无评论~</h6>
                        @endif
                    </ul>
                    {!! $comments->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
