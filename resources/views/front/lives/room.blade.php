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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
	<!--<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap-theme.min.css">-->
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/artDialog/css/ui-dialog.css">
	<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/view/main/style.css?v={{$webver}}">
	<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/view/main/chat.css?v={{$webver}}">
	<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/view/main/gift.css?v={{$webver}}">
	@if($user->role->f_font_size)
	<link href="{{$common_cdn}}/js/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" type="text/css" media="all">
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
	#js_notice_msg{
		color: {{$notice_msg_color}};
	}
	</style>
	@endif
	<style type="text/css">
	.jw-controlbar-left-group span,.jw-controlbar-right-group span,.jw-controlbar-center-group{opacity: 0;visibility:hidden;}
	.ui-dialog{
		border: 1px solid rgba(0,0,0,0);
		overflow: hidden;
	}
	.notitle-dialog{border: none;    overflow: inherit;}
	.notitle-dialog td.ui-dialog-header {border-bottom: none;}
	.notitle-dialog .ui-dialog-title{display: none;}
	.nobg-dialog{
		background-color: transparent;
	}
	.ui-dialog-close{
		    top: 13px;
    right: 13px;
		position: absolute;
		opacity:1;
		z-index: 5;
		display: block;
		color: rgba(0,0,0,0);
	    width: 23px;
	    height: 23px;
	    background: url({{$cdn}}/assets/v2/img/v2/close.png) no-repeat;
	}
 	.notitle-dialog .ui-dialog-close{
		top: -15px;
		right: -15px;
		position: absolute;
		opacity:1;
		z-index: 5;
		display: block;
		color: rgba(0,0,0,0);
	    width: 36px;
	    height: 36px;
	    background: url({{$cdn}}/assets/img/sprite.png) no-repeat;
	}
	.ui-dialog-close:hover, .ui-dialog-close:focus{
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
	.page-container.theme-background-{{$key}}{background-image: url("{{$value->imgurl}}");}
	.background-{{$key}}{background-image: url("{{$value->imgurl}}");}
	@else
	.page-container.theme-background-{{$key}}{background-image: url("{{$cdn.$value->imgurl}}");}
	.background-{{$key}}{background-image: url("{{$cdn.$value->imgurl}}");}
	@endif
	@if($value->selected)
	{{-- */ $defaultBgStyle = "theme-background-".$key; /* --}}
	@endif
	@endforeach
	@foreach($roles as $role)
	.chat-message-role-{{$role->role_id}}{
		background-image: url("{{$role->imgurl}}");
		background-size: 100% 100%;
		line-height: 27px;
		@if($role->imgwidth > 0)
	    width: {{$role->imgwidth/24*27}}px;
	    @else
	    width: 27px;
	    @endif
	    height: 27px;
	    display: inline-block;
        vertical-align: -8px;
	}
	.chat-me .chat-message-role-{{$role->role_id}}{
		text-align: right;
	}
	.icon-{{$role->role_id}} {
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
	@if($sysConfig->qq_img)
	.call-center .call-center-btn {
		background: url({{$sysConfig->qq_img}});
	}
	@endif

</style>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript">
	if(!window.console){
		window.console = {log:function(){}}
	}
	window.D = {
        cdn: '{{$cdn}}',
        ver: '{{$webver}}',
		roomId:'{{$room->id}}',
		parentRoomId:'{{$parentRoomId}}',
		dynamicMsg:'{{$room->dynamic_msg}}',
		showUserlist:{{$roomUI->show_userlist && $user->role->f_userlist ? 1:0}},
		deskIconUrl:"{{$cdn}}/assets/js/img/send-ok.png",
		phoneUrl:'{{$phoneUrl}}',
		theme:{!!json_encode( $theme )!!},
		loginPopTs: "{{$roompower->login_pop_ts}}" * 1000|| 0,
		guest_chat_cue:{{$roompower->guest_chat_cue?1:0}},
		@if($site->jf_opend)
		showjc:{{$roomUI->show_jc?1:0}},
		@endif
		agree_opend:{{$agree_opend}},
		defaultBgStyle:'{{$defaultBgStyle}}',
		luckmoney_need_phone:{{$luckmoney_need_phone}},
		teacher_pre:'{{$sysConfig->teacher_pre}}',
		lesson_img:'{{$roomUI->lesson_img}}',
		ui_type:'{{$site->ui_type}}',
		tgURL:'{{$tgURL}}',
		stockCode:"{{$sysConfig->stock_code}}",
		lookVideoImg:"{{$sysConfig->lookvideoImg}}",
		videoBgImg:"{{$videBgImg}}",
		chatOption:{
            dms_msg_enable: {{ !empty($site->dms_msg_enable) ? 1 : 0 }},
            proxyTopicMap: {!! !empty($proxyTopicMap) ? json_encode($proxyTopicMap) : '{}' !!},
			subKey:'{{$subKey}}',
            pubKey: '{{$pubKey}}',
			topic:'{{$topic}}',
            parentTopic:'{{$parentTopic}}',
			@if(!$logined)
			guestTopic:'{{$guestTopic}}',
			@endif
			siteTopic:'{{$siteTopic}}',
			@if($user->role->f_audit)
			topicAudit:'{{$topicAudit}}',
			@endif
			clientId:'{{$clientId}}',
			@if($site->ul_ht_opend)
			presentTopic:"__present__{{$parentTopic}}"
			@else
			presentTopic:"__present__{{$topic}}"
			@endif
		}
	}
	window.D.INFO = {
		'logo':'{{$room->logo}}',
		'title':'{{$room->title}}',
		'description':'{{$room->description}}'
	}
	window.D.HJTIME = {
		start:'{{$sysConfig->hj_start_at}}',
		end:'{{$sysConfig->hj_end_at}}',
		imgurl:'{{$sysConfig->hj_bg}}',
		opend:{{$sysConfig->hj_opend?1:0}}
	}
	window.D.CHANNELINFO = {
        stretching: parseInt('{{$sysConfig->stretching}}'),
        mobilefullscreen: parseInt('{{$sysConfig->mobilefullscreen}}'),
		alone_video:{{$alone_video}},
		@if( $roomLiveInfo->teacher )
		teacherName:'{{$sysConfig->teacher_pre}}<span style="color:{{$roomLiveInfo->teacher->name_color}}">{{$roomLiveInfo->teacher->name}}</span>',
		@else
		teacherName:'{{$room->title}}',
		@endif
		living:{{$roomLiveInfo->live_state?1:0}},
		channelType:'{{$roomLiveInfo->live_type}}',
		channelNumber:'{{$roomLiveInfo->live_play}}',
		channelHls:'{{$roomLiveInfo->live_hls}}',
		live_play:'{{$roomLiveInfo->live_play}}',
		live_hls:'{{$roomLiveInfo->live_hls}}',
		live_play1:'{{$roomLiveInfo->live_play1}}',
		live_hls1:'{{$roomLiveInfo->live_hls1}}',
		vod_url:"{{$roomLiveInfo->vod_url}}",
		@if($roomLiveInfo->teacher)
		teacher:{
			name:'{{$roomLiveInfo->teacher->name}}',
			id:"{{$roomLiveInfo->teacher->id}}",
		},
		noteacher:false,
		@else
		teacher:{
			name:'{{$room->title}}',
			id:0,
		},
		noteacher:true,
		@endif
		cur:0
	}
	window.D.USER = {
		uid:'{{$user->uid}}',
		name:'{{$user->name}}',
		type:'{{$user->type}}',
		pic:'{{$user->pic}}',
		role:{!!json_encode($user->role)!!},
		chatIntervalCount:{{$user->role->chat_ts}},
		plat:'{{$plat}}',
		logined:{{$logined}},
		isManager:{{$isManager}},
		isTeacher:{{$isTeacher}},
		lookvideo:{{$user->lookvideo?1:0}},
	}
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
        }
    });
    var __real_robot_num = 0;
	var __base__ = 0;
	var __base_num__ = {{$roompower->base_user}}
</script>
</head>
<body>
	{!!$room->code_body_pre!!}

	<div class="danmu-warp">
		<div class="danmu-content"></div>
	</div>
	<div class="page-container theme-default
	@if(isset($theme['layoutsider'])) {{$theme['layoutsider']}} @else layout-sider-left @endif
	@if(isset($theme['layout'])) {{$theme['layout']}} @else layout-video-right @endif
	@if(isset($theme['backgroundImg'])) {{$theme['backgroundImg']}} @else {{$defaultBgStyle}} @endif
	@if(isset($theme['buttonColor'])) {{$theme['buttonColor']}} @else theme-button-color-1 @endif" id="main" style="overflow-y:hidden">
		<div class="main-header">
		

			<div class="header-navbar" style="margin-left:0px;position: absolute;left: 0px;"  id="search">
				@if($room->logo)
					<a id="logo" class="logo" href="javascript:;">
						<img src="{{$room->logo}}" alt="logo">
					</a>
				@endif
				<ul>
					@if($site->proposing_opend)
					<li>
						<a  id="idProp" >
							<img style="    border-radius: 4px;" height="30px" class="icon_prop" src="{{$cdn}}/assets/img/fxts/fxts.png">
						</a>
					</li>
					@endif
					@foreach($roomnavs as $nav)
					@if($nav->pos == 1)
					<li >
						@if($nav->type == 4003)
						<a  href="{{$nav->url['url']}}"  target="_blank">
							@if(!empty($nav->icon))<img  style="max-height: 30px;" src="{{$nav->icon}}">@endif
							@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
						</a>
						@elseif($nav->type == 4002)
						<a  href="javascript:;" @if(isset($nav->url['imgurl']))  data-img="{{$nav->url['imgurl']}}" @endif @if(isset($nav->url['qqtype']) && !empty($nav->url['qqtype'])) class="my-pop-img-qq"  data-qqtype="{{$nav->url['qqtype']}}" @else class="my-pop-img" @endif   target="_blank">
							@if(!empty($nav->icon))<img  style="max-height: 30px;" src="{{$nav->icon}}">@endif
							@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
						</a>
						@elseif($nav->type == 4004)
						<a  href="javascript:;" class="nav-show-qq"  target="_blank">
							@if(!empty($nav->icon))<img style="max-height: 30px;" src="{{$nav->icon}}">@endif
							@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
						</a>
						@else
						<a  href="javascript:;" target="_blank" class="js-ui-dialog-{{$nav->type}}">
							@if(!empty($nav->icon))<img  style="max-height: 30px;" src="{{$nav->icon}}">@endif
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
					<li >
						<div class="call-center" >
							<a class="dropdown-toggle" data-hover="dropdown">
								<span class="call-otherrooms-btn">&nbsp;</span>
							</a>
							<ul class="dropdown-menu pull-right" style="min-width:114px;">
								@foreach($otherRooms as $value)
								@if($value->id != $room->id)
								<li>
									@if($value->domain)
									<a href="http://{{$value->domain}}/v/{{$value->name}}" target="_blank">{{$value->name}}</a>
									@else
									<a href="/v/{{$value->name}}" target="_blank">{{$value->name}}</a>
									@endif
								</li>
								@endif
								@endforeach
							</ul>
						</div>
					</li>
					@endif
					@if($roomqqs->count() > 0)
					<li >
						<div class="call-center" >
							<a href="javascript:;"  class=" nav-show-qq dropdown-toggle" data-hover="dropdown">
								<span class="call-center-btn">&nbsp;</span>
							</a>
						</div>
					</li>
					@endif
					<li>
						<div class="desktop-center">
							<a href="/siteurl/{{$room->
								id}}?name={{$room->title}}" target="e">
								<img src="{{$cdn}}/assets/img/zhou.gif" width="30" height="27">保存到桌面</a>
						</div>
					</li>
					<li class="profile-menu listitem" style="min-width: 138px;">
						<a  class="dropdown-toggle" data-hover="dropdown">
							<img class="avatar" src="{{$user->pic}}" alt="{{$user->name}}"/>
							<span class="text-e" >{{$user->name}}</span>
							<span class="caret"></span>
						</a>
						@if($logined)
						<div class="dropdown-menu profile-dropdown-menu">
							<div class="profile-block clearfix profile-block-base">
								<img class="img-circle img- profile-avatar pull-left" src="{{$user->pic}}" alt="10000">
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
									@if($roomUI->show_jc)
									<div class="bet-total">总竞猜次数：{{$user->extern->jc_num}}次</div>
									<div class="bet-win">中奖次数：{{$user->extern->jc_win_num}}次</div>
									<div class="bet-winp">胜率：@if($user->extern->jc_num){{$user->extern->jc_win_num*100/$user->extern->jc_num}}％@else 0％ @endif</div>
									@endif
								@else
									<div class="bet-cur">当前积分：0</div>
									@if($roomUI->show_jc)
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
									<button id="copy-button2" class="btn btn-success " style="margin-left: 10px;" data-clipboard-text="{{$tgURL}}">点击复制推广链接</button>
								</div>
								<div class="content">
									<p>
										已经推荐 {{$user->recommend_num}} 人，其中注册会员  {{$user->recommend_reg}}人
									</p>
								</div>
							</div>
							@if($site->shop_opend)
							<ul class="list-inline profile-footer-menu">
							<li class="profile-footer-menu-3"><a><i class="icon"></i> <span class="text">我的订单</span></a></li>
					<!--			<li class="profile-footer-menu-1"><a class="active"><i class="icon"></i> <span class="text">我的红包</span></a></li>
								<li class="profile-footer-menu-2"><a><i class="icon"></i> <span class="text">我的爱心</span></a></li>
								
								<li class="profile-footer-menu-4"><a><i class="icon"></i> <span class="text">我的特权</span></a></li>
								<li class="profile-footer-menu-5"><a><i class="icon"></i> <span class="text">我的关注</span></a></li>-->
							</ul>
							@endif
						</div>
						@endif
					</li>
					@if(!$logined)
					<li class="integral-menu listitem">
						@if($roompower->reg_open)
							<a  class="js-sigup-dialog">注册</a>
							/
						@endif
						<a class="js-login-dialog">登录</a>
					</li>
					@elseif($user->role->f_teacher_set && $room->parent == 0)
					<li class="integral-menu listitem">
						<a class="dropdown-toggle" data-hover="dropdown" >上课</a>
						<ul id="idTeachersWarp" class="dropdown-menu pull-right" style="min-width:10px;">
						</ul>
					</li>
					@endif
					<li class="theme-menu navbar-right listitem" style="margin-right:0px">
						<a  class="dropdown-toggle" data-hover="dropdown"> <i class="icon"></i>
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
										<div class="theme-layout theme-layout-sider-left" data-theme="layout-sider-left"></div>
										<div class="theme-layout theme-layout-sider-right" data-theme="layout-sider-right"></div>
									</div>
									<div class="theme-layout-video clearfix">
										<div class="text-muted">视频位置</div>
										<div class="theme-layout theme-layout-video-left" data-theme="layout-video-left"></div>
										<div class="theme-layout theme-layout-video-right" data-theme="layout-video-right"></div>
									</div>
								</div>

								<div>按钮颜色</div>
								<div class="btn-color-wrap clearfix">
									<a class="theme-color color-1" data-theme="theme-button-color-1"></a>
									<a class="theme-color color-2" data-theme="theme-button-color-2"></a>
									<a class="theme-color color-3" data-theme="theme-button-color-3"></a>
									<a class="theme-color color-4" data-theme="theme-button-color-4"></a>
									<a class="theme-color color-5" data-theme="theme-button-color-5"></a>
									<a class="theme-color color-6" data-theme="theme-button-color-6"></a>
									<a class="theme-color color-7" data-theme="theme-button-color-7"></a>
									<a class="theme-color color-8" data-theme="theme-button-color-8"></a>
									<a class="theme-color color-9" data-theme="theme-button-color-9"></a>
								</div>
								<div>背景图</div>
								<div class="background-wrap clearfix">
									@foreach($roomBgs as $key=>$value)
									<a class="theme-bg theme-background background-{{$key}}" data-theme="theme-background-{{$key}}"></a>
									@endforeach
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="login-tips-wrap">
				<div class="login-tips-content">
					@if($roompower->login_pop == 2)
					<span class="login-close"></span>
					@endif
				</div>
				<a class="login-btn js-login-dialog" ></a>
				@if($roompower->reg_open)
				<a class="signup-btn js-sigup-dialog"></a>
				@endif
			</div>

		</div>

		<div class="main-sider-menu">@include("front.lives.sider")</div>

		<div class="main-content" >
			<div class="main-container" style="left:0px;right:0px;">
				<div class="main-video">
					<div id="js-room-info" class="teacher-info-wrap">

						<div class="teacher-info-content">
							<span data-tid="{{ $roomLiveInfo->live_state && $roomLiveInfo->teacher ? $roomLiveInfo->teacher->id : ''  }}" style="cursor: pointer;" data-hover="dropdown" class="teacher-info-content-name dropdown-toggle">
								@if($roomLiveInfo->live_state && $roomLiveInfo->teacher )
									{{$sysConfig->teacher_pre}}<span style="color: {{ $roomLiveInfo->teacher->name_color }}">{{$roomLiveInfo->teacher->name}}</span>@else{{$room->title}}
								@endif
							</span>
							@if($site->video_cfg && $user->role->f_videobg && $room->parent == 0)
								<a href="javascript:;" style="color: red;" data-state="{{$roomLiveInfo->live_state}}" id="js-start-video">
									@if($roomLiveInfo->live_state)停止讲课 @else 开始讲课  @endif
								</a>
							@endif
							<div class="dropdown-menu " style="width:auto;padding: 0;@if(!$roomLiveInfo->teacher || !$roomLiveInfo->teacher->showimg || !$roomLiveInfo->live_state ) opacity: 0.0 @endif">
							<img id="js-teacher-img" style="max-width: 600px;" @if($roomLiveInfo->teacher)src="{{$roomLiveInfo->teacher->showimg}}" @endif>
							</div>
						</div>

						<div id="js-turn-video" style="display: inline-block;width: 100%;    position: absolute;" >
							<div style="width: 49%;display: inline-block;text-align: center;" >
								<div   class="teacher-turn teacher-turn-noactive" data-uid="{{$roomLiveInfo->live_uid}}" data-name="@if($roomLiveInfo->liveTeacher){{$roomLiveInfo->liveTeacher->name}}@endif" data-type="0" @if(!$roomLiveInfo->live_state) style="display:none;" @endif  >
									<span>{{$sysConfig->video_name1}}</span><span class="live-name">@if($roomLiveInfo->liveTeacher){{$roomLiveInfo->liveTeacher->name}}@endif</span>
								</div>
							</div>
							<div style="width: 50%;display: inline-block;text-align: center;" >
								<div  class="teacher-turn teacher-turn-noactive" data-uid="{{$roomLiveInfo->live_uid1}}" data-name="@if($roomLiveInfo->liveTeacher1){{$roomLiveInfo->liveTeacher1->name}}@endif" data-type="1" @if(!$roomLiveInfo->live_state) style="display:none;" @endif  >
									<span>{{$sysConfig->video_name2}}</span><span class="live-name1">@if($roomLiveInfo->liveTeacher1){{$roomLiveInfo->liveTeacher1->name}}@endif</span>
								</div>
							</div>
						</div>
						@endif
						<div id="js-refash-video" class="teacher-refash" @if(!$roomLiveInfo->live_state ) style="display:none;" @endif  >
							<i class="icon-refash"></i>
							<span>刷新视频</span>
						</div>
						@if($agree_opend)
						<div class="teacher-agrees" >
							<a class="dropdown-toggle" data-hover="dropdown">
								<span class="icon-teacher-agrees">&nbsp;</span>
							</a>
							<ul class="teacher-agree-warp dropdown-menu pull-right" >
							</ul>
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
							<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.css">
							<div class="video-timeout-bar">
								<div class="pull-right">
									<span style="float:left!important;">剩余观看时间:</span>
									<div id="countdown" class="countdownHolder"></div>
									<p id="note"></p>
								</div>
							</div>
							@endif
							<!--视频-->
							<div  id="js-video-player-wrap"  class="video-player-wrap" @if(!$roomLiveInfo->live_state) style="display:none;" @endif ></div>
							@if($roompower->video_pwd)
							<div id="js-video-player-pwd" style="display: none;width: 250px;margin: auto;margin-top: 25%;">
								<div class="input-group ">
									<input type="password" class="form-control" id="js-video-password" name="password" value="" placeholder="请输入视频密码">
									<span class="input-group-btn">
										<button id="js-video-pwd-btn" class="btn btn-success" type="submit">观看视频</button>
									</span>
								</div>
							</div>
							@endif

							<!--无视频区-->
							<div id="js-no-video-contanier" class="video-player-wrap "  @if($roomLiveInfo->live_state) style="display:none;" @endif>
								<div class="mod_video">
										<div id="js-no-video-tip" class="ntext">当前暂无直播,请关注下节课</div>
								</div>
							</div>
<!--
							<div class="nice-scroll videos-recommend-warp hidden" >
								<ul class="videos-recommend js-video-list"></ul>
							</div>-->
							@if($agree_opend)
							<img id="idTeacherPopAgree" style="cursor: pointer; position: absolute;bottom: 30px;right: 10px;z-index: 99;" src="{{$cdn}}/assets/img/agree/agree_v2.png">
							@endif
							@if($site->video_cfg)
							<div id="idVideoBg" style="@if($roomLiveInfo->live_state || !$videBgImg) display: none; @endif z-index:90;position: absolute;width: 100%;height: 100%;top: 0px;">
								<img width="100%" height="100%" src="{{$videBgImg}}">
							</div>
							<div id="js-hj-bg" style="display: none;position: absolute;width: 100%;height: 100%;z-index:91;">
								<img width="100%" height="100%" src="{{$sysConfig->hj_bg}}">
							</div>
							@endif
						</div>

						<div class="main-room-info">
							<div class="line-menu">
								<ul role="tablist">
									@if($roombanners->count()>0)
									<li class="active" >
										<a href="#banners" aria-controls="boards" role="tab" data-toggle="tab">
											<span class="text">活动展示</span>
											<span class="number"></span>
										</a>
									</li>
									@endif
									@if( $user->role->f_realtime)
									<li @if($roombanners->count() <= 0 && $roomTabs->count() <=0 ) class="active"  @endif>
										<a href="#tab-content-dynamic" aria-controls="boards" role="tab" data-toggle="tab">
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
									<div role="tabpanel" class="tab-pane active nice-scroll"   id="banners">
										<div class="boards-content js-tab-select-img">
													<ul  class="dscontent">
														@foreach($roombanners as $key =>$value)
														<li style="width: 100%; display: list-item;">
															<img style="height: auto; width: 100%;" src="{{$value->imgurl}}"></li>
														@endforeach
													</ul>
													<div class="banner-num" >
														<ul id="Ul_Pop" style="margin-bottom:0px;margin-left: -50%" >
															@foreach($roombanners as $key => $value)
															<li @if($key == 0) class="on" @endif >{{$key}}</li>
															@endforeach
														</ul>
													</div>
										</div>
									</div>
									@endif
									@if( $user->role->f_realtime)
									<div role="tabpanel" class="nice-scroll tab-pane  @if($roombanners->count() <= 0 && $roomTabs->count() <=0) active @endif"  id="tab-content-dynamic">
										<ul id="js-chat-status-event" class="chat-status-event"></ul>
									</div>
									@endif
									@foreach($roomTabs as $key => $value)
									<div role="tabpanel" class="nice-scroll tab-pane  @if($roombanners->count() <= 0 && $key == 0 ) active @endif" id="custtabs-{{$value->id}}">
										<div class="boards-content js-tab-select-img">{!!$value->text!!}</div>
									</div>
									@endforeach
									</div>

								</div>
							</div>
						</div>
						<div class="main-center">
						
							<div class="main-content-menu">
								<ul>
								@if($roomUI->show_user_num)
									<li id="idUserTotalWarp" class="" >
										<a href="javascript:;" class="dropdown-toggle"  data-hover="dropdown">
											<span class="text " >
												<img src="{{$cdn}}/assets/img/users.png" height="24px;">
												<span style="line-height: 24px;vertical-align: -1px;display: inline-block;" id="idUserTotal">{{$roompower->base_user}}</span>
											</span>
										</a>
										@if($user->role->f_base_user)
										<div class="dropdown-menu " style="width:160px;">
											<input id="idChangeUserInput" style="width: 90px;display: inline;margin-left: 5px;"  class="form-control" type="text" name="title" >
											<span id="idChangeUserBase" style="vertical-align: 0.5px;" class="btn btn-success ">确定</span>
										</div>
										@endif
									</li>
									@endif
								</ul>

							</div>

							<div class="tab-content main-conent-panle">
								<div role="tabpanel" class="tab-pane chat-wrap active" id="chat">

									<div class="chat-wrap-content-top">
										<div class="chat-top-history"  style="display: list-item;">
											<i class="icon-bullhorn text-danger"></i>
											<span class="chat-notice-name">公告</span>
											：
											<div class="notice_wrap">
												<span id="js_notice_msg">{{$room->notice_msg}}</span>
											</div>
										</div>
									</div>
									<div id="gift_show" style="pointer-events:none;bottom: 160px;right: 5px; z-index: 11;position: absolute;width: 140px;height: 140px;"></div>
									<div class="chat-wrap-content nice-scroll-h" style="overflow-x:hidden;
									@if($roomUI->show_guest_sub)
										@if($room->chat_bottom_msg&& $room->chat_top_msg) bottom:190px; @elseif($room->chat_top_msg || $room->chat_bottom_msg) bottom:160px; @endif
									@else
										@if($room->chat_bottom_msg&& $room->chat_top_msg) bottom:160px; @elseif($room->chat_top_msg || $room->chat_bottom_msg) bottom:130px; @endif
									@endif"></div>
									<div class="chat-content-exFun">
									@if($site->jf_opend && $roomUI->show_jc)
										
										<div style="display: inline-block;">
											<img  class="dropdown-toggle" data-hover="dropdown"  style="    vertical-align: 0px;cursor: pointer;" src="{{$cdn}}/assets/img/bet/rankbtn.png" height="24x">
											<div class="dropdown-menu " style="    width: 100px;min-width: 100px;padding-left: 13px;color: #333">
												<div id="js-betrank-btn" style="cursor: pointer;">竞猜排行榜</div>
												<div id="js-jfrank-btn" style="cursor: pointer;">积分排行榜</div>
											</div>
										</div>
										@endif
										@if($roomUI->show_past)
										<div style="display: inline-block;position: relative;">
											<img id="idUserPast" style="vertical-align: 0px;cursor: pointer;" src="{{$cdn}}/assets/img/past.png" height="24x">
											<div id="idUserPastRed" style="display:none;width: 8px;height: 8px;border-radius: 8px;background-color: red;position: absolute;right: 2px;top: 2px;"></div>
										</div>
										@endif
										<span id="chat-lock-screen-btn"  class="chat-content-exFun-item">
											<i class="icon icon-unlock"></i>
											锁屏
										</span>
										<span id="chat-clean-screen-btn" class="chat-content-exFun-item">
											<i class="icon icon-trash"></i>
											清屏
										</span>
										<!--<span id="chat-notice-deskTop-btn" class="chat-content-exFun-item">
											<i class="icon icon-volume-down"></i>
											桌面通知
										</span>-->
									</div>
									<div class="chat-float-model" >
									<div class="chat-float-model-item">
										<a  class="dropdown-toggle" data-hover="dropdown" data-logtype="30">
											<i class="icon icon_phone_ewm"></i>
										</a>
										<div>手机直播</div>
										<div class="dropdown-menu " style="left:-214px;top:0px;width:200px;height:200px;">
										@if($roomUI->wechat_img && $roomUI->replace_qrcode)
											<img src="{{$roomUI->wechat_img}}" class="qr-code-img">
										@else
											<p  class="qr-code-img" style="margin-top: 4px;" id="qrcode"></p>
											@endif
										</div>
									</div>
									@if($user->role->f_luck_max_money)
									<div  class="chat-float-model-item">
										<i class="icon icon_luck_money" style="cursor: pointer;"></i>
										<div>发红包</div>
									</div>
									@endif
									@if($roomUI->show_gift)
									<div  class="chat-float-model-item" >
										<a class="dropdown-toggle" data-hover="dropdown" data-logtype="30">
											<i class="icon icon_send_gift"></i>
										</a>
										<div>送礼物</div>
										<div id="js-gift-warp" class="dropdown-menu " style="margin-top:-60px;left:-250px;width:246px;padding: 8px 5px;border-radius: 10px;">
										</div>
									</div>
									@endif
									@if($site->jf_opend)
									<div class="treasure chat-float-model-item">
										<i class="close-treasure-box hidden"></i>
										<div class="treasure-box animate1"></div>
										<div class="treasure-count-down"><span>__:__</span></div>
									</div>
									@endif
									</div>
									@if($roomUI->show_guest_sub)
									<div class="chat-guest-sub" style="@if($room->chat_top_msg && $room->chat_bottom_msg)bottom:160px;@elseif($room->chat_top_msg || $room->chat_bottom_msg)bottom:130px;@else bottom: 100px; @endif"><span style="float: left;">游客福利！免费获取操作建议，老师的实战课件</span>
									<div style="float: right;margin-right: 10px;display: inline;height: 30px;">
									<input id="idGuestPhoneInput" style="width: 100px;display: inline;margin-left: 5px;    height: 28px;padding: 0px 6px;font-size: 12px;color: #555;border-radius: 3px;line-height: 30px;"  type="text" name="title" placeholder="请输入手机号码" >
									<span style="cursor: pointer;line-height: 30px;" id="idGuestSubPhone">免费订阅</span></div>
									</div>
									@endif
									@if($room->chat_top_msg)
									<div   class="chat-notify-msg-common dropup" style="@if($room->chat_bottom_msg)bottom:130px;@else bottom: 100px; @endif"><span style="cursor:pointer;" id="chat_tz_msg" class="dropdown-toggle"  data-hover="dropdown">{{$room->chat_top_msg}}</span>
										@if($user->role->f_notify)
										<div class="dropdown-menu " style="width:270px;">
										<input id="idNotifyInput" style="width: 200px;display: inline;margin-left: 5px;"  class="form-control" type="text" name="title" >
										<span id="idNotifyBtn" style="vertical-align: 0.5px;" class="btn btn-success ">确定</span>
										</div>
										@endif
									</div>
									@endif
									<form class="chat-form" @if($room->chat_bottom_msg) style="bottom:30px" @endif>
										<div class="chat-form-exFun">
											<span id="js-chat-faces-btn" class="face chat-form-exFun-item icon-smile"></span>
											@if($user->role->f_img)
											<span id="js-chat-picture-btn" class="chat-form-exFun-item icon-pic"></span>
											@endif
											@if($site->gift_opend)
											<span id="js-gift-btn" class="chat-form-exFun-item icon-gift " style="text-indent: -9999px;">
			
											<div class="MR-gift" id="js-gift-panel">
											</div>
											</span>
											@endif
											@if($user->role->f_caitiao)
											<div class="dropup" style="    display: inline-block;position: relative;width: 24px;height: 32px;">
												<span  class=" chat-form-exFun-item icon-ct dropdown-toggle" data-toggle="dropdown" class=""></span>
												<ul id="js-ct-chose" class="dropdown-menu" style="min-width: 58px;padding-left:5px;color:#000;">
													<li data-name='[彩条-顶一个]' style="cursor: pointer;height: 30px;line-height: 30px;">顶一个</li>
													<li data-name='[彩条-赞一个]' style="cursor: pointer;height: 30px;line-height: 30px;">赞一个</li>
													<li data-name='[彩条-鲜花]' style="cursor: pointer;height: 30px;line-height: 30px;" >鲜花</li>
													<li data-name='[彩条-掌声]' style="cursor: pointer;height: 30px;line-height: 30px;">掌声</li>
												</ul>
											</div>
											@endif
											@if($user->role->f_font_size)
											<div id="js-chat-color-btn" class="dropup" data-color="#333">
												<div class="in " class="dropdown-toggle" data-toggle="dropdown" style="background-color:#333"></div>
												<ul class="dropdown-menu" style="min-width: 148px;">
												    <li><div id="colorpalette1"></div></li>
												  </ul>
											</div>
											<span  style="vertical-align: 11px;">
												<select id="js-font-size-list" style="color: #333; width: 40px;font-size:12px">
													@for($i=18;$i>=12;$i--)
													<option value="{{$i}}" @if($i==14) selected @endif data-size="{{$i}}">{{$i}}</option>
													@endfor
												</select>
											</span>
											<div class="chat-font-bold-chose" style="">
												B
											</div>
											@endif
											@if($user->role->f_danmu)
											<div class= "chat-danmu-chose">
												弹
											</div>
											@endif
											@if($user->role->f_tochat)
											@if($sysConfig->mgr_to_chat)
											<span  style=" vertical-align: 11px;">
												<select id="js-chat-mgr-list" style="color: #333; width: 60px;font-size:12px">
													<option value="" selected>无</option>
													@if($roomLiveInfo->live_state && $roomLiveInfo->teacher )
													<option class="cur-teacher" value="{{$roomLiveInfo->teacher_uid}}" data-teacher="1" data-name="{{$roomLiveInfo->teacher->name}}">{{$roomLiveInfo->teacher->name}}</option>
													@endif
												</select>
											</span>
											@endif
											<div class="to-chat-warp" style="display: inline-block;">
												<span style="vertical-align: 13px;font-size: 12px;">对</span>
												<span id="js-chat-to-user" data-uid=""  class="to-chat-content" >大家</span>
												<span style="vertical-align: 13px;font-size: 12px;margin-right: 5px;">说</span>
												<i class="myclose" style="display:none;"></i>
											</div>
											@endif
											
											@if($user->role->f_robot_send)
											<div class=" chat-robot-warp">
												<select id="js-robot-num" style=" border: 1px solid #333;color: #333; width: 40px;font-size: 12px;">
													<option value="0">无</option>
													<option value="1">1</option>
													<option value="3">3</option>
													<option value="5">5</option>
													<option value="7">7</option>
													<option value="10">10</option>
												</select>
												<select id="js-robot-list" style="color: #333; width: 60px;font-size: 12px;@if($user->role->f_turn_msg)margin-right: 18px;@endif">
													<option value="0">机器人</option>
												</select>
											</div>
											@endif
										</div>
										<div class="chat-form-input-wrap" style="margin-right: @if($user->role->f_notice) 140px; @else 80px; @endif">
											<textarea class="chat-form-input nice-scroll" id="js-chat-form-input"></textarea>
										</div>

										<div class="chat-form-op">
											<button type="button" class="chat-form-btn send-btn" id="js-send-btn">发送</button>
											@if($user->role->f_notice)
											<button type="button" class="chat-form-btn notice-btn" id="js-notice-btn">&nbsp;</button>
											@endif
										</div>
										@if($user->role->f_turn_msg)
										<div id="js-chat-form-more" class="chat-form-more">
											<iframe class="chat-form-more-mask"></iframe>
											<div class="chat-form-more-warp">
												<span id="js-expend-btn" class="expend-btn" title="更多功能">&lt;</span>
												<span class="btn  btn－default" id="js-chat-form-more-share-btn">转播消息</span>
											</div>
										</div>
										@endif
									</form>
									@if($room->chat_bottom_msg)
									<div id="chat_mzsm_msg" style="cursor:pointer;"   class="chat-notify-msg-common">{{$room->chat_bottom_msg}}</div>
									@endif
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include('front.lives.jsrender')
			@if($roompower->pop_ad && $roomUI->pop_img)
			<div class="common-content" id="FirstPop" style="display: block;">
				<div class="sign-box scroll-login">
					<div class="hd">
						<img style="height: 470px; width: 950px;" src="{{$roomUI->pop_img}}">
						<span class="banner-close"></span>
					</div>
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
			<div id="idMp3Warp" style="pointer-events: none; ">
				
			</div>
@if($site->jf_opend)
<div class="treasure-box-panel" style="display: none;">
	<div class="close-btn right-top">×</div>
	<ul class="cb-list">
		@for($i=0;$i<6;$i++)
		{{-- */$gj_ts='gj_ts'.($i+1);$gj_jf='gj_jf'.($i+1);/* --}}
		<li data-time="{{$jfconfig->$gj_ts}}">
			<span @if($i<4)class="wait-get" @else class="w-cq-get"@endif ></span>
			<a href="javascript:;" data-scores="{{$jfconfig->$gj_jf}}"  data-historyid="0" data-index="{{$i}}" class="next-btn">@if($i<4)礼物专享@else 酬勤专享@endif</a>
		</li>
		@endfor
		

	</ul>
	<div class="c-txt get-state-ard">别着急，奖励正在准备中……</div>
</div>
@endif			
@if($user->role->f_font_size)
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
@endif
<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/artDialog/dialog-min2.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.nicescroll-3.6.0/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.qrcode/jquery.qrcode.min.js"></script>
@if($user->role->f_img)
<script type="text/javascript" src="{{$common_cdn}}/js/uploadify-2.2/jquery.uploadify.min.js"></script>
@endif
@if(!$logined && $roompower->login_pop)
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.my.js"></script>
@endif
@if($site->jf_opend)
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.min.js
"></script>
@endif
@if($logined)
<script type="text/javascript" src="{{$common_cdn}}/js/zeroclipboard-2.2.0/ZeroClipboard.min.js"></script>
@endif
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jwplayer/7.4.3/jwplayer.js"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/aodianplayer.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/mpslssplayer.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/black_clientv2.js?v={{$webver}}"></script>
	@if($app::config('site.dms_host', ''))
		<script type="text/javascript">
            if( typeof ROP != 'undefined'){
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
if(window.D.HJTIME.opend && window.D.HJTIME.start <= now && window.D.HJTIME.end >= now){
    window.D.CHANNELINFO.showVideo = 0;
}
@endif
	$(function(){
		@if(!$logined && $roompower->login_pop);
		startPopVisit('{{$roompower->login_pop}}');
		@endif
	});
</script>
{!!$room->code!!}
</body>
</html>
