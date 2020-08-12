<template>
  <!-- 用户信息查看 -->
  <div class="userinfo-check-box" id="userinfo-check-box" :style="{ position:'absolute',left:'10px',top:'20%'}">
    <div class="userinfo-check-top">
      <img :src="roomInfo.selectUser.pic? roomInfo.selectUser.pic:''" title=''>
      <span>
        <font>{{roomInfo.selectUser.name}}</font>
        <label v-if="roomInfo.selectUser.ip">IP：{{roomInfo.selectUser.ip}}</label>
        <address v-if="roomInfo.selectUser.ip_location">地域：{{roomInfo.selectUser.ip_location}}</address>
        <template v-if="roomInfo.selectUser.room_id != 0 && (roomInfo.room_id  == roomInfo.parent_room_id || roomInfo.room_id == roomInfo.selectUser.room_id ) ">
          <label>当日在线：
            <font style="color:#FBCA00">{{todayTime}}</font>
          </label>
          <label>累计在线：
            <font style="color:#FBCA00">{{allTime}}</font>
          </label>
        </template>
      </span>
      <div class="close-layer" @click="closeLayer"></div>
    </div>

    <template v-if="!roomInfo.selectUser.robot ">
      <template v-if="roomInfo.selectUser.room_id != 0 && (roomInfo.room_id  == roomInfo.parent_room_id  || roomInfo.room_id == roomInfo.selectUser.room_id ) ">
        <div class="userinfo-check-bot">
          <span v-if="userInfo.role.f_ip" @click="killIp">{{killipText}}</span>
          <span v-if="userInfo.role.f_kick" @click="lookVideo">{{lookvideoText}}</span>
          <span v-if="userInfo.role.f_kick" @click="userKick">{{kickText}}</span>
          <span v-if="userInfo.role.f_gag" @click="userGag">{{gagText}}</span>
        </div>
      </template>
    </template>
  </div>
</template>

<style scoped>
  .userinfo-check-box {
    position: absolute;
    z-index: 999;
    background-color: #fff;
    width: 90%;
    padding: 10px;
    border: 1px solid;
    height: 330px;
    border-radius: 4px;
  }

  .close-layer {
    background: red;
    color: #fff !important;
    border-radius: 40px;
    line-height: 40px;
    text-align: center;
    height: 40px;
    width: 40px;
    font-size: 28px;
    padding: 1px;
    top: -8px;
    right: -8px;
    position: absolute;
    z-index: 99;
  }

  .close-layer::before {
    content: "\2716";
  }

  .userinfo-check-box .userinfo-check-top {
    display: -webkit-box;
    /* Chrome 4+, Safari 3.1, iOS Safari 3.2+ */
    display: -moz-box;
    /* Firefox 17- */
    display: -webkit-flex;
    /* Chrome 21+, Safari 6.1+, iOS Safari 7+, Opera 15/16 */
    display: -moz-flex;
    /* Firefox 18+ */
    display: -ms-flexbox;
    /* IE 10 */
    display: flex;
    /* Chrome 29+, Firefox 22+, IE 11+, Opera 12.1/17/18, Android 4.4+ */
    height: 230px;
  }

  .userinfo-check-box .userinfo-check-top img {
    -moz-box-flex: 1;
    -webkit-box-flex: 1;
    box-flex: 1;
    border-radius: 4px;
    width: 168px;
    height: 168px;
  }

  .userinfo-check-top span {
    margin-left: 10px;
    font-size: 30px;
    height: 48px;
    line-height: 48px;
    vertical-align: middle;
  }

  .userinfo-check-top span label {
    color: #8d8d8d;
    display: block;
  }

  .userinfo-check-box .userinfo-check-bot {
    height: 68px;
    margin-top: 10px;
  }

  .userinfo-check-box .userinfo-check-bot span {
    display: inline-block;
    padding: 0px 10px;
    background-color: #fe9901;
    color: #fff;
    /* width: 150px; */
    height: 68px;
    border-radius: 8px;
    font-size: 28px;
    line-height: 68px;
    vertical-align: middle;
    text-align: center;
    padding: 0px 27px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import usefunMixin from "@/mixins/usefunMixin"
  export default {
    mixins: [usefunMixin],
  };
</script>