import Vuex from "vuex";
import * as types from "@/store/types";

import ChatGift from "@/pc_views/_/chatbar/ChatGift";
import layercommMixinPc from "@/mixins/layercommMixinPc";

const emptyRobot = { uid: 0, name: "" };
export default {
  data() {
    return {
      txtInput: "",
      dataFont: $t('18,17,16,15,14,13,12##字体的大小列表', __FILE__).split(','),
      myRobotList: [{ id: 0, name: "机器人" }],
      selectedNum: 0,
      selObj: emptyRobot,
      delayRobotTimeArr: $t('10,30,50,70,100##机器人自动发言延时时间列表', __FILE__).split(','), //延迟时间 10, 30, 50, 70, 100
      selectedTime: 0,
      showTurnMsg: false,
      giftShow: false,
      showColor: false,
    };
  },
  mixins: [layercommMixinPc],
  computed: {
    RobotNum() {
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
    chatToSelectID: {
      get: function () {
        return this.roomInfo.selChatMsgItem.toUid || 0;
      },
      set: function (newValue) {
        var tmp = newValue == "0" ? {} : this.roomInfo.teacher;
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          selChatMsgItem: tmp.tid ? { toUid: tmp.uid || tmp.tid, toName: tmp.name, from: "", toType: 400 } : { ...types.emptyChatTo }
        });
      }
    },
    //选择的机器人
    robotSelectID: {
      get: function () {
        return this.selObj && this.selObj.uid ? this.selObj.uid : 0;
      },
      set: function (newValue) {
        var tmp = this.roomInfo.robotsInfo.myrobotList.find(
          i => i.uid == newValue
        );
        this.selObj = tmp ? tmp : emptyRobot;
      }
    },
    fontSelect: {
      get: function () {
        return this.baseConfig.theme.msg_size || "14";
      },
      set: function (newValue) {
        dms.LiveApi.saveMsgFont({
          msg_size: newValue
        }, resp => {
          this.$store.state.baseConfig.theme.msg_size = newValue;
        }, resp => {

        });
      }
    }
  },
  mounted() {
    var self = this;
    $("#colorpalette1").wait(function () {
      $("#colorpalette1")
        .colorPalette()
        .on("selectColor", function (e) {
          dms.LiveApi.saveMsgFont({
            msg_color: e.color,
          }, resp => {
            self.$store.state.baseConfig.theme.msg_color = e.color;
          }, resp => {});
        });
    });

    $("#js-chat-faces-btn").wait(function () {
      $.fn.sinaEmotion.options = {
        rows: 42, // 每页显示的表情数
        language: "cnname", // 简体（cnname）、繁体（twname）
        appKey: "1362404091" // 新浪微博开放平台的应用ID
      };

      $("#js-chat-faces-btn").on("click", function (e) {
        $.fn.sinaEmotion.options.inputCallBack = function (msg) {
          self.txtInput = msg;
        };

        $("#js-chat-form-input").sinaEmotion("#js-chat-form-input");
        e.stopPropagation();
      });
    });
  },
  created() {
    //上传图片
    var self = this;
    $("#js-chat-picture-btn").wait(function () {
      self.upload();
    });

    this.selectedNum = this.roomInfo.robotsInfo.cur_sel_Num || 0;
    this.selectedTime = this.roomInfo.robotsInfo.msg_delaytime || 0;
    var tmp = this.roomInfo.robotsInfo.myrobotList.find(
      i => i.uid == this.roomInfo.robotsInfo.selRobotObj.cur_sel_robotid
    );
    this.selObj = tmp ? tmp : emptyRobot;
  },
  updated() {
    var is_robot = false;
    var myRobotLen = this.roomInfo.robotsInfo.myrobotList.length;
    if ((myRobotLen && this.selectedNum > 0) || this.selObj.uid) {
      is_robot = true;
    }

    myRobotLen &&
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        is_robot: is_robot,
        robotsInfo: {
          cur_sel_Num: this.selectedNum,
          msg_delaytime: this.selectedTime,
          selRobotObj: {
            cur_sel_robotid: this.selObj.uid,
            cur_sel_robotname: this.selObj.name
          }
        }
      });
  },

  methods: {
    upload() {
      var self = this;
      if ($("#js-chat-picture-btn").length > 0) {
        $("#js-chat-picture-btn").uploadify({
          height: 30, // 30,
          width: 30, //30,
          buttonText: "&nbsp;",
          swf: "/assets/js/uploadify-2.2/uploadify.swf",
          uploader: "/ajaxUpload?dir=chatpic",
          fileTypeDesc: "Image Files",
          fileSizeLimit: "1024K",
          fileTypeExts: "*.gif; *.jpg; *.png",
          onUploadSuccess: function (file, data, response) {
            data = $.parseJSON(data);
            var text = "[" + data.img + "]";
            self.txtInput = text;
            self.addToChatInput(text);
          }
        });
      }
    },
    danmuChange() {
      var _danmuIsOpen = !this.roomInfo.danmu_is_open;
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        danmu_is_open: _danmuIsOpen
      });
    },
    sendMsg() {
      var message = this.txtInput;
      message = $.trim(message);
      this.txtInput = "";
      if (message.length == 0) {
        return;
      }
      if (this.roomInfo.danmu_is_open) {
        //弹幕情况
        var danmuParams = {
          danmu_msg: message,
          font_color: this.baseConfig.theme.msg_color //??
        };
        dms.LiveApi.sendDanmu(danmuParams, res => {
          console.log("danMu===", res.msg);
        });
      } else {
        if (
          this.baseConfig.chatcfg.guest_chat_cue &&
          !this.userInfo.logined
        ) {
          this.dialogMsgAlign("游客不能发言，请先登录", "提示");
          return;
        }

        //机器人及其他普通消息情况
        if (this.roomInfo.wait_Send_Time > 0) {
          return;
        }
        var countTime = this.userInfo.role.chat_ts || 0;
        this.$store.state.roomInfo.wait_Send_Time = countTime;
        var intervarTimer = setInterval(() => {
          if (countTime == 0) {
            intervarTimer && clearInterval(intervarTimer);
          } else {
            countTime--;
            this.$store.state.roomInfo.wait_Send_Time = countTime;
          }
        }, 1000);
        this.$store.dispatch(types.DO_MSG_SEND_PC, {
          message: message,
          type: 1
        });
      }
    },
    sendNotice() {
      var message = this.txtInput;
      message = $.trim(message);
      this.txtInput = "";
      if (message.length == 0) {
        return;
      }
      dms.LiveApi.setNotice({ notice_msg: message }, resp => {}, resp => {});
    },

    fontConfig() {
      var _fontW = !this.baseConfig.theme.msg_bold;
      dms.LiveApi.saveMsgFont({
        msg_bold: _fontW,
      }, resp => {
        this.$store.state.baseConfig.theme.msg_bold = _fontW;
      }, resp => {});

    },
    //关闭对谁说
    closeToChat() {
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        selChatMsgItem: {
          ...types.emptyChatTo
        }
      });
    },

    addToChatInput(text) {
      var _input = $("#js-chat-form-input")[0];
      if (document.selection) {
        _input.focus();
        var cr = document.selection.createRange();
        cr.text = text;
        cr.collapse();
        cr.select();
      } else if (_input.selectionStart !== undefined) {
        var start = _input.selectionStart;
        var end = _input.selectionEnd;
        _input.value =
          _input.value.substring(0, start) +
          text +
          _input.value.substring(end, _input.value.length);
        _input.selectionStart = _input.selectionEnd = start + text.length;
      } else {
        _input.value += text;
      }
    },
    yjStart() {
      if (this.roomInfo.lottery_show) {
        return;
      }
      this.$store.dispatch(types.LOAD_YJLOTTERY);
      this.$store.state.roomInfo.lottery_show = true;
      this.popShow("YjContent");
      return;
    },
    robotAutoSend() {
      var _tempRobotList = this.roomInfo.robotsInfo.myrobotList.slice();
      if (!_tempRobotList.length) {
        this.$layer.msg("该用户没有机器人！", { time: 3 });
        return;
      }
      dms.LiveApi.loadAutoMsg({}, resp => {
        var content = resp.data; //JSON.parse(resp.msg);
        var _caitiaoList = [{
          "tag": "xh",
          name: '[彩条-鲜花V3]',
          checked: 0,
          type: 'caitiao'
        }, {
          "tag": "gl",
          name: '[彩条-给力V3]',
          checked: 0,
          type: 'caitiao'
        }, {
          "tag": "gz",
          name: '[彩条-鼓掌V3]',
          checked: 0,
          type: 'caitiao'
        }, {
          "tag": "dq",
          name: '[彩条-点赞V3]',
          checked: 0,
          type: 'caitiao'
        }, {
          "tag": "dz",
          name: '[彩条-顶起V3]',
          checked: 0,
          type: 'caitiao'
        }];
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          autoRobotConfig: {
            caitiaoList: content.caitiaoList && content.caitiaoList.length ? content.caitiaoList : _caitiaoList,
            textStr: content.textStr || '',
            minTime: content.minTime || 10,
            maxTime: content.maxTime || 20,
          }
        })
        this.popShow('RobotAutoModal');
      }, resp => {
        console.warn("GetRobotMsg", resp.msg);
      })
    }
  },
  components: {
    ChatGift
  }
}