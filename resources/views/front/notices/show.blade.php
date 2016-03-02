@extends('front.layouts.app')

@section('content')
    <div class="container">
        <h3 class="page-header">{{ $notice->title }}
        </h3>
        <div class="row">
            <div class="col-md-8 post-body">
                <p><i class="fa fa-clock-o"></i> 发布于{{ $notice->created_at->diffForHumans() }}</p>
                <div class="empty-row"></div>
                <div class="post-content">{!! $notice->content !!}</div>
                @define $commentable_model = $notice
                @include('front.partials.comments')
            </div>
            <div class="col-md-4">
                @include('front.partials.sidebar_search')
                @include('front.partials.sidebar_notices')
            </div>
        </div>
    </div>
@endsection
