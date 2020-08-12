<template>
  <!-- <div id="YjContent" class="yj-box">
    <div class="yj-close" @click="closeLottery"></div>
    <div id="yj-content" class="yj-content">
      <wait-next v-if="roomInfo.yjInfo.yjStep == 2"></wait-next>
      <win-user v-if="roomInfo.yjInfo.yjStep ==3 "></win-user>
      <yj-going v-if="roomInfo.yjInfo.yjStep ==1"></yj-going>
      <yj-end v-if="roomInfo.yjInfo.yjStep ==0"></yj-end>
      <yj-start v-if="roomInfo.yjInfo.yjStep ==4"></yj-start>
    </div>
  </div> -->

  <div id="YjContent" class="yj-box">
    <div class="yj-close" @click="closeLottery"></div>
    <div id="yj-content" class="yj-content">

      <!-- 等待开启下一轮 -->
      <div id="WaitNext" v-if="roomInfo.yjInfo.yjStep == 2">

        <ul class="yj-wait-user">
          <li v-if="userInfo.role.f_lottery">
            <span class="yj-go yj-open yjbtn" @click="startYj">开启摇奖</span>
          </li>
          <li v-else> {{roomInfo.yjInfo.lotteryObj.titleMsg}}</li>

          <li>上期奖品：{{roomInfo.yjInfo.lotteryObj.prize_name || '暂无数据'}}</li>
          <li>上期中奖名单</li>
        </ul>
        <div class="win-user-list p_scroll" v-if="roomInfo.yjInfo.lastAwardList.length">
          <li v-for="(item,index) in roomInfo.yjInfo.lastAwardList" :key="index" class="before-user-list">
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

      <!-- 中奖用户列表 -->
      <div id="WinUser" v-if="roomInfo.yjInfo.yjStep == 3 ">
        <div class="win-list">
          <div class="pic-state" :class="{'win-list-shake':roomInfo.yjInfo.cur_result_type == 0,'win-prize':roomInfo.yjInfo.cur_result_type == 1, 'win-loser':roomInfo.yjInfo.cur_result_type == 2}">
          </div>

          <div class="win-line"></div>
          <div class="win-title">
            <span>中奖名单</span>
            <span class="prize-user-num">{{roomInfo.yjInfo.win_user_list.length}}人</span>
          </div>
          <ul v-if="roomInfo.yjInfo.win_user_list.length" class="win-name p_scroll">
            <li v-for="(item,index) in curWinData" :key="index">
              {{item.uid }} &emsp;&emsp; {{item.u_name}}
            </li>
          </ul>
        </div>
      </div>
      <!-- 摇奖开始，倒计时中 -->
      <div id="YjGoing" v-if="roomInfo.yjInfo.yjStep ==1">
        <ul class="yj-start">
          <li>摇奖刷屏开始啦！请在聊天区刷起：</li>
          <li class="yj-con">{{roomInfo.yjInfo.lotteryObj.content}}</li>
          <template v-if="roomInfo.yjInfo.lotteryObj.adder_id == userInfo.uid">
            <li class="yj-do-start-box">
              <span class="yj-do-start">开始摇奖
                <span class="initiator-down">{{count}}</span>
              </span>
            </li>
          </template>
          <template v-else>
            <li class="count-down">倒计时：{{count}}</li>
            <li>
              <span class="yj-go yj-copy" :data-clipboard-text="roomInfo.yjInfo.lotteryObj.content" @click="copyTo">复制</span>
            </li>
          </template>
        </ul>
      </div>

      <!-- 摇奖结束，等待开奖 -->
      <div id="YjEnd" class="yj-end" v-if="roomInfo.yjInfo.yjStep == 0">
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

      <!-- 发起摇奖 -->
      <ul class="yj-start" v-if="roomInfo.yjInfo.yjStep ==4">
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
    </div>
  </div>

</template>
<style scoped>
  .yj-box {
    width: 392px;
    height: 327px;
    background: url(/assets/img/yj/bg1.png) center center no-repeat;
    background-size: contain;
    position: relative;
  }

  .yj-box.another {
    width: 394px;
    height: 355px;
    background: url('/assets/img/yj/bg2.png') center center no-repeat;
  }

  .yj-close {
    width: 30px;
    height: 30px;
    position: absolute;
    top: 16px;
    right: 24px;
    cursor: pointer;
    background: url("/assets/img/yj/close.png") no-repeat left;
    z-index: 999;
  }

  .yj-content {
    position: absolute;
    margin-top: 1px;
    padding: 7px 38px;
    width: 100%;
  }

  /*waitnext====================*/
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


  /*winuser*/
  .win-list {
    /* width: 85%; */
    height: auto;
    background: #df3b39;
    margin: 0 auto;
    margin-top: 63px;
    padding-bottom: 22px;
  }

  .win-prize {
    background: url("/assets/img/yj/text2.png") no-repeat left;
  }

  .win-loser {
    background: url("/assets/img/yj/text1.png") no-repeat left;
  }

  .pic-state {
    width: 88%;
    height: 57px;
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
    background: url("/assets/img/yj/yj.gif") no-repeat left;
    line-height: 66px;
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
    height: 130px;
    background: #fff;
    border-radius: 4px;
    margin: 0 auto;
    /* overflow-y: scroll; */
    font-size: 28px;
    overflow: auto;

  }

  .win-name li {
    color: #000;
    height: 25px;
    line-height: 25px;
    padding: 0 40px;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 16px;
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


  /*yjend*/
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

  /*yjgoing*/
  .yj-start,
  .yj-end li {
    text-align: center;
    font-size: 24px;
  }

  #YjGoing li {
    display: flex;
    flex-direction: column;
    align-content: center;
    align-items: center
  }

  .yj-con {
    font-size: 24px;
    text-align: center;
  }

  .count-down {
    color: red;
  }

  .yj-do-start,
  .count-down {
    display: inline-block;
    padding: 0px 10px;
    height: 42px;
    font-size: 18px;
    text-align: center;
    line-height: 42px;
    border-radius: 4px;
    color: #fff;
    background: #B2B2B2;
    margin-top: 7px;
    cursor: pointer;
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
    margin-top: 5px;
  }

  /*yjstart*/
  .yj-start {
    padding: 0px 20px;
    margin-top: 86px;
    display: flex;
    flex-direction: column;
  }

  .yj-start li {
    display: flex;
    font-size: 16px;
    height: 30px;
    line-height: 30px;
    margin-bottom: 6px;
  }

  .yj-start li input {
    width: 180px;
    height: 30px;
    border: 1px solid #C6C6C6;
    text-indent: 2px;
  }

  .txt-win-num {
    width: 150px !important;
  }

  .yj-start .li-five {
    text-align: center;
    padding-top: 7px;
    margin-top: 0px;
    align-items: center;
    align-content: center;
    flex-direction: column;
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

  var timer = null;
  export default {
    data() {
      return {
        curWinData: [],
        btnState: true,
        count: '00:00',
        txtContent: '',
        txtWinNum: '',
        txtCountTime: '',
        txtPrize: '',
      };
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).css("overflow", "hidden")
      $("#" + id).addClass("bgborder");
      $("#" + id + "_mask").hide();
    },

    created() {
      this.countDownFun(this.roomInfo.yjInfo.countDown);
      this.$watch('roomInfo.yjInfo.countDown', (newVal, oldVal) => {
        this.roomInfo.yjInfo.yjStep == 1 && this.countDownFun(newVal)
      })

      this.$watch('roomInfo.yjInfo.yjStep', (newVal, oldVal) => {
        this.roomInfo.yjInfo.yjStep == 3 && this.userList();
      })
    },
    methods: {
      startYj() {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          yjInfo: {
            yjStep: 4, //发起摇奖
          }
        })
      },
      IsInArray(arr, val) {
        arr = arr || []
        for (var i = 0; i < arr.length; i++) {
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
      drawLottery() {
        this.btnState = false;
        dms.LiveApi.drawLottery({
          lottery_id: this.roomInfo.yjInfo.lotteryObj.lottery_id
        }, resp => {
          var _con = resp.msg;
        }, resp => {
          //发起失败
          this.$layer.msg(resp.msg, { time: 2 })
        });
      },
      closeLottery() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          lottery_show: false,
          curlayer_pop_id: "",
        });
      },
      countDownFun(_mTime) {
        var _type = 1 // this.roomInfo.yjInfo.lotteryObj.adder_id == this.userInfo.uid ? 1 : 2;
        var self = this;
        if (!_mTime) return;
        var _totalTime = _mTime;
        timer && clearInterval(timer);
        timer = setInterval(function () {
          if (_totalTime <= 0) {
            clearInterval(timer); //设置时间
            timer = null;
            return;
          }
          _totalTime = _totalTime - 1;
          console.log("_totalTime:" + _totalTime);
          self.count = dms.timeFormatStr(_totalTime * 1000, _type) || '0';
          console.log("_totalTime:" + _totalTime, "count:" + self.count);
        }, 1000);
      },

      startlottery() {
        var _uid = this.userInfo.uid;
        var _roomId = this.roomInfo.room_id;
        dms.LiveApi.startLottery({
          content: this.txtContent,
          win_num: this.txtWinNum,
          count_down: this.txtCountTime,
          prize_name: this.txtPrize,
        }, resp => {
        }, resp => {
          this.$layer.msg(resp.msg, { time: 2 })
        });
      },
      //复制
      copyTo() {
        var clipboard = new Clipboard(".yj-copy");
        clipboard.on("success", e => {
          clipboard.destroy(); // 释放内存
        });
        clipboard.on("error", e => {
          alert("浏览器不支持自动复制，请手动复制内容"); // 不支持复制
          clipboard.destroy(); // 释放内存
        });
      },
    },
  };
</script>