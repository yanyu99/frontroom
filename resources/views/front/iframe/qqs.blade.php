<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.box{
			color: #999;
			width: 559px;
			height: 322px;
			padding-top: 48px;
			background-image:url({{$cdn}}/assets/img/qqs/bg.png);
		}
		.box-inner{
			
			padding-top: 8px;
			overflow-x: hidden;
			overflow-y: auto;
			width: 559px;
			height: 297px;
		}
		.item{
			color: #999;
			text-align: center;
			width: 136px;
			font-size: 12px;
			font-style: "微软雅黑";
			height: auto;
			margin: 0px 0px;
			float: left;
			margin-bottom: 8px;

		}
	</style>
</head>
<body style="margin: 0px;overflow: hidden;">
<div class="box" >
<div class="box-inner">
@foreach($roomqqs as $value)
<div class="item">
	<img width="76px" height="76px" style="display: block;margin: auto;border-radius: 5px;" @if($value->imgurl) src="{{$value->imgurl}}" @else src="{{$cdn}}/assets/img/qqs/default.png" @endif >
	
	<a style="display: block; @if($value->which == 1) opacity: 0; @endif  text-align: center;margin-top: 5px;"  href="http://wpa.qq.com/msgrd?v=3&uin={{$value->qq}}&site=qq&menu=yes" target="_blank">
		<img  src="{{$cdn}}/assets/img/qqs/qqjt.png">
	</a>
	<div style="margin-top: 3px;">{{$value->name}}</div>
	@if($value->phone)
	<div style="margin-top: 3px;">手机：{{$value->phone}}</div>
	@else
	<div style="margin-top: 3px;opacity: 0.0">手机：</div>
	@endif
</div>
@endforeach
</div>
</div>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>

<script type="text/javascript" src="{{$common_cdn}}/js/jquery.nicescroll-3.6.0/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
	$('.box-inner').niceScroll({
        cursorborder: '',
        horizrailenabled: false,
        cursorcolor: '#999',
        boxzoom: false
    });
</script>
</body>
</html>