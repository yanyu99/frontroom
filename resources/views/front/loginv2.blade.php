
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>登录</title>
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
		.modal-header{
			color: #444;
    		font-weight: 800;
    		font-size: 20px;
    		padding:5px 5px;

		}
		.alert{
			padding: 4px 15px;
		}

		.placeholder { color: #aaa; }
		.head{
			height: 80px;
			background-color: #fff
		}
		
		.foot{
			position: absolute;
			bottom: 0px;
			height: 100px;
			width: 100%;
			background-color: #fff;
			text-align: center;
			line-height: 80px;
			color: #ccc;
		}
		.form-signin{
			width: 340px;float: left;
			border: 1px solid #ccc;
			height: 335px;
			padding: 5px;
			box-shadow: 0 0 5px #888888;
			background-color: #fff
		}
		.container{
			max-width: 780px;
			margin-top: 50px;
		}
		.modal-body{
			padding: 0px 50px;
			border: none;
			padding-top: 50px;
		}
		.login-btn{
			padding: 5px 100px;
			background-color: #d90919;
			border: none;
			border-radius: 50px;
		}
	</style>
</head>
<body>
<div class="head">
	<div style="@if(!$isMobile)width: 1124px;@endif margin: auto;">
		<img src="@if($roomUI->login_logo){{$roomUI->login_logo}}@else{{$room->logo}}@endif" height="60px" style="margin-top: 7px;">
		@if(!$isMobile)
		<div style="float: right; line-height: 80px;font-size: 14px;color: #777">{{$room->title}}直播间</div>
		@endif
	</div>
</div>
	<div class="container" style="@if($isMobile) max-width:320px; @elseif(!$roomUI->login_ad ) max-width:400px;  @endif">
		@if($roomUI->login_ad && !$isMobile)<img  src="{{$roomUI->login_ad}}"  style="float: left;display: block;width: 400px;height: 335px;"> @endif
		<form id="js-data-form" style="@if($isMobile) width: 290px;height:225px;  @endif" class="form-signin form-horizontal" action="/auth/login" method="post">
			<div class="modal-header">
				欢迎登录
			</div>
			<div class="modal-body clearfix" style="@if($isMobile) padding-top: 10px;@endif">
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
				<div class="form-group" style="text-align: center;@if($isMobile) margin-top: 10px;@else margin-top: 40px;  @endif ">
					<button class="btn btn-primary login-btn" style="@if($isMobile)     padding: 5px 86px;  @endif" type="submit">
						登 录
					</button>
					@if($ctrl->_request('showReg') || $roomUI->login_qq)
					<div style="color: #777;margin-top: 10px;cursor: pointer;">
						@if($ctrl->_request('showReg'))
						<a href="/auth/reg?ui=v2&showLogin=1&roomid={{$roomId}}&back={{$back}}">没有{{ $sysConfig->reg_account_tag }}？去注册</a>
						@else
						还没有{{ $sysConfig->reg_account_tag }}请联系
							@if($isMobile)
					<a style="color: red;" href="mqqwpa://im/chat?chat_type=wpa&uin={{$roomUI->login_qq}}&version=1&src_type=web&web_src={{$ctrl->_requestHost()}}" target="_blank">助理</a>
					@else
						<a  style="color: red;" href="http://wpa.qq.com/msgrd?v=3&uin={{$roomUI->login_qq}}&site=qq&menu=yes" target="_blank">助理</a>
					@endif
						！
						@endif
					</div>
					@endif
				</div>
			</div>
		</form>
	</div>
	@if(!$isMobile)
<div class="foot">
	{{$room->copyright}}
</div>
@endif
</body>
</html>