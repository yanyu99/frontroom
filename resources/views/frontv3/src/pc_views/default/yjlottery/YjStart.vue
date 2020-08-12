<template>
  <ul class="yj-start">
    <li>刷屏内容：
      <input type="text" v-model="txtContent">
    </li>
    <li>刷屏时间：
      <input type="text" v-model="txtCountTime"> 分</li>
    <li>奖&emsp;&emsp;品：
      <input type="text" v-model="txtPrize">
    </li>
    <li>最大中奖人数：
      <input type="text" class='txt-win-num' v-model="txtWinNum">
    </li>
    <li class='li-five'>
      <span class="yj-go " @click="startlottery">发起摇奖</span>
    </li>
  </ul>
</template>
<style scoped>
  .yj-start {
    padding: 0px 20px;
    margin-top: 86px;
  }

  .yj-start li {
    display: inline-block;
    width: 100%;
    height: 30px;
    line-height: 30px;
    margin-bottom: 6px;
  }

  .yj-start li input {
    width: 181px;
    height: 30px;
    border: 1px solid #C6C6C6;
    text-indent: 2px;
  }

  .txt-win-num {
    width: 154px !important;
  }

  .li-five {
    text-align: center;
    padding-top: 7px;
  }

  .yj-go {
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
    data() {
      return {
        txtContent: '',
        txtWinNum: '',
        txtCountTime: '',
        txtPrize: '',
      }
    },
    methods: {
      startlottery() {
        dms.LiveApi.startLottery({
          content: this.txtContent,
          win_num: this.txtWinNum,
          count_down: this.txtCountTime,
          prize_name: this.txtPrize,
        }, resp => {
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            yjInfo: {
              lotteryObj: resp.lottery,
              countDown: resp.count_down,
              yjStep: 1, //摇奖进行中，开始倒计时
            }
          })
        }, resp => {
          this.$layer.msg(resp.msg, { time: 2 })
        });
      }
    },

  }
</script>