<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>{{ \app\api\ContentMgr::_content('pagecfg.title', $room_id) }}</title>
    @if(\app\api\ContentMgr::_content('pagecfg.icon', $room_id))
        <link href="{{ \app\api\ContentMgr::_content('pagecfg.icon', $room_id) }}" rel="shortcut icon"
              type="image/x-icon">
    @endif
    <meta name="Keywords" content="{{ \app\api\ContentMgr::_content('pagecfg.keywords', $room_id) }}">
    <meta name="description" content="{{ \app\api\ContentMgr::_content('pagecfg.description', $room_id) }}">

    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
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
            componentMap: {!! !empty($componentMap) ? json_encode($componentMap) : '{}' !!},
            componentTag: "{{ !empty($componentTag) ? $componentTag : 'default' }}",
            componentCfg: {!! !empty($componentCfg) ? json_encode($componentCfg) : '{}' !!},
            cdn: '{{$cdn}}',
            ver: '{{$webver}}',
            plat: '{{$plat}}',
            ip: "{{$request_client_ip}}",
            is_weixin: parseInt('{{ $is_weixin ? 1 : 0 }}'),
            device_type: '{{$device_type}}'
        };
        window.gettext = function (a, filename) {
            var f_map = window.D.componentCfg[filename] || {};
            var tmpArr = a.split('##');
            var key = tmpArr[1] || a;
            return f_map[key] || tmpArr[0] || '';
        };
        window.$t = window.gettext;
        window.$c = window.gettext;
        window.$m = window.gettext;
    </script>

    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/v3/pc/css/style.css?v={{$webver}}">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/v3/css/sina-emotion.css?v={{$webver}}">
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/artDialog/css/ui-dialog.css?v={{$webver}}">
    <link rel="stylesheet" href="{{$cdn}}/assets/v3/swiper/swiper.min.css?v={{$webver}}">
    <script type="text/javascript" src="{{$cdn}}/assets/v3/swiper/swiper.min.js?v={{$webver}}" ></script>
    <script type="text/javascript" src="{{$cdn}}/assets/v3/js/slide_nav.js?v={{$webver}}"></script>

    <style>
        .notice-le {
            width: 60px !important;
        }

        .jw-controlbar-left-group span, .jw-controlbar-right-group span, .jw-controlbar-center-group {
            opacity: 0;
            visibility: hidden;
        }

        .ui-dialog {
            border: 1px solid rgba(0, 0, 0, 0);
            overflow: hidden;
        }

        .notitle-dialog {
            border: none;
            overflow: inherit;
        }

        .ui-popup-modal .notitle-dialog-new {
            box-shadow: none;
        }

        .ui-popup-focus .notitle-dialog-new {
            box-shadow: none;
        }

        .notitle-dialog-new {
            border: none;
            overflow: inherit;
            background: rgba(0, 0, 0, 0)
        }

        .notitle-dialog-new td.ui-dialog-header, .notitle-dialog td.ui-dialog-header {
            border-bottom: none;
        }

        .notitle-dialog-new .ui-dialog-title, .notitle-dialog .ui-dialog-title {
            display: none;
        }

        .nobg-dialog {
            background-color: transparent;
        }

        .ui-dialog-close {
            top: 13px;
            right: 13px;
            position: absolute;
            opacity: 1;
            z-index: 5;
            display: block;
            color: rgba(0, 0, 0, 0);
            width: 23px;
            height: 23px;
            background: url(/assets/img/close-w.png) no-repeat;
        }

        .notitle-dialog .ui-dialog-close {
            top: -15px;
            right: -15px;
            position: absolute;
            opacity: 1;
            z-index: 5;
            display: block;
            color: rgba(0, 0, 0, 0);
            width: 36px;
            height: 36px;
            background: url(/assets/img/sprite.png) no-repeat;
        }

        .notitle-dialog-new .ui-dialog-close {
            top: 41px;
            right: -15px;
            position: absolute;
            opacity: 1;
            z-index: 5;
            display: block;
            color: rgba(0, 0, 0, 0);
            width: 36px;
            height: 36px;
            background: url(/assets/img/sprite.png) no-repeat;
        }

        .ui-dialog-close:hover, .ui-dialog-close:focus {
            opacity: 1;
        }

        .ui-dialog-header {
            padding: 0;
            border: 0 none;
            text-align: left;
            background: #2E6DD6;
            color: #fff;
        }
    </style>
    <style>

        @foreach($roles as $role_id => $_role)
		.userlist-icon-{{$_role['role_id']}}  {
            background-image: url("{{$_role['role_pic']}}") !important;;
            width:  @if($_role['role_picw'] != '') {{$_role['role_picw']}}px @else 24px @endif !important;
            background-repeat: no-repeat;
        }

        .chat-message-name-{{$_role['role_id']}}  {
            background-color: @if($_role['nick_bg_color'] == '') #ffffff@else {{$_role['nick_bg_color']}} @endif ;
            color: @if($_role['nick_color'] == '') {{$sysConfig->nick_color}} @else {{$_role['nick_color']}} @endif ;
        }

        .msg-bg-color-{{$_role['role_id']}} {
            @if($_role['role_id']  == 500)
                background-color: @if($_role['message_bg_color'] == '') {{$sysConfig->mgr_color}} @else {{$_role['message_bg_color']}} @endif  !important;
            @else
                background-color: @if($_role['message_bg_color'] == ''){{$sysConfig->def_color}} @else {{$_role['message_bg_color']}} @endif  !important;
        @endif
        }
        @endforeach
    </style>

    <!--  header_code start  -->
{!! \app\api\ContentMgr::_content('pagecfg.header_code', $room_id) !!}
<!--  header_code end -->
</head>
<body>
<div id="app"></div>
</body>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/base-polyfill.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/libs/paho-mqtt/mqttws31.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/mod.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/static/api/LiveApi.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/static/api/GraphQLApi.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.nicescroll-3.6.0/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/black_clientv2.js?v={{$webver}}"></script>
@if($app::config('site.dms_host', ''))
    <script type="text/javascript">
        if (typeof ROP != 'undefined') {
            ROP.ICS_ADDR = "{{ $app::config('site.dms_host', '') }}";
            ROP.ICS_PORT = parseInt("{{ $app::config('site.dms_port', 9123) > 0 ? $app::config('site.dms_port', 9123) : 9123 }}");
            ROP.ICS_PORT_FLASH = parseInt("{{ $app::config('site.dms_port_flash', 1883) > 0 ? $app::config('site.dms_port_flash', 1883) : 1883 }}");
            ROP.CDN_ADDR = "{{ $app::config('site.dms_cdn_host', '') }}";
        }
    </script>
@endif

<script type="text/javascript" src="{{$cdn}}/assets/v3/js/sina-emotion.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/dmshub.js?v={{$webver}}"></script>
<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/v3/js/jquery.countdown.css?v={{$webver}}">
<script type="text/javascript" src="{{$common_cdn}}/js/uploadify-2.2/jquery.uploadify.min.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/v3/js/dialog-min2.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.qrcode/jquery.qrcode.min.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js?v={{$webver}}"></script>
<link href="{{$common_cdn}}/js/bootstrap-colorpalette/css/bootstrap-colorpalette.css?v={{$webver}}" rel="stylesheet"/>
<script type="text/javascript"
        src="{{$common_cdn}}/js/bootstrap-colorpalette/js/bootstrap-colorpalette.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/v3/js/clipboard.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/placeholder/jquery.placeholder.js?v={{$webver}}"></script>
<script type="text/javascript">
    var LIVE_PLAT = 'pc';

    !(function () {
        var apiList = ['LiveApi', 'GraphQLApi'];
        var cdn = window.D && window.D.cdn || '';
        var ver = window.D && window.D.ver || '0.0';
        var resMap = {};
        for (var i = 0; i < apiList.length; i++) {
            var key = "static/api/" + apiList[i] + ".js";
            resMap[key] = {"url": cdn + "/static/api/" + apiList[i] + ".js?v=" + ver};
        }
        require.resourceMap({
            "res": resMap
        });
    })();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
        }
    });
    window.dms = new DmsHub({
        debug: (WEB_ENVIRON && WEB_ENVIRON == 'debug'),
        room_id: parseInt('{{$room_id}}'),
        uid: parseInt("{{$user->uid}}")
    });
    window.app = {};

    var roomInfo = {
        room_id: parseInt('{{$room_id}}'),
        parent_room_id: parseInt('{{ $parent_room_id }}'),
        token: '{{ $token }}'
    };

    var baseConfig = {
        syscfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('syscfg', $room_id)) !!},
        bgcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('bgcfg', $room_id)) !!},
        hotcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('hotcfg', $room_id)) !!},
        msgcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('msgcfg', $room_id)) !!},
        extcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('extcfg', $room_id)) !!},
        textcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('textcfg', $room_id)) !!},
        extcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('extcfg', $room_id)) !!},
        sitecfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('sitecfg', $room_id)) !!},
        eventcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('eventcfg', $room_id)) !!},
        playercfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('playercfg', $room_id)) !!},
        ulcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('ulcfg', $room_id)) !!},
        jfcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('jfcfg', $room_id)) !!},
        popcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('popcfg', $room_id)) !!},
        blockcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('blockcfg', $room_id)) !!},
        pagecfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('pagecfg', $room_id)) !!},
        noticecfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('noticecfg', $room_id)) !!},
        logincfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('logincfg', $room_id, ['pwd', 'video_pwd'])) !!},
        regcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('regcfg', $room_id)) !!},
        chatcfg: {!! json_encode(\app\api\ContentMgr::_contentCfg('chatcfg', $room_id)) !!},
        pgsizecfg:{!! json_encode(\app\api\ContentMgr::_contentCfg('pgsizecfg', $room_id)) !!},
        roomnavs: {!! !empty($roomnavs) ? json_encode($roomnavs) : '[]' !!},
        roomtabs: {!! !empty($roomtabs) ? json_encode($roomtabs) : '[]' !!},
        roombgs: {!! !empty($roombgs) ? json_encode($roombgs) : '[]' !!},
        theme:{!! !empty($theme) ? json_encode($theme) : '[]' !!},
        roomqqs:{!! !empty($roomqqs) ? json_encode($roomqqs) : '[]' !!},
        roles: {!! !empty($roles) ? json_encode($roles) : '[]' !!},
        channelInfo: {
            needPwd: parseInt('{{ \app\api\ContentMgr::_content('logincfg.video_pwd', $room_id) != '' ? 1 : 0 }}'),
            videoBgImg: '{{$videoBgImg}}',
            alone_video: {{ !empty($alone_video) ? 1 : 0 }},
            channelType: '{{$roomLiveInfo->live_type}}',
            vod_url: "{{$roomLiveInfo->vod_url}}",
            living: {{ !empty($roomLiveInfo->live_state) ? 1 : 0 }},
            live_play: '{{$roomLiveInfo->live_play}}',
            live_hls: '{{$roomLiveInfo->live_hls}}'
        }
    };

    var userInfo = {
        uid: "{{$user->uid}}",
        name: "{{$user->name}}",
        pic: "{{ \app\Util::stri_startwith($user->pic, '/assets/') && !empty($cdn) ? ("{$cdn}" . substr($user->pic, 1)) : $user->pic }}",
        role_id: parseInt('{{ $user->role_id }}'),
        lookvideo: parseInt('{{ !empty($user->lookvideo) ? 1 : 0}}'),
        role: {!! !empty($role) ? json_encode($role) : '{}' !!},
        logined: parseInt('{{ !empty($user->role_id) && $user->role_id != \app\Model\RoleBase::GUEST_ID ? 1 : 0 }}'),
        isManager: parseInt('{{ !empty($user->role_id) && $user->role_id == \app\Model\RoleBase::MGR_ID ? 1 : 0 }}'),
        isTeacher: parseInt('{{ !empty($user->role_id) && $user->role_id == \app\Model\RoleBase::TEACHER_ID ? 1 : 0 }}'),
        tgURL:"",
        recommend_num:"{{$user->recommend_num}}",
        recommend_reg:"{{$user->recommend_reg}}",
        dmsConfig: {
            aliMqtt: {!! !empty($aliMqtt) ? json_encode($aliMqtt) : '{}' !!},
            dms_msg_enable: parseInt('{{ !empty($site->dms_msg_enable) ? 1 : 0 }}'),
            proxyTopicMap: {!! !empty($proxyTopicMap) ? json_encode($proxyTopicMap) : '{}' !!},
            subKey: "{{$subKey}}",
            pubKey: "{{$pubKey}}",
            topic: "{{$topic}}",
            clerkTopic: '{{ $clerkTopic }}',
            parentTopic: "{{$parentTopic}}",
            guestTopic: "{{ !$logined ? $guestTopic : ''}}",
            siteTopic: "{{$siteTopic}}",
            clientId: "{{$clientId}}",
            liveNotifyTopic: '{{ $liveNotifyTopic }}',
            topicAudit: "{{ $topicAudit }}",
            presentTopic: "{{ $presentTopic }}"
        }
    };

    window.__checked_video_pwd__ = 0;
    var videoWin = {};

    dms.onMsg('courseStart', function (top, data) {
        onRecvCourseStart(data);
    });
    dms.onMsg('courseStop', function (top, data) {
        onRecvCourseStop(data);
    });

    function initLoadPlayer() {
        if (baseConfig.extcfg.hj_opend && !userInfo.role.f_hj) {
            var hjTimeFunc = function realRunHjTime() {
                var hm = dms.date('H:m');
                if (baseConfig.extcfg.hj_opend && baseConfig.extcfg.hj_hm.split(' ')[0] <= hm && baseConfig.extcfg.hj_hm.split(' ')[1] >= hm) {
                    hideVideo();
                } else {
                    showVideo();
                }
            };
            hjTimeFunc();
            setInterval(hjTimeFunc, 1000);
        }
        if (!userInfo.lookvideo) {
            baseConfig.channelInfo.living = 0;
        }
        startVideo();
    }


    function playVod(url) { //视频库 播放点播视频
        videoWin._playVod && videoWin._playVod(url);
    }

    function playVideo(url) {
        url = url || null;
        videoWin._play && videoWin._play(url);
    }

    function stopVideo() {
        videoWin._stop && videoWin._stop();
    }

    function onRecvCourseStart(data) {
        if (baseConfig.channelInfo.alone_video) {
            if (data.room_id != roomInfo.room_id) {
                // 独立视频 只处理 room_id 为 自己 room_id 的视频消息
            } else if (data.room_id == roomInfo.room_id) {
                baseConfig.channelInfo.alone_video = 1;
                baseConfig.channelInfo.living = 1;
                baseConfig.channelInfo.channelType = data.live_type;
                baseConfig.channelInfo.live_play = data.live_play;
                baseConfig.channelInfo.live_hls = data.live_hls;
                baseConfig.channelInfo.vod_url = data.vod_url;
                showVideo();
            }
        } else {
            if (data.room_id != roomInfo.parent_room_id && data.room_id == roomInfo.room_id) {
                baseConfig.channelInfo.alone_video = 1
            }
            baseConfig.channelInfo.living = 1;
            baseConfig.channelInfo.channelType = data.live_type;
            baseConfig.channelInfo.live_play = data.live_play;
            baseConfig.channelInfo.live_hls = data.live_hls;
            baseConfig.channelInfo.vod_url = data.vod_url;
            showVideo();
        }
    }

    function onRecvCourseStop(data) {
        if (baseConfig.channelInfo.alone_video) {
            if (data.room_id != roomInfo.room_id) {
                // 独立视频 只处理 room_id 为 自己 room_id 的视频消息
            } else if (data.room_id == roomInfo.room_id) {  // 消息中 room_id 等于自己 房间id 再次请求接口查询视频信息
                baseConfig.channelInfo.alone_video = 0;
                dms.LiveApi.liveInfo({}, function (resp) {
                    baseConfig.channelInfo.living = resp.live_state;
                    baseConfig.channelInfo.channelType = resp.live_type;
                    baseConfig.channelInfo.live_play = resp.live_play;
                    baseConfig.channelInfo.live_hls = resp.live_hls;
                    if (!baseConfig.channelInfo.living) {
                        baseConfig.channelInfo.videoBgImg = resp.imgurl;
                        hideVideo();
                    } else {
                        showVideo();
                    }
                });
            }
        } else {
            // 自己主房间 发送的下麦消息 停止视频
            if (data.room_id == roomInfo.parent_room_id) {
                baseConfig.channelInfo.living = 0;
                baseConfig.channelInfo.videoBgImg = data.imgurl;
                hideVideo();
            }
        }
    }

    function showVideo() {
        if (!baseConfig.channelInfo.living) {
            return;
        }
        if (!userInfo.lookvideo) {
            hideVideo();
            return;
        }

        if ((baseConfig.channelInfo.needPwd && window.__checked_video_pwd__) || !baseConfig.channelInfo.needPwd) {
            $('#js-video-player-pwd').hide();
            app.$store.commit("UPDATE_ROOM_INFO", {
                videoUrl: "/video?room_id=" + app.roomInfo.room_id + "&token=" + app.roomInfo.token,
                videoStatus: {
                    is_show_video: true
                }
            });
            playVideo();
        } else {
            app.$store.commit("UPDATE_ROOM_INFO", {
                videoUrl: "",
                videoStatus: {
                    is_show_video: false
                }
            });
        }
        window.videoWin = {};
    }

    function hideVideo() {
        app.$store.commit("UPDATE_ROOM_INFO", {
            videoUrl: "",
            videoStatus: {
                is_show_video: false
            }
        });
        stopVideo();
        window.videoWin = {};
    }

    function startVideo() {
        if (!userInfo.lookvideo) {
            hideVideo();
        } else if (baseConfig.channelInfo.living) {
            showVideo();
        }
    }
</script>

<script type="text/javascript" src="{{$cdn}}/assets/dist_f/vendor.js?v=aae205963da600c9e14b_{{$webver }}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/dist_f/pc.js?v=aae205963da600c9e14b_{{$webver }}"></script>
<script type="text/javascript">
    $(function () {
        if (window.processPaste) {
            $('#js-chat-form-input')[0].addEventListener('paste', processPaste);
        }

        $(".nice-scroll-h").wait(function () {
            $('.nice-scroll-h').niceScroll({
                cursorborder: '',
                horizrailenabled: false,
                cursorcolor: '#999',
                boxzoom: false
            });
            $('.nice-scroll').niceScroll({
                cursorborder: '',
                cursorcolor: '#999',
                boxzoom: false
            });
        })
    });

</script>
<!--  footer_code start  -->
<!-- {!! \app\api\ContentMgr::_content('pagecfg.footer_code', $room_id) !!} -->
<!--  footer_code end -->
</html>
