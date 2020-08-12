<template>
  <div class="main-center bor-left  ">
    <chat-top-nav class="chat-border-top1" v-if="!parseInt(baseConfig.msgcfg.is_show_chat_top)" :tabRanks="tabRanks" :btnColor="btnColor"></chat-top-nav>
    <div class="msg-block-con chat-border-top1">
      <div class="chat-wrap-content-top chat-top-history" :style="{'height':$t('32##聊天区头部导航高度', __FILE__)+'px','background-color':$c('rgba(0,0,0,0.5)##聊天区头部导航颜色值透明度',__FILE__),'line-height':$t('32##聊天区头部导航高度', __FILE__)+'px'}">
        <div class="notice-le">
          <i class="icon-bullhorn text-danger" :style="{'line-height':$t('32##聊天区头部导航高度', __FILE__)+'px'}"></i>
          <span class="chat-notice-name">公告：</span>
        </div>

        <div class="notice_wrap notice-ri" :style="{'color':$c('red##公告的字体颜色',__FILE__)}">
          <span id="js_notice_msg" style="">
            <marquee :scrollamount="$t('3##公告滚动速度', __FILE__)">
              <span v-html="notice_msg_html"></span>
            </marquee>
          </span>

          <!-- 聊天头部隐藏后 -->
          <template v-if="parseInt(baseConfig.msgcfg.is_show_chat_top)">
            <div class="chat-content-exFun notice_wrap_right">

              <div class="con-notice-rank-warp" :class="{'extern-css':!baseConfig.blockcfg.show_past}" v-if="baseConfig.hotcfg.show_rank" @click="showRank = !showRank" @mouseleave="showRank= false" @mouseenter="showRank=true">
                <span class="dropdown-toggle btn-rank" data-hover="dropdown" :style="btnColor">{{baseConfig.textcfg.rank_tit}}</span>
                <div class="dropdown-menu rankbox" style=" color: #fff;min-width: 50px;padding: 10px;background-color: #000;border: 1px solid #fff;border-radius: 3px;" v-show="showRank">
                  <template v-for="item in tabRanks">
                    <div :key="item.tag" class="tabranks-li" @click="popShow(item.tag)">
                      {{item.title}}
                    </div>
                  </template>
                </div>
              </div>

              <div style="display: inline-block;position: relative;" v-if="baseConfig.blockcfg.show_past" @click="userPast">
                <span id="idUserPast" class="btn-past" :style="btnColor">签到</span>
                <div id="idUserPastRed" class="past-pointer" v-show="!roomInfo.next_past_timeout"></div>
              </div>
            </div>
          </template>
        </div>
      </div>

      <!-- <message-box></message-box> -->
      <div class="chat-wrap-height " :style="{'background-color':$c('rgba(0,0,0,0.4)##聊天区颜色值透明度',__FILE__)}">
        <div class="chat-wrap-content nice-scroll-h" id="dmsMessage" :class="{'chat_top_msg':baseConfig.noticecfg.chat_top_msg}" style=" overflow-y: hidden; outline: none;" tabindex="6">
          <div class="chat-msg-warper">
            <chat-container :msgList="roomInfo.chatList"></chat-container>
          </div>
        </div>
        <div v-if="baseConfig.noticecfg.chat_top_msg.length" class="chat-notify-msg-common  dropup" :style="{'height':$t('33##聊天区管理员通知',__FILE__)+'px'}">
          <span style="cursor:pointer;color: rgb(249,219,77)" id="chat_tz_msg" class="dropdown-toggle" data-hover="dropdown" @click="isShowInput = !isShowInput">
            {{baseConfig.noticecfg.chat_top_msg}}
          </span>
          <div class="dropdown-menu " style="width:270px; display:block" v-if="userInfo.role.f_notify" v-show="isShowInput" @mouseenter.stop="isShowInput=true">
            <input id="idNotifyInput" class="form-control idNotifyInput" type="text" name="title" v-model="txtContent">
            <span id="idNotifyBtn" style="vertical-align: 0.5px;" class="btn btn-success " @click="sendNotify">确定</span>
          </div>
        </div>

        <div class="chat-float-model">
          <common-nav :navMenuArr="navMenuArr" :classname=" 'room-nav-chat'"></common-nav>
        </div>

        <div v-if="parseInt(baseConfig.msgcfg.is_show_chat_top) " v-show="isShowScreen" id="js-screen-group">
          <div id="chat-lock-screen-btn-new" @click="lockScreen" title="屏幕锁定开关" class="chat-content-exFun-div" :style="btnColor" :class="{'lock':roomInfo.screenLockStatus,'unlock':!roomInfo.screenLockStatus}"></div>
          <div id="chat-clean-screen-btn-new" @click="cleanScreen" title="清理屏幕" class="chat-content-exFun-div clearchat" :style="btnColor"></div>
        </div>

        <div v-if="userInfo.role.f_got_luck_money && roomInfo.packArr.length" class="got-luck-money-wrap" @click.stop="getPacket('popicon')">
          <img id="gotPacket" :src="$m('/assets/img/hbicon.gif##红包悬浮图片',__FILE__)">
          <br>
          <span>
            当前红包：
            <font style="color:yellow;">{{roomInfo.packArr.length}}</font>个
          </span>
        </div>
      </div>
    </div>

    <chat-bar-main></chat-bar-main>
  </div>
</template>

<style scoped>
  .main-center {
    z-index: 1;
    display: flex;
    flex-direction: column;
  }

  .msg-block-con {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .chat-wrap-height {
    position: relative;
    display: flex;
    flex: 1;
    flex-direction: column;
  }

  #dmsMessage {
    display: flex;
    flex: 1;
    flex-direction: column;
    padding-right: 65px;
    position: relative;
  }

  .chat-msg-warper {
    display: flex;
    flex: 1;
    width: 100%;
  }

  #js-screen-group {
    position: absolute;
    z-index: 11;
    right: 70px;
    top: 3px;
  }

  .got-luck-money-wrap {
    position: absolute;
    right: 2px;
    bottom: 10px;
    cursor: pointer;
    text-align: center;
  }

  .got-luck-money-con img {
    width: 62px;
  }

  .ft-sty {
    color: yellow;
  }

  .chat-float-model {
    width: 65px;
    position: absolute;
    right: 5px;
    top: 30px;
    z-index: 3;
  }

  .chat-float-model-item {
    position: relative;
  }

  /* .code-box {
    left: -214px;
    top: 0px;
    width: 200px;
    height: 200px;
    display: block;
  } */

  .i-cursor {
    cursor: pointer
  }

  .chat-notify-msg-common {
    color: red;
    white-space: nowrap;
    line-height: 30px;
    bottom: 0px;
    padding-left: 10px;
    font-size: 14px;
  }

  .idNotifyInput {
    width: 200px;
    display: inline;
    margin-left: 5px;
  }

  .past-pointer {
    right: 7px;
    top: 0px;
  }

  .notice_wrap_right {
    display: flex;
    font-size: 14px;
    top: 7px;
    font-size: 14px;
  }

  .notice_wrap {
    display: flex;
    flex: 1;
  }

  .notice-le {
    width: 52px;
    display: flex;
  }

  .notice-ri {
    display: inline-block;
    float: left;
  }

  .chat-top-history {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex-direction: row;
  }

  .rankbox {
    color: #fff;
    padding: 10px;
    background-color: #000;
    border: 1px solid #fff;
    border-radius: 3px;
    display: block;
    min-width: 98px;
    top: 22px !important;
  }

  .tabranks-li {
    cursor: pointer;
    margin-bottom: 8px;
    height: 20px;
    line-height: 20px;
  }

  .con-notice-rank-warp {
    display: inline-block;
  }

  .extern-css {
    width: 92px;
    float: right;
    text-align: right;
  }

  .chat-notice-name {
    margin-left: 2px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import ChatTopNav from '@/pc_views/_/chatblock/ChatTopNav'
  import ChatBarMain from '@/pc_views/_/chatblock/ChatBarMain'
  import CommonNav from "@/pc_views/_/util/CommonNav";
  import ChatMsgBox from "@/pc_views/_/chat/ChatMsgBox"
  import ChatMsgBox2 from "@/pc_views/_/chatmsg/ChatMsgBox"
  import gotpackMixinPc from "@/mixins/gotpackMixinPc";
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import signinMixinPc from "@/mixins/signinMixinPc"

  var _tmp = $t("1##是否使用新版的聊天消息格式", __FILE__)
  const ChatContainer = parseInt(_tmp) ? ChatMsgBox2 : ChatMsgBox;
  var screenTimer = null;

  export default {
    mixins: [gotpackMixinPc, layercommMixinPc, signinMixinPc],
    data() {
      return {
        isShowScreen: false,
        navMenuArr: [],
        isShowInput: false,
        txtContent: '',
        showRank: false,
        tabRanks: [],
      }
    },
    computed: {
      ...Vuex.mapGetters([types.innerMenus]),
      notice_msg_html() {
        return this.fixEmoji(this.baseConfig.noticecfg.notice_msg);
      },
      btnColor() {
        return {
          'background-color': $c('#000##房间头部按钮背景颜色', __FILE__),
          'border-color': $c('#7a7a7a##房间头部按钮背景颜色', __FILE__),
        }
      }
    },
    mounted() {
      this.tabRanks = [{
        tag: 'RANK_JF',
        title: this.baseConfig.textcfg.rank_jf,
      }, {
        tag: 'RANK_GIFTSEND',
        title: this.baseConfig.textcfg.rank_giftsend,
      }, {
        tag: 'RANK_GIFTGOT',
        title: this.baseConfig.textcfg.rank_giftgot,
      }];
      this.getRoomNavs();
      var self = this
      $('.chat-wrap-height').wait(function () {
        $('.chat-wrap-height').mouseenter(function (event) {
          self.isShowScreen = true;
          if (screenTimer) {
            clearTimeout(screenTimer);
            screenTimer = null;
          }
        });
        $('.chat-wrap-height').mouseleave(function (event) {
          screenTimer = setTimeout(function () {
            self.isShowScreen = false;
          }, 500);
        });
      })
    },
    methods: {
      lockScreen() {
        var _screenLockStatus = this.roomInfo.screenLockStatus == 0 ? 1 : 0
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          screenLockStatus: _screenLockStatus
        });
      },
      cleanScreen() {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          chatList: []
        });
      },
      getRoomNavs() {
        var _otherNav = [];
        _otherNav.push({
          key: 'TREASURE',
          tag: 'TREASURE',
          text: $t('宝箱##宝箱文本', __FILE__),
          icon: '',
          //icon: this.roomInfo.treasureInfo.treasurnStatus == 1 ? this.$m('/assets/v3/images/phone/open_treasure.png##宝箱打开图标', __FILE__) : this.$m('/assets/v3/images/phone/treasure.png##宝箱关闭图标', __FILE__),
          id: '',
          type: 0,
          pos: 2,
          popType: '1',
        })

        if (this.baseConfig.blockcfg.show_phonewem) {
          _otherNav.push({
            key: 'PHONELIVE',
            tag: 'PHONELIVE',
            text: $t('手机直播##手机直播文本', __FILE__),
            icon: $m('/assets/img/ui_icon/phone-icon.png##手机直播图标', __FILE__),
            id: '',
            type: 0,
            pos: 2,
            popType: 1,
          })
        }
        if (this.userInfo.role.f_luck_max_money) {
          _otherNav.push({
            tag: 'SENDPACKET',
            key: 'SENDPACKET',
            id: '',
            text: $t('发红包##发红包图标', __FILE__),
            icon: $m('/assets/img/ui_icon/phone-icon.png##发红包图标', __FILE__),
            type: 0,
            pos: 2, //聊天区
            popType: 2,
          })
        }
        var _tmpArr = this.innerMenus.filter(i => i.pos == 2);
        _tmpArr = _tmpArr.concat(_otherNav);
        this.navMenuArr = _tmpArr.reverse();
      },
      sendNotify() {
        this.isShowInput = false;
        if (!this.txtContent.length) {
          return;
        }
        dms.LiveApi.setDynamic({ dynamic_msg: this.txtContent }, resp => {}, resp => {})
      },
    },
    components: {
      ChatTopNav,
      ChatBarMain,
      ChatContainer: ChatContainer,
      CommonNav,
    }
  }
</script>