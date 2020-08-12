<template>
  <div id="YjStart">
    <ul class="yj-start">
      <li>摇奖刷屏开始啦！请在聊天区刷起：</li>
      <li class="yj-con">{{roomInfo.yjInfo.lotteryObj.content}}</li>
      <li class="count-down">倒计时：
        <span class="count-down-time">{{count}}</span>
      </li>
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
    margin-top: 180px;
    color: #000;
    font-size: 28px;
  }

  .yj-start li:nth-child(2) {
    font-size: 40px;
    color: #000;
    margin-top: 21px;
  }

  .yj-start .count-down {
    margin-top: 20px;
  }

  .count-down {
    color: red;
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
          self.count = dms.timeFormatStr(_totalTime * 1000, 2) || '0';
        }, 1000);
      }
    }
  };
</script>