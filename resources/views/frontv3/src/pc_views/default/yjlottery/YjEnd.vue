<template>
  <div id="YjEnd" class="yj-end">
    <ul class="yj-end">
      <template v-if="roomInfo.yjInfo.lotteryObj.adder_id == userInfo.uid">
        <li class="li-des">刷屏结束，是否开奖？</li>
        <li class='li-five'>
          <span v-if="btnState" class="yjbtn" @click="drawLottery">开始摇奖</span>
        </li>
      </template>
      <template v-else>
        <li class="li-des">刷屏结束，请等待开奖</li>
      </template>
    </ul>
  </div>
</template>
<style scoped>
  .yj-end {
    margin-top: 86px;
    width: 100%;
    text-align: center;
  }

  .li-des {
    margin-top: 60px;
    color: #000;
    font-size: 18px;
    text-align: center
  }

  .li-five {
    margin-top: 50px;
    text-align: center;
    padding-top: 7px;
  }

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
    data() {
      return {
        btnState: true
      }
    },
    methods: {
      drawLottery() {
        this.btnState = false;
        dms.LiveApi.drawLottery({
          lottery_id: this.roomInfo.yjInfo.lotteryObj.lottery_id
        }, resp => {
          var _con = resp.msg;
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            yjInfo: {
              lotteryObj: _con.lottery,
              win_user_list: _con.users,
              yjStep: 3, //中奖用户列表
            }
          })
        }, resp => {
          this.$layer.msg(resp.msg, { time: 2 })
        });
      },
    },
  };
</script>
