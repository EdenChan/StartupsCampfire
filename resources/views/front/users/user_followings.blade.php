@extends('front.layouts.app')

@section('content')
    <div class="empty-row"></div>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">{{ $user->name }}</a>用户关注
                </div>
                <div class="panel-body">
                    @if(count($followings) > 0)
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
                    @else
                        <h6 class="text-center">该用户暂无关注~</h6>
                    @endif
                    <div class="clearfix"></div>
                    {!! $followings->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
