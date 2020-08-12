<template>
  <div>
    <div class="chat-form-exFun" style="position:relative; " :style="{'background-color': isNewMode ? chatBarSty.bgcolor : (showTurnMsg ? chatBarSty.bgcolor : '' ) }">
      <span id="js-chat-faces-btn-box">
        <span id="js-chat-faces-btn" class="face chat-form-exFun-item icon-smile" @mouseenter="smailMouse(chatBarSty.face_smile_hover)" @mouseleave="smailMouse(chatBarSty.face_smile)" :style="{'background-image': 'url('+ icon_smail+')!important'}"></span>
      </span>
      <span v-if="userInfo.role.f_img" id="js-chat-picture-btn" class="chat-form-exFun-item icon-pic" :style="{'background-image': 'url('+ icon_upload+')'}"></span>

      <span v-if="baseConfig.eventcfg.gift_opend" @click="giftShow = !giftShow" id="js-gift-btn" class="chat-form-exFun-item icon-gift " @mouseenter="giftMouse(chatBarSty.icon_gift_hover)" @mouseleave="giftMouse(chatBarSty.icon_gift)" :style="{'background-image': 'url('+ icon_gift+')!important'}">
        <div v-show="giftShow" class="MR-gift" id="js-gift-panel">
          <chat-gift></chat-gift>
        </div>
      </span>

      <span id="js-yj-btn" class="chat-form-exFun-item icon_yj" @click.stop="yjStart" v-if="baseConfig.eventcfg.lottery_opend && userInfo.logined">
        <img :src="chatBarSty.yj_icon" alt="摇奖图标">
      </span>

      <template v-if="userInfo.role.f_font_size">
        <div @click="showColor = !showColor" id="js-chat-color-btn " class="js-chat-color-btn dropup" data-color="#333" @mouseenter="showColor =true" @mouseleave="showColor =false">
          <div class="in " data-toggle="dropdown" :style="{'background-color': baseConfig.theme.msg_color? baseConfig.theme.msg_color :'#333'}"></div>
          <ul class="dropdown-menu" style="min-width: 148px; display:block" v-show="showColor">
            <li>
              <div id="colorpalette1"></div>
            </li>
          </ul>
        </div>
        <!-- 字体大小 -->
        <span id="js-chat-font-btn" class="bar-com">
          <select id="js-font-size-list" v-model="fontSelect">
            <template v-for="item in dataFont">
              <option :key="item" :value="item" :selected="item == fontSelect">{{item}}</option>
            </template>
          </select>
        </span>
        <span class="js-font-bold-btn bar-com">
          <div class="chat-font-bold-chose f-nochose" :style="{'border-top':'1px solid #ccc','background-color':baseConfig.theme.msg_bold?chatBarSty.btn_sel:'','color':baseConfig.theme.msg_bold?'#fff':'#000'}" @click="fontConfig">B</div>
        </span>

      </template>
      <span v-if="userInfo.role.f_danmu" class="js-font-bold-btn bar-com">
        <div class="chat-danmu-chose f-nochose" :style="{'background-color':roomInfo.danmu_is_open?chatBarSty.btn_sel:'','color':roomInfo.danmu_is_open?'#fff':'#000'}" @click="danmuChange">弹</div>
      </span>

      <!-- 选择的讲师 -->
      <template v-if="userInfo.role.f_tochat">
        <template v-if="baseConfig.msgcfg.mgr_to_chat">
          <span class="js-chat-mgr-lists bar-com">
            <select id="js-chat-mgr-list" v-model="chatToSelectID">
              <option value="0" selected>无</option>

              <template v-if="baseConfig.channelInfo.living && parseInt(roomInfo.teacher.tid)">
                <option class="cur-teacher" :value="roomInfo.teacher.tid">{{roomInfo.teacher.name}}</option>
              </template>
            </select>
          </span>
        </template>

        <!-- 对谁说 -->
        <div class="to-chat-warp bar-com">
          <span>对</span>
          <div style="position:relative;display: inline-block;z-index:99">
            <span id="js-chat-to-user" data-uid="" class="to-chat-content">{{roomInfo.selChatMsgItem.toUid ? roomInfo.selChatMsgItem.toName: '大家'}}</span>
            <i class="myclose" @click="closeToChat" style="cursor:pointer;" v-show="roomInfo.selChatMsgItem.toUid"></i>
          </div>
          <span>说</span>
        </div>
      </template>

      <!-- 消息转播 -->
      <template v-if="userInfo.role.f_robot_send">
        <div id="js-chat-form-more " class="chat-form-more " :class="{'expend':showTurnMsg}" :style="{'z-index':100,'background-color':showTurnMsg ? chatBarSty.bgcolor:'' }">
          <span id="rightmore" class="rightmore" @click.stop="showTurnMsg = true" :style="{'background-image':'url('+chatBarSty.rightmore+')'}"></span>
          <span id="js-expend-btn" class="expend-btn" @click.stop="showTurnMsg = false" style="vertical-align: 2px;" :style="{'background-image':showTurnMsg ? 'url('+chatBarSty.expend_btn+')' : '','border-right-color':chatBarSty.btn_sel}">
          </span>

          <div class=" chat-robot-warp">
            <select id="js-robot-num" v-model="selectedNum" style=" border: 1px solid #c4c4c4;color: #333; width: 40px;font-size: 12px;">
              <option :value="0" selected>无</option>
              <option v-for="item in RobotNum" :key="item" :value="item" :selected="selectedNum == item">{{item == 0 ? '无':item}}</option>
            </select>
            <select id="js-robot-list" v-model="robotSelectID" style=" border: 1px solid #c4c4c4;color: #333; width: 60px;font-size: 12px;">
              <option value="0" selected>机器人</option>
              <option v-for="item in roomInfo.robotsInfo.myrobotList" :key="item.uid" :value="item.uid">{{ item.name}} </option>
            </select>
            <select id="js-robot-sendtime" style=" border: 1px solid #c4c4c4;color: #333; width: 50px;font-size: 12px;" v-model="selectedTime">
              <option value="0">时间</option>
              <template v-for="item in delayRobotTimeArr">
                <option :value="item" :key="item">
                  {{item}}秒
                </option>
              </template>
            </select>

          </div>
          <span v-if="userInfo.role.f_robot_send_msg" class="btn btn-default auto-btn-chatbar" :class="{'auto-btn-checked':roomInfo.autoRobotEnable}" style="vertical-align: 2px;" id="js-chat-form-auto-say" @click="robotAutoSend">自动发言</span>
        </div>
      </template>
    </div>

    <div class="chat-bot" :style="{'height':$t('80##聊天区输入框的高度',__FILE__)+'px'}">
      <div class="chat-form-input-wrap">
        <textarea class="chat-form-input nice-scroll" id="js-chat-form-input" v-model="txtInput" @keyup.enter="sendMsg"></textarea>
      </div>

      <button type="button" class="chat-form-btn send-btn" :class="{'waiting':roomInfo.wait_Send_Time}" @click="sendMsg" :style="{'background-color':chatBarSty.sendbtn_bgcolor,'background-image': 'url('+ chatBarSty.sendbtn_bgimg+')' }">
        <font>{{ roomInfo.wait_Send_Time ? roomInfo.wait_Send_Time: (chatBarSty.sendbtn_bgimg.length > 0 ? '' : '发送')  }}</font>
      </button>
      <button v-if="userInfo.role.f_notice" type="button" class="chat-form-btn notice-btn" id="js-notice-btn" @click="sendNotice" @mouseenter="noticeBtnMouse('#ABA9A9')" @mouseleave="noticeBtnMouse(chatBarSty.noticebtn_bgcolor)" :style="{'background-color':chatBarSty.noticebtn_bgcolor,'background-image': 'url('+chatBarSty.noticebtn_bgimg+')' }"></button>
    </div>
  </div>
</template>

<style scoped>
  .chat-form-exFun {
    display: flex;
    flex-direction: row;
    align-items: center;
    flex-wrap: wrap;
    padding-right: 60px;
  }

  .waiting {
    background-image: url("/assets/img/load.gif") !important;
  }

  .send-btn,
  .notice-btn {
    background-repeat: no-repeat;
    background-position: center;
  }

  .chat-form-input-wrap,
  .send-btn {
    float: left;
  }

  .bar-com {
    margin-right: 3px;
  }

  #js-chat-faces-btn-box {
    display: flex;
    width: 30px;
    position: relative;
  }

  #js-chat-picture-btn {
    width: 25px;
    display: flex;
  }

  #js-gift-btn {
    display: flex;
    width: 28px;
    height: 28px;
  }

  /* .f-nochose {
    background-color: #fff;
    color: #111;
  } */

  #js-chat-font-btn {
    display: flex;
    position: relative;
    width: 40px;
  }

  #js-font-size-list {
    height: 20px;
    margin: auto;
    display: flex;
    border: 1px solid rgb(196, 196, 196);
    color: rgb(51, 51, 51);
    width: 40px;
    font-size: 12px;
  }

  .chat-font-bold-chose {
    display: flex;
  }

  .js-font-bold-btn {
    display: flex;
    position: relative;
    width: 20px;

  }

  .chat-font-bold-chose,
  .chat-danmu-chose {
    width: 20px;
    height: 20px;
    text-align: center;
    margin: auto;
    color: #fff;
  }

  .js-chat-mgr-lists {
    display: inline-block;
    width: 60px;
    position: relative;
  }

  #js-chat-mgr-list {
    border: 1px solid #c4c4c4;
    color: #333;
    width: 60px;
    height: 20px;
    font-size: 12px;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
  }

  .to-chat-warp {
    display: flex;
    color: #000;
  }

  .chat-bot {
    width: 100%;
    display: flex;
    flex-direction: row;
    margin-top: 1px;
  }

  .rightmore {
    cursor: pointer;
  }

  .chat-form-input-wrap {
    display: flex;
    flex: 1;
  }

  #js-chat-picture-btn-button {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
  }

  .send-btn {
    margin-left: 2px;
  }

  .notice-btn {
    margin-left: 2px;
  }

  .notice-btn:hover {
    background-color: #ABA9A9 !important;
  }

  .notice-btn:active {
    background-color: #8E8C8C !important;
  }

  .js-chat-color-btn {
    display: flex;
    position: relative;
    width: 24px;
    margin-left: 3px;
  }

  .js-chat-color-btn .in {
    display: flex;
    width: 20px;
    height: 20px;
    background-size: 20px 20px;
    background-repeat: no-repeat;
    border: 1px solid #fff;
  }

  .btn {
    border-radius: 4px;
  }

  #sinaEmotion {
    top: 503px;
    display: block;
    width: 400px;
    right: 10px;
  }

  .chat-view-new .chat-form-op {
    margin-top: 1px;
  }

  .dropdown-menu {
    bottom: 20px !important;
  }

  .MR-gift {
    top: -176px !important;
    z-index: 1000;
  }

  .chat-form-input {
    /* margin-top: 1px; */
    border-radius: 0px;
    border: 0px none;
  }

  .icon_yj img {
    vertical-align: initial;
  }

  .share-btn-chatbar {
    height: 30px;
    line-height: 26px;
    background-color: #107bcf;
    color: #fff;
    position: absolute;
    left: 196px;
    top: 5px;
    padding: 0px 15px;
  }

  .icon_yj {
    position: relative;
    display: flex;
    height: 30px;
    width: 30px;
    border-radius: 30px;
    cursor: pointer;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    align-items: center;
    justify-content: center;
  }

  .icon_yj>img {
    width: 25px;
    height: 25px;
  }

  .chat-view-new .share-btn-chatbar {
    height: 30px;
    line-height: 26px;
    background-color: orange;
    color: #fff;
    position: absolute;
    left: 274px;
    top: 5px;
    padding: 0px 15px;
  }

  .chat-view-new .auto-btn-chatbar {
    height: 30px;
    line-height: 26px;
    background-color: #A1A1A1;
    color: #fff;
    position: absolute;
    left: 185px;
    top: 5px;
    padding: 0px 15px;
  }

  .auto-btn-checked {
    background-color: orange !important;
  }

  .auto-btn-chatbar {
    height: 30px;
    line-height: 26px;
    background-color: #6f6f6f;
    color: #b8b8b8;
    position: absolute;
    left: 185px;
    top: 5px;
    padding: 0px 15px;
  }

  .auto-btn-checked {
    background-color: #107bcf !important;
    color: #fff !important;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import ChatGift from "@/pc_views/_/chatbar/ChatGift";
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import chatInputMixin from "@/mixins/chatbar/chatInputMixin";

  export default {
    data() {
      return {
        isNewMode: false,
        icon_smail: '',
        icon_upload: '',
        icon_gift: '',
        btn_notice_color: ''
      }
    },
    mixins: [layercommMixinPc, chatInputMixin],
    props: ["chatBarSty"],
    mounted() {

      this.icon_smail = this.chatBarSty.face_smile;
      this.icon_upload = this.chatBarSty.icon_upload;
      this.icon_gift = this.chatBarSty.icon_gift;

      this.isNewMode = parseInt(this.baseConfig.msgcfg.chatbar_style);

      var isNew = parseInt(this.baseConfig.msgcfg.chatbar_style);
      var self = this
      $(".uploadify-button").wait(function () {
        $(".uploadify-button").css("background-image", "url('" + self.icon_upload + "')");
        $(".uploadify-button ,.uploadify  ").mouseenter(function () {
          $(".uploadify-button").css("background-image", "");
          $(".uploadify-button").css("background-image", "url('" + self.chatBarSty.icon_upload_hover + "')");
        }).mouseleave(function () {
          $(".uploadify-button").css("background-image", "");
          $(".uploadify-button").css("background-image", "url('" + self.chatBarSty.icon_upload + "')");
        })
      })

      $("#js-chat-picture-btn-button").wait(function () {
        $("#js-chat-picture-btn-button").mouseenter(function () {
          $(".uploadify-button").css("background-image", "url('" + self.chatBarSty.icon_upload_hover + "')");
        }).mouseleave(function () {
          $(".uploadify-button").css("background-image", "url('" + self.chatBarSty.icon_upload + "')");
        })
      })

      $(".chat-form-exFun-item").wait(function () {
        if (isNew) { //新版本
          $(".to-chat-warp span").css("color", "#000");
        } else {
          $(".to-chat-warp span").css("color", "#fff")
          $(".chat-form-exFun-item").mouseenter(function () {
            $(this).css("background-color", self.chatBarSty.btn_hover);
          }).mouseleave(function () {
            $(this).css("background-color", "");
          })
        }
      })

    },
    methods: {
      smailMouse(imgUrl) {
        if (!this.isNewMode) {
          return;
        }
        this.icon_smail = imgUrl
      },
      giftMouse(imgUrl) {
        if (!this.isNewMode) {
          return;
        }
        this.icon_gift = imgUrl
      },
      noticeBtnMouse(colVal) {
        this.btn_notice_color = colVal;
      }
    },
    components: {
      ChatGift
    }
  };
</script>