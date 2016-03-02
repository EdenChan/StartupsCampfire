@extends('front.layouts.app')

@section('content')
    @if($event->is_passed == 1)
    <h3 class="page-header">{{ $event->title }}
        <small>发起人
            @if($event->user_id == 0)
                {{ $event->event_user_name }}
            @else
                <a href="{{ route('frontend::user.profile', ['id' => $event->user->id]) }}">{{ $event->event_user_name }}</a>
            @endif
        </small>
    </h3>
    <div class="row">
        <div class="col-md-8 post-body">
            <p><i class="fa fa-clock-o"></i> 发布于{{ $event->created_at }}</p>
            <div class="empty-row"></div>
            <a href="{{ route('frontend::events.upvote', ['event_id' => $event->id]) }}"><i class="fa fa-thumbs-up"></i></a>
            ({{ $event->vote_count }}) •
            <a href="{{ route('frontend::events.downvote', ['event_id' => $event->id]) }}"><i class="fa fa-thumbs-down"></i></a>
            @if($event->user_id != 0 && $event->user->is_auth)
                • <a href="javascript:void(0)">
                    <i class="fa fa-trash-o" onclick="deleteResource({{ $event->id }}, 'event')"></i>
                </a>
                <form id="delete_event_{{ $event->id }}" action="{{ route('frontend::events.destroy', ['id' => $event->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            @endif
            <div class="empty-row"></div>
            <div class="event-cover row white-box">
                <img class="img-responsive col-md-6 event-cover-img" src="{{ $event->cover_full_path }}" alt="">
                <div class="col-md-6">
                    <br>
                    <p class="event-location">{{ $event->location }}</p>
                    <hr>
                    <p class="event-time">{{ $event->start_date }} 至 {{ $event->end_date }}</p>
                    <hr>
                    <p class="event-brief">{{ $event->brief }}</p>
                </div>
            </div>
            <br>
            <div class="event-content">{!! $event->body_parsed !!}</div>
            @include('front.partials.social_share')
            @define $commentable_model = $event
            @include('front.partials.comments')
        </div>
        <div class="col-md-4">
            @include('front.partials.sidebar_search')
            @include('front.events.partials.sidebar_hot_events')
            @include('front.partials.sidebar_notices')
        </div>
    </div>
    @else
    <br>
    <h1 class="text-center">该活动正在审核中</h1>
    @endif
@endsection
