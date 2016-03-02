@extends('front.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header text-center">重置密码</h3>
        </div>
        <div class="container">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        重置用户密码
                    </div>
                    <div class="panel-body">
                        @include('front.partials.errors')
                        <form action="{{ route('frontend::post_reset_password') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">邮箱</label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="请输入用户邮箱">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">新密码</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="请输入新密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-3 control-label">确认新密码</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('email') }}" placeholder="请确认新密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="fa fa-btn fa-recycle"></i> 重置密码
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection