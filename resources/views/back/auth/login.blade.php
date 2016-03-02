<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Startups Campfire Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ asset('css/amazeui.min.css') }}"/>
    <style>
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }
        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="am-g">
        <h1>Startups Campfire管理后台</h1>
        <p>分类管理、用户管理、活动管理、数据统计...</p>
    </div>
    <hr/>
</div>
<div class="am-g">
    <div class="am-u-lg-4 am-u-md-6 am-u-sm-centered">
        @include('back.partials.errors')
        <form action="{{ route('backend::admin.login') }}" method="POST" class="am-form">
            {{ csrf_field() }}
            <label for="email">管理员邮箱/用户名:</label>
            <input type="text" name="login_condition" id="login_condition" value="{{ old('login_condition') }}" placeholder="请输入管理员邮箱或用户名">
            <br>
            <label for="password">密码:</label>
            <input type="password" name="password" placeholder="请输入管理员密码">
            <br>
            <label for="remember-me">
                <input id="remember-me" type="checkbox">
                记住密码
            </label>
            <br />
            <div class="am-cf">
                <input type="submit" name="" value="登录" class="am-btn am-btn-primary am-btn-sm am-fl">
            </div>
        </form>
    </div>
</div>
</body>
</html>