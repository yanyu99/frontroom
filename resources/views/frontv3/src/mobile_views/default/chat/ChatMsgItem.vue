<template>
  <div :id="msg_id" @click="selChat(msgItemData)">
    <p>
      <time class='dms-date' :style="{'color':$c('#fe9a01##时间', __FILE__)}">{{msgItemData.time}}</time>
      <img class="chat-message-role" :src="userImgSrc(msgItemData)" :style="userImgStyle(msgItemData)" />

      <label :class='[{"dms-nick":true,"select-to-chat":userInfo.role.f_tochat},"chat-message-name-"+msgItemData.role_id]' :style="{'color':msgItemSty.msgNickCo,'background-color':msgItemSty.msgNickBgCo}">{{msgItemData.name}}</label>
      <span class="msg-red" v-if="userInfo.role.f_robot_diff && msgItemData.send_type == 2">(机器人)</span>
      <font class="msg-red" v-if="msgItemData.status == 1">(已禁言)</font>
      <font class="msg-red" v-if="msgItemData.status == 2">(聊天已关闭)</font>

      <template v-if=" msgItemData.to_uid ">
        <span class="dms-date" style="color:#fff;">对</span>
        <span :class='[{"dms-nick":true,"select-to-chat":userInfo.role.f_tochat},"chat-message-name-"+msgItemData.to_role_id]' :style="{'color':msgItemSty.msgNickCo,'background-color':msgItemSty.msgNickBgCo}">{{msgItemData.to_name}}</span>
      </template>
      <msg-option :itemData="msgItemData"></msg-option>
    </p>

    <p class="dms-chat-msg">
      <!-- 普通消息格式 -->
      <span v-if="!msgItemData.isLuckMoney" :class="['dms-chat-span','msg-bg-color-'+msgItemData.role_id]" :fontw="msgItemData.font_weight" :style="{
         'background-color':msgItemSty.msgBgCo,
            fontWeight: (msgItemData.font_weight== 1 ||msgItemData.font_weight== 'bold') ? 'bold':'normal',
            color: msgItemData.font_color ||msgItemSty.msgFontCo || $c('#222222##聊天消息的字体颜色', __FILE__),
          }" v-html="fixEmoji(msgItemData.message) "></span>

      <span style="color:red" v-if="msgItemData.hasFilter"> (异常消息，请留意) </span>
    </p>
  </div>
</template>

<style scoped>
  .dms-message-info p {
    line-height: 60px;
    vertical-align: middle;
    font-size: 26px;
  }

  .dms-nick {
    display: inline-block;
    padding: 0px 6px;
    border-radius: 6px;
    height: 60px;
    line-height: 60px;
    vertical-align: middle;
    font-size: 26px;
  }

  .dms-message-info p time {
    display: inline-block;
    color: #fff;
    padding: 0px 3px;
  }

  .dms-message-info p label {
    display: inline-block;
  }

  .dms-message-info .dms-chat-msg {
    margin-left: 10px;
    margin-right: 10px;
    padding: 0px 15px 14px 0px;
    overflow: hidden;
    display: block;
  }

  .dms-message-info .dms-chat-msg .dms-chat-span {
    display: inline-block;
    padding-left: 15px;
    line-height: 48px;
    vertical-align: middle;
    border-radius: 4px;
    color: #141414;
    padding-right: 10px;
    overflow: hidden;
    word-wrap: break-word;
    max-width: 98%;
  }

  .dms-message-info .dms-chat-msg .dms-chat-span img {
    width: 100%;
    background-size: 100%;
  }

  .dms-chat-msg img {
    vertical-align: middle;
    width: 100%;
  }

  .chat-pic {
    max-width: 100%;
  }

  .sina-emotion {
    vertical-align: middle;
  }

  .msg-red {
    color: red;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import MsgOption from "@/mobile_views/_/chat/MsgOption";
  import msgItemMixinMobile from "@/mixins/msgItemMixinMobile";

  export default {
    props: ["msgItemData", "afterAppend", "msgItemSty"],
    mixins: [msgItemMixinMobile],
    components: {
      MsgOption
    },
    methods: {
      //点击昵称对聊
      selChat(obj) {
        //添加颜色
        $(".content li").css("background-color", '');
        $("#limsg_" + obj.id).css("background-color", self.$c('#181818##聊天消息选中的背景颜色', __FILE__));

        if (!this.userInfo.role.f_tochat || this.userInfo.uid == obj.uid) {
          return
        }
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          selChatMsgItem: {
            toUid: obj.uid,
            toName: obj.name,
            from: 'chatto',
            toType: obj.role_id
          }
        });
      },
    }
  };
</script>