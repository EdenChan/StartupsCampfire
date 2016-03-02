@extends('back.layouts.app')

@include('front.partials.import_ueditor')
@section('admin-content')
    @include('back.events.partials.event_title')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-table"></span>
                        <a href="{{ route('backend::admin.events.index') }}">活动列表</a>
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
                                    <li class="am-active"><a href="#tab1">编辑平台活动</a></li>
                                </ul>
                                <div class="am-tabs-bd">
                                    @include('back.partials.errors')
                                    <form class="am-form" action="{{ route('backend::admin.events.update', ['id' => $event->id]) }}" method="POST" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                活动标题
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="title" id="title" type="text" class="am-input-sm"
                                                       value="{{ $event->title }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                活动简介
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="brief" id="brief" type="text" class="am-input-sm"
                                                       value="{{ $event->brief }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                开始时间
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="start_date" id="start_date" type="text" class="am-input-sm" readonly
                                                       value="{{ $event->start_date }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                结束时间
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="end_date" id="end_date" type="text" class="am-input-sm" readonly
                                                       value="{{ $event->end_date }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                活动举办地点
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input name="location" id="location" type="text" class="am-input-sm"
                                                       value="{{ $event->location }}">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                原活动封面图
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <img src="{{ $event->cover_full_path }}" alt="" width="200" height="120" />
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6"></div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                更新活动封面图
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <input type="file" name="cover" id="event-cover" class="form-control">
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6"></div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                更新活动内容
                                            </div>
                                            <div class="am-u-sm-8 am-u-md-4">
                                                <script id="container" name="content" type="text/plain"></script>
                                            </div>
                                            <div class="am-hide-sm-only am-u-md-6"></div>
                                        </div>
                                        <div class="am-g am-margin-top">
                                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                                <button type="submit" class="am-btn am-btn-primary">更新活动</button>
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
            ue.execCommand('insertHtml', '{!! $event->content !!}');
        });
        $('#start_date').datetimepicker({
            format: 'yyyy-mm-dd hh:ii'
        });
        $('#end_date').datetimepicker({
            format: 'yyyy-mm-dd hh:ii'
        });
    </script>
@endsection

