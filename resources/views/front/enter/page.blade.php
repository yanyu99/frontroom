<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    @if($isMobile)
        <meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0"
              name="viewport">
    @endif

    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
    <script type="text/javascript">
        window.D = {
            cdn: '{{ $cdn }}',
            ver: '{{ $webver }}'
        };
    </script>

    <script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{$cdn}}/assets/js/base-polyfill.js?v={{$webver}}"></script>

    <title>{{$room->title}}</title>
    <script type="text/javascript">

        var P_TYPE = '{{$p_type}}';
        var S_TYPE = {{ !empty($s_type) ? 1 : 0  }};
        var ROOM_URL = '{!! $room_url !!}';
        var IS_MOBILE = {{ !empty($isMobile) ? 1 : 0  }};
        var DATA_USER = {!! !empty($user) ? json_encode($user) : '{}' !!};
        var DATA_ROOM = {!! !empty($room) ? json_encode($room) : '{}' !!};
        var DATA_CONFIG = {!! !empty($config) ? json_encode($config) : '{}' !!};
        var VIDEO_SHOW_CONTROL = false;
        if (typeof window.console == "undefined" || typeof window.console.log == "undefined") {
            window.console = {
                log: function () {
                }
            };
        }

        function jumpToRoom() {
            var date = new Date();
            date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
            //var opt = { path: '/', expires: date };
            $.cookie('_enter', S_TYPE);
            location.href = ROOM_URL;
        }
    </script>
</head>
<body>
{!!$room->code_body_pre!!}

@if($p_type == 'pic')
    <style>
        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            background: url({{ $isMobile ? $config['mpic'] : $config['pic']}}) no-repeat;
            background-size: 100% 100%;
            overflow: hidden;
        }
    </style>
    <div id="room_enter_pic" style="cursor: pointer;height: 100%;width: 100%"></div>

    <script type="text/javascript">

        $(function () {
            $('#room_enter_pic').click(function () {
                jumpToRoom();
            });
        });
    </script>

@elseif($p_type == 'video')
    @if($isMobile)
        <style>
            html, body {
                width: 100%;
                height: 100%;
            }

            .enter_h3 {
                width: 100%;
                text-align: center;
            }
        </style>
        <script type="text/javascript" src="{{$cdn}}/assets/js/mpshlsplayer.js?v={{$webver}}"></script>
        <div id="room_enter_video" style="width: 100%"></div>
        <div>
            <h3 class="enter_h3">
                <a onclick="jumpToRoom()">点我进入直播间</a>
            </h3>
        </div>
    @else
        <style>
            html, body {
                width: 100%;
                height: 100%;
            }

            a {
                color: #666;
                text-decoration: none;
                outline: 0
            }

            a:hover {
                text-decoration: none
            }

            .sec-v-posi {
                /* pointer-events:none; */
                position: absolute;
                top: 10%;
                left: 10%;
                width: 80%;
                height: 80%;
            }

            .tab-hide {
                display: none;
            }

            .sec-v-posi .video-asd {
                width: 212px;
                height: 46px;
                box-sizing: border-box;
                background-color: rgba(0, 0, 0, .5);
                border-radius: 11px;
                margin: auto;
                color: #fff;
                line-height: 43px;
                border: 1px solid #fff;
            }

            .video-asd:hover {
                color: #FFA409;
                border: 1px solid #FFA409;
            }
        </style>
        <script type="text/javascript" src="{{$cdn}}/assets/js/mpshlsplayer.js?v={{$webver}}"></script>
        <div id="room_enter_video" style="height: 100%;width: 100%"></div>
        <div class="sec-v-posi " id="video_shade">
            <div style="text-align: center;" class="tab-hide" id="lesson_show_info">
                <a onclick="jumpToRoom()" class="alert_login">
                    <div class="video-asd" style="display: block;">
                        <span id="show_time" style="font-size: 16px;">点我进入直播间</span>
                    </div>
                </a>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#lesson_show_info').css({
                    'margin-top': ($('#video_shade').height() - $('#lesson_show_info').height()) / 2
                });
                $('#video_shade').mouseenter(function () {
                    $('#lesson_show_info').removeClass('tab-hide');
                });
                $('#video_shade').mouseleave(function () {
                    $('#lesson_show_info').addClass('tab-hide');
                });
            });
        </script>
    @endif

    <script type="text/javascript">

        var objectPlayer;

        $(function () {
            objectPlayer = new mpsPlayer({
                container: 'room_enter_video',  //播放器容器ID，必要参数
                uin: '13830',//用户ID
                appId: 'f6mm6Nb3B33PxXii',//播放实例ID
                url: "{!! $config['video'] !!}",
                width: '100%',//播放器宽度，可用数字、百分比等
                height: '100%',//播放器高度，可用数字、百分比等
                autostart: true,//是否自动播放，默认为false
                stretching: 1, //设置全屏模式,1代表按比例撑满至全屏,2代表铺满全屏,3代表视频原始大小,默认值为1。hls初始设置不支持，手机端不支持
                mobilefullscreen: true,  //移动端是否全屏，默认为false
                controlbardisplay: 'enable',//是否显示控制栏，值为：disable、enable  默认为disable。
                isclickplay: false,//是否单击播放，默认为false
                isfullscreen: false,//是否双击全屏，默认为true
                enablehtml5: false,//是否优先使用H5播放器，默认为false
                isloadcount: 1,//网络波动卡顿loading图标显示(默认1s后)
                isdefaultfull: true,
                onReady: function () {
                    console.log('objectPlayer onReady');
                    objectPlayer.addPlayerCallback && objectPlayer.addPlayerCallback('stop', function () {
                        console.log('callback play.stop cur:', objectPlayer.currenttime(), ', total:', objectPlayer.totalfiletime());
                        jumpToRoom();
                    });
                }
            });

            if (IS_MOBILE) {
                $('#video-js').wait(function () {
                    var videoPlay = $(this)[0];
                    videoPlay.addEventListener && videoPlay.addEventListener('ended', function (e) {
                        console.log('callback videoPlay ended');
                        jumpToRoom();
                    });
                })
            } else {
                $('#html5Media1').wait(function () {
                    var videoPlay = $(this)[0];
                    videoPlay.addEventListener && videoPlay.addEventListener('ended', function (e) {
                        console.log('callback videoPlay ended');
                        jumpToRoom();
                    });
                })
            }
        });
    </script>
@else

    {!! !empty($config['html']) ? $config['html'] : ''  !!}
@endif
</body>

{!!$room->code!!}
</html>