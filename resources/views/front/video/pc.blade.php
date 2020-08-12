<!DOCTYPE html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,Chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$room->title}}</title>
    <style type="text/css">
        html, body{
            width: 100%;
            height: 100%;
            margin: 0px;
        }
        .index-video-wrap{
            width: 100%;
            height: 100%;
        }
        .video-player-wrap{
            width: 100%;
            height: 100%;
        }
    </style>
    <script type="text/javascript">
        var WEB_ENVIRON = '{{ $app::config('ENVIRON') }}';
        if (!(WEB_ENVIRON && WEB_ENVIRON == 'debug')) {
            window.console = console || {};
            window.console._log = window.console.log || function () {
            };
            window.console.log = function () {
            };
            window.console._warn = window.console.warn || function () {
            };
            window.console.warn = function () {
            };
        }
        window.D = {
            cdn: '{{$cdn}}',
            ver: '{{$webver}}'
        };
    </script>
</head>
<body>
<div class="index-video-wrap">
    <div id="js-video-player-wrap" class="video-player-wrap" style='overflow: hidden;'></div>
</div>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>
@if($roomLiveInfo->live_type == 5)<!--mps-->
<script type="text/javascript" src="{{$cdn}}/assets/js/mpslssplayer.js?v={{$webver}}"></script>
@elseif($roomLiveInfo->live_type == 6)
    <script type="text/javascript" src="{{$common_cdn}}/js/jwplayer/7.4.3/jwplayer.js?v={{$webver}}"></script>
@else
    <script type="text/javascript" src="{{$cdn}}/assets/js/aodianplayer.js?v={{$webver}}"></script>
@endif

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

<script type="text/javascript">
    $(function () { 
        if(window.parent && window.parent.initLoadPlayer){
            setTimeout(() => {
                window.parent.initLoadPlayer(); 
            }, 1000); 
        } else{
            alert('window.parent.initLoadPlayer error');
        }
    });
    function _play(url){ 
        var _url = url ||'{{$roomLiveInfo->live_hls}}';  
        pushVideoOnline('{{$roomLiveInfo->live_type}}', '{{$roomLiveInfo->live_play}}', _url, '');
    }
    function _stop(){
        pushVideoffline('{{$roomLiveInfo->live_type}}');
    }

    function pushVideoOnline(channelType, channelNumber, channelHls, vod_url) {
        $('#js-vod-player-wrap').hide();
        if (vod_url) {
            setVideoChannel(channelType, "", $('#js-video-player-wrap'), true, vod_url);
        } else {
            setVideoChannel(channelType, channelNumber, $('#js-video-player-wrap'), true, channelHls);
        }
    }

    function pushVideoffline(channelType) {
        setVideoChannel(channelType, "", $('#js-video-player-wrap'), false, "");
    }

    function playVod(vodurl) {
        setVideoChannel(4, "", $('#js-vod-player-wrap'), true, vodurl);
    }

    function setVideoChannel(channelType, channelNumber, $videoPlayerWrap, online, hlsUrl) { 
        var $yyVideoPlayerTmpl = $('#js-video-yy-tmpl');
        var $letvVideoPlayerTmpl = $('#js-video-letv-tmpl');
        var $videoPlayerTmpl = $yyVideoPlayerTmpl;
        var isTeacher = '{{$isTeacher}}'
        if (!online) {  
            $videoPlayerWrap.empty();
            return;
        }
        if (channelType == 1) {
            $videoPlayerTmpl = $letvVideoPlayerTmpl;
        } else if (channelType == 3) {
            $videoPlayerTmpl = $yyVideoPlayerTmpl;
        } else if (channelType == 9 || channelType == 11) {
            $videoPlayerTmpl = $("#js-video-yynew-tmpl");
        } else if (channelType == 6) {
            $videoPlayerWrap.empty();
            window.myJwPlayer = window.jwplayer('js-video-player-wrap');
            var option = {
                width: "100%",
                height: "100%",
                backcolor: "#ccc",
                key: 'CrfBMys1AxkTi6A7O28ztphsFyEQqfCmqL92Sg==', //Z1NmLnoKuA0dz4qEut5SNqUqF8aEQgtpQWgSag== jw6
                file: channelNumber,
                rtmp: {
                    reconnecttime: 5,
                    bufferlength: 1
                },
                controls: "over",
                autoStart: true,
                repeat: false,
                volume: 80,
                events: {
                    onReady: function () {
                        console.log("onReady!!!");
                        window.myJwPlayer.play();
                    },
                    onPlay: function () {
                        console.log("开始播放!!!");
                    },
                    onPause: function () {
                        console.log("暂停!!!");
                    },
                    onBufferChange: function (event) {

                        console.log("缓冲改变!!!", event);
                        if (event.bufferPercent == 0) {
                            setTimeout(function () {
                                window.myJwPlayer.stop();
                                window.myJwPlayer.play();
                            }, 1000);
                        }
                    },
                    onBufferFull: function (event) {
                        console.log("视频缓冲完成!!!", event);
                    },
                    onError: function (obj) {
                        console.log("播放器出错!!!" + obj.message);
                    },
                    onFullscreen: function (obj) {
                        if (obj.fullscreen) {
                            console.log("全屏");
                        } else {
                            console.log("非全屏");
                        }
                    },
                    onMute: function (obj) {
                        console.log("静音/取消静音")
                    }
                }
            };
            window.myJwPlayer.setup(option);
        } else if (channelType == 4 || channelType == 7 || channelType == 8) {
            $videoPlayerWrap.empty();
            window.objectPlayer = new aodianPlayer({
                container: $videoPlayerWrap.attr("id"),//播放器容器ID，必要参数
                rtmpUrl: channelNumber,//控制台开通的APP rtmp地址，必要参数
                hlsUrl: hlsUrl,//控制台开通的APP hls地址，必要参数
                /* 以下为可选参数*/
                width: '100%',//播放器宽度，可用数字、百分比等
                height: '100%',//播放器高度，可用数字、百分比等
                autostart: true,//是否自动播放，默认为false
                bufferlength: '1',//视频缓冲时间，默认为3秒。hls不支持！手机端不支持
                maxbufferlength: '2',//最大视频缓冲时间，默认为2秒。hls不支持！手机端不支持
                stretching: parseInt('{{$sysConfig->stretching}}') || 1, //设置全屏模式,1代表按比例撑满至全屏,2代表铺满全屏,3代表视频原始大小,默认值为1。hls初始设置不支持，手机端不支持
                controlbardisplay: 'enable',//是否显示控制栏，值为：disable、enable默认为disable。
                //adveDeAddr: '',//封面图片链接
                //adveWidth: 320,//封面图宽度
                //adveHeight: 240,//封面图高度
                //adveReAddr: ''//封面图点击链接
                isfullscreen: channelType != 8,
            });
            if (isTeacher) {
                var timer = setInterval(function () {
                    if (objectPlayer.setMute && objectPlayer.handle) {
                        objectPlayer.setMute(true);
                        clearInterval(timer);
                    }
                }, 50)
            }
        } else if (channelType == 5) {
            $videoPlayerWrap.empty();
            window.objectPlayer = new mpsPlayer({
                container: 'js-video-player-wrap',//播放器容器ID，必要参数
                uin: '24260',//用户ID
                appId: '7mbz3B1mbNUXyXQW',//播放实例ID
                hlsUrl: hlsUrl,//控制台开通的APP hls地址
                rtmpUrl: channelNumber,//控制台开通的APP rtmp地址
                flvUrl: '',//flv地址
                width: '100%',//播放器宽度，可用数字、百分比等
                height: '100%',//播放器高度，可用数字、百分比等
                autostart: true,//是否自动播放，默认为false
                stretching: parseInt('{{$sysConfig->stretching}}') || 1, //设置全屏模式,1代表按比例撑满至全屏,2代表铺满全屏,3代表视频原始大小,默认值为1。hls初始设置不支持，手机端不支持
                mobilefullscreen: parseInt('{{$sysConfig->mobilefullscreen}}') || false,  //移动端是否全屏，默认为false
                controlbardisplay: 'enable',//是否显示控制栏，值为：disable、enable默认为disable。
                isclickplay: false,//是否单击播放，默认为false
                isfullscreen: true,//是否双击全屏，默认为true
                enablehtml5: false,//是否优先使用H5播放器，默认为false
                isloadcount: 1//网络波动卡顿loading图标显示(默认1s后)
            });
        } else {
            $videoPlayerTmpl = $yyVideoPlayerTmpl;
        }
        if (channelType != 4 && channelType != 5 && channelType != 6 && channelType != 7 && channelType != 8) {
            var palyerParames = {
                channelNumber: channelNumber,
                width: $videoPlayerWrap.width(),
                height: $videoPlayerWrap.height()
            };
            if (online) {
                $videoPlayerWrap.empty().append($videoPlayerTmpl.render(palyerParames));
            } else {
                $videoPlayerWrap.empty();
            }
        }
    }


</script>
</body>
</html>