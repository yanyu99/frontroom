<template>
  <div :id="msg_id" class="chat-message-content chat-message-new">
    <p class="chat-message-meta  chat-header" :class="{'inlineDiv':!baseConfig.msgcfg.chat_br, 'blockDiv':baseConfig.msgcfg.chat_br }">
      <span class="chat-name-bg">
        <img class="chat-message-role" :src="userImgSrc(msgItemData)" :style="userImgStyle(msgItemData)" />
        <span class="chat-name js-chat-select-name" @click="selChat(msgItemData)" :class="['chat-message-name-'+msgItemData.role_id]" :style="{'color':msgItemSty.msgNickCo,'background-color':msgItemSty.msgNickBgCo}">{{msgItemData.name}}</span>
        <span class="chat-time">{{msgItemData.time}}</span>
      </span>
      <span class="chat-op">
        <msg-option :msgItemData="msgItemData"></msg-option>
      </span>

      <template v-if="baseConfig.msgcfg.show_root_room && userInfo.isManager">
        <span v-if="msgItemData.from_room_name" class="chat-message-from-room" style="">转播：{{msgItemData.from_room_name}}</span>
      </template>
      <span class="robot-diff" v-if="userInfo.role.f_robot_diff && msgItemData.send_type == 2">(机器人)</span>

      <!-- question -->
      <template v-if="msgItemData.role_id && msgItemData.role_id == 100">
        <img src="/assets/img/question.png" style="width: 18px;" />
      </template>
    </p>
    <p class="dot-top" v-if="baseConfig.msgcfg.chat_br"></p>
    <p class="chat-body " :class="['msg-bg-color-'+ msgItemData.role_id]" :style="{'background-color':msgItemSty.msgBgCo,'color':msgItemSty.msgFontCo}">

      <template v-if="msgItemData.to_uid">
        <span class="chat-to-user ">对</span>
        <img class="chat-message-role" :src="userImgSrc(msgItemData,true)" :style="userImgStyle(msgItemData,true)" />
        <span class="js-chat-select-name chat-to-name">{{msgItemData.to_name}}</span>
      </template>

      <span class="chat-content" :attr-data="msgItemData.font_weight" :style="{
             'font-size': msgItemData.font_size ?msgItemData.font_size+'px' :'14px',
             'font-weight':msgItemData.font_weight== 1 ||msgItemData.font_weight== 'bold' ? 'bold':'normal',
             'color': msgItemData.font_color || '#333'}" v-html=" fixEmoji(msgItemData.message) "></span>

      <span style="color:red" v-if="msgItemData.hasFilter"> (异常消息，请留意) </span>
      <template v-if="!baseConfig.msgcfg.hide_plat">
        <span v-if="msgItemData.plat && msgItemData.plat != 'pc' && msgItemData.plat != 'phone'" class="chat-message-plat" :style="chatPlatSty">来自:{{msgItemData.plat}}</span>
      </template>
    </p>
  </div>
</template>
<style scoped>
  .chat-message-new {
    margin-right: 12px;
  }

  .inlineDiv {
    width: auto;
    display: inline-block;
    margin-bottom: 3px !important;
  }

  .blockDiv {
    width: 100%;
    display: block;
  }

  .chat-body {
    max-width: 96%;
  }

  .chat-message {
    line-height: auto;
  }

  .chat-message-content p {
    margin: 0px;
  }

  .sina-emotion {
    vertical-align: middle;
  }

  .chat-message-role {
    display: inline-block;
    height: 20px !important;
  }

  .chat-message-time,
  .chat-message-role,
  .chat-message-name {
    vertical-align: middle;
  }

  .robot-diff {
    color: red;
  }

  .chat-message-plat {
    font-size: 14px;
    border: 1px solid;
    padding: 0px 4px;
    border-radius: 2px;
    white-space: nowrap;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import MsgOption from "@/pc_views/_/chat/MsgOption";
  import msgItemMixinPc from "@/mixins/msgItemMixinPc";

  export default {
    data() {
      return {
        chatPlatSty: {
          'color': $c("##ffA42F##消息平台的颜色", __FILE__),
          'border-color': $c("##ffA42F##消息平台的颜色", __FILE__),
        },
      }
    },
    name: 'ChatMsgItem2',
    props: ["msgItemData", "afterAppend", "msgItemSty"],
    mixins: [msgItemMixinPc],
    components: {
      MsgOption
    },
    methods: {
      //点击昵称对聊
      selChat(obj) {
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