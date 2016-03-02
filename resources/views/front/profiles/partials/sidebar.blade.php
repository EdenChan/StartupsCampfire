<div class="col-md-3">
    <div class="user-info-sidebar white-box">
        <a href="{{ route('frontend::user.profile', ['user_id' => $user->id]) }}">
            <img src="{{ $profile->avatar_full_path }}" class="user-avatar img-responsive">
        </a>
        <br>
        <br>
        <strong>用户名：</strong>{{ $user->name }}
        <hr>
        <ul class="list-unstyled">
            <li>
                <strong>邮箱：</strong>{{ $user->email }}
            </li>
            <li>
                <strong>性别：</strong>{{ $profile->gender_text}}
            </li>
            @if ($profile->education)
                <li><strong>毕业院校：</strong>{{ $profile->education }}</li>
            @endif
            @if ($profile->address)
                <li><strong>所在地：</strong><i class="fa fa-map-marker"></i> {{ $profile->address }}</li>
            @endif
            @if ($profile->phone)
                <li><strong>联系电话：</strong>{{ $profile->phone }}</li>
            @endif
            @if ($profile->experience)
                <li><strong>工作经验：</strong>{{ $profile->experience }}</li>
            @endif
            @if ($profile->qq)
                <li><strong>qq号：</strong>{{ $profile->qq }}</li>
            @endif
            @if ($profile->weibo)
                <li><strong>微博地址：</strong><a href="{{ $profile->weibo }}" target="_blank">点击访问</a></li>
            @endif
            @if ($profile->weibo)
                <li><strong>微信号：</strong>{{ $profile->wechat }}</li>
            @endif
        </ul>
        <ul class="list-unstyled user-friends-count">
            <li>
                <span>{{ $user->followers_count }}</span>
                粉丝
            </li>
            <li>
                <span>{{ $user->followings_count }}</span>
                关注
            </li>
        </ul>
        @if ($user->is_auth)
            <a class="btn btn-success btn-block text-left" href="{{ route('frontend::user.authprofile.edit') }}">更新用户信息</a>
        @elseif(!$user->is_auth && !$user->following_user)
            <a class="btn btn-success btn-block text-left" href="{{ route('frontend::user.follow', ['user_id' => $user->id]) }}">添加关注</a>
        @elseif(!$user->is_auth && $user->following_user)
            <a class="btn btn-success btn-block text-left" href="{{ route('frontend::user.unfollow', ['user_id' => $user->id]) }}">取消关注</a>
        @endif
    </div>
</div>