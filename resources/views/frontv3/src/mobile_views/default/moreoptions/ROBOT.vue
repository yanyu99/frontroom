<template>
  <div id="ROBOT">

    <div class="robot-box">
      <div class="robot-top">
        <p class="p-tit">机器人</p>
      </div>
      <div class="robot-con">
        <div class="robot-con-info">
          <span class="sp-robot-num">
            <select class="sel-robot-num" v-model="selectedNum">
              <template v-for="(item,index) in robotNum">
                <option :key="index" :value="item">
                  {{item == 0 ? '无':item}}
                  <!-- {{roomInfo.robotsInfo.cur_sel_Num ? roomInfo.robotsInfo.cur_sel_Num :item}} -->
                </option>
              </template>

            </select>
          </span>

          <span class="sp-robot">
            <select class="sel-robot" v-model="selectedId">
              <option value="">机器人</option>
              <template v-for="item in roomInfo.robotsInfo.myrobotList">
                <option :value="item.uid" :key="item.uid">
                  {{item.name}}
                </option>
              </template>
            </select>
          </span>

          <span class="sp-robot">
            <select class="sel-robot" v-model="selectedTime">
              <option value="0">默认</option>
              <template v-for="item in delayRobotTimeArr">
                <option :value="item" :key="item">
                  {{item}}秒
                </option>
              </template>
            </select>
          </span>

        </div>

      </div>
    </div>
  </div>
</template>
<style scoped>
  .p-tit {
    display: inline-block;
    color: #fe9901;
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    height: 100px;
    line-height: 100px;
    vertical-align: middle;
    border-bottom: 1px solid #e6e6e6;
    width: 100%;
  }

  .robot-con {
    margin: 0 auto;
  }

  .robot-box {
    width: 680px;
  }

  .robot-box span {
    display: inline-block;
    width: 206px;
    height: 68px;
    border: 1px solid #c9c9c9;
    border-radius: 6px;
  }

  .robot-box span:first-child {
    padding-right: 15px;
  }

  .robot-con-info {
    text-align: center;
    margin: 20px auto;
  }

  .robot-box span select {
    display: inline-block;
    width: 206px;
    height: 68px;
    /* border: 1px solid #c9c9c9; */
    font-weight: 400;
    font-style: normal;
    font-size: 30px;
    color: #333333;
    text-align: center;
    line-height: normal;
    border-radius: 6px;
  }

  .sp-robot-num {}

  .sp-robot {}
</style>

<script>
  import * as types from "@/store/types";
  const emptyRobot = { uid: '', name: '' }

  export default {
    data() {
      return {
        selectedNum: 0,
        selObj: emptyRobot,
        //robotNum: [1, 2, 5, 7, 10],
        delayRobotTimeArr: [10, 30, 50, 70, 100],
        selectedTime: 0
      };
    },
    created() {
      this.selectedNum = this.roomInfo.robotsInfo.cur_sel_Num || 0,
        this.selectedTime = this.roomInfo.robotsInfo.msg_delaytime || 0
      var tmp = this.roomInfo.robotsInfo.myrobotList.find(i => i.uid == this.roomInfo.robotsInfo.selRobotObj.cur_sel_robotid)
      this.selObj = tmp ? tmp : emptyRobot
    },
    updated() {
      var is_robot = false;
      var myRobotLen = this.roomInfo.robotsInfo.myrobotList.length
      if (myRobotLen && this.selectedNum > 0 || this.selObj.uid) {
        is_robot = true;
      }

      myRobotLen && this.$store.commit(types.UPDATE_ROOM_INFO, {
        is_robot: is_robot,
        robotsInfo: {
          cur_sel_Num: this.selectedNum,
          msg_delaytime: this.selectedTime,
          selRobotObj: {
            cur_sel_robotid: this.selObj.uid,
            cur_sel_robotname: this.selObj.name,
          },

        },
      });
    },
    computed: {
      robotNum() {
        var tmp = [];
        var _tmpRobotNumArr = this.baseConfig.sitecfg.robot_chat_selects;
        _tmpRobotNumArr = _tmpRobotNumArr.split(',');

        for (var i = 0; i < _tmpRobotNumArr.length; i++) {
          var n = _tmpRobotNumArr[i];
          n = parseInt(n);
          if (n >= 0) {
            tmp.push(n);
          }
        }
        return tmp;
      },
      selectedId: {
        get: function () {
          return this.selObj && this.selObj.uid ? this.selObj.uid : ''
        },
        set: function (newValue) {
          var tmp = this.roomInfo.robotsInfo.myrobotList.find(i => i.uid == newValue)
          this.selObj = tmp ? tmp : emptyRobot
        }
      },
    }
  };
</script>