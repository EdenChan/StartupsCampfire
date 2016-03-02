@extends('back.layouts.app')

@section('content')
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
<form action="{{ route('backend::admin.register') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    管理员账号<input type="text" name="name" value="{{ old('login_condition') }}">
    管理员邮箱<input type="email" name="email" value="{{ old('email') }}">
    密码<input type="password" name="password">
    <input type="submit" value="新增"/>
</form>
@endsection