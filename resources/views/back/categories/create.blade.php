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
                        <a href="{{ route('backend::admin.categories.index') }}">分类列表</a>
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
                                    <li class="am-active"><a href="#tab1">新建分类</a></li>
                                </ul>
                                <div class="am-tabs-bd">
                                    @include('back.partials.errors')
                                    <form class="am-form" action="{{ route('backend::admin.categories.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                上级分类
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                @include('back.partials.category_tree_select')
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                分类名称
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="content" id="content" type="text" class="am-input-sm"
                                                       value="{{ old('content') }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                Url参数名
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="url_tag" id="url_tag" type="text" class="am-input-sm"
                                                       value="{{ old('url_tag') }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">该参数将用于Url中，建议自定义Url参数增加表现力，只支持英文</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                Seo描述
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="seo_desc" id="seo_desc" type="text" class="am-input-sm"
                                                       value="{{ old('seo_desc') }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6"></div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                <button type="submit" class="am-btn am-btn-primary">新增分类</button>
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

