@extends('front.layouts.app')

@section('content')
    @include('front.partials.import_ueditor')
    <div class="empty-row"></div>
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    申请活动
                </div>
                <div class="panel-body">
                    @include('front.partials.errors')
                    <form action="{{ route('frontend::events.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="event-title" class="col-sm-3 control-label">活动标题</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" id="event-title" class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event-brief" class="col-sm-3 control-label">活动简介</label>
                            <div class="col-sm-6">
                                <input type="text" name="brief" id="event-brief" class="form-control" value="{{ old('brief') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event-start_date" class="col-sm-3 control-label">开始时间</label>
                            <div class="col-sm-6">
                                <input type="text" name="start_date" id="event-start_date" readonly class="form-control" value="{{ old('start_date') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event-end_date" class="col-sm-3 control-label">结束时间</label>
                            <div class="col-sm-6">
                                <input type="text" name="end_date" id="event-end_date" readonly class="form-control" value="{{ old('end_date') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event-location" class="col-sm-3 control-label">活动举办地点</label>
                            <div class="col-sm-6">
                                <input type="text" name="location" id="event-location" class="form-control" value="{{ old('location') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event-cover" class="col-sm-3 control-label">活动封面图</label>
                            <div class="col-sm-6">
                                <input type="file" name="cover" id="event-cover" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event-content" class="col-sm-3 control-label">活动内容</label>
                            <div class="col-sm-6">
                                <script id="container" name="content" type="text/plain" value="{{ old('content') }}"></script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i> 申请活动
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            ue.execCommand('insertHtml', '{!! old('content') !!}');
        });
    </script>
@endsection
