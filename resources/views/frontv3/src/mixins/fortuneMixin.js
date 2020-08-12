import Vuex from "vuex";
import * as types from "@/store/types";

export default {
  data() {
    return {
      lastRotate: 0,
      actvieIndex: 0,
      __runing__: false,

      rotate_angle: 0, //将要旋转的角度
      rotate_angle_pointer: 0, //指针将要旋转的度数
      rotate_transition: "transform 6s ease-in-out", //初始化选中的过度属性控制
      rotate_transition_pointer: "transform 12s ease-in-out", //初始化指针过度属性控制
      click_flag: true //是否可以旋转抽奖
    };
  },

  created() {
    var _trans = (360 / 8) * this.baseConfig.jfcfg.jf_default_prize - 22.5;
    this.rotate_angle_pointer = "rotate(" + _trans + "deg)";
    this.lastRotate = (360 / 8) * this.baseConfig.jfcfg.jf_default_prize - 45;
    this.$store.dispatch(types.LOAD_FORTUNEINFO)
  },
  methods: {
    chou() {
      if (this.__runing__) return;
      this.__runing__ = true;

      dms.LiveApi.doFortune({}, resp => {
        this.rotating(resp.data.got);
      }, resp => {
        setTimeout(function () {
          this.__runing__ = false;
        }, 500);
        this.dialogMsgAlign(resp.msg, "提示");
      })
    },

    //旋转
    rotating(index) {
      if (!this.click_flag) return;
      var during_time = parseInt(Math.random() * 5 + 4);
      var rand_circle = parseInt(Math.random() * 5 + 3); // 附加多转几圈，2-3
      this.click_flag = false; // 旋转结束前，不允许再次触发
      var tmp_rotate_angle = rand_circle * 360 + 360 - (index - 1) * 45;
      var _tmp_rotate_angle = tmp_rotate_angle + this.lastRotate;
      this.lastRotate += parseInt(tmp_rotate_angle / 360) * 360;

      this.rotate_transition = "transform " + during_time + "s ease-in-out";
      this.rotate_angle = "rotate(" + _tmp_rotate_angle + "deg)";

      // 旋转结束后，允许再次触发
      setTimeout(() => {
        this.__runing__ = false;
        this.click_flag = true;
        this.winning(index);
      }, during_time * 1000);
    },
    //中奖函数，需传入中奖结果 string
    winning(id) {
      dms.LiveApi.resultFortune({ prize_id: id }, resp => {
        this.dialogMsgAlign(resp.msg, "提示");
      });
    },

  }
};