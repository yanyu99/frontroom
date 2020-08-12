<template>
  <div :id="msg_id" class="chat-message-content">
    <p>
      <i class="dms-role"></i>
      <span class="dms-date">{{msgItemData.time}}</span>
      <span class="dms-nick chat-message-name ">系统消息</span>
    </p>
    <p class="chat-content-warp dms-chat-msg chat-message-context">
      <span class=" dms-chat-span cash-gift-system-item" v-html=" fixEmoji(msgItemData.message) "></span>
    </p>
  </div>

</template>
<style scoped>
  .dms-message-info p label {
    display: inline-block;
    color: #fe9901;
  }

  .dms-message-info .dms-chat-msg {
    margin-left: 10px;
    margin-right: 10px;
    padding: 0px 15px 14px 0px;
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
    word-wrap: break-word;
    max-width: 98%;
  }
</style>
<style>
  .cash-gift-system-item img {
    width: 28px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import msgItemMixinPc from "@/mobile_views/_/chat/msgItemMixinPc";

  export default {
    props: ["msgItemData", "afterAppend"],
    mixins: [msgItemMixinPc],
    computed: {}

  };
</script>