@extends('back.layouts.app')

@include('front.partials.import_ueditor')
@section('admin-content')
    @include('back.notices.partials.notice_title')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-table"></span>
                        <a href="{{ route('backend::admin.notices.index') }}">公告列表</a>
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
                                    <li class="am-active"><a href="#tab1">编辑站点公告</a></li>
                                </ul>
                                <div class="am-tabs-bd">
                                    @include('back.partials.errors')
                                    <form class="am-form" action="{{ route('backend::admin.notices.update', ['id' => $notice->id]) }}" method="POST" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                公告标题
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="title" id="title" type="text" class="am-input-sm"
                                                       value="{{ $notice->title }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                更新公告内容
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <script id="container" name="content" type="text/plain"></script>
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6"></div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                <button type="submit" class="am-btn am-btn-primary">更新公告</button>
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
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            initialFrameWidth : 600
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            ue.execCommand('insertHtml', '{!! $notice->content !!}');
        });
    </script>
@endsection

