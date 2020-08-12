<template>
  <div class="dms-send-container">
    <chat-to :curType=" 'priChat' "></chat-to>

    <div class="dms-textarea-container" :style="{'background-color':$c('#090909##聊天消息发送底部的颜色', __FILE__),'height':$t('46##聊天发送底部的高度',__FILE__)+'px'}">
      <span id="dms-emotion-button-pri" class="dms-emotion-button" :style="{ background:'url('+$m('/assets/v3/images/phone/emotion.png##表情图标', __FILE__)+') no-repeat center'}"></span>
      <div class="dms-textarea-box">
        <input type="text" class="input-text" v-model="textMsg" id="aodianyun-dms-text-pri" maxlength="30" placeholder="说点什么..." @keyup.enter="sendMsg" :style="{color:$c('#6f6f6f##输入框字体的颜色', __FILE__),backgroundColor:$c('#090909##输入框背景的颜色', __FILE__),border:'1px solid '+$c('#505050##输入框边框的颜色', __FILE__)}">
      </div>
      <a href="javascript:;" class="chat-send-btn" id="id-chat-btn" @click="sendMsg" :style="{backgroundColor: $c('#fe9901##聊天发送按钮颜色', __FILE__)}">{{$t("发送##私聊消息发送按钮文字",__FILE__)}}</a>
    </div>
  </div>
</template>


<style scoped>
  .dms-send-container {
    width: 100%;
    overflow: hidden;
    z-index: 99;
  }

  .dms-textarea-container {
    padding: 0px 10px;
    background-color: #090909;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    align-items: center;
  }

  .dms-textarea-container span {
    width: 63px;
    height: 63px;
    background-size: 63px !important;
    vertical-align: middle;
    padding-right: 3px;
    margin-right: 8px;
  }

  .dms-textarea-box {
    padding-right: 10px;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .input-text {
    width: 99%;
    height: 62px;
    line-height: 62px;
    /* border: 1px solid #505050; */
    /* background-color: #2c2c2c; */
    /* color: #6f6f6f; */
    border-radius: 8px;
    padding-left: 4px;
    font-size: 25px;
  }

  .chat-send-btn {
    display: inline-block;
    color: #fff;
    width: 114px;
    height: 64px;
    line-height: 64px;
    vertical-align: middle;
    text-align: center;
    font-size: 27.8px;
    border-radius: 8px;
    font-weight: bold;
    float: right;
    margin-right: 0px 5px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import ChatTo from "@/mobile_views/_/chatbar/ChatTo";

  export default {
    data() {
      return {
        textMsg: ""
      };
    },
    created() {
      var self = this;
      $("#dms-emotion-button-pri").wait(function () {
        $.fn.sinaEmotion.options = {
          rows: 21, // 每页显示的表情数
          language: "cnname", // 简体（cnname）、繁体（twname）
          appKey: "1362404091" // 新浪微博开放平台的应用ID
        };

        $("#dms-emotion-button-pri").on("click", function (e) {
          $.fn.sinaEmotion.options.inputCallBack = function (msg) {
            self.textMsg = msg;
          };
          $("#aodianyun-dms-text-pri").sinaEmotion("#aodianyun-dms-text-pri");
          e.stopPropagation();
        });
      });
    },
    mounted() {
      var self = this;
      // $("#sinaEmotion").wait(function () {  
      //   $("body").bind("click", function (e) {  
      //     var e = e || window.event; //浏览器兼容性
      //     var elem = e.target || e.srcElement;
      //     while (elem) {
      //       //循环判断至跟节点，防止点击的是div子元素
      //       if (elem.id && elem.id == "sinaEmotion") {
      //         //console.log("这是div里面的");
      //         return false;
      //       }
      //       elem = elem.parentNode;
      //     }
      //   });
      // });
    },
    methods: {
      sendMsg() {
        var message = this.textMsg;
        message = $.trim(message);
        this.textMsg = "";

        if (message.length == 0) {
          return;
        }
        this.$store.dispatch(types.DO_PRI_MSG_SEND, {
          message: message
        });
      }
    },
    components: {
      ChatTo
    }
  };
</script>