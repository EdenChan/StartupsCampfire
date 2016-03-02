<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#scamp-navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('frontend::index') }}">Startups Campfire</a>
        </div>
        <div id="scamp-navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @foreach($navigation_tree as $navigation_level_1)
                    @if(count($navigation_level_1['children']) == 0)
                    <li><a href="{{ $navigation_level_1->url }}">{{ $navigation_level_1->name }}</a></li>
                    @else
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="{{ $navigation_level_1->url }}">{{ $navigation_level_1->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach($navigation_level_1['children'] as $navigation_level_2)
                                <li><a href="{{ $navigation_level_2->url }}">{{ $navigation_level_2->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <ul class="nav navbar-nav navbar-right ">
                    <li><a data-toggle="modal" data-target="#searchModal"><i class="fa fa-btn fa-search"></i> 搜索</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ route('frontend::register') }}"><i class="fa fa-btn fa-heart"></i> 注册</a></li>
                        <li><a href="{{ route('frontend::login') }}"><i class="fa fa-btn fa-sign-in"></i> 登录</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"><i class="fa fa-btn fa-user"></i>
                                {{ Auth::user('user')->name }}
                                @if($notifications_count > 0)
                                    ({{ $notifications_count }})
                                @endif
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu user-profile-menu list-unstyled">
                                <li>
                                    <a href="{{ route('frontend::posts.create') }}">
                                        <i class="fa fa-edit"></i>
                                        发布新动态
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend::events.create') }}">
                                        <i class="fa fa-users"></i>
                                        申请新活动
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend::user.focus_posts') }}">
                                        <i class="fa fa-eye"></i>
                                        我的关注
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend::notifications.index') }}">
                                        <i class="fa fa-envelope"></i>
                                        我的消息
                                        @if($notifications_count > 0)
                                            ({{ $notifications_count }})
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend::user.authprofile') }}">
                                        <i class="fa fa-user"></i>
                                        我的档案
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="{{ route('frontend::logout') }}">
                                        <i class="fa fa-btn fa-sign-out"></i>
                                        退出登录
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </ul>
        </div>
    </div>
</nav>