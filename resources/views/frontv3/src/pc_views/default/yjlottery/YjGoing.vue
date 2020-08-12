<template>
  <div id="YjGoing">
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
        <li class="count-down">倒计时：
          <span class="count-down-time">{{count}}</span>
        </li>
        <li>
          <span class="yj-go yj-copy" :data-clipboard-text="roomInfo.yjInfo.lotteryObj.content" @click="copyTo">复制</span>
        </li>
      </template>
    </ul>
  </div>
</template>
<style scoped>
  .yj-start,
  .yj-end li {
    text-align: center;
    font-size: 24px;
  }

  .yj-start li:nth-child(1) {
    margin-top: 80px;
    color: #000;
    font-size: 20px;
  }

  .yj-start li:nth-child(2) {
    font-size: 40px;
    color: #000;
    margin-top: 10px;
  }

  .yj-start .count-down {
    /* margin-top: 20px; */
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
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  var timer = null;
  export default {
    data() {
      return {
        count: '00:00'
      }
    },
    created() {
      this.countDownFun(this.roomInfo.yjInfo.countDown);
      this.$watch('roomInfo.yjInfo.countDown', (newVal, oldVal) => {
        this.countDownFun(newVal)
      })
    },

    methods: {
      countDownFun(_mTime) {
        var _type = this.roomInfo.yjInfo.lotteryObj.adder_id == this.userInfo.uid ? 1 : 2;
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
          self.count = dms.timeFormatStr(_totalTime * 1000, _type) || '0';
        }, 1000);
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
      }
    }
  };
</script>