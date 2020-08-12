import * as types from "@/store/types"
export default {
  methods: {
    //签到
    userPast() {
      var _tempRobotList = this.roomInfo.robotsInfo.myrobotList.slice()
      var userId = this.roomInfo.robotsInfo.selRobotObj.cur_sel_robotid //当前默认选中机器人
      var selNum = this.roomInfo.robotsInfo.cur_sel_Num //当前选中机器人的数量

      this.isBothRobot = false;
      if (selNum > 0 && _tempRobotList.length > 0) {
        this.isBothRobot = true;

        for (var i = 0; i < selNum; i++) {
          if (_tempRobotList.length <= 0) {
            return;
          }
          var index = Math.floor(Math.random() * _tempRobotList.length);
          var robotOption = _tempRobotList[index]
          _tempRobotList.splice(index, 1)
          userId = robotOption.uid;

          var _params = {
            'robot_id': userId
          }
          this.realPast(_params);
        }
      } else {
        this.realPast();
      }
    },

    realPast(_params) {
      dms.LiveApi.sendPast(_params, resp => {
        if (this.isBothRobot) return;
        $("#idUserPastRed").hide();
      }, resp => {
        if (this.isBothRobot) return;
        if (resp.code == 401) {
          //弹出登录 根据当前模式弹出登录框
          this.baseConfig.syscfg.reg_mod == 2 ? this.popShow('CouponLogin') : this.popShow('Login')
        } else {
          dialog({
            title: "提示",
            content: resp.msg,
            quickClose: true
          }).show();
        }
      });
    },
  }
}