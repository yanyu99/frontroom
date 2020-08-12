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
  <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/phone/room.css?v={{$webver}}">
  <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.css?v={{$webver}}">
  <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/artDialog/ui-dialog.css?v={{$webver}}">
  <style type="text/css">
  iframe{
    border: none;
  }
  .mpstitle-name {
    position: absolute;
    z-index: 5;
    top: 0;
    left: 0;
    right: 0;
    text-shadow: none;
    color: #fff;
    background-color: #000;
    font-weight: 700;
    width: 100%;
    text-align: center;
    font-size: 16px;
    height: 50px;
    list-style: none;
    line-height: 50px;
    display: none
  }
  .scale-iframe{
    -webkit-transform: scale(0.5);
    -webkit-transform-origin: 100% 100%;
    margin-left: -285px;
    margin-top: -170px;
  }
  .scale-iframe3{
    -webkit-transform: scale(0.4);
    -webkit-transform-origin: 100% 100%;
    margin-left: -480px;
    margin-top: -288px;
  }
  .scale-iframe1{
    -webkit-transform: scale(0.8);
    -webkit-transform-origin: 100% 100%;
    margin-left: -73px;
    margin-top: -98px;
  }
  .ui-dialog{
    border: 1px solid rgba(0,0,0,0);
    overflow: hidden;
  }
  .notitle-dialog{border: none;    overflow: inherit;}
  .notitle-dialog td.ui-dialog-header {border-bottom: none;}
  .notitle-dialog .ui-dialog-title{display: none;}
   .notitle-dialog-new{border: none;    overflow: inherit;background: rgba(0,0,0,0);box-shadow: none;}
  .notitle-dialog-new td.ui-dialog-header {border-bottom: none;}
  .notitle-dialog-new .ui-dialog-title{display: none;}
  .ui-popup-modal .notitle-dialog-new{
    box-shadow:none;
  }
  .ui-popup-focus  .notitle-dialog-new{
    box-shadow:none;
  }
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
 .notitle-dialog-new .ui-dialog-close,.notitle-dialog .ui-dialog-close{

    top: -3px;
    right: -3px;
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
@foreach($roles as $role)
  .chat-message-role-{{$role->role_id}}{
    background-image: url("{{$role->imgurl}}");
    background-size: 100% 100%;
    line-height:  1.5rem;
    @if($role->imgwidth > 0)
    width: {{$role->imgwidth/24*27}}px;
    @else
    width:  1.5rem;
    @endif
    height:  1.5rem;
    display: inline-block;
    vertical-align: -8px;
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
}
@endif
#sinaEmotion{
  width: 320px;
  min-height: 199px;
}
#sinaEmotion .faces{
  width: 320px;
}
{{-- */
$containJC = $roomUI->show_jc || $roomnavs->contains('type', '4005') ;
$containLesson = $roomUI->show_lesson || $roomnavs->contains('type', '4014') || $lessonV2;
$containManual = $roomUI->show_manual || $roomnavs->contains('type', '4007');
$containCjrl= $roomUI->show_cjrl || $roomnavs->contains('type', '4012');
$containFortune= $roomnavs->contains('type', '4020');
/* --}}

.input-group {
    position: relative;
    display: table;
    border-collapse: separate;
}
.form-control {
    display: block;
    width: 100%;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.input-group .form-control, .input-group-addon, .input-group-btn {
    display: table-cell;
}
.input-group .form-control {
    position: relative;
    z-index: 2;
    float: left;
    width: 100%;
    margin-bottom: 0;
}
.input-group-btn {
    position: relative;
    font-size: 0;
    white-space: nowrap;
     width: 1%;
    white-space: nowrap;
    vertical-align: middle;
}

.input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
    z-index: 2;
    margin-left: -1px;
}
.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:first-child>.btn-group:not(:first-child)>.btn, .input-group-btn:first-child>.btn:not(:first-child), .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group>.btn, .input-group-btn:last-child>.dropdown-toggle {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
.input-group-btn>.btn {
    position: relative;
}
.btn {
  background-color: #107bcf;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
  #js_notice_msg{
      color: {{$notice_msg_color}};
  }
  .dms-textarea-container .chat-send-btn.waiting {
      background-image: url("/assets/img/load.gif");
      background-repeat: no-repeat;
      background-size: 100% 100%;
      background-position: center;
      background-color: #eee !important;
      color: #333 !important;
      cursor: default;
  }
    #fixed-pop_fortune_btn{
      right: 18px;
      position: absolute;
      top: 90px;
    }
  </style>

  @if( !empty($roomUI->mobile_banner_cfg) )
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/js/swiper/swiper.min.css?v={{$webver}}">
    <style type="text/css">
      #swiper-pagination-id{
        bottom: 2px;
      }
    </style>
  @endif

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
    roomId:'{{$room->id}}',
    parentRoomId:'{{$parentRoomId}}',
    dynamicMsg:'{{$room->dynamic_msg}}',
    loginPopTs: "{{$roompower->login_pop_ts}}" * 1000|| 0,
    guest_chat_cue:{{$roompower->guest_chat_cue?1:0}},
    lookVideoImg:"{{$sysConfig->lookvideoImg}}",
    videoBgImg:"{{$videBgImg}}",
    teacher_pre:"{{$sysConfig->teacher_pre}}",
    phone_video:'{{$sysConfig->phone_video}}',
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
      clientId:'{{$clientId}}',
     @if($site->ul_ht_opend)
      presentTopic:"__present__{{$parentTopic}}"
      @else
      presentTopic:"__present__{{$topic}}"
      @endif
    },
    @if($site->jf_opend)
    treasureTimes:['{{$jfconfig->gj_ts1}}','{{$jfconfig->gj_ts2}}','{{$jfconfig->gj_ts3}}','{{$jfconfig->gj_ts4}}','{{$jfconfig->gj_ts5}}','{{$jfconfig->gj_ts6}}'],
    @endif
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
    channelType:'{{$roomLiveInfo->live_type}}',
    channelNumber:'{{$roomLiveInfo->live_play}}',
    channelHls:'{{$roomLiveInfo->live_hls}}',
    living:{{$roomLiveInfo->live_state}},
    live_play:'{{$roomLiveInfo->live_play}}',
    live_hls:'{{$roomLiveInfo->live_hls}}',
    live_play1:'{{$roomLiveInfo->live_play1}}',
    live_hls1:'{{$roomLiveInfo->live_hls1}}',
    vod_url:"{{$roomLiveInfo->vod_url}}",
    chosed:0
  }
  window.D.USER = {
    uid:'{{$user->uid}}',
    name:'{{$user->name}}',
    type:'{{$user->type}}',
    pic:'{{$user->pic}}',
    role:{!!json_encode($user->role)!!},
    chatIntervalCount:parseInt('{{$user->role->chat_ts}}'),
    plat:'{{$plat}}',
    logined:parseInt('{{$logined}}'),
    isManager:parseInt('{{$isManager}}'),
    lookvideo:parseInt('{{$user->lookvideo?1:0}}'),
  };
  window.D.CONF = {
      mgr_to_chat: parseInt('{{$sysConfig->mgr_to_chat}}'),
      chat_add_hot: parseInt('{{$sysConfig->chat_add_hot}}'),
      hide_to_user: parseInt('{{$sysConfig->hide_to_user}}')
  };
  $.ajaxSetup({headers: {
          'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
      }
  });
var realUserTotal = 0;
var __base__ = 0;
var __real_robot_num = 0;
var __base_num__ = {{$roompower->base_user}};
  </script>
</head>
<body>
<li class="mpstitle-name">{{$room->title}}</li>

{!!$room->code_body_pre!!}
<div class="common-content" id="connectold">
    <div style="margin-top: 100px;text-align: center;">
      <span style="font-size: 21px;color: red;font-weight: bold;">你的{{ $sysConfig->reg_account_tag }}在其他的页面打开</span>
    </div>
    </div>
<div class="nav-title" >
  <div class="logo-div">
        <img class="logo-img" src="{{!empty($room->mobile_logo) ? $room->mobile_logo: $room->logo}}">
  </div>
  
   @if(!$logined)
      <div class="fr head-info">
          <a class="head-user">
              <img src="{{$user->pic}}">
          </a>
      </div>
    @else
      <div class="fr head-info" style="margin-top:10px">
          <a  href="/user/info" style="width: 30px;height:30px;">
              <img src="{{$user->pic}}" style="border-radius: 30px">
          </a>
      </div>
    @endif

</div>
<div class="surface-container" style="position: relative;" >
  <div id="playBtn" class="play-btn" style="display: none" onclick="onPlay();"></div>
  @if($roomLiveInfo->live_type == 5)<!--mps-->
    <div id="id-video-warp" style="height:100%"></div>
  @elseif($roomLiveInfo->live_type == 3 || $roomLiveInfo->live_type == 9)<!--yy-->
    <div id="live"></div>
    <script src="//vodplayer.bs2dl.yy.com/yycloud.min.js"></script>
    <script>
      function startZhiniuPlay(){
        window.__starting = true;
        $.get("/live/zhiniu/"+window.D.CHANNELINFO.channelHls,function(resp,text){
          if(resp.code == 0 && window.__starting){
              $('#live').empty();
                yyObject.setPlayer({
                  vquality:"3",
                  appid:50020,
                  mode:0,
                  width:document.body.clientWidth,
                  height:document.body.clientWidth/16*9,
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
    </script>
    @elseif($roomLiveInfo->live_type == 11)
      <iframe id="id-huya" style="margin-top:-100px;border:0;width:100%;height:500px;" src="http://m.huya.com/{{$roomLiveInfo->live_hls}}"></iframe>
    @elseif($roomLiveInfo->live_type == 13)<!-- alipalyer -->
      <div id="id-video-warp" style="height:100%"></div>
    @else
  <video id="video-js" controls="" preload="auto" webkit-playsinline="" playsinline="" src="{{$room->live_hls}}" type="application/x-mpegURL" poster="" style="display: none"></video>
  @endif

 @if($roompower->video_pwd)
            <div id="js-video-player-pwd" style="display: none;width:200px;margin: auto;margin-top: 20%;">
              <div class="input-group">
                <input type="password" class="form-control" id="js-video-password" name="password" value="" placeholder="请输入视频密码">
                <span class="input-group-btn">
                  <button id="js-video-pwd-btn" class="btn btn-success" type="submit">观看视频</button>
                </span>
              </div>
            </div>
            @endif
  <div id="idVideoMsg" class="video-msg-info"></div>
  @if($site->video_cfg)
  <div id="idVideoBg" style="@if($roomLiveInfo->live_state || !$videBgImg) display: none; @endif position: absolute;width: 100%;height: 100%;top: 0px;z-index:100;">
    <img class="surface-container-img" width="100%" height="100%" src="{{$videBgImg}}">
  </div>
  <div id="js-hj-bg" style="display: none;position: absolute;width: 100%;height: 100%;z-index:101;">
    <img class="surface-container-img" width="100%" height="100%" src="{{$sysConfig->hj_bg}}">
  </div>
  @endif

</div>
@if(!$logined && $roompower->login_pop)
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.css">
<div class="video-timeout-bar">
  <div style="float:right;!important;">
    <span style="float:left!important;">剩余观看时间:</span>
    <div id="countdown" class="countdownHolder"></div>
    <p id="note"></p>
  </div>
</div>
@endif

  @if($roomLiveInfo->teacher)
  <div class="live-info" style="z-index:2;" >
    <label id="idCurTeacher" >{{$sysConfig->teacher_pre}}<span style="color:{{$roomLiveInfo->teacher->name_color}}">{{$roomLiveInfo->teacher->name}}</span></label>
  </div>
  @endif

@if($site->gift_opend)
  <div class="ryPopGift-wrap">
      <div class="ryPopGift ryPopGift_small first"></div>
      <div class="ryPopGift ryPopGift_small middele"></div>
      <div class="ryPopGift ryPopGift_small last"></div>
  </div>
@endif

<div class="chat_nav_box" id="chat_nav_box">
  <div class="chat-title tab_nav" id="chattitle">
    <div class=" clist " id="clist" style="position: absolute; left: 0px;top: 0px; overflow: hidden; height:100%;">
        <span id="chatchannel" class="tab-header z-crt"><img class="new-message"
                                                             src="{{$cdn}}/assets/img/phone/new.png">公聊</span>
      <span id="pri-chatchannel" class="tab-header"><img class="new-message" src="{{$cdn}}/assets/img/phone/new.png">私聊</span>
      @if( $user->role->f_userlist)
        <span class="tab-header">用户</span>
      @endif
      @if($containLesson)
        @if($lessonV2)
          @if($showLessonV2)
            <span id="my-lesson-id" class=" tab-header ">{{$sysConfig->lesson_pre}}</span>
          @endif
        @else
          <span id="my-lesson-id" class=" tab-header">{{$sysConfig->lesson_pre}}</span>
        @endif
      @endif
      @if($site->hot_opend)
        <span class="tab-header">人气榜</span>
      @endif
      @if($containManual)
        <span class="tab-header">操作建议</span>
      @endif
      @if( $sysConfig->show_rank )
        <span id="js-betbakn-dialog" class="tab-header">排行榜</span>
      @endif
      @if($site->vod_opend1)
        <span id="js-vod-dialog" class="tab-header">视频库</span>
      @endif
      @if($containCjrl)
        <span class="tab-header">财经数据</span>
      @endif
    </div>
  </div>
  <div class="tab-num">
    @if($roomUI->show_user_num)
      <span class="tab-header" style="float:right;margin-right:5px;" data-type="usernum">
          <img class="user-center-icon" src="/assets/img/phone/user.png" alt="用户"> <i id="userTotal"
                                                                                      style="margin-left:0.4em;">{{$roompower->base_user}}</i>
        </span>
    @endif
  </div>
</div>

@if( !empty($roomUI->mobile_banner_cfg) )
  <div class="mobile-banner" style="height: 56px;width: 100%">
    <div class="swiper-container swiper-container-ad" style="height: 56px;width: 100%">
      <div class="swiper-wrapper">
        @foreach($roomUI->mobile_banner_cfg as $idx=>$item)
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

            activeSwiperAd();

            $('.chat-title span').on('click', function() {
                if ($(this).data('type') === "usernum") {
                    return;
                }
                if ($(this).index() == 0) {
                    $('.mobile-banner').height(56);
                    $('.swiper-container').height(56);
                } else {
                    $('.mobile-banner').height(0);
                    $('.swiper-container').height(0);
                }
            });
        });
    </script>
  @endpush
@endif

  <div class="panes"  >
    <div class="pane">
        <div  class ="chat-notice-box">
          <span class="chat-notice-name">公告</span>：
          <div class="notice_wrap">
            <span id="js_notice_msg">{{$room->notice_msg}}</span>
          </div>
        </div>
      <div class="dms-message-container" id="dmsMessage">
      </div>
      <div class="dms-send-container" id="dmsSend">
        <div class="dms-textarea-container">
        <span id="js-gift-btn" class="gift-button"></span>
          <div class="dms-textarea-box" >
          <input type="text" class="input-text"  id="aodianyun-dms-text" maxlength="30" placeholder="在这里输入聊天内容">
          </div>
          <a href="javascript:;" class="chat-send-btn" id="id-chat-btn">发送</a>
          <span class="dms-emotion-button"></span>
          </div>
          <div class="bottom-wrap">
              <div class="bottom-plane plane-pic"></div>
              <div class="bottom-plane plane-gift ">
                <!-- 礼物列表 -->
                <div class="MR-gift" id="js-gift-panel"></div>
              </div>
          </div>
      </div>
      <div id="popwarp" style="display: none;"></div>
      <div id="js-fixed-warp" style="display: none;" >
        <ul class="fixed-container">
          @if($roomqqs->count() > 0)
          <li id="kf_warp" >
            <span style="color: rgb(55,208,235);">主播</span><img style="width: 20px; height: 20px;" src="{{$cdn}}/assets/img/phone/icon/kf.png" >
          </li>
          @endif

          <li id="share-btn" >
             <span style="color: rgb(253,167,89);">分享</span><img style="width: 20px; height: 20px;" src="{{$cdn}}/assets/img/phone/icon/fx.png" >
          </li>
          @if($roomUI->show_past)
          <li id="idUserPast">
            <span style="color: rgb(72,209,140);">签到</span><img style="width: 20px; height: 20px;" src="{{$cdn}}/assets/img/phone/icon/qd.png" >
          </li>
          @endif
          @if($site->jf_opend && $containJC)
          <li id="js-bet-dialog">
            <span style="color: rgb(244,92,71);">竞猜</span><img style="width: 20px; height: 20px;" src="{{$cdn}}/assets/img/phone/icon/jc.png" >
          </li>
          @endif
        </ul>
        @if($roomqqs->count() > 0)
        <div id="kf_warp_customer" class="class-kf-warp" style="right:0px;position: absolute;display:none;top: 38px;z-index: 101;">
          <ul class="customer-list">
            @foreach($roomqqs as $value)
            <li>
              <a href="mqqwpa://im/chat?chat_type=wpa&uin={{$value->qq}}&version=1&src_type=web&web_src={{$myHost}}" target="_blank">
                <span>{{$value->name}}</span>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        @endif

      </div>
      @if($containFortune)
      <div class="pop_fortune_btn" id="fixed-pop_fortune_btn"></div>
      @endif
      <div class="pop_btn"></div>
      @if($site->jf_opend)
      <dir class="treasure">
        <div class="treasure-box"></div>
        <div class="treasure-count-down"><span>__:__:__</span></div>
      </dir>
      @endif
      @if($user->role->f_tochat && $sysConfig->mgr_to_chat)
        <img id="idTeacherInfo" src="{{$cdn}}/assets/img/toteacher.png"   style="@if(!$roomLiveInfo->live_state) display: none;@endif" class="select-to-mgr-chat" @if($roomLiveInfo->teacher) data-uid="{{$roomLiveInfo->teacher->id}}" data-name="{{$roomLiveInfo->teacher->name}}" @endif>
      @endif
     <span id="js-chat-to-user"  style="display:none;position: fixed;bottom: 45px;left: 5px;color: #333;font-size: 0.8em;padding: 2px 8px;z-index:100;background-color: #FF4646;border-radius: 8px;">对 <span style="color:#fff;"></span> 说</span>
    </div>
    <div class="pane" style="display:none;">
        <div class="dms-message-container" id="privateChat">
        </div>
        <div class="dms-send-container">
          <div class="dms-textarea-container">
            <div class="dms-textarea-box private-box" >
            <input type="text" class="input-text"  id="id-prichat-text" maxlength="30" placeholder="在这里输入聊天内容">
            </div>
            <a href="javascript:;" class="chat-send-btn" id="id-prichat-btn">发送</a>
            <span class="dms-emotion-button"></span>
            </div>
        </div>
      <span id="js-private-user"  style="display:none;position: fixed;bottom: 45px;left: 5px;color: #333;font-size: 0.8em;padding: 2px 8px;z-index:100;background-color: #FF4646;border-radius: 8px;">对 <span style="color:#fff;"></span> 私聊</span>
    </div>
    @if( $user->role->f_userlist)
    <div class="pane ul-warp" style="display:none;overflow-y:scroll;">
      <ul id="idUserList" class="user-list"></ul>
      <div id="js-more-user" style="padding: 5px;text-align: center;cursor: pointer;">获取更多</div>
    </div>
    @endif
      @if($containLesson)
      @if($lessonV2)
        @if($showLessonV2)
        <div id="my-lesson-pane-id" class="pane" style="display:none;-webkit-overflow-scrolling: touch;overflow-y: scroll;">
          <iframe id="idLessonIframe" onload="typeof onIframeLoad == 'function' && onIframeLoad(this);" src="/iframe/lesson/{{$room->id}}?mobile=1" width="100%" height="100%" scrolling="yes" style="border: none;margin: 0px;padding: 0px;" frameborder="0"></iframe>
        </div>
        @endif
      @else
      <div id="my-lesson-pane-id" class="pane" style="display:none;overflow-y:scroll;">
        <img src="{{$roomUI->lesson_img}}" width="100%">
      </div>
      @endif
    @endif
    @if($site->hot_opend)
    <div class="pane sider-hot-rank"  style="background: #f2ecdd;display:none;overflow-y:scroll;">
      <ul id="idHotRank">

      </ul>
    </div>
    @endif
    @if($containManual)
    <div class="pane" style="display:none;overflow-y:scroll;">
      @if(!$user->role->f_manual)
      <p>暂无权限查看</p>
      @else
      <div class="suggestion-table" style="padding:0px 15px;">
      </div>
      @endif
    </div>
    @endif


    @if($sysConfig->show_rank)
    <div  class="pane" style="display:none;overflow-y:scroll;">
        <div class="rank-tab">
            @if($containJC)
                <li class="active" data-link="idBetRank" data-url="betrank" >竞猜排行榜</li>
                <li  data-link="idJfRank" data-url="jfrank" >积分排行榜</li>
            @else
                <li  data-link="idJfRank" data-url="jfrank" class="active">积分排行榜</li>
            @endif
        </div>
        @if($containJC)
            <div class="rank-show" id="idBetRank"></div>
        @endif
        <div class="rank-show" id="idJfRank"></div>
    </div>
    @endif
    @if($site->vod_opend1)
      <div id="js-vod-warp" class="pane" style="display:none;overflow-y:scroll;">
      </div>
      @endif
    @if($containCjrl)
    <div class="pane" style="display:none;overflow-y:scroll;">
      <iframe style=" height: 100%;   width: 100%;border: none;" src="http://www.jin10.com/example/jin10.com.html"></iframe>
    </div>
    @endif
  </div>
  <!--弹幕-->
  <div class="danmu-warp" style="pointer-events: none;">
    <div class="danmu-content"></div>
  </div>

  <!--宝箱-->
  <div class="treasure"></div>
  <!--登陆提示-->
  <div class="login-tips-wrap">
    <div class="login-tips-content">
      @if($roompower->login_pop == 2)
        <span class="login-close"></span>
        @endif
    </div>
    <a href="/auth/login?ui=v2&isMobile=1&back={!!urlencode($ctrl->fullUrl())!!}&roomid={{$room->id}}@if($roompower->reg_open)&showReg=1 @endif" class="login-btn js-login-dialog" ></a>
    @if($roompower->reg_open)
    @if($sysConfig->reg_mod == 1)
    <a href="/auth/reg?back={!!urlencode($ctrl->fullUrl())!!}&roomid={{$room->id}}&showLogin=1"  class="signup-btn js-sigup-dialog"></a>
    @elseif($sysConfig->reg_mod == 2)
     <a href="/auth/coupon?roomid={{$room->id}}"  class="coupon-btn js-coupon-dialog"></a>
    @endif
    @endif
  </div>
  <!--分享-->
  <div id="sharedWrap"></div>
  <div id="shared">
    <h2 style="margin-left:8px;margin-bottom: 12px;margin-top:10px;color: #000;font-weight: 400;">分享到:</h2>
    <ul>
      <li onclick="icon3()" id="icon3">
        <img src="/assets/img/phone/tx.png" width="44px" height="44px">腾讯微博</li>
      <li onclick="icon2()" id="icon2">
        <img src="/assets/img/phone/sina.png" width="44px" height="44px">新浪微博</li>
      <li onclick="icon4()" id="icon4">
        <img src="/assets/img/phone/qz.png" width="44px" height="44px">QQ空间</li>
    </ul>
  </div>
  <div id="js-user-panel" class="user-panel" @if(!($site->jf_opend)) style="height:174px;" @endif>
    <div class="user-info">
      <div class="item">用户昵称：<span>{{$user->account}}</span></div>
      <!--div class="item">用户{{ $sysConfig->reg_account_tag }}：<span>{{$user->name}}</span></div-->
      <div class="item">用户角色：<span>{{$user->role->name}}</span></div>
      @if(($site->jf_opend))
        <div class="item">用户积分：<span>@if($user->extern){{$user->extern->jf_cur}}@else 0 @endif</span></div>
        <!--div class="item">送礼积分：<span>@if($user->jf_giftsend){{$user->extern->jf_giftsend}}@else 0 @endif</span></div-->
      @endif
      @if(!$logined)
          @if($roompower->reg_open)
              @if($sysConfig->reg_mod == 1)
              <a href="/auth/reg?back={!!urlencode($ctrl->fullUrl())!!}&roomid={{$room->id}}&showLogin=1" class="btn" style="float:right;margin-right:5px;margin-top:4px;">注册</a>
               @elseif($sysConfig->reg_mod == 2)
             <a href="/auth/coupon?roomid={{$room->id}}" class="btn" style="float:right;margin-right:5px;margin-top:4px;" >领券</a>
            @endif
          @endif
        <a href="/auth/login?ui=v2&isMobile=1&back={!!urlencode($ctrl->fullUrl())!!}&roomid={{$room->id}} @if($roompower->reg_open)&showReg=1 @endif" class="btn" style="float:right;margin-right:2px;margin-top:4px;">登录</a>
      @else
          <a href="/user/modify?mobile=1&back={!!urlencode($ctrl->fullUrl())!!}" class="btn" style="float:right;margin-right:5px;margin-top:4px;">设置</a>
          <a href="/auth/logout" class="btn" style="float:right;margin-right:5px;margin-top:4px;">登出</a>
      @endif
    </div>
  </div>
@include('front.phone.jsrender')
@if($roomLiveInfo->live_type == 5)
<script type="text/javascript" src="{{$cdn}}/assets/js/mpslssplayer.js?v={{$webver}}"></script>
@endif
<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/black_clientv2.js?v={{$webver}}"></script>
@if($app::config('site.dms_host', ''))
  <script type="text/javascript">
      if( typeof ROP != 'undefined'){
          ROP.ICS_ADDR = "{{ $app::config('site.dms_host', '') }}";
          ROP.CDN_ADDR = "{{ $app::config('site.dms_cdn_host', '') }}";
      }
  </script>
@endif
@if(!$logined && $roompower->login_pop)
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.my.js"></script>
@endif
@if($site->jf_opend)
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.countdown/jquery.countdown.min.js"></script>
@endif

@include("widget.hot-li-tmpl")

<script type="text/javascript" src="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/artDialog/dialog.js?v={{$webver}}"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/phone/room.js?v={{$webver}}"></script>
<script type="text/javascript">
function onIframeLoad(self){

}
function setIframeHeight(height){
    $('#idLessonIframe').height(  height );
}
function showFortune(){
    var url = "/fortune/index";
    var align_dom = document.getElementById('chat_nav_box');
      var iframeHtml = '<iframe id="fortuneDialog" class="scale-iframe3" src="'+url+'" width="800" height="480"></iframe>'
      window._fortuneDialog = dialog({
          align: 'bottom',
          content: iframeHtml,
          backdropOpacity:0.0,
          height:192,
          width:320,
          padding:'0px',
          skin: 'notitle-dialog-new',
          title:"xx",
      });
      window._fortuneDialog.show(align_dom);
}
$(function(){
    resizeVideo();
    panesInit();
    initChat();
    startVideo();
    getRoominfos();
    startLifeCheck();
    initNotice();
    @if($containFortune)
        @if($popUpFortune)
            showFortune();
        @endif
    $('.pop_fortune_btn').click(function(){
      showFortune();
    })
    @endif
    $('#kf_warp').click(function(e){
      $('#kf_warp_customer').toggle();
      e.preventDefault();
      e.stopPropagation();
    })
    $('#js-turn-video').click(function(e){
      $('#js-turn-video-warp').toggle();
      e.preventDefault();
      e.stopPropagation();
    })
    $('.head-user').click(function(e){
      $('.user-panel').toggle();
      e.preventDefault();
      e.stopPropagation();
    })

    $('body').on("touchstart",function(){
      var $target = $(event.target);
      var id = $target.attr('id');
      if(id == "kf_warp_customer" || $target.parents('.class-kf-warp').length > 0){
        return;
      }
      if(id == "js-turn-video-warp" || $target.parents('.turn-video-class').length > 0){
        return;
      }
      if(id != 'js-user-panel' && $target.parents('.user-panel').length <= 0){
        $('#kf_warp_customer').hide();
        $('.user-panel').hide();
        $('#js-turn-video-warp').hide();
      }

    })
    @if( $user->role->f_userlist)

    initUL();
    @endif
    @if(!$logined && $roompower->login_pop)
    startPopVisit('{{$roompower->login_pop}}')
    @endif
    initPast();
    @if(empty($user->role->f_hj) && $site->video_cfg)
    RunHjTime();
    @endif
    @if($site->jf_opend)
    initTreasure();
    @endif
    @if($site->hot_opend)
    initHot();
    @endif
    @if($site->jf_opend )
    $('#js-vod-dialog').bind('click',function(){
      $.get('/iframe/vodphone/'+window.D.roomId,function(resp){
        $('#js-vod-warp').html(resp);
      })
    })
    $('#js-bet-dialog').bind("click",function(){
        var url = "/iframe/bet/" + window.D.roomId;
        var iframeHtml = '<iframe class="scale-iframe" src="'+url+'" width="570" height="340"></iframe>'
        window._hdDialog = dialog({
            content: iframeHtml,
            backdropOpacity:0.1,
            height:170,
            width:285,
            padding:'0px',
            skin: 'notitle-dialog',
            title:"xx",
            quickClose:true,
        });
        window._hdDialog.showModal();
        hidePop();
    })
    $('.rank-tab li').click(function(){
      $(this).siblings().removeClass("active");
      $(this).addClass("active");
      doRank($(this));
    })
    function doRank($item){
        var urlItem = $item.attr('data-url');
        var urlLikn = $item.attr('data-link');
        $('.rank-show').hide();
        $.get('/iframe/'+urlItem+'/'+window.D.roomId+"?mobile=1",function(resp,text){
          $('#'+urlLikn).html(resp);
          $('#'+urlLikn).show();
        })
    }
    $('#js-betbakn-dialog').bind("click",function(){
        $.get('/iframe/betrank/'+window.D.roomId+"?mobile=1",function(resp,text){
          doRank($('.rank-tab .active'));
        })
    })
    @endif
  })

var objectPlayer = {};

@if($roomLiveInfo->live_type == 5)

function tabHeight() {
    if($_BROWSER.versions.android){
        var height  = $(window).width() * 9 / 16;
        $('#videoBox').height(height);
        resizeVideo();
    }else if($_BROWSER.versions.iPhone){
        resizeVideo();
    }
}

window.objectPlayer = new mpsPlayer({
      //appId: "fHNNBuuB3BbUWJiP",
      //uin: 13830,
      container:'id-video-warp',//播放器容器ID，必要参数
      uin: 24260,//用户ID
      appId: '7mbz3B1mbNUXyXQW',//播放实例ID
      hlsUrl: '{{$roomLiveInfo->live_hls}}',//控制台开通的APP hls地址
      rtmpUrl: '{{$roomLiveInfo->live_play}}',//控制台开通的APP rtmp地址
      flvUrl: '',//flv地址
      width: '100%',//播放器宽度，可用数字、百分比等
      height: '100%',//播放器高度，可用数字、百分比等
      autostart: true,//是否自动播放，默认为false
      stretching: window.D.CHANNELINFO.stretching || 1, //设置全屏模式,1代表按比例撑满至全屏,2代表铺满全屏,3代表视频原始大小,默认值为1。hls初始设置不支持，手机端不支持
      mobilefullscreen: window.D.CHANNELINFO.mobilefullscreen || false,  //移动端是否全屏，默认为false
      controlbardisplay: 'enable',//是否显示控制栏，值为：disable、enable默认为disable。
      isclickplay: false,//是否单击播放，默认为false
      isfullscreen: true,//是否双击全屏，默认为true
      enablehtml5: false,//是否优先使用H5播放器，默认为false
      isloadcount: 1,//网络波动卡顿loading图标显示(默认1s后)
      isdefaultfull: true,
      onReady:function(){
          console.log && console.log('mpsPlayer onReady');
          setTimeout(function () {
              tabHeight();
          }, 200);
      },
      playCallback: function () {
          console.log && console.log('mpsPlayer playCallback');
          setTimeout(function () {
              tabHeight();
          }, 200);
      },
      pauseCallback: function () {
          console.log && console.log('mpsPlayer pauseCallback');
          setTimeout(function () {
          }, 1000);
      }
});
@endif


@if($roomLiveInfo->live_type == 13)
    if($_BROWSER.versions.ios){
        window.objectPlayer = new Aliplayer({
          id: 'id-video-warp',
          autoplay: true,
          isLive:false,
          playsinline:true,
          x5_type: 'h5',
          x5_video_position: 'top',
          width:"100%",
          height:"100%",
          controlBarVisibility:"hover",
          useH5Prism:false,
          useFlashPrism:false,
          source: '{{$roomLiveInfo->live_hls}}',
          cover:"",
          skinLayout:[{"name":"controlBar","align":"blabs","x":0,"y":0,"children":[{"name":"progress","align":"tlabs","x":0,"y":0},
              {"name":"playButton","align":"tl","x":15,"y": 13},
              {"name":"fullScreenButton","align":"tr","x":20,"y": 12},
              {"name":"volume","align":"tr","x":20,"y": 12},
              {"name":"timeDisplay","align":"tl","x":10,"y": 12}]},
              {"name":"bigPlayButton","align":"blabs","x":30,"y":80}]
      },function(player){

      });
    } else {
        var hls_str = '{{$roomLiveInfo->live_hls}}';
        var html_str = '<video id="video-js" controls="" preload="auto" webkit-playsinline="" playsinline="" src="' + hls_str + '" type="application/x-mpegURL" poster="" ></video>';
        $('#id-video-warp').append(html_str);
    }

@endif

function playVod1(url){
    if(objectPlayer && objectPlayer.changePlayer){
        return objectPlayer.changePlayer(url);
    }
    $('#idVideoMsg').hide();
    $('#idVideoBg').hide();
    $('#video-js').attr('src', url);
    $('#playBtn').hide();
    $('#carousel').hide();
    $('#video-js').attr('autoplay', "autoplay");
    $('#video-js').show();
    var video = document.getElementById('video-js');
    if(!video){
        video = $('#id-video-warp').find('video').length>0 ? $('#id-video-warp').find('video')[0] : null ;
    }
    video && video.play();
}
function startVideo() {
 $('#js-video-pwd-btn').click(function(){
        if( $("#js-video-password").val() == ""){
           dialog({title:"提示",content:"请输入视频密码",quickClose: true}).show();
            return;
        }
        $.post('/live/videopwd/' + window.D.roomId, { 'pwd': $("#js-video-password").val() }, function(resp,err) {
            if(resp.code == 0){
                __checked_video_pwd__ = 1;
                showVideo();
            }else{
                dialog({title:"提示",content:resp.msg,quickClose: true}).show();
            }
        });
    })
  $('#js-turn-video-warp li').click(function(){
    $('#js-turn-video-warp li').removeClass('active')
    $(this).addClass('active');
    if($(this).attr('data-type') == 1){
      window.D.CHANNELINFO.chosed = 2;
      window.D.CHANNELINFO.channelNumber = window.D.CHANNELINFO.live_play1;
      window.D.CHANNELINFO.channelHls = window.D.CHANNELINFO.live_hls1;
    }else{
      window.D.CHANNELINFO.chosed = 1;
      window.D.CHANNELINFO.channelNumber = window.D.CHANNELINFO.live_play;
      window.D.CHANNELINFO.channelHls = window.D.CHANNELINFO.live_hls;
    }
    $('#idTeacherInfo').attr('data-uid',$(this).attr('data-uid'));
    $('#idTeacherInfo').attr('data-name',$(this).attr('data-name'));
    $('#idTeacherInfo').show();
    onLiving(window.D.CHANNELINFO.living);
    $('#js-video-chose-warp').hide();
  });
  $('#js-video-chose-warp img').click(function(){
     $('#js-turn-video-warp li').removeClass('active')
    if($(this).attr('data-type') == 1){
      window.D.CHANNELINFO.chosed = 2;
      window.D.CHANNELINFO.channelNumber = window.D.CHANNELINFO.live_play1;
      window.D.CHANNELINFO.channelHls = window.D.CHANNELINFO.live_hls1;
      $( $('#js-turn-video-warp li')[1] ).addClass('active');
    }else{
      window.D.CHANNELINFO.chosed = 1;
      window.D.CHANNELINFO.channelNumber = window.D.CHANNELINFO.live_play;
      window.D.CHANNELINFO.channelHls = window.D.CHANNELINFO.live_hls;
      $( $('#js-turn-video-warp li')[0] ).addClass('active');
    }
    $('#idTeacherInfo').attr('data-uid',$(this).attr('data-uid'));
    $('#idTeacherInfo').attr('data-name',$(this).attr('data-name'));
    $('#idTeacherInfo').show();
    onLiving(window.D.CHANNELINFO.living);
    $('#js-video-chose-warp').hide();
  })
  window.onLiving = function(living) {
    if (living) {
      play();
    } else {
      stop();
    }
  }
  window.onPlay = function(){
      play();
  }
    var mpsTimer = null;
  function play() {
    @if($roomLiveInfo->live_type == 5)
        mpsTimer = setInterval(function () {
            if(objectPlayer.startPlay){
                setTimeout(function () {
                    if(window.D.CHANNELINFO.vod_url && objectPlayer.changePlayer){
                        objectPlayer.changePlayer(window.D.CHANNELINFO.vod_url);
                    } else {
                        objectPlayer.startPlay();
                    }
                    clearInterval(mpsTimer);
                }, 100);
            }
          }, 100);
       return ;
    @elseif($roomLiveInfo->live_type == 3 || $roomLiveInfo->live_type == 9)
      startZhiniuPlay();
    @elseif($roomLiveInfo->live_type == 11)
    $('#id-huya').attr('src',"http://m.huya.com/"+window.D.CHANNELINFO.channelHls);
    @else
    $('#video-js').show();
    if(window.D.CHANNELINFO.vod_url){
      $('#video-js').attr('src', window.D.CHANNELINFO.vod_url);
    }else{
      $('#video-js').attr('src', window.D.CHANNELINFO.channelHls);
    }
    $('#playBtn').hide();
    $('#carousel').hide();
    var video = document.getElementById('video-js');
    video && video.play();
    @endif

  }
  function stop() {
   @if($roomLiveInfo->live_type == 5)
     if(objectPlayer.pausePlay)
       objectPlayer.pausePlay();
       return;
   @elseif($roomLiveInfo->live_type == 3 || $roomLiveInfo->live_type == 9)
   stopZhiniuPlay();
   @elseif($roomLiveInfo->live_type == 11)
   $('#id-huya').attr('src',"");
    @else
    $('#video-js').hide();
    $('#video-js').attr('src', '');
    $('#playBtn').hide();
    $('#carousel').show();
    var video = document.getElementById('video-js');
    if(video){
      video.currentTime = 0;
      video.pause();
    }
    @endif
  }


 if(!window.D.USER.lookvideo){
    hideVideo();
 }else{
     if (window.D.CHANNELINFO.living) {
         showVideo();
     }
 }
}
</script>
@stack('scripts')

</body>
</html>