<template>
  <div :id="msg_id">
    <p>
      <time class='dms-date' :style="{'color':$c('#fe9a01##时间', __FILE__)}">{{msgItemData.time}}</time>
      <img class="chat-message-role" :src="userImgSrc(msgItemData)" :style="userImgStyle(msgItemData)" />
      <label v-if="msgItemData.isLuckMoney" class="dms-nick select-to-chat isluckmoney" :class='["chat-message-name-"+msgItemData.user.role_id]' 
      :style="{'color':msgItemSty.msgNickCo,'background-color':msgItemSty.msgNickBgCo}">{{msgItemData.user.name}}</label>
    </p>

    <div class="dms-chat-msg">
      <span class="talk-content packet-box">
        <span class="talk-gave">
          <p class="talk-gave-span">{{msgItemData.text}}</p>
          <p class="talk-gave-span">{{msgItemData.user.name}}的现金红包</p>
          <span class="btn-get" @click.stop="getPacket('msgitem',msgItemData.luck_id)">领取红包</span>
        </span>
      </span>
    </div>
  </div>
</template>
<style scoped>
  .dms-nick {
    padding: 0px 6px;
    border-radius: 6px;
    line-height: 60px;
    vertical-align: middle;
    font-size: 26px;
  }

  .dms-message-info p time {
    display: inline-block;
    color: #fff;
    padding: 0px 3px;
  }

  .dms-message-info p label {
    display: inline-block;
  }

  .dms-message-info .dms-chat-msg {
    margin-left: 10px;
    margin-right: 10px;
    padding: 0px 15px 14px 0px;
    overflow: hidden;
  }

  .packet-box {
    padding: 16px 15px;
    background-color: #fa9d3b;
    border-radius: 6px;
    overflow: hidden;
    width: 65%;
    margin-top: 4px;
    display: block;
  }

  .talk-gave {
    font-size: 26px;
    color: #fff;
    padding: 10px 15px;
    position: relative;
    overflow: hidden;
    padding-left: 170px;
    background-image: url(/assets/v3/images/phone/packet.png);
    background-repeat: no-repeat;
    background-size: 150px;
    display: inline-block;
  }

  .talk-gave::before {
    width: 150px;
  }

  .dms-message-info p.talk-gave-span {
    float: left;
    color: #fff;
    height: 40px;
    line-height: 40px;
    display: block;
    overflow: hidden;
    width: 100%;
  }

  .talk-gave-i {
    position: absolute;
    left: 8px;
    top: 8px;
    width: 100px;
    height: 80px;
    line-height: 100px;
    text-align: center;
    color: #d7493d;
    font-size: 40px;
    display: block;
  }

  .btn-get {
    display: inline-block;
    background-color: #cd3d3d;
    padding: 0px 25px;
    border-radius: 6px;
    color: #fff;
    height: 54px;
    line-height: 54px;
    vertical-align: middle;
  }
</style>

<script>
  import * as types from "@/store/types";
  import msgItemMixinMobile from "@/mixins/msgItemMixinMobile";
  import gotpackMixinMobile from "@/mixins/gotpackMixinMobile";
  export default {
    props: ["msgItemData", "afterAppend","msgItemSty"],
    mixins: [gotpackMixinMobile, msgItemMixinMobile],
  }
</script>
