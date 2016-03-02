@extends('front.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">社区活动
                <small>创客Party</small>
            </h3>
        </div>
    </div>
    @if (count($events) > 0)
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                热门活动
                @define $filter_url_segment = 'frontend::events.index'
                @include ('front.partials.filter_bar')
            </div>
        <div class="panel-body">
        @foreach ($events as $event)
        <div class="col-md-3">
            <div class="event-box">
                <a href="{{ route('frontend::events.show', ['id' => $event->id]) }}" class="event-sub-box">
                    <img src="{{ $event->cover_full_path }}" class="img-responsive" alt="">
                    <div class="event-caption">
                        <div class="event-caption-content">
                            <div class="event-location">{{ $event->location }}</div>
                            <hr>
                            <div class="event-time">{{ $event->start_date }}至<br>{{ $event->end_date }}</div>
                        </div>
                    </div>
                </a>
                <h4>
                    <a href="{{ route('frontend::events.show', ['id' => $event->id]) }}">{{ $event->title }}</a>
                </h4>
                <p>
                    <a href="{{ route('frontend::events.upvote', ['event_id' => $event->id]) }}" class="remove-padding-left">
                        <span class="fa fa-thumbs-o-up"> {{ $event->vote_count }}</span>
                    </a>| 发起人
                    @if($event->user_id == 0)
                        {{ $event->event_user_name }}
                    @else
                        <a href="{{ route('frontend::user.profile', ['user_id' => $event->user->id]) }}">{{ $event->event_user_name }}</a>
                    @endif
                </p>
                <p>
                    {{ $event->brief }}
                </p>
            </div>
        </div>
        @endforeach
        </div>
        </div>
    </div>
    {!! $events->render() !!}
    @endif
@endsection
