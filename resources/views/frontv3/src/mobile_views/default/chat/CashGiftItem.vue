<template>
  <div class :id="msg_id">
    <p>
      <i class="dms-role"></i>
      <span class="dms-date" :style="{'color':$c('#fe9a01##时间', __FILE__)}">{{msgItemData.time}}</span>
      <span class="dms-nick" :style="{color:$c('#fff##系统消息', __FILE__)}">系统消息</span>
    </p>
    <p class="chat-content-warp dms-chat-msg">
      <span style="font-weight: bold;  color:red;" class="dms-content chat-message-context dms-chat-span cash-gift-system-item" v-html=" fixEmoji(msgItemData.message) "></span>
    </p>
  </div>
</template>
<style scoped>
  .dms-message-info p {
    height: 60px;
    line-height: 60px;
    vertical-align: middle;
    font-size: 26px;
    color: #fff;
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
    width: 54px;
  }
</style>


<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import msgItemMixinMobile from "@/mixins/msgItemMixinMobile";

  export default {
    props: ["msgItemData", "afterAppend"],
    mixins: [msgItemMixinMobile],
    computed: {}
  };
</script>