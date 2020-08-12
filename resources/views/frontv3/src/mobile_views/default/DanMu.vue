<template>
  <div class="danmubox">
    <div class="danmu-msg danmu-content" style="color:#ffff00" v-show="danmuRuning == 1">
      <span v-if="danmuData.msg"  v-html="fixEmoji(danmuData.msg,'chat-danmu')"></span>
    </div>
  </div>
</template>
<style scoped>
  .slide-fade-enter-active {
    transition: all 0s linear;
  }

  .slide-fade-leave-active {
    transition: all .0s linear;
    /* transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0); */
  }

  .slide-fade-enter,
  .slide-fade-leave-to {
    /* transform: translateX(10px); */
    opacity: 0;
  }

  .danmubox {
    position: absolute;
    width: 100%;
    top: 45%;
    height: 50px;
  }

  .danmu-msg {
    position: relative;
    right: 0px;
    top: 0px;
    display: inline;
    z-index: 1000;
    font-size: 40px;
    font-weight: bold;
    white-space: nowrap;
    /* width: 100%; */
    height: 50px;
    background: transparent;
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
        this.danmuRuning = 1;
        var w_width = $(window).width();
        // var _confSpeed = parseInt(self.$t('100##弹幕滚动速度(秒)', __FILE__) || 60);
  
        var speed = ($('.danmu-content').width() + w_width) / 60 * 1000;

        $('.danmu-content').css('margin-left', w_width);
        $('.danmu-content').animate({
          "margin-left": -$('.danmu-content').width()
        }, speed, 'linear', function () {
          self.danmuRuning = 0; //运行完毕
          if (self.danmuList.length) {
            self.runDanmu();
          }
        });
      },
    },
  }
</script>