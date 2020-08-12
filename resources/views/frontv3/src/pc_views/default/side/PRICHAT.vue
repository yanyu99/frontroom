<template>
  <div class="menu-box">

    <div tabindex="1" id="PRICHAT" class="vl-notify vl-notify-main  vl-notify-iframe" v-show="roomInfo.is_show_pri_box" style="z-index: 460;">
      <div class="vl-notify-content" style="min-height: inherit; overflow: auto;">

        <div class="menu-main">
          <template>
            <div class="menu-contain">
              <!-- 左边 -->
              <div class="ly-left nice-scroll" tabindex="1" style="overflow: hidden; outline: none;">
                <ul class="user-list-pri list-unstyled">

                  <li class="user-item" role="presentation" v-for="item in priChatUserList" :key="item.uid" :islook="item.islook" :id="'userpri_'+ item.uid" :class="{'active':item.uid == roomInfo.selPriChatMsgItem.toUid}" @click.stop="chanPriUser(item)">
                    <a aria-expanded="true">
                      <img class="img-circle user-pic" :src="item.pic" alt="user">
                      <span class="text">{{item.name}}</span>
                      <span class="status-online"></span>
                      <!-- <span class="status-message" :class="{'active':!item.islook && item.uid != roomInfo.selPriChatMsgItem.toUid}"></span> -->
                    </a>
                    <i class="icon-times user-delete" @click.stop="closePriUser(item.uid)">x</i>
                  </li>

                </ul>
              </div>

              <!-- 右边 -->
              <div class="ly-right">
                <div class="ly-header">
                  <div class="current-user-info">
                    <div class="name">{{roomInfo.selPriChatMsgItem.toName}}</div>
                    <div class="description text-muted"></div>
                  </div>
                </div>

                <div class="ly-body">
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane nice-scroll p-scroll active" style="overflow-y: scroll; outline: none;">

                      <template>
                        <div class="chat-message  clearfix" v-for="item in curPriChatList" :msg-id="'df_'+item.id" :key="item.id" :class="{'chat-me':item.msgtype !='rec_pri_msg'}">
                          <span class="dropdown chat-message-avatar" style="width:84px">
                            <img :src="item.msgtype =='rec_pri_msg'?  item.pic: userInfo.pic " alt="user">
                            <span :style="{'margin-left':item.msgtype !='rec_pri_msg'  ?'5px':'','color':'#ccc;'}">{{item.time}}</span>
                          </span>
                          <div class="chat-message-content" style="margin-top:6px;">
                            <div class="chat-message-context">
                              <i class="chat-message-context-caret"></i>
                              <span v-html="fixEmoji(item.message)"></span>
                            </div>
                          </div>
                        </div>
                      </template>

                    </div>
                  </div>
                </div>

                <div class="ly-footer">
                  <form class="private-chat-form">
                    <div class="private-chat-form-exFun">
                      <span id="js-chat-faces-btn-pri" class="private-chat-form-exFun-item private-icon-smile">
                        表情
                      </span>
                      <span id="js-chat-picture-btn-pri" @click="uploadImg" class="private-chat-form-exFun-item private-icon-pic">
                        图片
                      </span>
                    </div>
                    <div class="private-chat-form-input-wrap">
                      <textarea class="private-chat-form-input nice-scroll" v-model="textMsgPri" id="js-chat-form-input_pri" tabindex="10" @keyup.enter="sendMsg" style="overflow: hidden; outline: none;"></textarea>
                    </div>
                    <div class="chat-form-op">
                      <button type="button" class="btn private-chat-form-btn send-btn" id="js-send-btn" @click="sendMsg">发送</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </template>
        </div>

        <div class="close-layer" @click="closeLayer">×</div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .mask {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1000;
  }

  .vl-notify .vl-notify-content {
    padding: 0px;
  }

  .icon-pic,
  #js-chat-picture-btn-pri.uploadify .uploadify-button {
    background-image: url("/assets/img/pic_min.png");
  }

  .waitlook {
    background-color: rgb(51, 122, 183);
    border-radius: 8px;
    color: #fff;
  }

  .user-list-pri .active .text {
    color: #337ab7 !important;
    text-decoration: none;
  }

  .user-list-pri .waitlook .text {
    color: #3f3c3c !important;
    text-decoration: none;
  }

  .send-btn {
    height: 34px;
    border: 0px;
  }

  .to-chat-warp .myclose {
    display: inline-block;
    position: relative;
    right: 27px;
    top: -24px;
    background-image: url("/assets/img/xxx-close.png");
    background-repeat: no-repeat;
    width: 19px;
    height: 19px;
    z-index: 999;
  }

  .danmu-warp .danmu-content {
    position: relative;
    right: 0px;
    top: 0px;
    display: inline;
    z-index: 1000;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    white-space: nowrap;
  }

  .chat-system-msg {
    margin-left: 10px;
  }

  .chat-system-msg .time {
    color: #aaa;
    font-size: 12px;
  }

  .chat-system-msg .text {
    color: red;
    font-size: 14px;
    font-weight: bold;
  }

  .chat-pic {
    cursor: url("/assets/img/zoom.png"), auto;
  }

  .chat-wrap-content {
    padding: 0 0 10px;
    overflow-y: scroll;
    position: absolute;
    width: 100%;
    bottom: 100px;
    top: 33px;
  }

  .chat-form {
    position: absolute;
    bottom: 0;
    width: 100%;
    background: rgba(136, 136, 136, 0.26);
    padding: 0 10px 10px;
    z-index: 4;
    border-top: 1px solid #333;
  }

  .chat-content-exFun {
    position: absolute;
    top: -35px;
    right: 10px;
    height: 35px;
    line-height: 35px;
  }

  .chat-content-exFun-item {
    font-size: 12px;
    display: inline-block;
    height: 24px;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 5px;
    margin-right: 5px;
    cursor: pointer;
    background-position: center;
    background-repeat: no-repeat;
    background-color: rgba(0, 0, 0, 0.3);
    padding: 0 10px;
    line-height: 24px;
  }

  .chat-content-exFun-item:hover {
    background-color: rgba(0, 0, 0, 0.1);
  }

  .chat-content-exFun-item:active {
    background-color: rgba(0, 0, 0, 0.6);
  }

  .chat-form-exFun {
    height: 42px;
    line-height: 42px;
  }

  .chat-form-exFun-item,
  #js-chat-picture-btn-pri {
    display: inline-block;
    height: 30px;
    width: 30px;
    border-radius: 24px;
    overflow: hidden;
    margin-top: 6px;
    cursor: pointer;
    background-position: center;
    background-repeat: no-repeat;
  }

  .chat-form-exFun-item:hover {
    background-color: #000;
  }

  .icon-smile {
    background-image: url("/assets/img/smile6bfb.png?_v=2") !important;
  }

  .icon-gift {
    text-indent: -999px;
    background-image: url("/assets/img/gift.png?_v=2") !important;
  }

  .icon-pic,
  #js-chat-picture-btn-pri.uploadify .uploadify-button {
    background-position: center;
    background-repeat: no-repeat;
    background-image: url("/assets/img/pic6bfb.png?_v=2") !important;
  }

  .icon-pic,
  #js-chat-picture-btn-pri.uploadify .uploadify-button {
    background-position: center;
    background-repeat: no-repeat;
    background-image: url("/assets/img/pic_min.png") !important;
  }

  .icon-pic,
  #js-chat-picture-btn-pri.uploadify .uploadify-button {
    background-image: url("/assets/img/pic_min.png") !important;
  }

  .icon-ct {
    background-position: center;
    background-repeat: no-repeat;
    background-image: url("/assets/img/ct.png?_v=2") !important;
  }

  #js-chat-picture-btn-queue {
    display: none;
  }

  #js-chat-picture-btn-pri.uploadify:hover .uploadify-button {
    background-color: #000;
  }

  .icon-send-star {
    background-image: url("/assets/img/send-star6bfb.png?_v=2") !important;
  }

  .chat-form-input-wrap {
    margin-right: 150px;
  }

  .chat-form-input {
    height: 48px;
    display: block;
    width: 100%;
    display: block;
    padding: 5px;
    color: #333;
    resize: none;
    color: rgba(255, 255, 255, 1);
    background: rgba(0, 0, 0, 0.15);
  }

  .chat-form-op {
    position: absolute;
    top: 42px;
    right: 0;
  }

  .chat-form-btn {
    padding: 14px 0;
    font-size: 14px;
    color: #fff;
    cursor: pointer;
  }

  .send-btn {
    width: 80px;
    border-width: 1px 2px 2px 1px;
    background-color: #009efc;
    margin-right: 5px;
  }

  .send-btn.waiting {
    background-image: url("/assets/img/load.gif");
    background-repeat: no-repeat;
    background-position: center;
    background-color: #eee !important;
    color: #333 !important;
    cursor: default;
  }

  .send-btn:hover {
    background-color: #139ef1;
  }

  .send-btn.disabled,
  .send-btn[disabled] {
    cursor: not-allowed;
    box-shadow: none;
    opacity: 0.65;
  }

  .send-btn:active {
    background-color: #1271ab;
  }

  .notice-btn {
    width: 48px;
    margin-right: 10px;
    background-color: #aeabab;
    background-repeat: no-repeat;
    background-position: center;
    background-image: url(/assets/img/danmu.png);
    text-indent: -99999;
  }

  .notice-btn:hover {
    background-color: #aba9a9;
  }

  .notice-btn:active {
    background-color: #8e8c8c;
  }

  .chat-tips-history {
    padding: 5px;
    text-align: center;
  }

  .chat-tips-history .text {
    border-radius: 3px;
    line-height: 14px;
    font-size: 12px;
    display: inline-block;
    padding: 5px 15px;
    background-color: rgba(6, 6, 6, 0.53);
  }

  .chat-message {
    padding: 0px 10px;
    line-height: 32px;
    margin: 0;
  }

  .chat-message .dropdown {
    position: relative;
  }

  .chat-message .dropdown:hover .dropdown-menu {
    display: block;
    top: 28px;
    zoom: 1;
  }

  .chat-message.chat-me .dropdown-menu {
    left: auto;
    right: 0;
  }

  .chat-message-avatar {
    float: left;
    width: 32px;
    height: 32px;
    margin-top: 6px;
  }

  .chat-message-avatar img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    vertical-align: middle;
  }

  .chat-message-context-caret {
    display: block;
    width: 0;
    height: 0;
    border-width: 6px 6px 0;
    border-style: solid;
    border-color: #fff transparent transparent;
    position: absolute;
    top: 10px;
    left: -6px;
  }

  .chat-message-context {
    background-color: #fff;
    color: #333;
    border-radius: 3px;
    padding: 5px 10px;
    position: relative;
    line-height: 22px;
    max-width: 100%;
    display: inline-block;
    box-shadow: 1px 1px 5px #999;
    word-break: break-all;
  }

  .chat-message-status-content {
    color: #999;
  }

  .chat-me .chat-message-avatar {
    float: right;
  }

  .chat-me .chat-message-content {
    margin-left: 0;
  }

  .chat-me .chat-message-meta {
    text-align: right;
  }

  .chat-me .chat-message-context {
    float: right;
    box-shadow: 1px 1px 5px #999;
    margin-right: 5px;
  }

  .chat-me .chat-message-context-caret {
    right: -6px;
    left: auto;
  }

  .user-list {}

  .user-list .user-item:hover {
    background: rgba(255, 255, 255, 0.05);
  }

  .user-item .private-btn {
    position: absolute;
    right: 5px;
    top: 15px;
    line-height: 18px;
    padding: 0 3px;
    border: 1px solid #658ea7;
    background-color: #000;
  }

  .user-right-menu {
    position: absolute;
    top: -45px;
    left: 3px;
    right: 3px;
    border-radius: 3px;
    height: 50px;
    color: #333;
    line-height: 24px;
  }

  .user-list ul li:first-child .user-right-menu {
    top: auto;
    bottom: -45px;
  }

  .user-right-menu ul {
    margin-top: 8px;
  }

  .user-right-menu li {
    width: 33.3%;
    text-align: center;
    float: left;
    padding: 0;
    margin: 0;
    cursor: pointer;
    border-right: 1px solid #ddd;
  }

  .user-right-menu li span:hover {
    color: #009efc;
  }

  .chat-wrap-content-top ul {
    max-height: 48px;
    overflow: hidden;
  }

  .chat-top-history {
    display: none;
    margin-bottom: 5px;
    padding-top: 5px;
    border-top: 1px solid #333;
  }

  .chat-top-history:first-child {
    border-top: none;
    margin-bottom: 0;
  }

  .chat-top-fixed-btn {
    position: absolute;
    bottom: -7px;
    left: 50%;
    width: 40px;
    height: 7px;
    cursor: pointer;
    margin-left: -24px;
    color: #666;
    text-align: center;
    border-top: 1px solid #444;
    line-height: 13px;
  }

  .chat-wrap-content-top-fixed {
    height: auto;
  }

  .chat-wrap-content-top-fixed .chat-top-history:first-child {
    margin-bottom: 5px;
  }

  .chat-wrap-content-top-fixed ul {
    height: auto;
    overflow-y: auto;
    max-height: 300px;
  }

  .chat-wrap-content-top-fixed .chat-top-fixed-btn {
    border-bottom: 1px solid #444;
    border-top: none;
    bottom: -1px;
    height: 15px;
  }

  .chat-wrap-content-top-fixed .chat-top-fixed-btn .icon-double-angle-down:before {
    content: "\f102";
  }

  .chat-top-fixed-btn:hover {
    color: #7abdff;
    border-color: #7abdff;
  }

  .chat-message-300 .chat-message-context,
  .chat-message-400 .chat-message-context,
  .chat-message-500 .chat-message-context,
  .chat-message-1000 .chat-message-context {
    color: red;
    font-weight: bolder;
  }

  /* reward */

  .envelope-reward {
    text-indent: 0;
    height: 300px;
    color: #333;
    width: 300px;
    text-align: center;
    background: #fff;
    cursor: default;
    position: absolute;
    top: -300px;
    left: 0px;
    z-index: 99;
    font: 14px/1.4 "STHeiti", "Microsoft YaHei", "arial";
  }

  .reward-title {
    border-bottom: 1px #ddd solid;
    padding: 10px 0;
    color: #d9534f;
    font-size: 16px;
  }

  .reward-back {
    border-right: 1px solid #eee;
    display: block;
    padding: 0 10px;
    line-height: 35px;
    margin-top: -9px;
  }

  .reward-back:hover {
    background: #f3f3f3;
  }

  /* pay */

  .envelope-pay {
    text-indent: 0;
    height: 300px;
    color: #333;
    width: 300px;
    text-align: center;
    background: #fff;
    cursor: default;
    position: absolute;
    top: -300px;
    left: 0px;
    z-index: 99;
    font: 14px/1.4 "STHeiti", "Microsoft YaHei", "arial";
  }

  .pay-title {
    border-bottom: 1px #ddd solid;
    padding: 10px 0;
    color: #d9534f;
    font-size: 16px;
  }

  .pay-back {
    border-right: 1px solid #eee;
    display: block;
    padding: 0 10px;
    line-height: 35px;
    margin-top: -9px;
  }

  .pay-back:hover {
    background: #f3f3f3;
  }

  .chat-lucky-money .chat-message-context {
    width: 180px;
    font-size: 12px;
    color: #fff;
    background-color: #fa9d3b;
    cursor: pointer;
  }

  .chat-lucky-money .chat-message-context-text {
    overflow: hidden;
  }

  .chat-lucky-money-icon {
    width: 32px;
    height: 36px;
    background: url("/assets/img/lucky-money/rb01.png") center no-repeat;
    float: left;
  }

  .chat-lucky-money-name {
    margin-left: 40px;
  }

  .chat-lucky-money-tips {
    margin-top: 2px;
    margin-left: 40px;
  }

  .chat-lucky-money-body {
    padding: 5px 0 0;
  }

  .chat-lucky-money .chat-message-context-caret {
    border-color: #fa9d3b transparent transparent;
  }

  .chat-lucky-money-footer {
    color: #999;
    margin: 10px -10px -10px;
    background: #fff;
    padding: 3px 10px 0;
    font-size: 12px;
    border-radius: 0 0 2px 2px;
  }

  .ZebraDialog iframe {
    display: block;
  }

  .ZebraDialog .ZebraDialog_BodyOuter {
    background: transparent;
  }

  .user-top {
    top: auto;
    bottom: -45px;
  }

  .chat-message input[type="checkbox"].chat-checkbox {
    margin-top: 8px;
    margin-right: -16px;
    position: relative;
    left: -10px;
    /* top: 10px; */
    margin-top: 12px;
  }

  .chat-form-more {
    position: absolute;
    right: 0;
    height: 38px;
    font-size: 9px;
    width: 16px;
    background: #414967;
    top: 1px;
    border-radius: 2px 0 0 2px;
    overflow: hidden;
    color: #dde6ef;
  }

  .chat-form-more.expend {
    color: #999;
    left: 1px;
    width: 100%;
  }

  .chat-form-more .expend-btn {
    cursor: pointer;
    display: inline-block;
    height: 40px;
    line-height: 32px;
    border-right: 1px solid #31363c;
    padding: 0 8px 0 5px;
    z-index: 999999;
    color: #999;
  }

  .chat-form-more .expend-btn:hover {
    color: #fff;
  }

  .chat-form-more-mask {
    position: absolute;
    z-index: 99999;
    top: 0;
    right: 0;
  }

  .chat-form-more-warp {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 999999;
  }

  .chat-form-more-warp .btn {
    color: #ccc;
    border: 1px solid #777;
    margin-left: 5px;
    margin-top: 0px;
  }

  .chat-form-more-warp .btn:hover {
    color: #fff;
    border: 1px solid #ccc;
  }

  .chat-message-type-100 {
    /*    background: rgba(238, 238, 238, 0.25);*/
    border-top: 1px solid rgba(202, 219, 232, 0.25);
  }

  /*闂瓟*/

  .video-player-broadcast-wrap {
    background: #fff;
    background: rgba(255, 255, 255, 0.9);
  }

  .broadcast-question-message {
    background: rgba(51, 122, 183, 0.08);
    border-top: 1px solid rgb(202, 219, 232);
    border-bottom: 1px solid rgb(202, 219, 232);
    margin-top: -1px;
  }

  .video-player-broadcast-wrap .broadcast-message {
    border-top: 1px solid rgba(51, 122, 183, 0.1);
    padding: 8px 5px;
    margin: 0;
    margin-top: -1px;
  }

  .video-player-broadcast-wrap .chat-message-context {
    border: none;
    box-shadow: none;
    background-color: transparent;
    padding: 5px 25px 5px 0;
  }

  .video-player-broadcast-wrap .chat-message-avatar img {
    height: 48px;
    width: 48px;
    vertical-align: top;
    margin-top: -5px;
  }

  .video-player-broadcast-wrap .chat-message-content {
    margin-left: 55px;
  }

  .broadcast-message .chat-message-context-caret,
  .broadcast-question-message .chat-message-context-caret {
    display: none;
  }

  .dds-card {
    position: absolute;
    width: 276px;
    z-index: 150;
    top: 0;
    left: 0;
    background-color: rgba(128, 128, 128, 0.3);
    visibility: hidden;
    padding: 5px 5px;
  }

  .dds-card .card-inner {
    min-height: 100px;
    color: #fff;
    background-color: #221d20;
  }

  .dds-card .card-info {
    padding: 10px;
  }

  .dds-card .photo-con {
    float: left;
    width: 66px;
    margin-right: 10px;
  }

  .dds-card .photo {
    position: relative;
    width: 64px;
    height: 64px;
    overflow: hidden;
  }

  .dds-card .photo img {
    width: 64px;
    height: 64px;
  }

  .dds-card .user-info {
    width: 160px;
    line-height: normal;
    /* height: 60px; */
    font-size: 12px;
    float: left;
  }

  .dds-card .card-close {
    position: absolute;
    right: 8px;
    top: 2px;
    text-decoration: none;
    font-family: arial, sans-serif;
    font-size: 20px;
    color: #fff;
    cursor: pointer;
  }

  .dds-card .user-info p {
    margin-bottom: 3px;
  }

  .dds-card .user-opt {
    background: #2d292b;
    padding: 2px 10px;
    height: 22px;
  }

  .dds-card .card-arrow {
    position: absolute;
    overflow: hidden;
  }

  .dds-card .arrow-left {
    left: -10px;
    width: 0;
    height: 0;
    border-bottom: 10px solid transparent;
    border-top: 10px solid transparent;
    border-right: 8px solid #999;
    font-size: 0;
    line-height: 0;
  }

  .dds-card .arrow-right {
    right: -9px;
    width: 0;
    height: 0;
    border-bottom: 10px solid transparent;
    border-top: 10px solid transparent;
    border-left: 8px solid #999;
    font-size: 0;
    line-height: 0;
  }

  .dds-card .arrow-top {
    background-position: -341px -40px;
    width: 13px;
    height: 12px;
    top: -7px;
    left: 50%;
    margin-left: -7px;
  }

  .dds-card .arrow-bottom {
    background-position: -361px -40px;
    width: 13px;
    height: 12px;
    bottom: -7px;
    left: 50%;
    margin-left: -7px;
  }

  .user-gag-btn,
  .user-kick-btn,
  .user-ip-btn,
  .user-lookvideo-btn {
    float: right;
    margin: 0 5px;
    cursor: pointer;
    font-size: 14px;
    color: #c5d1ec;
  }

  .question-icon {
    display: inline-block;
    width: 14px;
    height: 14px;
    background: url(/assets/img/ask.png) no-repeat;
    margin-left: 5px;
    vertical-align: middle;
  }

  .chat-me .question-icon {
    background: url(/assets/img/answer.png) no-repeat;
    margin-left: 0px;
    margin-right: 5px;
  }

  .lm-got-bg {
    background: url(/assets/img/luckmoney/send-bg.png) no-repeat;
    width: 250px;
    height: 84px;
    display: inline-block;
    vertical-align: -52px;
    margin-top: 8px;
  }

  .lm-got-bg .btn-got {
    background: url(/assets/img/luckmoney/got.png) no-repeat;
    width: 98px;
    height: 23px;
    display: inline-block;
    cursor: pointer;
  }

  .lm-gotsuc {
    background: url(/assets/img/luckmoney/gotsuc.png) no-repeat;
    width: 359px;
    height: 261px;
    display: inherit;
  }

  .lm-gotsuc .btn-ok {
    width: 103px;
    height: 34px;
    border: none;
    border-radius: 5px;
    position: absolute;
    left: 127px;
    bottom: 18px;
    background-image: url("/assets/img/luckmoney/ok.png");
  }

  .lm-phone-check {
    width: 360px;
    height: 314px;
    display: inherit;
    padding-left: 40px;
    padding-right: 40px;
    background: url(/assets/img/luckmoney/phone-bg.png) no-repeat;
  }

  .lm-phone-check .lm-btn-suc {
    width: 237px;
    height: 50px;
    border: none;
    position: absolute;
    left: 60px;
    bottom: 58px;
    background-image: url("/assets/img/luckmoney/ljqkb.png");
  }

  .chat-float-model {
    position: absolute;
    right: 5px;
    top: 30px;
    z-index: 3;
  }

  .chat-float-model .chat-float-model-item {
    cursor: pointer;
    min-width: 65px;
    text-align: center;
    margin-top: 10px;
  }

  .chat-float-model .chat-float-model-item:hover {
    color: red;
  }

  .chat-font-bold-chose {
    display: inline-block;
    padding-left: 3px;
    padding-right: 3px;
    vertical-align: 11px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    line-height: 18px;
    border: 1px solid #ccc;
  }

  .chat-font-bold-chose.chose {
    background-color: #ccc;
    border: 1px solid #aaa;
    color: #333;
  }

  .chat-danmu-chose {
    line-height: 18px;
    display: inline-block;
    padding-left: 3px;
    padding-right: 3px;
    font-size: 14px;
    vertical-align: 11px;
    cursor: pointer;
    border: 1px solid #ccc;
  }

  .chat-danmu-chose.chose {
    background-color: #ccc;
    border: 1px solid #aaa;
    color: #333;
  }

  body {
    font: 14px/1.4 "STHeiti", "Microsoft YaHei", "锟斤拷锟斤拷", "arial";
    background: #fff;
    overflow: hidden;
  }

  .ly-left {
    width: 150px;
    background: #cfe1f7;
    position: fixed;
    left: 0;
    bottom: 0;
    top: 0;
  }

  .ly-right {
    background: #fff;
    position: fixed;
    left: 150px;
    right: 0px;
    bottom: 0;
    top: 0;
  }

  .ly-header,
  .ly-body,
  .ly-footer,
  .ly-sider {
    position: absolute;
  }

  .ly-header {
    border-bottom: 1px solid #eee;
    top: 0;
    height: 60px;
    left: 0;
    right: 0;
  }

  .ly-body {
    top: 60px;
    bottom: 100px;
    left: 0;
    right: 0;
  }

  .ly-sider {
    top: 60px;
    bottom: 0;
    width: 150px;
    right: 0;
    border-left: 1px solid #eee;
    background-color: #f2f2f2;
  }

  .ly-footer {
    border-top: 1px solid #eee;
    bottom: 0;
    height: 100px;
    left: 0;
    right: 0;
  }

  ul.user-list-pri>li.user-item {
    padding: 5px;
    margin: 5px;
    overflow: hidden;
    cursor: default;
    position: relative;
    cursor: pointer;
  }

  .user-list-pri .user-item {
    position: relative;
    cursor: pointer;
  }

  ul.user-list-pri>li.user-item:hover {
    background: #ecf3fd;
    border-radius: 8px;
  }

  ul.user-list-pri>li.user-item.active {
    background: #ecf3fd;
    border-radius: 8px;
  }

  ul.user-list-pri>li.user-item .user-pic {
    height: 32px;
    width: 32px;
  }

  ul.user-list-pri>li.user-item .user-delete {
    position: absolute;
    top: 12px;
    right: 10px;
    display: none;
    font-family: arial, sans-serif;
    color: #fff;
    background: #333;
    border-radius: 50%;
  }

  ul.user-list-pri>li.user-item .user-delete:hover {
    background: #111;
    cursor: pointer;
  }

  ul.user-list-pri>li.user-item:hover .user-delete {
    display: block;
  }

  ul.user-list-pri>li.user-item a {
    text-decoration: none;
    display: block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
  }

  ul.user-list-pri>li.user-item.active .user-delete {
    display: none;
  }

  .chat-form {
    position: relative;
    background: #fff;
  }

  .ly-header .current-user-info {
    padding: 5px 15px;
  }

  .ly-header .current-user-info .name {
    font-size: 18px;
  }

  .ly-header .current-user-info .description {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
  }

  .ly-sider .to-user-info {
    text-align: center;
  }

  .ly-sider .to-user-info .user-pic {
    display: block;
    width: 100px;
    height: 100px;
    margin: 25px auto 5px;
  }

  .ly-sider .to-user-info .description {
    padding: 0 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
  }

  .ly-body .tab-pane {
    padding: 15px 5px;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    overflow: hidden;
  }

  .private-chat-form {
    height: 80px;
  }

  .private-chat-form-input {
    width: 100%;
    border: none;
    height: 60px;
    display: block;
    resize: none;
    padding: 5px;
    overflow: hidden;
    outline: none;
  }

  .private-chat-form .private-chat-form-btn {
    color: #fff;
    padding-top: 5px;
    padding-bottom: 5px;
    position: absolute;
    top: 20px;
    right: 5px;
  }

  .private-chat-form-btn:hover {
    color: #fff;
  }

  .private-chat-form-exFun {
    padding: 0 5px;
    height: 30px;
    line-height: 30px;
  }

  .private-chat-form-exFun-item:hover {
    background-color: #eee;
  }

  .private-icon-smile {
    background-image: url("/assets/img/smile_min.png") !important;
  }

  .private-icon-pic,
  #js-chat-picture-btn-pri.uploadify .uploadify-button {
    background-position: center;
    background-repeat: no-repeat;
    background-image: url("/assets/img/pic_min.png") !important;
  }

  #js-chat-picture-btn-pri.uploadify:hover .uploadify-button {
    background-color: #eee;
  }

  .status-message {
    position: absolute;
    left: 6px;
    top: 6px;
    width: 6px;
    height: 6px;
    background-color: red;
    border-radius: 50%;
    display: none;
  }

  .status-message.active {
    display: block;
  }

  .menu-contain {
    position: relative;
    width: 640px;
    height: 607px;
  }

  .ly-left,
  .ly-right {
    position: absolute !important;
  }
</style>
<script>
  import * as types from "@/store/types";
  import Vuex from "vuex";

  import { mapState } from "vuex";
  export default {
    data() {
      return {
        textMsgPri: "",
        priChatList: [], //私聊历史记录
        priChatUserList: [] // 具体格式为 [{uid:xxx, name: 'xxx', pic: 'xxxx', priList:[] }]
      };
    },
    mounted() {
      var self = this;
      $("#js-chat-faces-btn-pri").wait(function () {
        $.fn.sinaEmotion.options = {
          rows: 42, // 每页显示的表情数
          language: "cnname", // 简体（cnname）、繁体（twname）
          appKey: "1362404091" // 新浪微博开放平台的应用ID
        };

        $("#js-chat-faces-btn-pri").on("click", function (e) {
          $.fn.sinaEmotion.options.inputCallBack = function (msg) {
            self.textMsgPri = msg;
          };

          $("#js-chat-form-input_pri").sinaEmotion("#js-chat-form-input_pri");
          e.stopPropagation();
        });
      });
    },
    computed: {
      curPriChatList() {
        if (this.priChatUserList.length == 0) {
          return [];
        }
        var uid = this.roomInfo.selPriChatMsgItem.toUid || 0;
        let idx = this.priChatUserList.findIndex(i => i.uid && i.uid == uid);
        idx = idx >= 0 ? idx : 0;

        var tmp = this.priChatUserList[idx].priList || [];
        tmp.sort((a, b) => (a.id > b.id ? 1 : -1));
        console.log('curPriChatList', tmp);
        return tmp;
      }
    },
    created() {
      var self = this;
      $("#js-chat-picture-btn-pri").wait(function () {
        self.uploadImg();
      });

      //当前用户列表
      this.$watch("roomInfo.priChatToList", (newVal, oldVal) => {
        this.roomInfo.priChatToList.map(user => {
          let idx = this.priChatUserList.findIndex(u => u.uid == user.uid);
          if (idx < 0) {
            let tmp = {
              name: user.name,
              pic: user.pic,
              uid: user.uid,
              islook: user.islook && user.uid == this.roomInfo.selPriChatMsgItem.toUid ? true : false, //user.islook,
              priList: []
            };
            this.priChatUserList.push(tmp);
            idx = this.priChatUserList.length - 1; //当前用户的索引
            this.getHistoryChatList(idx, {
              name: user.name,
              pic: user.pic,
              uid: user.uid
            });
          }
        });
      });
      //消息列表
      this.$watch("roomInfo.priChatList", (newVal, oldVal) => {
        this.roomInfo.priChatList.map(msg => {
          let idx = this.priChatUserList.findIndex(u => u.uid == msg.uid);
          if (idx < 0) {
            let tmp = {
              name: msg.name,
              pic: msg.pic,
              uid: msg.uid,
              islook: user.islook && user.uid == this.roomInfo.selPriChatMsgItem.toUid ? true : false,
              priList: []
            };
            this.priChatUserList.push(tmp);
            idx = this.priChatUserList.length - 1; //当前用户的索引
            this.getHistoryChatList(idx, msg);
          }
          this.addPriMsg(idx, msg, 2);
        });
      });
    },

    methods: {
      addPriMsg(idx, msg, msgtype) {
        this.priChatUserList[idx].priList =
          this.priChatUserList[idx].priList || [];

        var jdx = this.priChatUserList[idx].priList.findIndex(
          j => j.id == msg.id
        );
        if (jdx < 0) {
          this.priChatUserList[idx].priList.push(msg);
        }
        this.afterAppend();
      },
      getHistoryChatList(idx, msg) {
        //historyPriChat($room_id, $toUid)
        dms.LiveApi.historyPriChat({ toUid: msg.uid }, resp => {
          /* db    'id',   'room_id', 'snd_uid', 'rcv_uid', 'message',  'created_at'  */
          // api   {"id":2505,"room_id":1015,"snd_uid":5760,"rcv_uid":5762,"message":"567567","created_at":"2018-05-27 20:21:57","updated_at":"2018-05-27 20:21:57","time":"20:21"}
          // state {"uid":5760,"name":"t_003","pic":"/assets/img/avatar/t3/32/28.png","message":"567567","cmd":"prichat","time":"20:21","id":2505,"curuid":"5762","curname":"t_005","msgtype":"rec_pri_msg", "islook":true}

          resp.list = resp.list || [];
          resp.list.map(m => {
            let base_msg = {
              id: m.id,
              message: m.message,
              room_id: m.room_id,
              time: m.time,
              islook: false,
              curuid: this.userInfo.uid,
              curname: this.userInfo.name,
              cmd: "prichat"
            };
            let tmp_msg =
              m.snd_uid == msg.uid ?
              {
                //当前用户接收到的消息
                ...base_msg,
                uid: msg.uid,
                name: msg.name,
                pic: msg.pic,
                msgtype: "rec_pri_msg"
              } :
              {
                //当前用户发送的消息
                ...base_msg,
                uid: this.userInfo.uid,
                name: this.userInfo.name,
                pic: this.userInfo.pic,
                msgtype: "chat_me"
              };
            this.addPriMsg(idx, tmp_msg, 1);
          });
        });
      },
      sendMsg() {
        var message = this.textMsgPri;
        message = $.trim(message);
        this.textMsgPri = "";

        if (message.length == 0) {
          return;
        }
        this.$store.dispatch(types.DO_PRI_MSG_SEND, {
          message: message
        });
      },
      closePriUser(uid) {
        var idx = this.priChatUserList.findIndex(i => i.uid && i.uid == uid);
        if (idx >= 0) {
          this.priChatUserList.splice(idx, 1);
        }
        //如果不是当前用户
        if (this.curPriChatList.length <= 0) { //关闭弹出层
          this.$layer.close(this.roomInfo.curlayer_pop_id);
        }
      },
      chanPriUser(item) {
        var _tempArr = this.roomInfo.priChatToList.slice();
        var jdx = _tempArr.findIndex(j => j.uid == item.uid);
        if (jdx != 0) {
          _tempArr[jdx].islook = true; //已经查看
        }
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          priChatToList: _tempArr,
          selPriChatMsgItem: {
            toUid: item.uid,
            toPic: item.pic,
            toName: item.name
          }
        });
        this.afterAppend();
      },
      afterAppend() {
        var box = ".tab-content .tab-pane";
        setTimeout(function () {
          $(box).scrollTop($(box)[0].scrollHeight + 9999);
        }, 200);
      },

      uploadImg() {
        var self = this;
        $("#js-chat-picture-btn-pri").uploadify({
          height: 30,
          width: 30,
          buttonText: "&nbsp;",
          swf: "/assets/js/uploadify-2.2/uploadify.swf",
          uploader: "/ajaxUpload?dir=chatpic",
          fileTypeDesc: "Image Files",
          fileSizeLimit: "1024K",
          fileTypeExts: "*.gif; *.jpg; *.png",
          onUploadSuccess: function (file, data, response) {
            data = $.parseJSON(data);
            var text = "[" + data.img + "]";
            self.textMsgPri = text;
            self.addToChatInput(text);
          }
        });
      },
      addToChatInput(text) {
        var _input = $("#js-chat-form-input_pri")[0];
        if (document.selection) {
          _input.focus();
          var cr = document.selection.createRange();
          cr.text = text;
          cr.collapse();
          cr.select();
        } else if (_input.selectionStart !== undefined) {
          var start = _input.selectionStart;
          var end = _input.selectionEnd;
          _input.value =
            _input.value.substring(0, start) +
            text +
            _input.value.substring(end, _input.value.length);
          _input.selectionStart = _input.selectionEnd = start + text.length;
        } else {
          _input.value += text;
        }
      },

      closeLayer() {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          //priChatToList: _tempArr, //左侧结构
          is_show_pri_box: false,
          // selPriChatMsgItem: {
          //   toUid: 0,
          //   toName: "",
          //   toPic: "",
          //   from: "prichat"
          // },
        });
      }
    }
  };
</script>