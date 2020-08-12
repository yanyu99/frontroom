<template>
  <span class="sp-msg" :id="msg_id">
    <p>
      <i class="dms-role"></i>
      <span class="dms-date" :style="{'color':$c('#fe9a01##时间', __FILE__)}">{{msgItemData.time}}</span>
      <span class="dms-nick" :style="{color:$c('#ffffff##系统消息文字颜色', __FILE__)}">系统消息</span>
    </p>
    <p class="dms-chat-msg">
      <span class="dms-chat-span" :style="{color:$c('red##系统提示消息字体颜色', __FILE__),'background-color':$c('#ffffff##系统提示消息背景颜色')}" v-html="msgItemData.text"></span>
    </p>
  </span>
</template>

<style scoped>
  .sp-msg {
    display: block;
  }

  .dms-message-info {
    padding: 5px 15px;
    position: relative;
  }

  .dms-message-info p {
    line-height: 60px;
    vertical-align: middle;
    font-size: 26px;
    color: #fff;
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
    margin-left: 10px;
    margin-right: 10px;
    padding: 0px 15px 14px 0px;
    display: block;
  }

  .dms-message-info .dms-chat-msg .dms-chat-span {
    display: inline-block;
    padding-left: 15px;
    /* height: 48px;  */
    line-height: 48px;
    vertical-align: middle;
    border-radius: 4px;
    background-color: #fff;
    padding-right: 10px;
    font-weight: bold;
    color: red;
    word-wrap: break-word;
    max-width: 98%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import msgItemMixinMobile from "@/mixins/msgItemMixinMobile";

  export default {
    props: ["msgItemData", "afterAppend", "msgItemSty"],
    mixins: [msgItemMixinMobile],
  };
</script>