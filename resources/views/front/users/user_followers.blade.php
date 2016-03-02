@extends('front.layouts.app')

@section('content')
    <div class="empty-row"></div>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">{{ $user->name }}</a>粉丝列表
                </div>
                <div class="panel-body">
                    @if(count($followers) > 0)
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
                    @else
                        <h6 class="text-center">该用户暂无粉丝~</h6>
                    @endif
                    <div class="clearfix"></div>
                    {!! $followers->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
