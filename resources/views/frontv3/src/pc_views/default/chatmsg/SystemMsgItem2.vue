<template>
  <div class="chat-message-new" :id="msg_id">
    <p class="chat-header " :class="{'inlineDiv':!baseConfig.msgcfg.chat_br, 'blockDiv':baseConfig.msgcfg.chat_br }">
      <span class="chat-name-bg">
        <i class="myicon-sysmsg"></i>
        <span class="chat-sysname ">系统消息</span>
        <span class="chat-time">{{msgItemData.time}}</span>
      </span>
    </p>
    <p class="dot-top" v-if="baseConfig.msgcfg.chat_br"></p>
    <p class="chat-body" style="pointer-events:none;" :class="['msg-bg-color-'+ msgItemData.role_id]" :style="{'color':msgItemSty.msgFontCo,
    'background-color':msgItemSty.msgBgCo}">
      <span :style="{'font-size':msgItemData.font_size+'px'|| '14px',
          'color':  msgItemData.font_color || 'red'} " v-html="msgItemData.text"></span>
    </p>
  </div>
</template>

<style scoped>
  .inlineDiv {
    width: auto;
    display: inline-block;
    margin-bottom: 3px !important;
  }

  .blockDiv {
    width: 100%;
    display: block;
  }

  .chat-message-new p {
    margin: 0px;
  }

  .chat-message-content p.chat-message-meta,
  p.chat-message-context {
    margin: 0px;
  }

  .chat-message-content {
    margin-bottom: 3px;
  }

  .chat-body {
    max-width: 96%;
    background-color: #fff7ec;
  }

  .chat-body span {
    word-break: break-all;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import msgItemMixinPc from "@/mixins/msgItemMixinPc";

  export default {
    props: ["msgItemData", "afterAppend", "msgItemSty"],
    mixins: [msgItemMixinPc],
  };
</script>