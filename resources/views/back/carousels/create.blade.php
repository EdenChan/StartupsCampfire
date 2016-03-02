@extends('back.layouts.app')

@section('admin-content')
    @include('back.carousels.partials.carousel_title')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-table"></span>
                        <a href="{{ route('backend::admin.carousels.index') }}">幻灯片列表</a>
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
                                    <li class="am-active"><a href="#tab1">新增幻灯片</a></li>
                                </ul>
                                <div class="am-tabs-bd">
                                    @include('back.partials.errors')
                                    <form class="am-form" action="{{ route('backend::admin.carousels.store') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                显示顺序
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="order" id="order" type="text" class="am-input-sm"
                                                       value="{{ old('order') }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                上传图片
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input type="file" name="image"/>
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                幻灯片外链
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="url" id="url" type="text" class="am-input-sm"
                                                       value="{{ old('url') }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6"></div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                <button type="submit" class="am-btn am-btn-primary">新增幻灯片</button>
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

