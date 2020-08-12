<template>
  <div class="danmu-warp danmubox">
    <div class="danmu-content" v-show="danmuRuning == 1">
      <span v-if="danmuData.msg" :style="{'color':danmuData.font_color}" v-html="fixEmoji(danmuData.msg,'chat-danmu')"></span>
    </div>
  </div>
</template>
<style scoped>
  .danmubox {
    position: fixed;
    top: 30%;
    overflow: hidden;
    z-index: 9;
  }

  .danmu-content span {
    display: inline-block;
    height: 60px;
    line-height: 60px;
    vertical-align: middle;
  }
</style>
<script>
  export default {
    data() {
      return {
        danmuRuning: 0,
        danmuList: null,
        danmuData: {}
      }
    },
    mounted() {
      dms.onMsg("danmu_msg", (top, data) => {
        this.runDanmu(data)
      });
    },
    methods: {
      runDanmu(msgData) {
        if (!this.danmuList) {
          this.danmuList = [];
        }
        if (msgData && msgData.msg) {
          this.danmuList.push(msgData);
        }

        if (this.danmuRuning) {
          return;
        }
        if (this.danmuList.length <= 0) {
          return;
        }

        var self = this;
        this.danmuData = this.danmuList.shift();
        var _confSpeed = parseInt(self.$t('100##弹幕滚动速度(秒,越大越快)', __FILE__) || 60);

        setTimeout(() => {
          this.danmuRuning = 1;
          var w_width = $(window).width(); //this.roomInfo.sizeConfig.clientWidth > 1080 ? this.roomInfo.sizeConfig.clientWidth : 1080; 
          var danmuLen = $('.danmu-content').width();
          var speed = (danmuLen + w_width) / _confSpeed * 1000;
          $('.danmu-content').css('margin-left', w_width);
          $('.danmu-content').animate({
            "margin-left": -danmuLen
          }, speed, 'linear', function () {
            self.danmuRuning = 0; //运行完毕
            self.danmuList.length && self.runDanmu();
          });
        }, 100)
      },
    },
  }
</script>