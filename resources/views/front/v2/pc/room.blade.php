<!DOCTYPE html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,Chrome=1">
    <title>{{$room->title}}</title>
    @if($room->icon)
        <link href="{{$room->icon}}" rel="shortcut icon" type="image/x-icon">
    @endif
    <meta name="Keywords" content="{{$room->keywords}}">
    <meta name="description" content="{{$room->description}}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
<!--<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.css">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/artDialog/ui-dialog.css?v={{$webver}}">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/v2/css/pc/style.css?v={{$webver}}">
    @if($user->role->f_font_size)
        <link href="{{$common_cdn}}/js/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet"
              type="text/css" media="all">
        <style type="text/css">
            #js-chat-color-btn {
                display: inline-block;
                position: relative;
                width: 24px;
                height: 32px;
            }
            #js-chat-color-btn .in {
                position: absolute;
                top: 6px;
                left: 2px;
                width: 20px;
                height: 20px;
                background: url({{$cdn}}/assets/img/select2.png) center;
                background-size: 20px 20px;
                background-repeat: no-repeat;
            }
        </style>
    @endif
    <style type="text/css">
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
            background: url({{$cdn}}/assets/v2/img/v2/close.png) no-repeat;
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
            background: url({{$cdn}}/assets/img/sprite.png) no-repeat;
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
            background: url({{$cdn}}/assets/img/sprite.png) no-repeat;
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
        {{-- */ $defaultBgStyle = "theme-background-1"; /* --}}
	@foreach($roomBgs as $key=>$value)
		@if(substr( $value->imgurl,0,7 ) =="http://")
		.page-container.theme-background-{{$key}}   {
            background-image: url("{{$value->imgurl}}");
        }
        .background-{{$key}}   {
            background-image: url("{{$value->imgurl}}");
        }
        @else
		.page-container.theme-background-{{$key}}   {
            background-image: url("{{$cdn.$value->imgurl}}");
        }
        .background-{{$key}}   {
            background-image: url("{{$cdn.$value->imgurl}}");
        }
        @endif
		@if($value->selected)
		{{-- */ $defaultBgStyle = "theme-background-".$key; /* --}}
		@endif
	@endforeach
	@foreach($roles as $role)
		.chat-message-role-{{$role->role_id}}   {
            background-image: url("{{$role->imgurl}}");
            background-size: 100% 100%;
            line-height: 27px;
            width: {{$role->imgwidth/24*27}}px;
            height: 27px;
            display: inline-block;
            vertical-align: -8px;
        }
        .chat-me .chat-message-role-{{$role->role_id}}   {
            text-align: right;
        }
        .icon-{{$role->role_id}}    {
            display: inline-block;
            background-image: url("{{$role->imgurl}}") !important;
            @if($role->imgwidth > 0)
   width: {{$role->imgwidth}}px;
            @else
   width: 24px;
            @endif
   background-repeat: no-repeat;
        }
        @endforeach
	@if($roomUI->login_pop_img)
		.login-tips-content {
            background-image: url({{$roomUI->login_pop_img}});
            background-size: 100% 100%;
        }
        @endif

	{{-- */$containJC = $roomnavs->contains('type', '4005');
		$containFortune = $roomnavs->contains('type', '4020')?1:0;
		
	 /* --}}

	  {{-- 判断是否显示 侧边栏 菜单 如果所有元素都不存在 自动隐藏侧边菜单 并增大聊天区域和视频区域  控制 div 为 main-sider-menu  */
	  $showMainSiderMenu =  ( $site->hot_opend || $roomnavs->filter(function ($value, $key) {return $value->pos == 3;})->count() > 0 || $sysConfig->stock_code || $roomUI->show_siderewm || $roomUI->show_siderlist )
	  /* --}}

	 @if($roomnavs->contains('pos',4))
	.page-container.layout-sider-right .main-sider-menu {
            left: auto;
            right: 0;
            border-left: none;
        }
        .page-container.layout-sider-right .main-content {
            left: 63px;
            right: {{$showMainSiderMenu ? 236: 0}}px;
        }
        .page-container.layout-sider-right .sider-menu-content {
            left: 0px;
            right: auto;
        }
        .page-container.layout-sider-left .main-sider-menu {
            left: 63px;
            right: auto;
            border-right: none;
        }
        .page-container.layout-sider-left .main-content {
            left: {{$showMainSiderMenu ? 299 : 63}}px;
            right: 0;
        }
        .page-container.layout-sider-left .sider-menu-content {
            left: 0px;
            right: auto;
        }
        @endif

	#js_notice_msg {
            color: {{$notice_msg_color}};
        }
    </style>

    @if( !empty($roomUI->pc_banner_cfg) )
        <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/js/swiper/swiper.min.css?v={{$webver}}">
        <style type="text/css">
            .page-container{
                margin-top: 140px;
            }
            #swiper-pagination-id{
                bottom: 3px;
            }
        </style>
    @endif
</head>
<body>
{!!$room->code_body_pre!!}
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/base-polyfill.js?v={{$webver}}"></script>
<link rel="stylesheet" href="//g.alicdn.com/de/prismplayer/2.5.0/skins/default/aliplayer-min.css" />
<script type="text/javascript" src="{{$cdn}}/assets/js/aliplayer-min.js?v={{$webver}}"></script>

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
        ver: '{{$webver}}',
        roomId: '{{$room->id}}',
        parentRoomId: '{{$parentRoomId}}',
        dynamicMsg: '{{$room->dynamic_msg}}',
        showUserlist:{{$roomUI->show_userlist && $user->role->f_userlist ? 1:0}},
        deskIconUrl: "{{$cdn}}/assets/js/img/send-ok.png",
        phoneUrl: '{{$phoneUrl}}',
        lessonUrl: "{{$roomUI->lesson_img}}",
        theme:{!!json_encode( $theme )!!},
        containFortune:{{$containFortune}},
        popUpFortune:{{$popUpFortune}},
        loginPopTs: "{{$roompower->login_pop_ts}}" * 1000 || 0,
        guest_chat_cue:{{$roompower->guest_chat_cue?1:0}},
        showjc:{{$containJC?1:0}},
        agree_opend:{{$agree_opend}},
        reg_mod:{{$sysConfig->reg_mod}},
        luckmoney_need_phone:{{$luckmoney_need_phone}},
        teacher_pre: '{{$sysConfig->teacher_pre}}',
        ui_type: '{{$site->ui_type}}',
        tgURL: '{{$tgURL}}',
        defaultBgStyle: '{{$defaultBgStyle}}',
        stockCode: "{{$sysConfig->stock_code}}",
        lookVideoImg: "{{$sysConfig->lookvideoImg}}",
        videoBgImg: "{{$videBgImg}}",
        chatOption: {
            dms_msg_enable: {{ !empty($site->dms_msg_enable) ? 1 : 0 }},
            proxyTopicMap: {!! !empty($proxyTopicMap) ? json_encode($proxyTopicMap) : '{}' !!},
            subKey: '{{$subKey}}',
            pubKey: '{{$pubKey}}',
            topic: '{{$topic}}',
            parentTopic: '{{$parentTopic}}',
            @if(!$logined)
            guestTopic: '{{$guestTopic}}',
            @endif
            siteTopic: '{{$siteTopic}}',
            @if($user->role->f_audit)
            topicAudit: '{{$topicAudit}}',
            @endif
            clientId: '{{$clientId}}',
            @if($site->ul_ht_opend)
            presentTopic: "__present__{{$parentTopic}}"
            @else
            presentTopic: "__present__{{$topic}}"
            @endif
        },

    }
    window.D.HJTIME = {
        start: '{{$sysConfig->hj_start_at}}',
        end: '{{$sysConfig->hj_end_at}}',
        imgurl: '{{$sysConfig->hj_bg}}',
        opend:{{$sysConfig->hj_opend?1:0}}
    }
    window.D.INFO = {
        'logo': '{{$room->logo}}',
        'title': '{{$room->title}}',
        'description': '{{$room->description}}'
    }
    window.D.CHANNELINFO = {
        stretching: parseInt('{{$sysConfig->stretching}}'),
        mobilefullscreen: parseInt('{{$sysConfig->mobilefullscreen}}'),
        alone_video:{{$alone_video}},
        @if( $roomLiveInfo->teacher )
        teacherName: '{{$sysConfig->teacher_pre}}<span style="color:{{$roomLiveInfo->teacher->name_color}}">{{$roomLiveInfo->teacher->name}}</span>',
        @else
        teacherName: '{{$sysConfig->teacher_pre}}无',
        @endif
        living:{{$roomLiveInfo->live_state?1:0}},
        channelType: parseInt('{{$roomLiveInfo->live_type}}'),
        channelNumber: '{{$roomLiveInfo->live_play}}',
        channelHls: '{{$roomLiveInfo->live_hls}}',
        live_play: '{{$roomLiveInfo->live_play}}',
        live_hls: '{{$roomLiveInfo->live_hls}}',
        live_flv: '{{$roomLiveInfo->live_flv}}',
        live_play1: '{{$roomLiveInfo->live_play1}}',
        live_hls1: '{{$roomLiveInfo->live_hls1}}',
        vod_url: "{{$roomLiveInfo->vod_url}}",
        @if($roomLiveInfo->teacher)
        teacher: {
            name: '{{$roomLiveInfo->teacher->name}}',
            id: "{{$roomLiveInfo->teacher->id}}",
        },
        noteacher: false,
        @else
        teacher: {
            name: '{{$room->title}}',
            id: 0,
        },
        noteacher: true,
        @endif
        chosed: 0,
        showVideo: 0,
    }
    window.D.USER = {
        uid: '{{$user->uid}}',
        name: '{{$user->name}}',
        type: '{{$user->type}}',
        pic: '{{$user->pic}}',
        role:{!!json_encode($user->role)!!},
        chatIntervalCount:parseInt('{{$user->role->chat_ts}}'),
        plat: '{{$plat}}',
        logined:parseInt('{{$logined}}'),
        isManager:parseInt('{{$isManager}}'),
        isTeacher:parseInt('{{$isTeacher}}'),
        lookvideo:parseInt('{{$user->lookvideo?1:0}}'),
    };
    window.D.CONF = {
        chatbox_style: parseInt('{{$sysConfig->chatbox_style}}'),
        mgr_to_chat: parseInt('{{$sysConfig->mgr_to_chat}}'),
        chat_add_hot: parseInt('{{$sysConfig->chat_add_hot}}'),
        hide_to_user: parseInt('{{$sysConfig->hide_to_user}}')
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
        }
    });
    var __real_robot_num = 0;
    var __base__ = 0;
    var __base_num__ = {{$roompower->base_user}}
</script>

@if( !empty($roomUI->pc_banner_cfg) )
    <div class="pc-banner" style="height: 140px;width: 100%">
        <div class="swiper-container swiper-container-ad" style="height: 140px;width: 100%">
            <div class="swiper-wrapper">
                @foreach($roomUI->pc_banner_cfg as $idx=>$item)
                <div class="swiper-slide" style="text-align:center" data-src="{{$item['src']}}">
                    <a href="{{$item['href']}}" target="_blank">
                        <img data-src="{{$item['src']}}" class="swiper-lazy" style="width: 100%;height: 100%"/>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination swiper-pagination-ad" id="swiper-pagination-id"></div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="{{$cdn}}/assets/js/swiper/swiper.jquery.min.js?v={{$webver}}"></script>
        <script type="text/javascript">
            $(function () {
                function resizePageHeightByBanner() {
                    var w_h = document.documentElement.clientHeight;
                    $('.page-container').height(w_h - $('.pc-banner').height());
                }

                function activeSwiperAd() {
                    var mySwiperAd = new Swiper('.swiper-container-ad',{
                        loop: true,
                        pagination: '.swiper-pagination-ad',
                        paginationClickable: true,
                        lazyLoading : true,
                        autoplay: 600 * 1000,
                        autoplayDisableOnInteraction: false
                    });
                }

                $(window).resize(function () {
                    resizePageHeightByBanner();
                });
                resizePageHeightByBanner();
                activeSwiperAd();
            });
        </script>
    @endpush
@endif

<div class="danmu-warp">
    <div class="danmu-content"></div>
</div>

<div class="page-container theme-default
        @if(isset($theme['layoutsider'])) {{$theme['layoutsider']}} @else layout-sider-left @endif
        @if(isset($theme['layout'])) {{$theme['layout']}} @else layout-video-right @endif
        @if(isset($theme['backgroundImg'])) {{$theme['backgroundImg']}} @else {{$defaultBgStyle}} @endif
        @if(isset($theme['buttonColor'])) {{$theme['buttonColor']}} @else theme-button-color-1 @endif" id="main"  style="overflow-y:hidden">

    <div class="main-header">
        <div class="header-navbar" id="search">
            @if($room->logo)
                <img class="main-logo" src="{{$room->logo}}" alt="logo">
            @endif
            <ul>
                @if($site->proposing_opend)
                    <li>
                        <a id="idProp">
                            <img style="border-radius: 4px;" height="30px" class="icon_prop"
                                 src="{{$cdn}}/assets/img/fxts/fxts.png">
                        </a>
                    </li>
                @endif
                {{-- */$i=0;/* --}}
                @foreach($roomnavs as $nav)
                    @if($nav->pos == 1)
                        <li>
                            @if($nav->type == 4003)
                                <a href="{{$nav->url['url']}}"
                                   @if(empty($nav->title)) style="line-height: 36px;font-size: 0px;display: block;"
                                   @endif target="_blank">
                                    @if(!empty($nav->icon))<img style="max-height: 30px;"
                                                                src="{{$nav->icon}}">@endif
                                    @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                </a>
                            @elseif($nav->type == 4002)
                                <a href="javascript:;"
                                   @if(empty($nav->title)) style="line-height: 36px;font-size: 0px;display: block;"
                                   @endif @if(isset($nav->url['imgurl']))  data-img="{{$nav->url['imgurl']}}"
                                   @endif @if(isset($nav->url['qqtype']) && !empty($nav->url['qqtype'])) class="my-pop-img-qq"
                                   data-qqtype="{{$nav->url['qqtype']}}"
                                   @else class="my-pop-img" @endif >
                                    @if(!empty($nav->icon))<img style="max-height: 30px;"
                                                                src="{{$nav->icon}}">@endif
                                    @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                </a>
                            @elseif($nav->type == 4004)
                                <a href="javascript:;" class="nav-show-qq"
                                   @if(empty($nav->title)) style="line-height: 36px;font-size: 0px;display: block;" @endif >
                                    @if(!empty($nav->icon))<img style="max-height: 30px;"
                                                                src="{{$nav->icon}}">@endif
                                    @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                </a>
                            @elseif($nav->type == 4017)
                                <a href="javascript:;" data-width="{{$nav->url['width']}}"
                                   data-height="{{$nav->url['height']}}" data-id="{{$nav->id}}"
                                   class="nav-show-banner"
                                   @if(empty($nav->title))  style="line-height: 36px;font-size: 0px;display: block;" @endif>
                                    @if(!empty($nav->icon))<img style="max-height: 30px;"
                                                                src="{{$nav->icon}}">@endif
                                    @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                </a>
                            @elseif($nav->type == 4500)
                                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin={{$nav->url['qq']}}&amp;site=qq&amp;menu=yes"
                                   target="_blank" data-qq="{{$nav->url['qq']}}" data-id="{{$nav->id}}">
                                    @if(!empty($nav->icon))<img style="max-height: 30px;"
                                                                src="{{$nav->icon}}">@endif
                                    @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                </a>
                            @else
                                <a href="javascript:;" class="js-ui-dialog-{{$nav->type}}"
                                   data-title="{{$nav->title}}" data-id="{{$nav->id}}">
                                    @if(!empty($nav->icon))<img style="max-height: 30px;"
                                                                src="{{$nav->icon}}">@endif
                                    @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                </a>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="header-right-menu">
            <ul>
                @if(isset($otherRooms) && $otherRooms->count() > 0)
                    <li>
                        <div class="call-center">
                            <a class="dropdown-toggle" data-hover="dropdown">
                                <span class="call-otherrooms-btn">&nbsp;</span>
                            </a>
                            <ul class="dropdown-menu pull-right" style="min-width:114px;">
                                @foreach($otherRooms as $value)
                                    @if($value->id != $room->id)
                                        <li>
                                            @if($value->domain)
                                                <a href="http://{{$value->domain}}/v/{{$value->name}}"
                                                   target="_blank">{{$value->name}}</a>
                                            @else
                                                <a href="/v/{{$value->name}}"
                                                   target="_blank">{{$value->name}}</a>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="profile-menu listitem" style="min-width: 138px;">
                    <a class="dropdown-toggle" data-hover="dropdown">
                        <img class="avatar" src="{{$user->pic}}" alt="{{$user->name}}"/>
                        <span class="text-e">{{$user->name}}</span>
                        <span class="caret"></span>
                    </a>
                    @if($logined)
                        <div @if(!$sysConfig->style_opend) style="left: -230px;"
                             @endif class="dropdown-menu profile-dropdown-menu">
                            <div class="profile-block clearfix profile-block-base">
                                <img class="img-circle img- profile-avatar pull-left"
                                     src="{{$user->pic}}" alt="10000">
                                <div class="">
                                    <div class="profile-name">{{$user->name}}</div>
                                    <ul class="op list-inline">
                                        <li>
                                            <a class="js-user-setting-dialog">设置</a>
                                        </li>
                                        <li>|</li>
                                        <li>
                                            <a href="/auth/logout">退出</a>
                                        </li>
                                    </ul>
                                </div>
                                @if($site->jf_opend )
                                    <div id="idBetInfo" style="padding-left: 90px;line-height: 18px;">
                                        @if($user->extern)
                                            <div class="bet-cur">当前积分：{{$user->extern->jf_cur}}</div>
                                            <div class="bet-giftsend">
                                                送礼积分：{{$user->extern->jf_giftsend}}</div>
                                            @if($containJC)
                                                <div class="bet-total">总竞猜次数：{{$user->extern->jc_num}}
                                                    次
                                                </div>
                                                <div class="bet-win">中奖次数：{{$user->extern->jc_win_num}}
                                                    次
                                                </div>
                                                <div class="bet-winp">
                                                    胜率：@if($user->extern->jc_num){{$user->extern->jc_win_num*100/$user->extern->jc_num}}
                                                    ％@else 0％ @endif</div>
                                            @endif
                                        @else
                                            <div class="bet-cur">当前积分：0</div>
                                            <div class="bet-giftsend">送礼积分：0</div>
                                            @if($containJC)
                                                <div class="bet-total">总竞猜次数：0次</div>
                                                <div class="bet-win">中奖次数：0次</div>
                                                <div class="bet-winp">胜率：0％</div>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="profile-block clearfix">
                                <div class="title" style="margin-bottom: 5px;">
                                    我的推广
                                    <button id="copy-button2" class="btn btn-success "
                                            style="margin-left: 10px;" data-clipboard-text="{{$tgURL}}">
                                        点击复制推广链接
                                    </button>
                                </div>
                                <div class="content">
                                    <p>
                                        已经推荐 {{$user->recommend_num}} 人，其中注册会员 {{$user->recommend_reg}}人
                                    </p>
                                </div>
                            </div>

                            <ul class="list-inline profile-footer-menu">
                                @if($site->shop_opend)
                                    <li class="profile-footer-menu-3">
                                        <a display="float:left">
                                            <i class="icon"></i>
                                            <span class="text">我的订单</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="profile-footer-menu-5" style="margin-left: 20px">
                                    <a display="float:left">
                                        <!-- wwwwwwwwwwwwwwwwww--> <i class="icon"></i>
                                        <span class="text">个人中心</span>
                                    </a>
                                </li>
                                <!--		<li class="profile-footer-menu-1"><a class="active"><i class="icon"></i> <span class="text">我的红包</span></a></li>
                                            <li class="profile-footer-menu-2"><a><i class="icon"></i> <span class="text">我的爱心</span></a></li>
                                            <li class="profile-footer-menu-4"><a><i class="icon"></i> <span class="text">我的特权</span></a></li>
                                            <li class="profile-footer-menu-5"><a><i class="icon"></i> <span class="text">我的关注</span></a></li>-->
                            </ul>

                        </div>
                    @endif
                </li>
                @if(!$logined)
                    <li class="integral-menu listitem">
                        @if($roompower->reg_open)
                            @if($sysConfig->reg_mod == 1)
                                <a class="js-sigup-dialog">注册</a>
                            @elseif($sysConfig->reg_mod == 2)
                                <a class="js-coupon-dialog">领劵</a>
                            @endif
                            /
                        @endif
                        <a class="js-login-dialog">登录</a>
                    </li>
                @elseif($user->role->f_teacher_set && $room->parent == 0 && !$sysConfig->auto_lesson)
                    <li class="integral-menu listitem">
                        <a class="dropdown-toggle" data-hover="dropdown">上课</a>
                        <ul id="idTeachersWarp" class="dropdown-menu pull-right"
                            style="min-width:10px;">
                        </ul>
                    </li>
                @endif
                @if($sysConfig->style_opend)
                    <li class="theme-menu navbar-right listitem" style="margin-right:0px">
                        <a class="dropdown-toggle" data-hover="dropdown"> <i class="icon"></i>
                            <span class="text"></span>
                        </a>
                        <div class="dropdown-menu theme-dropdown-menu">

                            <h4>
                                <span class="text">个性化</span>
                            </h4>
                            <div class="block theme">
                                <div>布局</div>
                                <div class="layout-wrap clearfix">
                                    <div class="theme-layout-sider clearfix">
                                        <div class="text-muted">固定菜单位置</div>
                                        <div class="theme-layout theme-layout-sider-left"
                                             data-theme="layout-sider-left"></div>
                                        <div class="theme-layout theme-layout-sider-right"
                                             data-theme="layout-sider-right"></div>
                                    </div>
                                    <div class="theme-layout-video clearfix">
                                        <div class="text-muted">视频位置</div>
                                        <div class="theme-layout theme-layout-video-left"
                                             data-theme="layout-video-left"></div>
                                        <div class="theme-layout theme-layout-video-right"
                                             data-theme="layout-video-right"></div>
                                    </div>
                                </div>

                                <!--<div>按钮颜色</div>
                                <div class="btn-color-wrap clearfix">
                                    <a class="theme-color color-1"
                                       data-theme="theme-button-color-1"></a>
                                    <a class="theme-color color-2"
                                       data-theme="theme-button-color-2"></a>
                                    <a class="theme-color color-3"
                                       data-theme="theme-button-color-3"></a>
                                    <a class="theme-color color-4"
                                       data-theme="theme-button-color-4"></a>
                                    <a class="theme-color color-5"
                                       data-theme="theme-button-color-5"></a>
                                    <a class="theme-color color-6"
                                       data-theme="theme-button-color-6"></a>
                                    <a class="theme-color color-7"
                                       data-theme="theme-button-color-7"></a>
                                    <a class="theme-color color-8"
                                       data-theme="theme-button-color-8"></a>
                                    <a class="theme-color color-9"
                                       data-theme="theme-button-color-9"></a>
                                </div>-->
                                <div>背景图</div>
                                <div class="background-wrap clearfix">
                                    @foreach($roomBgs as $key=>$value)
                                        <a class="theme-bg theme-background background-{{$key}}"
                                           data-theme="theme-background-{{$key}}"></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <div class="login-tips-wrap">
            <div class="login-tips-content">
                @if($roompower->login_pop == 2)
                    <span class="login-close"></span>
                @endif
            </div>
            <a class="login-btn js-login-dialog"></a>
            @if($roompower->reg_open)
                @if($sysConfig->reg_mod == 1)
                    <a class="signup-btn js-sigup-dialog"></a>
                @elseif($sysConfig->reg_mod == 2)
                    <a class="coupon-btn js-coupon-dialog"></a>
                @endif
            @endif

        </div>
    </div>
    @include('front.v2.pc.left')
    @include("front.v2.pc.sider")

    <div class="main-content">
        <div class="main-container" style="left:0px;right:0px;">
            <div class="main-video">
                <div id="js-room-info" class="teacher-info-wrap">
                    <ul class="video-left-ul">
                        <li id="js-live-btn" class="active">视频直播</li>
                        @if($site->vod_opend1)
                            <li id="js-vod-list">视频库</li>
                        @endif
                        <li id="js-refash-video"
                            style="@if(!$roomLiveInfo->live_state) display:none; @endif">刷新
                        </li>

                        <li style="width: auto;" @if($alone_video) style="display: none;" @endif>
                            <span data-tid="{{ $roomLiveInfo->live_state && $roomLiveInfo->teacher ? $roomLiveInfo->teacher->id : ''  }}"
                  data-hover="dropdown" class="dropdown-toggle teacher-info-content-name">
                @if($roomLiveInfo->live_state && $roomLiveInfo->teacher )
                    {{$sysConfig->teacher_pre}}<span
                            style="color: {{ $roomLiveInfo->teacher->name_color }}">{{$roomLiveInfo->teacher->name}}</span>
                @endif
            </span>
                            @if($site->video_cfg && $user->role->f_videobg && $room->parent == 0)
                                <a href="javascript:;" style="color: red;"
                                   data-state="{{$roomLiveInfo->live_state}}" id="js-start-video">
                                    @if($roomLiveInfo->live_state)停止讲课 @else 开始讲课  @endif
                                </a>
                            @endif
                            <div class="dropdown-menu "
                                 style="width:auto;left:1px;padding: 0;@if(!$roomLiveInfo->teacher || !$roomLiveInfo->teacher->showimg || !$roomLiveInfo->live_state) opacity: 0.0 @endif">
                                <img id="js-teacher-img" style="max-width: 600px;"
                                     @if($roomLiveInfo->teacher)src="{{$roomLiveInfo->teacher->showimg}}" @endif>
                            </div>
                        </li>
                    </ul>
                    @if($agree_opend)
                        <div class="teacher-agrees">
                            <a class="dropdown-toggle" data-hover="dropdown">
                                <span class="icon-teacher-agrees">&nbsp;</span>
                            </a>
                            <ul class="teacher-agree-warp dropdown-menu pull-right">
                            </ul>
                        </div>
                    @endif

                    <div class="desktop-center">
                        <a href="/siteurl/{{$room->id}}?name={{$room->title}}" target="e"></a>
                    </div>
                    @if($showLessonV2)
                        <div class="lesson-text" @if($alone_video) style="display: none;"
                             @endif  id="idLessonV2">
                            <span class="dropdown-toggle"
                                  data-hover="dropdown">{{$sysConfig->lesson_pre}}</span>
                            <div class="dropdown-menu"
                                 style="width: 528px;height: 450px;right: 0px;left: auto;padding: 0;margin: 0;">
                                <iframe id="lessonFrame" src="/iframe/lesson/{{$room->id}}" width="528"
                                        height="450"></iframe>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="index-video-wrap">
                    <div class="main-video-player">
                        @if($site->gift_opend)
                            <div class="ryPopGift ryPopGift_small first">
                            </div>
                            <div class="ryPopGift ryPopGift_small middele">
                            </div>
                            <div class="ryPopGift ryPopGift_small last">
                            </div>
                            <div class="ryPopGift ryPopGift_small ends">
                            </div>
                        @endif
                        @if(!$logined && $roompower->login_pop)
                            <link rel="stylesheet" type="text/css"
                                  href="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.css">
                            <div class="video-timeout-bar">
                                <div class="pull-right">
                                    <span style="float:left!important;">剩余观看时间:</span>
                                    <div id="countdown" class="countdownHolder"></div>
                                    <p id="note"></p>
                                </div>
                            </div>
                        @endif
                        <div id="js-video-player-wrap" class="video-player-wrap"></div>
                        @if($roompower->video_pwd)
                            <div id="js-video-player-pwd"
                                 style="display: none;width: 250px;margin: auto;margin-top: 25%;">
                                <div class="input-group ">
                                    <input type="password" class="form-control" id="js-video-password"
                                           name="password" value="" placeholder="请输入视频密码">
                                    <span class="input-group-btn">
                        <button id="js-video-pwd-btn" class="btn btn-success" type="submit">观看视频</button>
                    </span>
                                </div>
                            </div>
                        @endif

                        <div id="js-no-video-contanier" class="video-player-wrap" style="display: none;">
                            <div class="mod_video">
                                <div id='js-no-video-tip' class="ntext">当前暂无直播,请关注下节课</div>
                            </div>
                        </div>
                        <!--<div class="nice-scroll videos-recommend-warp hidden" >
                            <ul class="videos-recommend js-video-list"></ul>
                        </div>-->
                        @if($agree_opend)
                            @if($site->agree_opend==3)
                                <div class="pao" style="width: 50px;height:50px;position: absolute;bottom: 30px;right: 10px;">
                                    <img id="idTeacherCurAgree"
                                         style="cursor: pointer; position: absolute;bottom: 0px;right: 0px;z-index: 99;"
                                         src="{{$cdn}}/assets/img/agree/agree_v2.png">

                                </div>
                            @else
                                <img id="idTeacherPopAgree"
                                     style="cursor: pointer; position: absolute;bottom: 30px;right: 10px;z-index: 99;"
                                     src="{{$cdn}}/assets/img/agree/agree_v2.png">
                            @endif
                        @endif
                        @if($site->video_cfg)
                            <div id="idVideoBg"
                                 style=" display: none; position: absolute;width: 100%;height: 100%;z-index:90;">
                                <img width="100%" height="100%" src="{{$videBgImg}}">
                            </div>
                            <div id="js-hj-bg"
                                 style="display: none;position: absolute;width: 100%;height: 100%;z-index:91;">
                                <img width="100%" height="100%" src="{{$sysConfig->hj_bg}}">
                            </div>
                        @endif
                        <div id="js-vod-player-wrap" style="display: none;z-index: 100;background: none;"
                             class="video-player-wrap"></div>
                    </div><!--TAB-->
                    <div class="main-room-info">
                        <div class="line-menu">
                            <ul role="tablist">
                                @if($roombanners->count()>0)
                                    <li class="active">
                                        <a href="#banners" aria-controls="boards" role="tab"
                                           data-toggle="tab">
                                            <span class="text">{{$sysConfig->banner_title}}</span>
                                            <span class="number"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($user->role->f_realtime)
                                    <li @if($roombanners->count() <= 0 && $roomTabs->count() <=0 ) class="active" @endif>
                                        <a href="#tab-content-dynamic" aria-controls="boards" role="tab"
                                           data-toggle="tab">
                                            <span class="text">实时动态</span>
                                            <span class="number"></span>
                                        </a>
                                    </li>
                                @endif
                                @foreach($roomTabs as $key => $value)
                                    <li @if($roombanners->count() <= 0 && $key == 0 ) class="active" @endif >
                                        <a href="#custtabs-{{$value->
                            id}}" aria-controls="boards" role="tab" data-toggle="tab">
                                            <span class="text">{{$value->title}}</span>
                                            <span class="number"></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content">
                            @if($roombanners->count()>0)
                                <div role="tabpanel" class="tab-pane active nice-scroll" id="banners">
                                    <div class="boards-content js-tab-select-img">
                                        <ul id="Ul_dscontent" class="dscontent">
                                            @foreach($roombanners as $key =>$value)
                                                <li style="width: 100%; display: list-item;">
                                                    <img style="height: auto; width: 100%;"
                                                         src="{{$value->imgurl}}"></li>
                                            @endforeach
                                        </ul>
                                        <div class="banner-num">
                                            <ul id="Ul_Pop" style="margin-bottom:0px;margin-left: -50%">
                                                @foreach($roombanners as $key => $value)
                                                    <li @if($key == 0) class="on" @endif >{{$key}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if( $user->role->f_realtime)
                                <div role="tabpanel"
                                     class="nice-scroll tab-pane  @if($roombanners->count() <= 0 && $roomTabs->count() <=0) active @endif"
                                     id="tab-content-dynamic">
                                    <ul id="js-chat-status-event" class="chat-status-event"></ul>
                                </div>
                            @endif
                            @foreach($roomTabs as $key => $value)
                                <div role="tabpanel"
                                     class="nice-scroll tab-pane  @if($roombanners->count() <= 0 && $key == 0 ) active @endif"
                                     id="custtabs-{{$value->id}}">
                                    <div class="boards-content js-tab-select-img">{!!$value->text!!}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!--MAIN-VIDEO-->

            @include('front.v2.pc.chatbox')
        </div>
    </div><!--main-container-->
</div>

@include('front.v2.pc.jsrender')
@if($roompower->pop_ad && empty($roomUI->pop_img) &&  $roombanners->count()>0)
    <div class="common-content" id="FirstPop" style="display: block;">
        <div class="sign-box scroll-login">
            <div class="boards-content ">
                <ul id="Ul_dscontent_show" class="dscontent">
                    @foreach($roombanners as $key =>$value)
                        <li style="width: 100%; display: none;">
                            <img style="height: auto; width: 100%;" src="{{$value->imgurl}}"></li>
                    @endforeach
                </ul>
                <div class="banner-num">
                    <ul id="Ul_Pop_Show" style="margin-bottom:0px;margin-left: -50%">
                        @foreach($roombanners as $key => $value)
                            <li @if($key == 0) class="on" @endif >{{$key}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <span class="banner-close"></span>
        </div>
    </div>
@endif
<div class="common-content" id="connectold">
    <div class="sign-box scroll-login" style="margin-top: -20px;margin-left: -170px;">
        <span style="font-size: 30px;color: red;font-weight: bold;">你的{{ $sysConfig->reg_account_tag }}在其他的页面打开</span>
    </div>
</div>
<div id="lookUserCard" class="dds-card">
    <div class="card-arrow arrow-left" style="top: 44px;"></div>
    <span class="card-close">×</span>
    <div class="card-inner">
        <div class="card-info">
            <p class="tips">正在加载中...</p>
        </div>
    </div>
</div>
<div id="rop_context"></div>
<div id="idMp3Warp" style="pointer-events: none; "></div>

@if($site->jf_opend)
    <div class="treasure-box-panel" style="display: none;">
        <div class="close-btn right-top">×</div>
        <ul class="cb-list">
            @for($i=0;$i<6;$i++)
                {{-- */$gj_ts='gj_ts'.($i+1);$gj_jf='gj_jf'.($i+1);/* --}}
                <li data-time="{{$jfconfig->$gj_ts}}">
                    <span @if($i<4)class="wait-get" @else class="w-cq-get"@endif ></span>
                    <a href="javascript:;" data-scores="{{$jfconfig->$gj_jf}}" data-historyid="0"
                       data-index="{{$i}}" class="next-btn">@if($i<4)礼物专享@else 酬勤专享@endif</a>
                </li>
            @endfor
        </ul>
        <div class="c-txt get-state-ard">别着急，奖励正在准备中……</div>
    </div>
@endif
            sider-menu-content
@include("widget.hot-li-tmpl")

@if($user->role->f_font_size)
    <script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
@endif

<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{$cdn}}/assets/artDialog/dialog.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.nicescroll-3.6.0/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.qrcode/jquery.qrcode.min.js"></script>

@if($user->role->f_img)
    <script type="text/javascript" src="{{$common_cdn}}/js/uploadify-2.2/jquery.uploadify.min.js"></script>
@endif

@if((!$logined && $roompower->login_pop))
    <script type="text/javascript" src="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.my.js"></script>
@endif

@if($site->jf_opend)
    <script type="text/javascript" src="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.min.js"></script>
@endif

@if($logined)
    <script type="text/javascript" src="{{$common_cdn}}/js/zeroclipboard-2.2.0/ZeroClipboard.min.js"></script>
@endif

<script type="text/javascript" src="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jwplayer/7.4.3/jwplayer.js"></script>

@if($roomLiveInfo->live_type == 5)
    <script type="text/javascript" src="{{$cdn}}/assets/js/mpslssplayer.js?v={{$webver}}"></script>
@else
    <script type="text/javascript" src="{{$cdn}}/assets/js/aodianplayer.js?v={{$webver}}"></script>
@endif
<script type="text/javascript" src="{{$common_cdn}}/js/black_clientv2.js?v={{$webver}}"></script>

@if($app::config('site.dms_host', ''))
    <script type="text/javascript">
        if (typeof ROP != 'undefined') {
            ROP.ICS_ADDR = "{{ $app::config('site.dms_host', '') }}";
            ROP.CDN_ADDR = "{{ $app::config('site.dms_cdn_host', '') }}";
        }
    </script>
@endif

<script type="text/javascript" src="{{$cdn}}/assets/js/video.js?v={{$webver}}"></script>

@if($user->role->f_img)
    <script type="text/javascript" src='{{$cdn}}/assets/js/past.js?v={{$webver}}'></script>
@endif

<script type="text/javascript" src='{{$cdn}}/assets/js/chat.js?v={{$webver}}'></script>

<script type="text/javascript">
    window.D.CHANNELINFO.showVideo = window.D.CHANNELINFO.living;

            @if(empty($user->role->f_hj) && $site->video_cfg)
    var now = getTimeFormat();
    if (window.D.HJTIME.opend && window.D.HJTIME.start <= now && window.D.HJTIME.end >= now) {
        window.D.CHANNELINFO.showVideo = 0;
    }
    @endif

    $(function () {
        @if($roompower->pop_ad  && $roomUI->pop_img)
        popImg("{{$roomUI->pop_img}}", true, {backdropOpacity: 0.3, quickClose: false, model: true});
        @endif
        @if(!$logined && $roompower->login_pop)
        startPopVisit('{{$roompower->login_pop}}');

        @endif

    })

</script>

@stack('scripts')

{!!$room->code!!}

</body>
</html>