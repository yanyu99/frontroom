<template>
  <div v-if="tab.tag == roomInfo.active_menu" class="pane">
    <div class="dms-message-container" id="dmsMessagePri" :style="{background: $c('#252525##聊天框的背景颜色', __FILE__),}">
      <chat-msg-box :msgList="roomInfo.priChatList" :curType=" 'priChat' "></chat-msg-box>
    </div>
    <chat-bar-pri></chat-bar-pri>

  </div>
</template>

<style scoped>
  .pane {
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .pane {
    overflow: auto;
    position: relative;
  }

  .dms-message-container {
    background-color: #252525;
    bottom: 38px;
    width: 100%;
    overflow-y: scroll;
    overflow-x: hidden;
    overflow-x: hidden;
    display: flex;
    flex: 1;
    flex-direction: column;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import ChatMsgBox from "@/mobile_views/_/chat/ChatMsgBox";
  import ChatBarPri from "@/mobile_views/_/chatbar/ChatBarPri";

  export default {
    props: {
      tab: Object
    },
    components: {
      ChatMsgBox,
      ChatBarPri
    }
  };
</script>