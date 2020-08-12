<template>
  <div class="chat-message-content" :id="msg_id">
    <p class="chat-message-meta">
      <span class="chat-message-time">{{msgItemData.time}}</span>
      <span class="chat-message-name ">系统消息</span>
    </p>
    <p class="chat-message-context" style="pointer-events:none;"  :class="['msg-bg-color-'+ msgItemData.role_id]" :style="{'color':msgItemSty.msgFontCo,
    'background-color':msgItemSty.msgBgCo}" >
      <span :style="{'font-size':msgItemData.font_size+'px'|| '14px',
          'color': msgItemData.font_color || 'red'} " v-html="msgItemData.text"></span>
    </p>
  </div>
</template>

<style scoped>
  .chat-message-content p.chat-message-meta,
  p.chat-message-context {
    margin: 0px;
  }
  .chat-message-content{
    margin-bottom: 3px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import msgItemMixinPc from "@/mixins/msgItemMixinPc";

  export default {
    props: ["msgItemData", "afterAppend","msgItemSty"],
    mixins: [msgItemMixinPc],
  };
</script>