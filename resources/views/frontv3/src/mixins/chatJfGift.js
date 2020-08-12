import Vuex from "vuex";
import * as types from "@/store/types";
export default {
  data() {
    return {
      active: 0,
      showIndex: 0,
      curIsRobot: false,
    };
  },
  methods: {
    changeTab(item, index) {
      this.active = index;
    },
    showActive(curItem) {
      this.showIndex = curItem.gift_id;
    },
    realSendGift(obj, event) {
      var userId = this.userInfo.uid //用户id
      var _tempRobotList = this.roomInfo.robotsInfo.myrobotList //我的机器人列表
      var selNum = this.roomInfo.robotsInfo.cur_sel_Num //当前选中机器人的数量
      var selRobotId = this.roomInfo.robotsInfo.selRobotObj.cur_sel_robotid //当前默认选中机器人
      var isRobot = false;
      var robotOption = {}

      if (selNum > 0 && _tempRobotList.length > 0) {
        isRobot = true;
        for (var i = 0; i < selNum; i++) {
          if (_tempRobotList.length <= 0) {
            return;
          }
          var index = Math.floor(Math.random() * _tempRobotList.length); //在机器人的长度范围内生成一个随机索引
          robotOption = _tempRobotList[index]
          _tempRobotList.splice(index, 1) //
          userId = robotOption.uid;
          this.sendGift(obj, userId);
        }
      } else {
        if (selRobotId && _tempRobotList.length > 0) {
          isRobot = true;
          userId = selRobotId
        }
        this.sendGift(obj, userId);
      }
      this.curIsRobot = isRobot
    },
    sendGift(obj, userId) {
      dms.LiveApi.sendGift({
        gift_id: obj.gift_id,
        gift_num: 1,
        robot_id: this.curIsRobot ? userId : 0,
        room_id: this.roomInfo.room_id,
      }, (res) => {}, resp => {
        this.dialogMsgAlign(resp.msg);
      })

    }
  }
}