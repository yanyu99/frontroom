<template>
  <div :id="msg_id" class="chat-message-content">
    <p class="luck-p">
      <time class="dms-date chat-message-time">{{msgItemData.time}}</time>
      <img
        class="chat-message-role"
        :src="userImgSrc(msgItemData)"
        :style="userImgStyle(msgItemData)"
      >
      <label
        v-if="msgItemData.isLuckMoney"
        :class="['chat-message-name-'+msgItemData.user.role_id]"  :style="{'color':msgItemSty.msgNickCo,'background-color':msgItemSty.msgNickBgCo}"
        class="chat-message-name dms-nick"
      >{{msgItemData.user.name}}</label>
    </p>

    <span class="talk-content packet-box">
      <span class="talk-gave">
        <p class="talk-gave-span">{{msgItemData.text}}</p>
        <p class="talk-gave-span">{{msgItemData.user.name}}的现金红包</p>
        <span class="btn-get" @click.stop="getPacket('msgitem',msgItemData.luck_id)">领取红包</span>
      </span>
    </span>
  </div>
</template>
<style scoped>
.luck-p {
  margin-top: 5px;
  margin-bottom: 5px;
}

.dms-nick {
  vertical-align: middle;
  height: 31px;
  line-height: 27px;
  font-weight: normal;
}

.chat-message-role {
  display: inline-block;
  height: 27px !important;
}

.chat-message-time,
.chat-message-role,
.chat-message-name {
  vertical-align: middle;
  margin-bottom: 0px;
}

.packet-box {
  padding: 8px 8px 3px;
  background-color: #fa9d3b;
  border-radius: 6px;
}

.talk-content {
  overflow: hidden;
  width: 240px;
  margin-top: 4px;
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
