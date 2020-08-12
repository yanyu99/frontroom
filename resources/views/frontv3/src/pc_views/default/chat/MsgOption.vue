<template>
  <span class="msg-options">
    <template v-if=" (!msgItemData.from_room_name && userInfo.role.f_look)  || (userInfo.role_id > 500 && roomInfo.parent_room_id == roomInfo.room_id)">
      <a v-if="msgItemData.uid != userInfo.uid" class="chat-message-look-btn" @click="lookUser(msgItemData,$event)">看</a>
    </template>

    <template v-if="userInfo.role.f_deletechat">
      <a v-show="!(msgItemData.selfShow && msgItemData.hasFilter)" class="chat-message-delete-btn" @click="delMsg(msgItemData.id)">删</a>
    </template>

    <template v-if="userInfo.role.f_audit">
      <template v-if="msgItemData.selfShow || !msgItemData.is_audited">
        <a v-show=" !(msgItemData.selfShow || msgItemData.hasFilter)" class="chat-message-audit-btn" @click="checkMsg(msgItemData.id)" :style="{backgroundColor:checkColor}">审</a>
      </template>
    </template>
    <span class="msg-red" v-if="msgItemData.status == 1">(已禁言)</span>
    <span class="msg-red" v-if="msgItemData.status == 2">(聊天已关闭)</span>
  </span>
</template>

<style scoped>
  .msg-options {
    /* display: inline-block */
  }

  .msg-red {
    color: red;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        checkColor: '',
      }
    },
    props: ["msgItemData"],
    methods: {
      showStyle(msgItemData) {
        this.checkColor = '#00a0fc';
        if (msgItemData.send_roomid != this.roomInfo.room_id) {
          if (msgItemData.room_id == 0) {
            this.checkColor = "#FF02E0"
          } else {
            this.checkColor = "red"
          }
        }
      },
      lookUser(obj, event) {
        this.$store.dispatch(types.DO_USERINFO_LOOK, {
          uid: obj.uid,
          x: event.pageX,
          y: event.pageY - 100,
          from: 'chatoption',
        });
      },
      delMsg(id) {
        this.$store.dispatch(types.DO_MSG_DEL, {
          id: id
        });
        //滚动条设置
      },
      checkMsg(id) {
        this.$store.dispatch(types.DO_MSG_CHECK, {
          id: id
        });
      }
    }
  };
</script>