@extends('front.layouts.app')

@section('content')
    @include('front.partials.import_ueditor')
    <div class="empty-row"></div>
	<div class="container">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					发布动态
				</div>
				<div class="panel-body">
					@include('front.partials.errors')
					<form action="{{ route('frontend::posts.store') }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<div class="form-group">
							<label for="category-id" class="col-sm-3 control-label">选择分类</label>
                            <div class="col-sm-6">
                                @include('front.partials.category_tree_select')
                            </div>
						</div>
                        <div class="form-group">
                            <label for="post-title" class="col-sm-3 control-label">标题</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" id="post-title" class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post-content" class="col-sm-3 control-label">内容</label>
                            <div class="col-sm-6">
                                <script id="container" name="content" type="text/plain"></script>
                            </div>
                        </div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i> 发布
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
            <div class="empty-row"></div>
            @include('front.partials.category_tree_display')
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
