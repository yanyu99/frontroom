<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
	<title>双视频</title>

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

</style> 
<script type="text/javascript">
window.D={}
window.D.CHANNELINFO = {
	living:1,
	channelType:'{{$roomLiveInfo->live_type}}',
	channelNumber:'{{$roomLiveInfo->live_play1}}',
	channelHls:'{{$roomLiveInfo->live_hls1}}',
}
window.D.USER = {
	isTeacher:false,
}
</script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>
	<script type="text/javascript" src="{{$cdn}}/assets/js/aodianplayer.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/mpslssplayer.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/video.js?v={{$webver}}"></script>
<script type="text/javascript">
	$(function(){
		startVideo();
		pushVideoOnline();
	})
	function js_startVideo(){
		pushVideoOnline();
	}
	function js_stopVideo(){
		pushVideoffline();
	}
</script>
</head>
<body style="">

<script id="js-video-yy-tmpl" type="text/x-jsrender">
<object id="videoE" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="300px">
	<param name="movie" value="http://yy.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yyscene.swf" />
	<param name="quality" value="high" />
	<param name="wmode" value="transparent" />
	<embed class="videoEmB" width="100%" height="100%" align="middle"
			id="videolive" src="http://yy.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yyscene.swf"
		type="application/x-shockwave-flash" autostart="false"
		wmode="transparent" allowfullscreen="true"
	allowscriptaccess="always" quality="high" />
</object>
</script>

<div id="js-video-player-wrap"  class="video-player-wrap" style="width: 300px;height: 300px;"></div>
</body>
</html>