<template>
  <div id="WinUser">
    <div class="win-list">
      <div :class="{'win-list-shake':roomInfo.yjInfo.cur_result_type == 0,'win-prize':roomInfo.yjInfo.cur_result_type == 1,
      'win-loser':roomInfo.yjInfo.cur_result_type == 2}">
        <img :src="roomInfo.yjInfo.cur_result_type == 1 ? '/assets/img/yj/text2.png' :
         (roomInfo.yjInfo.cur_result_type == 2 ? '/assets/img/yj/text1.png' :'/assets/img/yj/yj.gif')" alt="">
      </div>

      <div class="win-line"></div>
      <div class="win-title">
        <span>中奖名单</span>
        <span class="prize-user-num">{{roomInfo.yjInfo.win_user_list.length}}人</span>
      </div>
      <ul class="win-name">
        <li v-for="(item,index) in curWinData" :key="index">
          {{item.uid}} &emsp;&emsp; {{item.u_name}}</li>
      </ul>
    </div>
  </div>
</template>
<style scoped>
  .win-list {
    width: 85%;
    height: auto;
    background: #df3b39;
    margin: 0 auto;
    margin-top: 110px;
    padding-bottom: 22px;
  }

  .win-prize,
  .win-loser {
    width: 88%;
    height: 115px;
    border-radius: 4px;
    margin: 0 auto;
    overflow: hidden;
    color: #000;
    text-align: center;
    font-size: 24px;
    line-height: 120px;
  }

  .win-prize img {
    width: 100%
  }

  .win-loser img {
    width: 100%
  }

  .win-list-shake {
    width: 88%;
    height: 115px;
    border-radius: 4px;
    margin: 0 auto;
    overflow: hidden;
    color: #000;
    text-align: center;
    line-height: 66px;
    font-size: 24px;
  }

  .win-list-shake.active {
    display: none;
  }

  .win-list-shake img {
    width: 100%;
    height: 100%;
  }

  .win-name {
    width: 88%;
    height: 230px;
    background: #fff;
    border-radius: 4px;
    margin: 0 auto;
    overflow-y: scroll;
    font-size: 28px
  }

  .win-name::-webkit-scrollbar {
    display: none;
  }

  .win-name li {
    color: #000;
    height: 40px;
    line-height: 40px;
    padding: 0 40px;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .win-list-shake li {
    color: #000;
    height: 41px;
    line-height: 41px;
    padding-left: 24px;
    text-align: left;
    font-size: 24px;
  }

  .win-line {
    width: 88%;
    height: 1px;
    border-top: 1px dashed #e26666;
    margin: 0 auto;
    margin-top: 12px;
  }

  .win-title {
    width: 88%;
    height: 31px;
    line-height: 30px;
    color: #ffeb3b;
    font-size: 18px;
    font-weight: bold;
    margin: 0 auto;
  }

  .win-title span {
    display: inline-block;
    width: 49%;
  }

  .win-title span:nth-child(1) {
    text-align: left;
  }

  .win-title span:nth-child(2) {
    text-align: right;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        curWinData: [],
      };
    },
    created() {
      this.userList();
    },
    methods: {
      IsInArray(arr, val) {　
        arr = arr || []
        for (var i = 0; i < arr.length ; i++) {
          if (arr[i] == val) {
            return true;
          }
        }
        return false;
      },


      userList() {
        var u_index = 0;
        var _winUserList = this.roomInfo.yjInfo.win_user_list.slice(); //用户列表
        var _arr = this.roomInfo.yjInfo.win_user_uids; // 中奖用户id

        if (timer != null) {
          clearInterval(timer);
          timer = null;
        }
        const _data = () => { //异步每隔1spush一条 
          this.curWinData.push(_winUserList[u_index]);
          u_index++;

          if (u_index >= _winUserList.length || !_winUserList.length) {
            clearInterval(timer);
            timer = null;
            setTimeout(() => {
              this.$store.commit(types.UPDATE_ROOM_INFO, {
                yjInfo: {
                  cur_result_type: this.IsInArray(_arr, this.userInfo.uid) ? 1 : 2, //当前用户是否中奖
                }
              })
            }, 1000)
          }
        }
        var timer = setInterval(_data, 2000);
      },
    },
  };
</script>