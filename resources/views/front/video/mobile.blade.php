<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{$room->title}}</title>
    <style type="text/css">
        html, body{
            width: 100%;
            height: 100%;
            margin: 0px;
        }
        .surface-container{
            width: 100%;
            height: 100%;
        }
    </style>
    <!-- <script type="text/javascript" src="http://192.168.28.136:8080/target/target-script-min.js#anonymous"></script> -->
    <script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js?v={{$webver}}"></script>
    <script type="text/javascript" src="{{$cdn}}/assets/js/base-polyfill.js?v={{$webver}}"></script>
    @if( !empty($is_weixin) )
        <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>  
    @endif
    <script type="text/javascript">
        var WEB_ENVIRON = '{{ $app::config('ENVIRON') }}';
        if(!(WEB_ENVIRON && WEB_ENVIRON == 'debug')){
            window.console = console || {};
            window.console._log = window.console.log || function () {};
            window.console.log = function () {};
            window.console._warn = window.console.warn || function () {};
            window.console.warn = function () {};
        }
        window.D = {
            cdn: '{{$cdn}}',
            ver: '{{$webver}}'
        };
    </script>
</head>
<body>
<div class="surface-container"  >
    @if($roomLiveInfo->live_type == 5)<!--mps-->  
        <script type="text/javascript" src="{{$cdn}}/assets/js/mpslssplayer.js?v={{$webver}}"></script>
        <div id="video-js-warp" style="height:100%"></div>
    @elseif($roomLiveInfo->live_type == 3 || $roomLiveInfo->live_type == 9)<!--yy-->
        <div id="live"></div>
        <script src="//vodplayer.bs2dl.yy.com/yycloud.min.js"></script>
        <script type="text/javascript">
            function startZhiniuPlay(channelHls){
                window.__starting = true;
                $.get("/live/zhiniu/"+channelHls, function(resp){
                    if(resp.code == 0 && window.__starting){
                        $('#live').empty();
                        yyObject.setPlayer({
                            vquality:"3",
                            appid:50020,
                            mode:0,
                            width:document.body.clientWidth,
                            height:document.body.clientHeight,
                            auto_play:0,
                            token:resp.token,
                            vid:resp.streamId,
                            controls:1
                        },document.getElementById("live"));
                    }
                });
            }
            function stopZhiniuPlay(){
                window.__starting = false;
                $('#live').empty();
            }
            var yyTimer = null;
            $(function () {
                yyTimer = setInterval(function () {
                    if(typeof yyObject != 'undefined' && typeof yyObject.setPlayer == 'function'){
                        setTimeout(function () {
                            if(window.parent && window.parent.initLoadPlayer){
                                window.parent.initLoadPlayer();
                            } else{
                                // alert('window.parent.initLoadPlayer error');
                            }
                            clearInterval(yyTimer);
                        }, 100);
                    }
                }, 100);
            });
        </script>
    @elseif($roomLiveInfo->live_type == 11)
        <iframe id="id-huya" frameborder="no" border="0" style="margin-top:-100px;border:0;width:100%;height:500px;" src="http://m.huya.com/{{$roomLiveInfo->live_hls}}"></iframe>
    @else
        <video id="video-js" style="width:100%; height:100%;" allowfullscreen autoplay="autoplay" controls="" preload="auto" webkit-playsinline="" playsinline="" 
        src="{{$roomLiveInfo->live_hls}}"
            type="application/x-mpegURL" poster="" style="" x5nativepanel=""></video>
    @endif

</div>

<script type="text/javascript">
    var DEVICE_TYPE = '{{$device_type}}';
    var IS_WEIXIN = {{ !empty($is_weixin) ? 1 : 0 }};

    window.__starting = false;
    var objectPlayer;
    

    var triggerEvent = function(element,type){
        var event;
        if(document.createEventObject){
            event = document.createEventObject();
            return element.fireEvent('on'+type,event);
        }else{
            event = document.createEvent('HTMLEvents');
            event.eventName = type;
            event.initEvent(type,true,true);
            return !element.dispatchEvent(event);
        }
    }

    @if($roomLiveInfo->live_type == 5)
        function tabHeight() {

        }
        objectPlayer = new mpsPlayer({
            //appId: "fHNNBuuB3BbUWJiP",
            //uin: 13830,
            container:'video-js-warp',//播放器容器ID，必要参数
            uin: 24260,//用户ID
            appId: '7mbz3B1mbNUXyXQW',//播放实例ID
            hlsUrl: '{{$roomLiveInfo->live_hls}}',//控制台开通的APP hls地址
            rtmpUrl: '{{$roomLiveInfo->live_play}}',//控制台开通的APP rtmp地址
            flvUrl: '',//flv地址
            width: '100%',//播放器宽度，可用数字、百分比等
            height: '100%',//播放器高度，可用数字、百分比等
            autostart: true,//是否自动播放，默认为false
            stretching: parseInt('{{$sysConfig->stretching}}') || 1, //设置全屏模式,1代表按比例撑满至全屏,2代表铺满全屏,3代表视频原始大小,默认值为1。hls初始设置不支持，手机端不支持
            mobilefullscreen: parseInt('{{$sysConfig->mobilefullscreen}}') || false,  //移动端是否全屏，默认为false
            controlbardisplay: 'enable',//是否显示控制栏，值为：disable、enable默认为disable。
            isclickplay: true,//是否单击播放，默认为false
            isfullscreen: true,//是否双击全屏，默认为true
            enablehtml5: true,//是否优先使用H5播放器，默认为false

            isloadcount: 1,//网络波动卡顿loading图标显示(默认1s后)
            isdefaultfull: true,
            onReady:function(){
                console.log && console.log('mpsPlayer onReady');
                setTimeout(function () {
                    if( IS_WEIXIN ){
                        // if(!window.WeixinJSBridge && DEVICE_TYPE == 'ios'){
                            if(!window.WeixinJSBridge){
                            window.WeixinJSBridge = window.parent.WeixinJSBridge || {
                                invoke: function(type, args, callback){
                                    callback()
                                }
                            };
                            //alert('window.WeixinJSBridge')
                        }
                        console.log && console.warn("parent WeixinJSBridge", window.parent.WeixinJSBridge)
                        console.log && console.warn('ios wx addEventListener WeixinJSBridgeReady');
                        window.parent.document.addEventListener('WeixinJSBridgeReady',function(ev){  
                            console.log && console.warn("ios wx WeixinJSBridgeReady", ev);
                            //alert('WeixinJSBridgeReady')
                            triggerEvent(document, 'WeixinJSBridgeReady')

                        },false);
                    } 
                    if(window.parent && window.parent.initLoadPlayer){
                        window.parent.initLoadPlayer(); 
                    } else{
                        // alert('window.parent.initLoadPlayer error');
                    }
                    tabHeight();
                }, 200);
            },
            playCallback: function () {
                // alert("playCallback");
                console.log && console.log('mpsPlayer playCallback');
                setTimeout(function () {
                    tabHeight();
                }, 200);
            },
            pauseCallback: function () {
                //alert("pauseCallback");
                console.log && console.log('mpsPlayer pauseCallback');
                setTimeout(function () {
                }, 1000);
            }
        });
    @endif

    function _playVod1(url){
        var _v = document.getElementById('video-js') || document.getElementById('video');

        console.log && console.warn("_playVod1", url);
        if( $(_v).attr('src') != url){
            $(_v).attr('src', '');
            $(_v).attr('src', url);
        }
        $(_v).attr('preload', "auto");
        $(_v).attr('autoplay', "autoplay");

        if(_v){
            _v.play();
        } else {
            //alert('error getElementById video')
        }
    }
    function _play(channelHls, vod_url) { 
        vod_url = vod_url || '';
        channelHls = channelHls || '';
        var _v = document.getElementById('video-js') || document.getElementById('video');

        @if($roomLiveInfo->live_type == 5)
            var url = vod_url || channelHls;
            _playVod1(url);
            return ;
        @elseif($roomLiveInfo->live_type == 3 || $roomLiveInfo->live_type == 9)
            startZhiniuPlay(channelHls);
        @elseif($roomLiveInfo->live_type == 11)
            $('#id-huya').attr('src',"http://m.huya.com/"+channelHls);
        @else  
            $(_v).show();
            if(vod_url){
                $(_v).attr('src', vod_url);
            }else{
                $(_v).attr('src', channelHls);
            }
            if(_v){
                _v.play();
            } else {
                //alert('error getElementById video')
            }
        @endif
    }

    function _stop() {
        var _v = document.getElementById('video-js') || document.getElementById('video');
        @if($roomLiveInfo->live_type == 5)
            if(objectPlayer.pausePlay){
                objectPlayer.pausePlay();
            } else {
            }
            return ;
        @elseif($roomLiveInfo->live_type == 3 || $roomLiveInfo->live_type == 9)
            stopZhiniuPlay();
        @elseif($roomLiveInfo->live_type == 11)
            $('#id-huya').attr('src',"");
        @else
            $(_v).hide();
            $(_v).attr('src', '');

            if(_v){
                _v.currentTime = 0;
                _v.pause();
            } else {
                //alert('error getElementById video')
            }
        @endif
    }
</script>
</body>
</html>
