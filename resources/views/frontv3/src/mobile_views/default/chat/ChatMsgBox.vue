<template>
  <ul class="content">
    <li v-for="item in msgList" :key='item.id' class="dms-message-info" :id="'limsg_'+ item.id">
      <component :afterAppend="afterAppend" :msgItemData=" item " :is="msgType(item)" :msgItemSty="getRoleType( item.isLuckMoney?item.user.role_id :item.role_id)" @click="selectMsg(item)"></component>
    </li>
  </ul>

</template>

<style scoped>
  .dms-message-info {
    padding: 5px 15px;
    position: relative;
    overflow: hidden;
    display: block;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import ChatMsgItem from "@/mobile_views/_/chat/ChatMsgItem";
  import SystemMsgItem from "@/mobile_views/_/chat/SystemMsgItem";
  import PriChatItem from "@/mobile_views/_/chat/PriChatItem";
  import PacketItem from "@/mobile_views/_/chat/PacketItem";
  var scrollTopTimer = null;

  export default {
    props: ["msgList", "curType"],
    methods: {
      getRoleType(roleId) {
        var _styObj = {
          msgBgCo: $c("#ffffff##默认消息的背景颜色", __FILE__),
          msgFontCo: $c("#333333##默认消息的字体颜色", __FILE__),
          msgNickCo: $c("#fe9901##默认昵称的颜色", __FILE__),
          msgNickBgCo: $c("#ffffff##默认昵称背景的颜色", __FILE__),
        }

        if (roleId > 0) {
          if (roleId >= 500) {
            _styObj = {
              msgBgCo: $c("#ff00ff##管理员消息的背景颜色", __FILE__),
              msgFontCo: $c("#333333##管理员消息的字体颜色", __FILE__),
              msgNickCo: $c("#FFFFFF##管理员昵称的颜色", __FILE__),
              msgNickBgCo: $c("#62ce61##管理员昵称背景的颜色", __FILE__),
              msgFunBtnCo: $c("##管理员消息操作按钮的背景颜色", __FILE__),
            }
          } else if (roleId >= 400 && roleId < 500) {
            _styObj = {
              msgBgCo: $c("#ff00ff##讲师消息的背景颜色", __FILE__),
              msgFontCo: $c("#333333##讲师消息的字体颜色", __FILE__),
              msgNickCo: $c("#FFFFFF##讲师昵称的颜色", __FILE__),
              msgNickBgCo: $c("#62ce61##讲师昵称背景的颜色", __FILE__),
              msgFunBtnCo: $c("##讲师消息操作按钮的背景颜色", __FILE__),
            }
          } else if (roleId == 100) {
            _styObj = {
              msgBgCo: $c("#ff00ff##游客消息的背景颜色", __FILE__),
              msgFontCo: $c("#333333##游客消息的字体颜色", __FILE__),
              msgNickCo: $c("#FFFFFF##游客昵称的颜色", __FILE__),
              msgNickBgCo: $c("#62ce61##游客昵称背景的颜色", __FILE__),
              msgFunBtnCo: $c("##游客消息操作按钮的背景颜色", __FILE__),
            }
          } else {
            _styObj = {
              msgBgCo: $c("#ff00ff##会员消息的背景颜色", __FILE__),
              msgFontCo: $c("#333333##会员消息的字体颜色", __FILE__),
              msgNickCo: $c("#FFFFFF##会员昵称的颜色", __FILE__),
              msgNickBgCo: $c("#62ce61##会员昵称背景的颜色", __FILE__),
              msgFunBtnCo: $c("##会员消息操作按钮的背景颜色", __FILE__),
            }
          }
        }
        return _styObj;
      },
      msgType(item) {
        var default_type =
          this.curType == "priChat" ? "PriChatItem" : "ChatMsgItem";
        return item._type ?
          item._type :
          item.isLuckMoney ? "PacketItem" : default_type;
      },
      afterAppend(msg_id) {
        var box = this.curType == "priChat" ? "#dmsMessagePri .content" : "#dmsMessage .content";
        var _boxScroll = $(box)[0];
        $("#" + msg_id).wait(function () {
          if (scrollTopTimer || !_boxScroll) {
            return;
          }
          scrollTopTimer = setTimeout(() => {
            $(box).scrollTop($(box)[0].scrollHeight + 99999);
            scrollTopTimer = null;
          }, 400);
        });

        $(this)
          .find("img")
          .one("load", function () {
            if (scrollTopTimer || !_boxScroll) {
              return;
            }
            scrollTopTimer = setTimeout(() => {
              $(box).scrollTop($(box)[0].scrollHeight + 99999);
              scrollTopTimer = null;
            }, 400)
          })
          .each(function () {
            if (this.complete) {
              $(this).load();
            }
          });
      },
      selectMsg(itemData) {
        var chatPubObj = {
          toUid: itemData.uid,
          toName: itemData.name,
          from: "chat_msg_box",
          toType: itemData.role_id
        };

        if (this.curType == "priChat") {
          this.$store.state.roomInfo.selPriChatMsgItem = chatPubObj;
        } else {
          this.$store.state.roomInfo.selChatMsgItem = chatPubObj;
        }
      }
    },
    components: {
      ChatMsgItem,
      SystemMsgItem,
      PriChatItem,
      PacketItem,
    }

  };
</script>