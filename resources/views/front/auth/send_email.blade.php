@extends('front.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header text-center">忘记密码</h3>
        </div>
        <div class="container">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        发送重置密码邮件
                    </div>
                    <div class="panel-body">
                        @include('front.partials.errors')
                        @if(!empty(Session::get('status')))
                            <div class="alert alert-success">
                                {{ Session::get('status') }}
                            </div>
                        @endif
                        <form action="{{ route('frontend::send_reset_email') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">邮箱</label>

                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="请输入用户邮箱">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="fa fa-btn fa-mail-forward"></i> 发送重置密码邮件
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
