<template>
  <div :id="msg_id" class="chat-message-new">
    <p class="chat-message-meta chat-header">
      <span class="chat-name-bg">
        <img
          class="chat-message-role"
          :src="userImgSrc(msgItemData)"
          :style="userImgStyle(msgItemData)"
        >
        <span
          class="chat-name js-chat-select-name"
          :class="['chat-message-name-'+msgItemData.user.role_id]" :style="{'color':msgItemSty.msgNickCo,'background-color':msgItemSty.msgNickBgCo}"
          @click="selChat(msgItemData)"
        >{{msgItemData.user.name}}</span>
        <span class="chat-time">{{msgItemData.time}}</span>
      </span>
    </p>
    <span class="tri-up"></span>
    <p style="background-color:transparent;">
      <span class="talk-content packet-box chat-content">
        <span class="talk-gave">
          <p class="talk-gave-span">{{msgItemData.text}}</p>
          <p class="talk-gave-span">{{msgItemData.user.name}}的现金红包</p>
          <span class="btn-get" @click.stop="getPacket('msgitem',msgItemData.luck_id)">领取红包</span>
        </span>
      </span>
    </p>
  </div>
</template>


<style scoped>
.chat-message-role {
  display: inline-block;
  height: 20px !important;
}

.chat-message-time,
.chat-message-role,
.chat-message-name {
  vertical-align: middle;
  margin-bottom: 0px;
}

.packet-box {
  padding: 8px 8px 4px;
  background-color: #fa9d3b;
  border-radius: 6px;
}

.talk-content {
  overflow: hidden;
  width: 240px;
  /* margin-top: 4px; */
  display: block;
}

.talk-gave {
  font-size: 14px;
  color: #fff;
  padding: 2px 0px 0px;
  position: relative;
  overflow: hidden;
  padding-left: 85px;
  background-image: url(/assets/v3/images/phone/packet.png);
  background-repeat: no-repeat;
  background-size: 68px;
  display: inline-block;
  height: 80px;
}

.talk-gave p {
  line-height: 20px !important;
  margin: 0px;
}

.talk-gave::before {
  width: 150px;
}

.btn-get {
  display: inline-block;
  background-color: #cd3d3d;
  padding: 0px 20px;
  border-radius: 6px;
  color: #fff;
  height: 30px;
  line-height: 30px;
  vertical-align: middle;
  cursor: pointer;
  margin-top: 4px;
}

.talk-gave-span {
  width: 126px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
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

.tri-up {
  width: 0;
  height: 0;
  border-width: 0 5px 5px 5px;
  border-style: solid;
  border-color: transparent transparent #fa9d3b transparent;
  display: block;
  margin-left: 10px;
}
</style>

<script>
import * as types from "@/store/types";
import MsgOption from "@/pc_views/_/chat/MsgOption";
import msgItemMixinPc from "@/mixins/msgItemMixinPc";
import gotpackMixinPc from "@/mixins/gotpackMixinPc";
export default {
  props: ["msgItemData", "afterAppend","msgItemSty"],
  mixins: [msgItemMixinPc, gotpackMixinPc]
};
</script>
