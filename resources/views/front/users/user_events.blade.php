@extends('front.layouts.app')

@section('content')
    <div class="empty-row"></div>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">{{ $user->name }}</a>活动列表
                </div>
                <div class="panel-body">
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
                        @else
                            <h6 class="text-center">该用户暂未发起过活动~</h6>
                        @endif
                    </ul>
                    {!! $events->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
