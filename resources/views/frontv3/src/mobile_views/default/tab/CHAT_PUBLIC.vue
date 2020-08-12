<template>
  <div class="tabpublic-warp" v-if="tab.tag == roomInfo.active_menu">
    <div v-if="baseConfig.popcfg.mobile_banner_cfg.length>0" class="slider" :style="{'height':$t('56##首页banner高度',__FILE__)+'px'}">
      <ul id="Ul_dscontent" class="dscontent">
        <li v-for="(item,index) in baseConfig.popcfg.mobile_banner_cfg" :key="index" style="width: 100%;" v-show="curpicInd == index">
          <img :src="item" class="swiper-lazy" style="width: 100%;" />
        </li>
      </ul>
      <div class="banner-num">
        <ul id="Ul_Pop" style="margin-bottom:0px;margin-left: -50%">
          <li v-for="(item,index) in baseConfig.popcfg.mobile_banner_cfg" :key="index" @click="picNumClick(index)" :class="{'on':curpicInd == index}"></li>
        </ul>
      </div>
    </div>

    <div class="pane" style="">
      <div class="chat-notice-box" :style="{background:$c('#1e1e1e##公告的背景颜色', __FILE__),color:$c('#ff0000##滚动公告的字体颜色', __FILE__),'height':$t('37##滚动公告的高度',__FILE__)+'px'}">
        <span class="chat-notice-name">公告:</span>
        <div class="notice_wrap">
          <marquee scrollamount="2">
            <span id="js_notice_msg" v-html="notice_msg_html">
            </span>
          </marquee>
        </div>
        <div class="user-past" v-if="baseConfig.blockcfg.show_past" @click.stop="userPast">签到</div>
      </div>

      <div class="dms-message-container " id="dmsMessage" :style="{'background-color':$c('#252525##聊天框的背景颜色', __FILE__)}">
        <chat-msg-box :msgList="roomInfo.chatList" :curType=" 'pubChat' "></chat-msg-box>
      </div>
      <chat-bar></chat-bar>
      <pub-right-func></pub-right-func>

      <div v-if="userInfo.role.f_got_luck_money && roomInfo.packArr.length" class="got-luck-money-wrap" @click.stop="getPacket('popicon')">
        <div class="got-luck-money-con">
          <img id="gotPacket" src="/assets/img/hbicon.gif">
          <br>
          <span :style="{color:$c('#fff##右侧浮动字体颜色', __FILE__)}">
            当前红包：
            <font class="ft-sty">{{roomInfo.packArr.length}}</font>个
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .tabpublic-warp {
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .user-past {
    color: #fff;
    background: #75b83f;
    width: 100px;
    text-align: center;
    border-radius: 8px;
    margin-right: 20px;
    height: 60px;
    line-height: 60px;
    margin-top: 4px;
    font-size: 28px;
  }

  .pane {
    overflow-y: auto;
    position: relative;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .chat-notice-box {
    height: 74px;
    line-height: 74px;
    color: #ff0000;
    font-size: 28px;
    padding: 2px 10px;
    position: relative;
    z-index: 9;
    width: 100%;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    flex-direction: row;
  }

  .chat-notice-name {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
  }

  .notice_wrap {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
    overflow-y: hidden;
  }

  .pan {
    background-color: #252525;
  }

  .dms-message-container {
    background-color: #252525;
    width: 100%;
    /* overflow-y: scroll; */
    overflow-x: hidden;
    display: flex;
    flex: 1;
    flex-direction: column;
  }

  #js_notice_msg {
    word-break: keep-all;
  }

  /* 隐藏滚动条 */

  /*webkit内核*/

  .dms-message-container::-webkit-scrollbar {
    width: 0px;
    height: 0px;
  }

  .dms-message-container::-webkit-scrollbar-button {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-webkit-scrollbar-track {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-webkit-scrollbar-track-piece {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-webkit-scrollbar-corner {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-webkit-scrollbar-resizer {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-webkit-scrollbar {
    width: 10px;
    height: 10px;
  }

  /*o内核*/

  .dms-message-container .-o-scrollbar {
    -moz-appearance: none !important;
    background: rgba(0, 255, 0, 0) !important;
  }

  .dms-message-container::-o-scrollbar-button {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-o-scrollbar-track {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-o-scrollbar-track-piece {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-o-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-o-scrollbar-corner {
    background-color: rgba(0, 0, 0, 0);
  }

  .dms-message-container::-o-scrollbar-resizer {
    background-color: rgba(0, 0, 0, 0);
  }

  /*IE10,IE11,IE12*/

  .dms-message-container {
    -ms-scroll-chaining: chained;
    -ms-overflow-style: none;
    -ms-content-zooming: zoom;
    -ms-scroll-rails: none;
    -ms-content-zoom-limit-min: 100%;
    -ms-content-zoom-limit-max: 500%;
    -ms-scroll-snap-type: proximity;
    -ms-scroll-snap-points-x: snapList(100%, 200%, 300%, 400%, 500%);
    -ms-overflow-style: none;
    overflow: auto;
  }

  .got-luck-money-wrap {
    position: absolute;
    right: 120px;
    bottom: 120px;
    cursor: pointer;
    text-align: center;
  }

  .got-luck-money-con img {
    width: 92px;
  }

  .ft-sty {
    color: yellow;
  }

  .slider {
    width: 100%;
    display: flex;
  }

  .slider img {
    width: 100%;
    height: 112px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import ChatMsgBox from "@/mobile_views/_/chat/ChatMsgBox";
  import ChatBar from "@/mobile_views/_/chatbar/ChatBar";

  import PubRightFunc from "@/mobile_views/_/pop/PubRightFunc";
  import gotpackMixinMobile from "@/mixins/gotpackMixinMobile";
  export default {
    props: {
      tab: Object
    },
    mixins: [gotpackMixinMobile],
    data() {
      return {
        userId: 0,
        curpicInd: 0,
      };
    },
    computed: {
      notice_msg_html() {
        return this.fixEmoji(this.baseConfig.noticecfg.notice_msg);
      }
    },
    mounted() {
      var self = this;
      $("#Ul_dscontent").wait(function () {
        var max = self.baseConfig.popcfg.mobile_banner_cfg.length;
        var bannerInterval = setInterval(function () {
          self.curpicInd++;
          if (self.curpicInd == max) self.curpicInd = 0;
        }, 6000);
      });
    },
    methods: {
      picNumClick(ind) {
        this.curpicInd = ind;
      },
      lookUser(id) {
        this.userId = id;
      },
      userPast() {
        //签到的弹出消息框
        dms.LiveApi.sendPast({}, resp => {}, resp => {
          this.$layer.msg(resp.msg, { time: 1 });
          if (resp.code == 401) {
            //跳转登录页面
            setTimeout(() => {
              window.location.hash = "/login";
            }, 3000)
          }
        })
        return;
      }
    },
    components: {
      ChatMsgBox,
      ChatBar,
      PubRightFunc,
    }
  };
</script>