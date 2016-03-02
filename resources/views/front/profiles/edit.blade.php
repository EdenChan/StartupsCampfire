@extends('front.layouts.app')

@section('content')
	<div class="container user-profile">
        @define $is_auth = true
        @include('front.profiles.partials.sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    编辑个人信息
                </div>

                <div class="panel-body">
                    @include('front.partials.errors')
                    <form action="{{ route('frontend::user.authprofile.update', ['user_id' => $user->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">

                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="gender" class="col-sm-3 control-label">性别</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="0">男</option>
                                    <option value="1">女</option>
                                    <option value="2">保密</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">个人简介</label>

                            <div class="col-sm-6">
                                <input type="text" name="description" class="form-control" value="{{ $profile->description }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="col-sm-3 control-label">原头像</label>

                            <div class="col-sm-6">
                                <img src="{{ $profile->avatar_full_path }}" class="img-circle" height="60" width="60">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="col-sm-3 control-label">头像</label>

                            <div class="col-sm-6">
                                <input type="file" name="avatar" class="form-control" value="{{ $profile->avatar }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">毕业院校</label>

                            <div class="col-sm-6">
                                <input type="text" name="education" class="form-control" value="{{ $profile->education }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">从事职业</label>

                            <div class="col-sm-6">
                                <input type="text" name="occupation" class="form-control" value="{{ $profile->occupation }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">工作经验</label>

                            <div class="col-sm-6">
                                <input type="text" name="experience" class="form-control" value="{{ $profile->experience }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">所在地</label>

                            <div class="col-sm-6">
                                <input type="text" name="address" class="form-control" value="{{ $profile->address }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">联系电话</label>

                            <div class="col-sm-6">
                                <input type="text" name="phone" class="form-control" value="{{ $profile->phone }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">qq号</label>

                            <div class="col-sm-6">
                                <input type="text" name="qq" class="form-control" value="{{ $profile->qq }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">微博地址</label>

                            <div class="col-sm-6">
                                <input type="text" name="weibo" class="form-control" value="{{ $profile->weibo }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">微信号</label>

                            <div class="col-sm-6">
                                <input type="text" name="wechat" class="form-control" value="{{ $profile->wechat }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-sign-in"></i> 提交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <script>
        $('#gender option').eq({{ $profile->gender }}).attr('selected', true);
    </script>
@endsection
