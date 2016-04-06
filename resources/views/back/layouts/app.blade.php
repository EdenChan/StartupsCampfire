<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Startups Campfire Admin</title>
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ asset('css/amazeui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/amazeui.datetimepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
    <script src="{{ asset('scripts/jquery.min.js') }}"></script>
    <script src="{{ asset('scripts/amazeui.min.js') }}"></script>
    <script src="{{ asset('scripts/amazeui.datetimepicker.min.js') }}"></script>
</head>
<body>
    <header class="am-topbar admin-header">
        <div class="am-topbar-brand">
            <strong>Startups Campfire</strong><small>管理后台</small>
        </div>
        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
                <li class="am-dropdown" data-am-dropdown>
                    <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                        <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="{{ url('admin/logout') }}"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <div class="am-cf admin-main">
        @include('back.partials.sidebar')
        <div class="admin-content">
            @yield('admin-content')
        </div>
    </div>
    <hr>
    <footer data-am-widget="footer" class="am-footer am-footer-default">
        <div class="am-footer-switch">
            <span class="am-footer-ysp">
                  Powered By
            </span>
            <span class="am-footer-divider"> | </span>
            <a class="am-footer-desktop" href="http://amazeui.org/" target="_blank">
                AmazeUI
            </a>
        </div>
        <div class="am-footer-miscs ">
            <p>Edited by <a href="https://github.com/EdenChan" target="_blank" class="">EdenChan</a></p>
        </div>
    </footer>
@yield('extra_scripts')
</body>
</html>
