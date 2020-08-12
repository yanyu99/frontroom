import * as types from "@/store/types"
import layercommMixinPc from "@/mixins/layercommMixinPc"

var videoCountDownBar = null;
export default {
  mixins: [layercommMixinPc],
  data() {
    return {
      countdownTime: "",
      isClickClose: false,
      isFirst: true,
    }
  },
  mounted() {
    this.startPopVisitFunc()
  },
  methods: {
    _initHtml(timeStr) { //生成定时器代码
      //以冒号拆分 如果秒
      var timeHtml = '';
      var timeArr = timeStr.split(':');
      if (!timeArr || timeArr.length == 0) {
        timeArr = "00:00:00:00"
      }
      for (let i = 0; i < timeArr.length; i++) {
        for (let j = 0; j < timeArr[i].length; j++) {
          timeHtml += "<span class='sp-time-item'>" + timeArr[i][j] + "</span>"
          if (timeArr[i].length - 1 == j && i != timeArr.length - 1) {
            timeHtml += "<span class='sp-spl'>:</span>"
          }
        }
      }
      return timeHtml
    },

    startPopVisitFunc() {
      var popType = parseInt(this.baseConfig.logincfg.login_pop) //0关闭  1开启不可关闭 2开启可关闭
      const _chronograph = (_time, type) => {
        var type = type || parseInt(this.baseConfig.logincfg.login_pop);

        var initTime = (type == 4 && !this.isClickClose) ? 0 : _time * 1000
        this.countdownTime = this._initHtml("00:00:00:00");
        //开始倒计时并显示
        videoCountDownBar = setInterval(() => {
          if (initTime <= 0) {
            this.countdownTime = this._initHtml("00:00:00:00");
            videoCountDownBar && clearInterval(videoCountDownBar);
            videoCountDownBar = null;
            //播放器暂停
          } else {
            initTime -= 1000
            var timeStr = dms.timeFormat(initTime, 'd:h:m:s')
            this.countdownTime = this._initHtml(timeStr)
          }
        }, 1000);

        //计时结束，弹出框提示,关闭视频，记录当前访问的人数

        setTimeout(() => {
          window.LIVE_PLAT == 'pc' ? this.pcTimeOut(type) : this.mobileTimeOut(type)
          self.$store.state.roomInfo.is_show_logintips = type == 3 ? false : true
          hideVideo();
          (popType == 1 || popType == 5) && dms.setCookie("ws_visitors_remind", -1, 30 * 24 * 60 * 60 * 1000);
        }, initTime)
      }

      var timeNum = parseInt(this.baseConfig.logincfg.login_pop_ts); // 系统配置 剩余可观看时间 单位为秒
      var visitorsNum = 0;
      if (popType == 1 || popType == 5) { // 弹出不可关闭
        visitorsNum = dms.getCookie("ws_visitors_remind"); // 读 cookie 判断上次 visitorsNum 是否为 -1
        visitorsNum = parseInt(visitorsNum)
        visitorsNum = isNaN(visitorsNum) ? 0 : visitorsNum
        if (visitorsNum == -1 || parseInt(this.baseConfig.logincfg.login_pop_ts) == 0) {
          _chronograph(0); // 延时 0ms 倒计时 弹出 登录框
          return;
        }
      }
      var remainVistTime = visitorsNum;
      // 判断 cookie 中 剩余时间 是否正确
      timeNum = remainVistTime > 0 && remainVistTime <= timeNum ? remainVistTime : timeNum;
      _chronograph(timeNum);

      if (popType == 1 || popType == 5) { //1开启不可关闭
        var leftSecond = timeNum;
        var interTimer = setInterval(function () {
          leftSecond--;
          if (leftSecond < 0) {
            clearInterval(interTimer);
          }
        }, 1000)

        window.onbeforeunload = function () { //在刷新或关闭时调用
          if (visitorsNum != -1) {
            dms.setCookie("ws_visitors_remind", leftSecond, 24 * 60 * 60 * 1000);
          }
        }
      }

      if (popType == 2 || popType == 4) { //弹出可关闭
        var self = this;
        $('.login-tips-wrap .login-close').bind('click', function (e) {
          self.isClickClose = true;
          self.$store.state.roomInfo.is_show_logintips = false;
          showVideo();
          _chronograph(timeNum);
        });
      }
    },
    toLogin(valTime) {
      if (this.baseConfig.syscfg.reg_mod == 2) {
        this.popShow('CouponLogin', { noClose: valTime || false })
      } else {
        this.popShow('Login', { noClose: valTime || false })
      }
    },
    pcTimeOut(type) {
      if (type == 3) {
        this.isFirst && this.toLogin(true);
        this.isFirst = false;
        return;
      }
      if (type == 5) {
        ROP.Leave();
        this.$layer.close(this.roomInfo.curlayer_pop_id);
        window.location.hash = '#/login';
        return;
      }
    },
    mobileTimeOut(type) {
      if (type == 3) { //弹出登录页
        if (this.userInfo.logined) {
          window.location.hash = '#/usermain';
          return;
        }
        let _id = this.$layer.iframe({
          content: {
            content: UserInfos,
            parent: this,
            data: {
              check: "我是参数"
            }
          },
          area: ["95%"]
        });
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_pop_curBoxId: _id
        })
        $('.vl-notify-mask').css('pointer-events', 'none')
      }
      if (type == 5) {
        ROP.Leave();
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
        window.location.hash = '#/login';
        return;
      }
    },
  },
}