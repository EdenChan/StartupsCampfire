@extends('back.layouts.app')

@section('admin-content')
    <div class="am-cf am-padding">
        @include('back.categories.partials.category_title')
    </div>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-table"></span>
                        <a href="{{ route('backend::admin.navigations.index') }}">导航列表</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12">
            <div class="container">
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="am-tabs am-margin" data-am-tabs="">
                                <ul class="am-tabs-nav am-nav am-nav-tabs">
                                    <li class="am-active"><a href="#tab1">新建导航</a></li>
                                </ul>
                                <div class="am-tabs-bd">
                                    @include('back.partials.errors')
                                    <form class="am-form" action="{{ route('backend::admin.navigations.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                上级导航
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                @include('back.partials.navigation_tree_select')
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                导航内容
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="name" id="name" type="text" class="am-input-sm"
                                                       value="{{ old('name') }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                导航Url
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="url" id="url" type="text" class="am-input-sm"
                                                       value="{{ old('url') }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">设置导航的Url</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                <button type="submit" class="am-btn am-btn-primary">新增导航</button>
                                            </div>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

@endsection

