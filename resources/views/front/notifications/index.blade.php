@extends('front.layouts.app')

@section('content')
	<div class="container">
        <div class="empty-row"></div>
		<div class="col-sm-offset-2 col-sm-8">
			<!-- Current posts -->
			@if (count($notifications) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						您的消息
					</div>
					<div class="panel-body">
						<table class="table table-striped post-table">
							<thead>
								<th>消息</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($notifications as $notification)
									<tr>
										<td class="table-text">
                                            {!! $notification->notification_desc !!}
                                        </td>
									</tr>
								@endforeach
							</tbody>
						</table>
                        {!! $notifications->render() !!}
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
