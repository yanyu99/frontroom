<template>
  <div class="robot_auto_box" id="RobotAutoModal">
    <div class="robot_auto_title">
      机器人自动发言
    </div>
    <span class="robot_auto_close" @click="closePop">
      <img src="/assets/img/close.png" alt="">
    </span>
    <p class="robot_auto_notice">*机器人会以所设置的文字发言内容和所选彩条随机发言</p>
    <div class="robot_auto_con">
      <h5>发言内容：
        <span class="robot_tip">（多条发言以回车键分隔）</span>
      </h5>
      <textarea autofocus="autofocus" name="" id="robot_auto_text" v-model="textStr"></textarea>
      <div>
        <h5>彩条选择：</h5>
        <div class="robot_caitiao">
          <template v-for="item in ctArr ">
            <span :key="item.name">
              <input type="checkbox" :id="item.name" :test="item.checked" :value="item.name" v-model="selCaiTiaoArr" />
              <i :style="{'background-image':'url('+item.iconUrl+')'}"></i>
            </span>
          </template>
        </div>
      </div>
      <div class="robot_speak_interval">
        <h5>发言间隔：
          <span>
            <input type="text" class="robot_min_time" v-model="minTime" @keyup="minTime=minTime.replace(/\D/gi,'')">至
            <input type="text" class="robot_max_time" v-model="maxTime" @keyup="maxTime=maxTime.replace(/\D/gi,'')">秒
            <span class="robot_time_tip">最小10秒，最大3600秒</span>
          </span>
        </h5>
      </div>
      <div>
        <h5 style="line-height:20px;">
          <span style="vertical-align: 12px;">开启自动发言：</span>
          <input class="mui-switch mui-switch-anim" type="checkbox" id="robot_switch" v-model="isRobotEnable" />
        </h5>
      </div>
    </div>
    <div class="robot_auto_ok">
      <button class="robot_confirm" type="button" @click="robotAutoSend">确定</button>
    </div>
  </div>
</template>
<style scoped>
  .robot_auto_close {
    background: url('/assets/img/close.png') no-repeat left;
  }

  /* 机器人自动发言 */

  .robot_auto_box {
    width: 500px;
    height: 501px;
    background: #fff;
  }

  .robot_auto_title {
    width: 90%;
    height: 58px;
    border-bottom: 1px solid #E4E4E4;
    font-size: 18px;
    text-align: center;
    line-height: 58px;
    margin: 0 auto;
    color: #515151;
    font-weight: bold;
  }

  .robot_auto_close {
    position: absolute;
    top: 17px;
    right: 15px;
    display: block;
    width: 18px;
    height: 18px;
    cursor: pointer;
  }

  .robot_auto_close img {
    width: 100%;
    height: 100%;
  }

  .robot_auto_notice {
    color: #797979;
    width: 90%;
    margin: 10px auto;
    font-size: 14px;
  }

  .robot_auto_con {
    width: 90%;
    height: 325px;
    margin: 0 auto;
  }

  .robot_auto_box h5 {
    font-size: 14px;
    color: #333333;
    font-weight: bold
  }

  .robot_tip {
    font-weight: normal;
    color: #FF6600;
  }

  .robot_auto_box textarea {
    border: 1px solid #A9A9A9;
    width: 100%;
    height: 130px;
    resize: none;
    color: #000;
    padding-left: 2px;
  }

  .robot_caitiao span i {
    /* background-image: url('/assets/v2/img/v2/chatIcon.png?v=3'); */
    padding: 4px 14px;
  }

  .robot_caitiao span {
    display: inline-block;
    height: 28px;
    line-height: 28px;
    margin-right: 5px;
    width: 55px;
  }

  .robot_caitiao span input {
    margin-right: 7px;
    cursor: pointer;
  }

  .robot_speak_interval input {
    width: 50px;
    height: 28px;
    border: 1px solid #A9A9A9;
    margin-right: 5px;
    padding-left: 2px;
  }

  .robot_speak_interval span {
    font-weight: normal;
  }

  .robot_time_tip {
    color: #FF6600
  }

  /* 开关 */

  .mui-switch {
    width: 52px;
    height: 32px;
    position: relative;
    border: 1px solid #dfdfdf;
    background-color: #fdfdfd;
    box-shadow: #dfdfdf 0 0 0 0 inset;
    border-radius: 30px;
    background-clip: content-box;
    display: inline-block;
    -webkit-appearance: none;
    user-select: none;
    outline: none;
  }

  .mui-switch:before {
    content: '';
    width: 30px;
    height: 30px;
    position: absolute;
    top: 0px;
    left: 0;
    border-radius: 30px;
    background-color: #fff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
    outline: none;
  }

  .mui-switch:checked:before {
    left: 20px;
  }

  .mui-switch.mui-switch-anim {
    transition: border cubic-bezier(0, 0, 0, 1) 0.4s, box-shadow cubic-bezier(0, 0, 0, 1) 0.4s;
  }

  .mui-switch.mui-switch-anim:before {
    transition: left 0.3s;
  }

  .mui-switch.mui-switch-anim:checked {
    box-shadow: #64bd63 0 0 0 16px inset;
    background-color: #64bd63;
    transition: border ease 0.4s, box-shadow ease 0.4s, background-color ease 1.2s;
  }

  .mui-switch.mui-switch-anim:checked:before {
    transition: left 0.3s;
  }

  #robot_switch {
    outline: none;
    cursor: pointer;
  }

  .robot_auto_ok {
    width: 90%;
    height: 30px;
    border-top: 1px solid #E4E4E4;
    margin: 0 auto;
    text-align: center
  }

  .robot_auto_ok button {
    width: 126px;
    height: 40px;
    background: #09ADF2;
    color: #fff;
    font-size: 16px;
    text-align: center;
    line-height: 40px;
    margin-top: 19px;
    border-radius: 4px;
    cursor: pointer;
  }

  .auto-btn-checked {
    background-color: orange !important;
  }
</style>
<script>
  import Vuex from "vuex"
  import * as types from "@/store/types"
  var autoRobotTimer = null;
  var autoRobotDelay = 1;

  export default {
    data() {
      return {
        textStr: '',
        minTime: 0,
        maxTime: 0,
        selCaiTiaoArr: [],
        isRobotEnable: true,
        ctArr: []
      }
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
    },
    created() {
      this.textStr = this.roomInfo.autoRobotConfig.textStr;
      this.minTime = this.roomInfo.autoRobotConfig.minTime;
      this.maxTime = this.roomInfo.autoRobotConfig.maxTime;
      var _ctArr = this.roomInfo.autoRobotConfig.caitiaoList;
      _ctArr.filter(i => {
        if (i.checked) {
          this.selCaiTiaoArr.push(i.name)
        }
      })

      this.getCaitiaoData();
    },
    methods: {
      robotAutoSend() {
        var minTime = parseInt(this.minTime);
        var maxTime = parseInt(this.maxTime);
        if (isNaN(minTime) || minTime < 10) {
          alert("发言间隔最小10秒!");
          return;
        }
        if (isNaN(maxTime) || maxTime > 3600) {
          alert("发言间隔最大3600秒!");
          return;
        }
        if (minTime > maxTime) {
          alert("发言间隔最小值不能大于间隔最大值！");
          return;
        }
        var _txtSendStr = this.textStr;
        if (!this.selCaiTiaoArr.length && !$.trim(_txtSendStr).length) {
          alert("发送消息不为空！");
          return;
        }

        var _caitiaoList = []; //彩条信息
        var caiTiaoArr = this.roomInfo.autoRobotConfig.caitiaoList;
        caiTiaoArr.forEach(ele => {
          var _checked = this.selCaiTiaoArr.filter(i => i == ele.name).length;
          _caitiaoList.push({
            tag: ele.tag,
            name: ele.name,
            checked: _checked ? 1 : 0,
            type: 2
          })
        });

        autoRobotDelay = 1;
        var _isRobotEnable = this.isRobotEnable;
        var _autoRobotConfig = {};
        _autoRobotConfig.caitiaoList = _caitiaoList;
        _autoRobotConfig.textStr = _txtSendStr;
        _autoRobotConfig.minTime = parseInt(minTime);
        _autoRobotConfig.maxTime = parseInt(maxTime);

        this.$store.commit(types.UPDATE_ROOM_INFO, {
          autoRobotConfig: {
            caitiaoList: _caitiaoList,
            textStr: _txtSendStr,
            minTime: parseInt(minTime),
            maxTime: parseInt(maxTime),
            //..._autoRobotConfig
          },
          autoRobotEnable: _isRobotEnable,
        })
        this.initRobotAutoTimer();
        dms.LiveApi.saveAutoMsg(_autoRobotConfig, resp => {
          this.$layer.close(this.roomInfo.curlayer_pop_id)
        }, resp => {
          console.warn(resp.msg)
        })
      },
      initRobotAutoTimer() {
        var autoRobotEnable = this.roomInfo.autoRobotEnable;
        console.warn("initRobotAutoTimer autoRobotEnable", this.roomInfo.autoRobotEnable, ",autoRobotTimer:", autoRobotTimer);
        if (autoRobotTimer) {
          if (!autoRobotEnable) {
            clearInterval(autoRobotTimer);
            autoRobotTimer = null;
          }
          return
        }
        autoRobotTimer = setInterval(() => {
          if (!autoRobotEnable) {
            return;
          }

          if (autoRobotDelay > 0) {
            autoRobotDelay -= 1;
          }

          if (autoRobotDelay == 0) {
            this.robotSendMsg();
            var randTmp = Math.random() * (this.roomInfo.autoRobotConfig.maxTime - this.roomInfo.autoRobotConfig.minTime);
            autoRobotDelay = parseInt(this.roomInfo.autoRobotConfig.minTime) + parseInt(randTmp);
          }
          console.log("autoRobotDelay==========", autoRobotDelay);
        }, 1000);
      },

      //机器人自动发言
      robotSendMsg() {
        if (!this.roomInfo.autoRobotEnable) {
          console.warn("robotSendMsg autoRobotEnable", this.roomInfo.autoRobotEnable);
          return;
        }
        var _selCaitiaoArr = this.roomInfo.autoRobotConfig.caitiaoList.filter(function (i) {
          return i.checked == 1
        })

        var _txtStr = $.trim(this.roomInfo.autoRobotConfig.textStr);
        var _txtMsgArr = _txtStr.length ? _txtStr.split(/[\n,]/g) : [];
        var _tmpArr = [];

        for (var i = 0; i < _txtMsgArr.length; i++) {
          _tmpArr.push({
            name: _txtMsgArr[i],
            type: 1,
          })
        }
        var msgArr = _selCaitiaoArr.concat(_tmpArr);
        var _curSendMsg = null;
        var idx = Math.floor(Math.random() * 65537) % msgArr.length; //生成的随机数
        _curSendMsg = msgArr[idx];

        var robotList = this.roomInfo.robotsInfo.myrobotList.slice();
        var _index = Math.floor(Math.random() * 65537) % robotList.length;
        var robotOption = robotList[_index];
        var userId = robotOption.uid;
        var msgObj = {
          uid: userId,
          name: robotOption.name,
          avatar: robotOption.pic,
          role_id: robotOption.role_id,
          robotId: userId,
          meClass: "",
          isRobot: true,
          type: _curSendMsg.type,
          message: _curSendMsg.type == 2 ? '[' + (types.caitiaoArr.filter(i => i.tag == _curSendMsg.tag)[0].imgUrl || '') + ']' : _curSendMsg.name,
        };
        this.$store.dispatch(types.DO_MSG_SEND_REAL, {
          initParamsData: msgObj
        })
      },
      closePop() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
      getCaitiaoData() {
        var _caitiaoArr = types.caitiaoArr;
        var _tmpArr = this.roomInfo.autoRobotConfig.caitiaoList; // types.caitiaoArr.slice();
        _tmpArr.forEach(ele => {
          _caitiaoArr.forEach(ct => {
            if (ele.tag == ct.tag) {
              ele.iconUrl = ct.iconUrl
            }
          })
        });
        this.ctArr = _tmpArr
      },
    },
  }
</script>