<template>
  <div id="WaitNext">
    <ul class="yj-wait-user">
      <li>{{roomInfo.yjInfo.lotteryObj.titleMsg}}</li>
      <li>上期奖品：{{roomInfo.yjInfo.lotteryObj.prize_name || '暂无数据'}}</li>
      <li>上期中奖名单</li>
      <li>
        <div v-for="(item,index) in roomInfo.yjInfo.lastAwardList" :key="index" class="before-user-list">
          <span> {{item.uid}} </span>
          <span>{{item.u_name}} </span>
        </div>
      </li>
    </ul>
  </div>
</template>
<style scoped>
  .yj-wait-user {
    width: 100%;
  }

  .yj-wait-user li {
    text-align: center;
    width: 100%;
    font-size: 28px;
    color: #000;
  }

  .yj-wait-user li:nth-child(1) {
    margin-top: 150px;
  }

  .yj-wait-user li:nth-child(2) {
    margin-top: 10px;
    color: red;
  }

  .yj-wait-user li:nth-child(3) {
    font-weight: bold;
  }

  .yj-wait-user li:nth-child(4) {
    width: 76%;
    margin: 0 auto;
    margin-top: 10px;
    height: 180px;
    overflow-y: scroll;
  }


  .before-user-list {
    height: 40px;
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
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
  };
</script>