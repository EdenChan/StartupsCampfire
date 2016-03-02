@extends('front.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header text-center">登录社区</h3>
        </div>
        <div class="container">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        登录/Login
                    </div>
                    <div class="panel-body">
                        @include('front.partials.errors')
                        <form action="{{ route('frontend::login') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="login_condition" class="col-sm-3 control-label">用户名/邮箱</label>

                                <div class="col-sm-6">
                                    <input type="text" name="login_condition" class="form-control" value="{{ old('login_condition') }}" placeholder="请输入用户名或邮箱登录">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">用户密码</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control" placeholder="请输入用户密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="fa fa-btn fa-sign-in"></i> 登录
                                    </button>
                                    <a class="btn btn-default btn-sm" href="{{ route('frontend::get_reset_email') }}">
                                        <i class="fa fa-btn fa-question"></i> 忘记密码
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
