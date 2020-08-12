@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">TAB栏配置</header>
			<div class="panel-body">
				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					@if($ctrl->errors_has('modify'))
					<div class="form-group">
						<div>
							<div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
								<span class="text">{{$ctrl->errors_first('modify', ':message')}}</span>
							</div>
						</div>
					</div>
					@endif
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">旧密码:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="password" name="oldpwd" value=""  ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">新密码:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="password" name="pwd" value=""  ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">确认新密码:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="password" name="pwd1" value=""  ></div>
					</div>
					<div class="form-group">
						<div class="controls text-center">
							<button type="submit" class="btn btn-primary">确定</button>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
@endsection
