@extends('front.layouts.app')
<header id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        @if(count($index_carousels) > 0)
            @foreach($index_carousels as $key=>$carousel)
            <li data-target="#myCarousel" data-slide-to="{{ $key }}"
                @if($key == 0)
                class="active"
                @endif></li>
            @endforeach
        @endif
    </ol>
    <div class="carousel-inner">
        @if(count($index_carousels) > 0)
            @foreach($index_carousels as $key=>$carousel)
            <div class="item
                @if($key == 0)
                active
                @endif">
                <a href="{{ $carousel->url }}" target="_blank"><div class="fill" style="background-size:100% 100%; background-image:url({{ $carousel->image_full_path }});"></div></a>
            </div>
            @endforeach
        @else
            <div class="item active">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
        @endif
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">热门活动</h3>
        </div>
        @foreach($hot_events as $event)
            <div class="col-md-4 col-sm-4">
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
    <br>
    <a href="{{ route('frontend::events.index') }}" class="btn btn-sm btn-default"><i class="fa fa-btn fa-angle-right"></i> 查看更多</a>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">社区热议</h3>
        </div>
        @foreach($hot_posts as $post)
        <div class="media col-sm-6 hot-posts-box">
            <div class="pull-left">
                <a href="{{ route('frontend::user.profile', ['user_id' => $post->user->id]) }}">
                    <img src="{{ $post->user->profile->avatar_full_path }}" class="img-circle" height="60" width="60">
                </a>
            </div>
            <div class="media-heading">
                <p><a href="{{ route('frontend::posts.show', ['id' => $post->id]) }}" class="text-primary">{{ $post->title }}</a></p>
            </div>
            <div class="media-body">
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
                <span class="timeago">{{ $post->created_at->diffForHumans() }}</span>
                <div class="pull-right">
                    <span class="badge">{{ $post->comment_count }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <br>
    <a class="btn btn-sm btn-default" href="{{ route('frontend::posts.index') }}"><i class="fa fa-btn fa-angle-right"></i> 查看更多</a>
    <div class="empty-row"></div>
    <div class="well">
        <div class="row">
            <div class="col-md-8">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
            </div>
        </div>
    </div>
@endsection