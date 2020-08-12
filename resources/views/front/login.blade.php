<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>系统登录</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">

	<style type="text/css">
		body{
			font: 14px/1.4 'STHeiti','Microsoft YaHei','宋体','arial';
	    	background: #eee;
	    	overflow: hidden;
		}
		h3{
			color: #0062b4;
    		font-weight: 800;
    		font-size: 17px;
		}
		.alert{
			padding: 4px 15px;
		}

		.placeholder { color: #aaa; }
	</style>
</head>
<body>
	<div class="container" style="max-width: 400px">

		<form id="js-data-form" class="form-signin form-horizontal" action="/auth/login" method="post">
		<div class="modal-header">
				<h3>登录</h3>
			</div>
			<div class="modal-body clearfix">
				@if($ctrl->errors_has('login'))
				<div class="form-group">
					<div>
						<div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
							<span class="text">{{$ctrl->errors_first('login', ':message')}}</span>
						</div>
					</div>
				</div>
				@endif
	      		{{$ctrl->csrf_field()}}
	      		
	      		<input type="hidden" value="1" name="front" />
				<input type="hidden" value="{{$back}}" name="back" />
				<input type="hidden" value="{{$roomId}}" name="roomId" />
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"> <i class="glyphicon glyphicon-user"></i>
						</span>
						<input type="text" id="name" name="login" value="{{$ctrl->old('login')}}" class="form-control" placeholder="{{ $sysConfig->reg_account_tag }}" required autofocus></div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon "> <i class="glyphicon glyphicon-lock"></i>
						</span>
						<input type="password" id="password" name="password" class="form-control" placeholder="密 码" required></div>
				</div>
			</div>
			<div class=" modal-footer">
			@if($ctrl->_request('showReg'))
			<a href="/auth/reg?showLogin=1&roomid={{$roomId}}&back={{$back}}">没有{{ $sysConfig->reg_account_tag }}？去注册</a>
			@endif
				<button class="btn btn-primary" type="submit">
					登 录
					<i class="icon-circle-arrow-right"></i>
				</button>

			</div>
		</form>
	</div>

	
</body>
</html>