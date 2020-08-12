<template>
  <div :id="msg_id" class="chat-message-content">
    <p class="chat-message-meta" :style="{ display: baseConfig.msgcfg.chat_br ? 'block' : 'inline-block'}">
      <span class="chat-message-time">{{msgItemData.time}}</span>
      <img class="chat-message-role" :src="userImgSrc(msgItemData)" :style="userImgStyle(msgItemData)" />
      <span :class="['chat-message-name','chat-message-name-'+msgItemData.role_id,'js-chat-select-name' ]" :style="{'color':msgItemSty.msgNickCo,'background-color':msgItemSty.msgNickBgCo}" @click="selChat(msgItemData)">{{msgItemData.name}}</span>
      <template v-if="baseConfig.msgcfg.show_root_room && userInfo.isManager">
        <span v-if="msgItemData.from_room_name" class="chat-message-from-room" style="">转播：{{msgItemData.from_room_name}}</span>
      </template>

      <template v-if="msgItemData.to_uid">
        <span class="chat-message-to-user">对</span>
        <span class="chat-message-name js-chat-select-name" :class="['chat-message-name-'+msgItemData.to_role_id]">{{msgItemData.to_name}}</span>
      </template>

      <msg-option :msgItemData="msgItemData"></msg-option>
      <span class="robot-diff" v-if="userInfo.role.f_robot_diff && msgItemData.send_type == 2">(机器人)</span>

      <template v-if="msgItemData.role_id && msgItemData.role_id == 100">
        <img src="/assets/img/question.png" style="width: 18px;" />
      </template>

    </p>
    <p class="chat-message-context" :class="['msg-bg-color-'+ msgItemData.role_id]" :style="{'background-color':msgItemSty.msgBgCo,'color':msgItemSty.msgFontCo}">
      <span :attr-data="msgItemData.font_weight" :style="{
             'font-size': msgItemData.font_size ?msgItemData.font_size+'px' :'14px',
             'font-weight':msgItemData.font_weight== 1 ||msgItemData.font_weight== 'bold' ? 'bold':'normal',
             'color': msgItemData.font_color||''}" v-html=" fixEmoji(msgItemData.message) "></span>

      <span style="color:red" v-if="msgItemData.hasFilter"> (异常消息，请留意) </span>
    </p>

    <template v-if="!baseConfig.msgcfg.hide_plat">
      <span v-if="msgItemData.plat && msgItemData.plat != 'pc' && msgItemData.plat != 'phone'" class="chat-message-plat">来自:{{msgItemData.plat}}</span>
    </template>
  </div>
</template>
<style scoped>
  .chat-message-content p {
    margin: 0px;
  }

  .sina-emotion {
    vertical-align: middle;
  }

  .chat-message-role {
    display: inline-block;
    height: 27px !important;
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
      return {}
    },
    name: 'ChatMsgItem',
    props: ["msgItemData", "afterAppend","msgItemSty"],
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