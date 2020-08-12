<template>
  <div class="chat-bottom chat-border-top1" style="bottom: 10px;width:100%">
    <div class="chat-form-qqs" :style="{'background-color': $c('rgba(0,0,0,0.8)##聊天区底部导航助理颜色透明值',__FILE__)}" v-if="qqMap.CHAT.length">
      <div class="qq-title">{{$t("高级助理##高级助理文字",__FILE__)}}</div>
      <div class="qq-item">
        <template v-for=" (item,ind) in qqMap.CHAT">
          <template v-if="item.which == 2">
            <span class="more_help chat-float-model-item" @click="showWeChat(ind)" :key="item.id" @mouseenter="showWeChat(ind)" @mouseleave="showWeChat(-1)">
              <img data-logtype="30" :src=" '/assets/img/qq3.png' " height="26" />
              <div class="wx_qr_img" v-show="curInd == ind" @mouseenter="showWeChat(ind)">
                <img :src="item.qr_img">
              </div>
            </span>
          </template>
          <template v-else>
            <a class="qqs-bth" :key="item.id" :href="'http://wpa.qq.com/msgrd?v=3&uin=' + item.qq + '&site=qq&menu=yes'" target="_blank">
              <img :src=" '/assets/img/qq2.png' " height="26">
            </a>
          </template>
        </template>
      </div>
      <a href="javascript:;" class="qq-more" @click=" popShow('QQHELPER',{text:'更多助理'})">{{$t("更多助理##更多助理文字",__FILE__)}}&gt;</a>
    </div>

    <div v-if="userInfo.role.f_caitiao" class="chat-form-caitiao" :style="{'background-color': $c('rgba(0,0,0,0.7)##彩条栏颜色透明值',__FILE__),'height':$t('40##彩条的高度',__FILE__)+'px'}">
      <span v-for="item in caitiaoArr" :data-name="item.name" :key="item.tag" @click="sendCaitiao(item)">
        <i :style="{'background-image':'url('+item.iconUrl+')'}"></i>{{item.title}}
      </span>
      <label class="startVote" @click="startVote" v-if="userInfo.role.vote_mgr && roomInfo.parent_room_id == roomInfo.room_id"></label>
    </div>

    <div class="chat-bottom" style="bottom: 10px;width:100%">
      <form class="chat-form">
        <!-- 聊天输入区域    :class="{'chat-view-new': parseInt(baseConfig.msgcfg.chatbar_style)}"-->
        <div class="chat-send-box " :style="{'background-color': $c('rgba(0,0,0,0.5)##chatbar颜色值透明度',__FILE__)}">
          <chat-input :chatBarSty="chatBarSty"></chat-input>
        </div>
      </form>

      <!-- 底部免责声明-->
      <div id="chat_mzsm_msg" v-if="baseConfig.noticecfg.chat_bottom_msg" class="chat-notify-msg-common chat-notify-bottom" :style="{height: $t('30##底部免责声明高度',__FILE__)+'px','background-color':  $c('rgba(0,0,0,0.5)##免责声明颜色值透明度',__FILE__)}">
        <template v-if="baseConfig.noticecfg.chat_bottom_url">
          <a :href="baseConfig.noticecfg.chat_bottom_url" target="_Blank" style="color: red">{{baseConfig.noticecfg.chat_bottom_msg}}</a>
        </template>
        <template v-else>{{baseConfig.noticecfg.chat_bottom_msg}}</template>
      </div>

    </div>
  </div>
</template>

<style scoped>
  .qqs-bth {
    margin-right: 5px;
  }

  .more_help {
    position: relative;
    cursor: pointer;
    margin-left: 2px;
  }

  .wx_qr_img {
    position: absolute;
    bottom: 28px;
    left: 0;
    z-index: 10;
    cursor: pointer;
    width: 170px;
    padding: 0px;
    min-width: auto;
    display: block;
  }

  .qq-more {
    line-height: 31px;
    position: absolute;
    right: 0px;
  }

  .wx_qr_img img {
    width: 170px;
  }

  .chat-form-caitiao {
    margin-top: 1px;
    white-space: nowrap;
    padding: 6px 5px;
    color: #fff;
  }

  .chat-form-caitiao span {
    cursor: pointer;
    display: inline-block;
    height: 28px;
    line-height: 28px;
    margin-right: 5px;
  }

  .chat-form-caitiao span i {
    padding: 4px 14px;
  }

  .startVote {
    position: absolute;
    right: 0;
    background: url('/assets/v3/images/pc/check_vote_icon.png') no-repeat left;
    display: inline-block;
    width: 40px;
    height: 30px;
    cursor: pointer;
  }

  .chat-form-qqs {
    position: relative;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from '@/store/types'
  import ChatInput from '@/pc_views/_/chatbar/ChatInput'
  import layercommMixinPc from "@/mixins/layercommMixinPc";

  export default {
    data() {
      return {
        dataList: [],
        curInd: -1,
        chatBarSty: {},
        caitiaoArr: []
      }
    },
    mixins: [layercommMixinPc],
    computed: {
      ...Vuex.mapGetters([types.qqMap])
    },
    created() {
      this.caitiaoArr = types.caitiaoArr;
      var _typeArr = this.qqMap.CHAT || [];
      this.dataList = _typeArr.length > 4 ? _typeArr.slice(0, 4) : _typeArr;
      this.getChatBarSty();
    },
    methods: {
      getChatBarSty() {
        var styV1 = {
          bgcolor: $c('#414967##v1--工具条块的背景颜色', __FILE__),
          btn_hover: $c('#000000##v1--按钮悬浮的颜色', __FILE__),
          btn_sel: $c('#222222##v1--按钮选中的颜色', __FILE__),
          face_smile: $m('/assets/v3/images/pc/chatbar/bq.png##v1--表情的图标', __FILE__),
          icon_upload: $m('/assets/v3/images/pc/chatbar/tp.png##v1--上传图片图标', __FILE__), //
          icon_upload_hover: $m('/assets/img/chatbar/img_sel.png##v1--上传图片悬浮图标', __FILE__),
          icon_gift: $m('/assets/img/gift6bfb.png##v1--积分礼物图标', __FILE__),
          icon_gift_hover: $c('/assets/img/chatbar/gift_sel.png##v1--积分礼物悬浮图标', __FILE__),
          yj_icon: (this.roomInfo.yjInfo.yjStep == 1 || this.roomInfo.yjInfo.yjStep == 0) && !this.roomInfo.lottery_show ?
            $m('/assets/img/yj/yj-btn-go.gif##v1--摇奖进行中图标', __FILE__) : $m('/assets/img/yj/yj-btn.gif##v1--摇奖图标', __FILE__),
          rightmore: $m('/assets/img/chatbar/arrowl_v1.png##v1--更多右侧图标', __FILE__),
          expend_btn: $m('/assets/img/chatbar/arrowr_v1.png##v1--左侧返回图标', __FILE__),
          //rightmore_bgcolor: $c('#414967##v1--更多右侧的背景颜色', __FILE__),
          sendbtn_bgcolor: $c('#009efc ##v1--发送按钮背景颜色', __FILE__),
          sendbtn_bgimg: $m("##发送按钮背景图片(默认无)", __FILE__),
          noticebtn_bgcolor: $c('#FD484D ##v1--公告按钮背景颜色', __FILE__),
          noticebtn_bgimg: $m("/assets/img/danmu.png##公告按钮背景图片", __FILE__),
          //btn_hover_color: $c("#ABA9A9##按钮悬浮的背景颜色", __FILE__),
        }

        var styV2 = {
          bgcolor: $c('#fff7ea ##v2--工具条块的背景颜色', __FILE__),
          btn_sel: $c('#ffab24##v2--按钮选中的颜色', __FILE__),
          face_smile: $m('/assets/img/chatbar/emotion.png##v2--表情的图标', __FILE__),
          face_smile_hover: $m('/assets/img/chatbar/emotion_sel.png##v2--表情悬浮的图标', __FILE__),
          icon_upload: $m('/assets/img/chatbar/img_icon.png##v2--上传图片图标', __FILE__),
          icon_upload_hover: $m('/assets/img/chatbar/img_sel.png##v2--上传图片悬浮图标', __FILE__),
          icon_gift: $m('/assets/img/chatbar/gift_icon.png##v2--积分礼物图标', __FILE__),
          icon_gift_hover: $c('/assets/img/chatbar/gift_sel.png##v2--积分礼物悬浮图标', __FILE__),
          yj_icon: (this.roomInfo.yjInfo.yjStep == 1 || this.roomInfo.yjInfo.yjStep == 0) && !this.roomInfo.lottery_show ?
            $m('/assets/img/yj/yj-btn-go.gif##v2--摇奖进行中图标', __FILE__) : $m('/assets/img/yj/yj-btn.gif##v2--摇奖图标', __FILE__),
          rightmore: $m('/assets/img/chatbar/arrowl.png##v2--更多右侧图标', __FILE__), //url(/assets/img/chatbar/arrowl.png?v=2.0)
          expend_btn: $m('/assets/img/chatbar/arrowr.png##v2--返回左侧图标', __FILE__),
          sendbtn_bgcolor: $c('#fff7ea##v2--发送按钮背景颜色', __FILE__),
          sendbtn_bgimg: $m("/assets/img/chatbar/sent.png##v2--发送按钮背景图片", __FILE__),
          noticebtn_bgcolor: $c('#ffffff##v2--公告按钮背景颜色', __FILE__),
          noticebtn_bgimg: $m("/assets/img/chatbar/notice.png##v2--公告按钮背景图片", __FILE__),
        }

        var isNew = parseInt(baseConfig.msgcfg.chatbar_style);
        this.chatBarSty = isNew ? styV2 : styV1;
      },
      showWeChat(ind) {
        this.curInd = this.curInd == ind ? -1 : ind
      },
      sendCaitiao(item) {
        if (
          this.baseConfig.chatcfg.guest_chat_cue &&
          !this.userInfo.logined
        ) {
          this.dialogMsgAlign("游客不能发言，请先登录", "提示");
          return;
        }
        if (this.roomInfo.wait_Send_Time > 0) {
          return;
        }
        var countTime = this.userInfo.role.chat_ts || 0;
        this.$store.state.roomInfo.wait_Send_Time = countTime;
        var intervarTimer = setInterval(() => {
          if (countTime == 0) {
            intervarTimer && clearInterval(intervarTimer);
          } else {
            countTime--;
            this.$store.state.roomInfo.wait_Send_Time = countTime;
          }
        }, 1000);

        this.$store.dispatch(types.DO_MSG_SEND_PC, {
          message: '[' + item.imgUrl + ']',
          type: 2,
        });
      },

      startVote() {
        if (!this.userInfo.role.vote_mgr) {
          this.dialogMsgAlign("没有权限发起投票!");
          return;
        }
        dms.checkVote({}, resp => {
          this.popShow('StartVote');
        }, resp => {
          this.dialogMsgAlign(resp.msg);
          return;
        })
      },
    },
    components: {
      ChatInput
    }
  }
</script>