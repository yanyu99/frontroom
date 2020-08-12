<template>
  <!-- 对某某说 弹出框 -->
  <div class="chat-teacher-con" v-show=" !!curData.toUid " :style="{'background-color':$c('#252525##聊天框的背景颜色', __FILE__)}">
    <span :style="{
        backgroundColor: $c('#666##背景颜色', __FILE__),
      }" @click.stop="closeChatTo()">对
      <label :style="{
          color: $c('#FFF##字体颜色', __FILE__)
        }">{{curData.toName}}</label> 说
      <label v-show="curType == 'pubChat' " class="close"></label>
    </span>
  </div>

</template>

<style scoped>
  .chat-teacher-con {
    z-index: 99;
    left: 15px;
    bottom: 92px;
    padding: 10px 15px 0px;
    width: 100%;
  }

  .chat-teacher-con span {
    display: inline-block;
    height: 50px;
    line-height: 50px;
    border-radius: 6px;
    padding: 0px 15px;
    position: relative;
  }

  .close {
    background: red;
    color: #fff;
    border-radius: 12px;
    line-height: 20px;
    text-align: center;
    height: 20px;
    width: 20px;
    font-size: 18px;
    padding: 1px;
    top: -5px;
    right: -10px;
    position: absolute;
    z-index: 99;
  }

  /* use cross as close button */

  .close::before {
    content: "\2716";
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    props: ["curType"],
    computed: {
      curData() {
        return this.curType == "pubChat" ?
          this.roomInfo.selChatMsgItem :
          this.roomInfo.selPriChatMsgItem;
      }
    },
    methods: {
      closeChatTo() {  
        if (this.curType == "pubChat") {
          console.log("=chatto=");
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            selChatMsgItem: types.emptyChatTo
          });
        }
      }
    }
  };
</script>