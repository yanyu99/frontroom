<template>
  <div :id="msg_id">
    <p>
      <!-- <i class="dms-role"  style="background-img:url("+msgItemData.pic+")"  ></i> -->
      <time class='dms-date' :style="{'color':$c('#fe9a01##时间', __FILE__)}">{{msgItemData.time}}</time>

      <!-- 如果是当前的用户发送的消息 -->
      <template v-if="msgItemData.msgtype == 'send_pri_msg'">
        <span class="dms-date" style="color: #00a0fc;">对</span>
        <label class="dms-nick select-pri-chat" :style="{'color':$c('#fe9a01##昵称', __FILE__)}">{{msgItemData.name}}</label>
        <span class="dms-date" style="color: #00a0fc;">私聊</span>
      </template>

      <template v-else>
        <label :class='{"dms-nick":true,"select-to-chat":userInfo.role.f_tochat}'>{{msgItemData.name}}</label>
        <span class="dms-nick select-pri-chat" :style="{'color':$c('#fe9a01##昵称', __FILE__)}">{{msgItemData.to_name}}</span>
        <span class="" style="color: #00a0fc;">对您私聊</span>
      </template>
    </p>
    <p class="dms-chat-msg">
      <span :style=" {color:msgItemData.font_color ?  msgItemData.font_color:$c('#222222##聊天消息的字体颜色', __FILE__)}" class="dms-chat-span" v-html=" fixEmoji(msgItemData.message) "></span>
    </p>
  </div>
</template>

<style scoped>
  .dms-message-info {
    padding: 5px 15px;
    position: relative;
  }

  .dms-message-info p {
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
    color: #fe9901;
  }

  .dms-message-info .dms-chat-msg {
    margin-left: 50px;
    margin-right: 10px;
    padding: 0px 15px 14px 0px;
    display: block;
  }

  .dms-message-info .dms-chat-msg .dms-chat-span {
    display: inline-block;
    padding-left: 15px;
    line-height: 48px;
    vertical-align: middle;
    border-radius: 4px;
    background-color: #fff;
    color: #141414;
    padding-right: 10px;
    overflow: hidden;
    word-wrap: break-word;
    max-width: 98%;
  }

  .dms-chat-msg img {
    vertical-align: middle;
  }

  .sina-emotion {
    vertical-align: middle;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import msgItemMixinMobile from "@/mixins/msgItemMixinMobile";
  export default {
    props: ["msgItemData", "afterAppend"],
    mixins: [msgItemMixinMobile],
  };
</script>