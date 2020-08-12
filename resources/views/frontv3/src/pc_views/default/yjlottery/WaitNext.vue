<template>
  <div id="WaitNext">
    <ul class="yj-wait-user">
      <li v-if="userInfo.role.f_lottery">
        <span class="yj-go yj-open yjbtn" @click="startYj">开启摇奖</span>
      </li>
      <li v-else> {{roomInfo.yjInfo.lotteryObj.titleMsg}}</li>

      <li>上期奖品：{{roomInfo.yjInfo.lotteryObj.prize_name || '暂无数据'}}</li>
      <li>上期中奖名单</li>
    </ul>
    <div class="win-user-list p_scroll" v-if="roomInfo.lastAwardList.users.length">
      <li v-for="(item,index) in roomInfo.lastAwardList.users" :key="index" class="before-user-list">
        <span> {{item.uid}} </span>
        <span>{{item.u_name}} </span>
      </li>
    </div>
    <div v-else>
      <li class="li-user-list">
        <span> 暂无数据！</span>
      </li>
    </div>
  </div>
</template>
<style scoped>
  .li-user-list {
    text-align: center;
  }

  #WaitNext {
    color: red;
  }

  .yj-wait-user {
    width: 100%;
  }

  .yj-wait-user li {
    text-align: center;
    width: 100%;
    font-size: 18px;
    color: #000;
    display: inline-block
  }

  .yj-wait-user li:nth-child(1) {
    margin-top: 75px;
  }

  .yj-wait-user li:nth-child(2) {
    margin-top: 5px;
    color: red;
  }

  .yj-wait-user li:nth-child(3) {
    font-weight: bold;
  }

  .win-user-list {
    margin: 0 auto;
    margin-top: 5px;
    height: 118px;
    /* overflow: hidden; */
    overflow: auto;
    width: 294px;
  }

  .win-user-list li {
    height: 20px;
    text-align: center;
    width: 98%;
    font-size: 14px;
    color: gray;
  }

  .before-user-list span {
    display: inline-block;
    width: 49%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .before-user-list span:nth-child(2) {
    text-align: left;
  }

  .yj-go,
  .yjbtn {
    display: inline-block;
    width: 130px;
    height: 42px;
    background: #FF8A00;
    font-size: 18px;
    text-align: center;
    line-height: 42px;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    name: 'WaitNext',
    methods: {
      startYj() {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          yjInfo: {
            yjStep: 4, //发起摇奖
          }
        })
      },
    }
  };
</script>