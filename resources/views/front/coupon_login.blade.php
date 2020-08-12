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
		.container{
			background-image: url('{{ !empty($sysConfig->reg2_pc_bg) ? $sysConfig->reg2_pc_bg : $cdn . '/assets/img/coupon_bg.jpg'}}');
			width: 1080px;
			height: 382px;

			filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')";
			-moz-background-size:100% 100%;
			background-size:100% 100%;
			background-attachment: fixed;
		}
		.login-name{
			position: absolute;
			top:301px;
			left: 882px;
			width: 97px;
			border:none;
			line-height: 26px;
    		background: rgba(0,0,0,0);
    		color: #fff;
		}
		.login-pwd{
			position: absolute;
			top:340px;
			left: 882px;
			border:none;
			width: 97px;
			border:none;
			line-height: 26px;
    		background: rgba(0,0,0,0);
    		color: #fff;
		}
		.login-btn{
			position: absolute;
			left: 990px;
			top: 300px;
			width: 69px;
			height: 69px;
			background:url('{{$cdn}}/assets/img/login-btn.png');
			border:none;
		}
		.login-error{
			    position: absolute;
    left: 845px;
    top: 277px;
    color: red;
		}
	</style>
</head>
<body>
	<div class="container" >

		<form id="js-data-form" action="/auth/login" method="post">
				@if($ctrl->errors_has('login'))
					<span class="login-error">{{$ctrl->errors_first('login', ':message')}}</span>
				@endif
	      		{{$ctrl->csrf_field()}}
	      		<input type="hidden" value="1" name="front" />
				<input type="hidden" value="{{$back}}" name="back" />
				<input type="hidden" value="{{$roomId}}" name="roomId" />
				<input class="login-name" type="text" id="name" name="login" value="{{$ctrl->old('login')}}" class="form-control" required autofocus></div>
				<input class="login-pwd" type="password" id="password" name="password" class="form-control" required>
				<button class="login-btn" type="submit">
				

				</button></div>
		</form>
	</div>

	
</body>
</html>