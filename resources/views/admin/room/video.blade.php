@extends('admin.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
<style type="text/css">
.jw-controlbar-left-group span,.jw-controlbar-right-group span,.jw-controlbar-center-group{
  opacity: 0;
  visibility:hidden;
}
</style>
@endsection
@section('content')
<script id="js-video-letv-tmpl" type="text/x-jsrender">
<object type="application/x-shockwave-flash" id="videoplayer" name="videoplayer" align="middle" data="http://sdk.lecloud.com/live.swf" width="100%" height="100%">
	<param name="wmode" value="direct">
	<param name="quality" value="high">
	<param name="bgcolor" value="#000000">
	<param name="allowscriptaccess" value="always">
	<param name="allowfullscreen" value="true">
	<param name="flashvars" value="activityId=@{{>channelNumber}}">
	<param name="wmode" value="transparent" />
	<param name="quality" value="high" />
</object>
</script>
<script id="js-video-yy-tmpl" type="text/x-jsrender">
<object id="videoE" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="100%">
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
<script id="js-video-yynew-tmpl" type="text/x-jsrender">
<object id="videoE" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="100%">
	<param name="movie"  value="http://weblbs.yystatic.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yycomscene.swf" />
	<param name="quality" value="high" />
	<param name="wmode" value="transparent" />
	<embed class="videoEmB" width="100%" height="100%" align="middle"
			id="videolive" src="http://weblbs.yystatic.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yycomscene.swf"
		type="application/x-shockwave-flash" autostart="false"
		wmode="transparent" allowfullscreen="true"
	allowscriptaccess="always" flashvars="sceneType=5&danmu=true&volume=0.5&source=http%3A%2F%2Fwww.yy.com%2F@{{>channelNumber}}f%3D0%26cpuid%3D0&anchorId=0&livedelay=1&coop=0&topSid=@{{>channelNumber}}&subSid=@{{>channelNumber}}" quality="high" />
</object>
</script>
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">视频基础配置</header>
			<div class="panel-body">
				@if($ctrl->errors_has('error'))
					<div class="form-group">
						<div>
							<div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
								<span class="text">{{$ctrl->errors_first('error', ':message')}}</span>
							</div>
						</div>
					</div>
				@endif
				<form id="myForm" class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<div class="form-group">
						<span class="col-sm-4 control-label">类型：</span>
						<div class="col-sm-4">
							<select id="idLiveType" name="live_type"  class="form-control">
								@foreach($liveTypes as $key=>$value)
								<option value="{{$key}}"  @if($key == $edit->live_type) selected  @endif >{{$value}}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<span class="col-sm-4 control-label">播放地址：</span>
						<div class="col-sm-4">
							<input  class="form-control" id="idLivePlay" type="text" name="live_play" value="{{$edit->live_play}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">手机播放地址：</span>
						<div class="col-sm-4">
							<input  class="form-control" id="idLivePlayHls" type="text" name="live_hls" value="{{$edit->live_hls}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">FLV地址：</span>
						<div class="col-sm-4">
							<input  class="form-control" id="idLivePlayHls" type="text" name="live_flv" value="{{$edit->live_flv}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">预览：</span>
						<div class="col-sm-8">
							<a   id="idPreview" class="btn btn-primary">预览</a>
							<div id="video-player-wrap" style="height:300px;width:400px;"></div>
						</div>
					</div>

					<div class="form-group">
						<span class="col-sm-4  control-label">是否开启视频：</span>
						<div class="col-sm-4">
							<input type="checkbox" class="js-switch" name="live_state" @if($edit->live_state) checked @endif /></div>
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
@section('script')
<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/aodianplayer.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/mpslssplayer.js?v={{$webver}}"></script>
<script type="text/javascript">

$(function () {
 $('#idPreview').live('click',function(){
 	var liveType = $('#idLiveType').val();
 	var livePlay = $('#idLivePlay').val();
 	var hlsUrl = $('#idLivePlayHls').val();
 	var vodUrl = $('#idVodUrl').val();
 	if(vodUrl){
 		$("#video-player-wrap").empty();
		var objectPlayer=new aodianPlayer({
		    container:'video-player-wrap',//播放器容器ID，必要参数
		    hlsUrl:vodUrl,
		    width: '100%',
		    height: '100%',
		    autostart: true,
		    bufferlength: '1',
		    maxbufferlength: '2',stretching: '1',
		    controlbardisplay: 'enable',
		});
		return;
 	}
 	setVideoChannel(liveType,livePlay,hlsUrl,$('#video-player-wrap'),1);
 })
  $('#idPreview1').live('click',function(){
 	var liveType = $('#idLiveType').val();
 	var livePlay = $('#idLivePlay1').val();
 	var hlsUrl = $('#idLivePlayHls1').val();
 	setVideoChannel(liveType,livePlay,hlsUrl,$('#video-player-wrap1'),1);
 })
//http://yy.com/s/@{{>channelNumber}}/yyscene.swf
function setVideoChannel(channelType,channelNumber,hlsUrl,$videoPlayerWrap,online){
	var $yyVideoPlayerTmpl = $('#js-video-yy-tmpl');
	var $letvVideoPlayerTmpl = $('#js-video-letv-tmpl');
	//var $genseeVideoPlayerTmpl=$("#js-video-gensee-tmpl");
	var $videoPlayerTmpl =  null;
	if(channelType == 1){
		$videoPlayerTmpl =$letvVideoPlayerTmpl;
	}else if(channelType == 2){
		$videoPlayerTmpl = $genseeVideoPlayerTmpl;
	}else if(channelType == 3){
		$videoPlayerTmpl = $yyVideoPlayerTmpl;
	}else if( channelType==4 ||channelType == 7 || channelType == 8|| channelType == 5) {
		$videoPlayerWrap.empty();
		var objectPlayer=new aodianPlayer({
		    container:$videoPlayerWrap.attr("id"),//播放器容器ID，必要参数
		    rtmpUrl:  channelNumber,//控制台开通的APP rtmp地址，必要参数
		   /* hlsUrl: ' http://20768.hlsplay.com/jzlm/stream.m3u8       ',*/ //控制台开通的APP hls地址，必要参数
		    /* 以下为可选参数*/
		    width: '100%',//播放器宽度，可用数字、百分比等
		    height: '100%',//播放器高度，可用数字、百分比等
		    autostart: true,//是否自动播放，默认为false
		    bufferlength: '1',//视频缓冲时间，默认为3秒。hls不支持！手机端不支持
		    maxbufferlength: '2',//最大视频缓冲时间，默认为2秒。hls不支持！手机端不支持
		    stretching: '1',//设置全屏模式,1代表按比例撑满至全屏,2代表铺满
		    controlbardisplay: 'enable',
		});
	}else if(channelType == 9 || channelType == 11){
		$videoPlayerTmpl = $("#js-video-yynew-tmpl");
	}else{
		return;
	}
	if(channelType!=4 && channelType!=5 && channelType != 6 &&channelType !=7 && channelType != 8){
		var palyerParames = {
			 	channelNumber:  channelNumber,
				width: $videoPlayerWrap.width(),
				height: $videoPlayerWrap.height()
			}
			if(online){
				$videoPlayerWrap.empty().append($videoPlayerTmpl.render(palyerParames));
			}else{
				$videoPlayerWrap.empty();
			}
		
	}
}
})
</script>
@endsection