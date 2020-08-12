<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
	<title>{{$room->title}}</title>
	@if($room->icon)
	<link href="{{$room->icon}}" rel="shortcut icon" type="image/x-icon">
	@endif
	<meta name="Keywords" content="{{$room->keywords}}">
	<meta name="description" content="{{$room->description}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
html{
	width:100%;
	height:100%;
}
body{
	width:100%; 
	height:100%;
	margin: 0px;
	padding: 0px;
	overflow: hidden;
}
iframe{
	border: none;
	margin: 0px;
	padding: 0px;
}
</style> 

</head>
<body style="">
<iframe src="{{$src}}" width="100%" height="100%" frameborder="0"  style="width: 100%;height: 100%;"></iframe>
</body>
</html>