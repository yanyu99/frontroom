<!DOCTYPE html>
<html>
<head>
	<title>领取入场券</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/validform/validform.css">

	<style type="text/css">
		body{
			font: 14px/1.4 'STHeiti','Microsoft YaHei','宋体','arial';
	    	background: #eee;
	    	overflow:hidden;
		}
		html{
			overflow:hidden;
		}
		h1{
			color: #0062b4;
    		font-weight: 800;
    		font-size: 17px;
    		border-bottom: 1px solid #ddd;
    		padding-bottom: 5px;
		}
		.form-body{
			background: #f6f6f6;
			border-radius: 5px;
			padding-top: 15px;
			margin-bottom: 25px;
			
		}
		.form-group{
			margin-bottom: 20px;
		}
		.btn-submit{
			width: 150px;
		}
		.Validform_checktip{
			margin-left:0px;
			position: absolute;
		}
		.placeholder { color: #aaa; }
	</style>
</head>
<body>
	<div class="container" style="max-width: 520px">
		<h1>领取入场券</h1>
		<h4>联系客服领取入场券</h4>
		

		<p>
		{{-- */$i=0;/* --}}
		@foreach($roomqqs as $value)
			@if($value->which == 0)
					@if($i++ <2)
							@if($isMobile)
							<a href="mqqwpa://im/chat?chat_type=wpa&uin={{$value->qq}}&version=1&src_type=web&web_src={{$ctrl->_requestHost()}}" target="_blank">
							<img width="48px;" src="@if($value->imgurl){{$value->imgurl}}@else{{$cdn}}/assets/img/kf.png @endif">
							</a>
							@else
							<a href="http://wpa.qq.com/msgrd?v=3&uin={{$value->qq}}&site=qq&menu=yes" target="_blank">
								<img  width="48px;" src="@if($value->imgurl){{$value->imgurl}}@else{{$cdn}}/assets/img/kf.png @endif">
							</a>
							@endif
					@endif
			@endif
		@endforeach
		</p>
		{{-- */$i=0;/* --}}
		@foreach($roomqqs as $value)
			@if($value->which == 1)
				@if($i++ < 1)
				<h4>或扫描客服二维码，回复“领取入场券”</h4>
				<img src="{{$value->imgurl}}" width="140px" height="140px">
				@endif
			@endif
		@endforeach
	</div>
</body>
</html>