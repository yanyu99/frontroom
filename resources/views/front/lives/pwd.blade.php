<!DOCTYPE html>
<html >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>{{$room->title}}</title>
	<link href="{{$room->icon}}" rel="shortcut icon" type="image/x-icon">
	<meta name="Keywords" content="{{$room->keywords}}">
	<meta name="description" content="{{$room->description}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/view/main/nopassword.css?v={{$webver}}">
	
	<style type="text/css">
	html{
		width: 100%;
		height: 100%;
	}
	body{
		width: 100%;
		height: 100%;
	}
	@if($sysConfig->pwd_bg)
		body {
    		background-image: url({{$sysConfig->pwd_bg}});
    		background-size: 100% 100%;
    	}
    @endif

   
	</style>
</head>
<body>
	<div class="container goin-room">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 col-xs-12 col-xs-offset-0">
				<h1 style="    margin: 120px 0 25px;" >
					<img src="{{$room->logo}}" style="max-width: 200px; min-width: 100px;" /></h1>
				@if($ctrl->errors_has('verify'))
				<div class="alert alert-warning alert-dismissible fade in" role="alert"> <strong>错误:</strong>
					{{$ctrl->errors_first('verify', ':message')}}
				</div>
				@endif
				<form id="goin-form" action="/verify/{{$room->id}}" method="post">
					<div class="input-group input-group-lg">
						{{$ctrl->csrf_field()}}
						<input type="text" class="form-control" id="password" name="password" value="" onfocus="this.type='password'" placeholder="请输入房间密码">
						<span class="input-group-btn">
							<button class="btn btn-success" type="submit">进入房间</button>
						</span>
					</div>
					<!-- /input-group -->
				</form>
			@if($sysConfig->pwd_bg && $sysConfig->pwd_ewm)	<h1 style="    margin: 10px 0 25px;">
					<img src="{{$roomUI->wechat_img}}" style="max-width: 200px; min-width: 100px;" /></h1>@endif
				<ul class="customer-list">
					@foreach($roomqqs as $value)
					<li style="list-style-type:none;">
					@if($isMobile)
					<a href="mqqwpa://im/chat?chat_type=wpa&uin={{$value->qq}}&version=1&src_type=web&web_src={{$myHost}}" target="_blank">
					@else
						<a href="http://wpa.qq.com/msgrd?v=3&uin={{$value->qq}}&site=qq&menu=yes" target="_blank">
					@endif
							<img src="{{$cdn}}/assets/img/kf.png" alt="user">
							<span style="color: #333;">{{$value->name}}</span>
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</body>
</html>