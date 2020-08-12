import * as types from "./types"
import dmsReg from "./dms_reg"


const actions = {
  /*  更多操作  数据加载  */
  //获取发红包信息
  [types.LOAD_USERPACKETINFO]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.getLuckMoney({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        userPacketInfo: res.data,
        last: Date.parse(new Date())
      })
    })
  },
  /*  弹出菜单 数据加载  */

  //抽奖
  [types.LOAD_FORTUNEINFO]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.fortuneInfo({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        lotteryInfo: res.data,
        last: Date.parse(new Date())
      })
    })
  },
  //人气榜
  [types.LOAD_RANKING_HOT]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.hotRank({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        hotRank: {
          teacherList: res.teachers,
          userTidMap: res.userTidMap,
          last: Date.parse(new Date())
        }
      })
    })
  },
  //留言排行榜
  [types.LOAD_RANKING_LEAVE]({ commit, dispatch, state, getters }, payload) {
    dms.getLeavesTeachers({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        leaveRank: {
          teacherList: res.teachers || [],
        }
      })
    })
  },
  //讲师审判  TODO
  // [types.LOAD_TEACHER_JUDGE]({ commit, dispatch, state, getters }) {
  //   dms.teacherJudgeList({}, res => {
  //     state.roomInfo.judgeTeacher.judgeList = res.teachers || [];
  //   })
  // },
  //积分排行榜
  [types.LOAD_RANK_JF]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.getRankJf({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        jfRankOption: {
          jfRankList: res.list || [],
          last: Date.parse(new Date())
        },
      })
    })
  },
  //获取课程 getLesson
  [types.LOAD_LESSON]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.getLesson({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        lessonInfo: {
          lessonList: res.lessons || [],
          dsc: res.dsc,
          teacher: res.teacher,
          title: res.title,
          mobile: res.mobile,
          last: Date.parse(new Date())
        }
      })
    })
  },

  //LOAD_RANK_GIFT_SEND
  [types.LOAD_RANK_GIFT_SEND]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.getRankGiftSend({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        giftSendRank: {
          dataList: res.list || [],
          last: Date.parse(new Date())
        }
      })
    })
  },
  [types.LOAD_RANK_GIFT_GOT]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.getRankGiftGot({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        giftGotRank: {
          dataList: res.list || [],
          last: Date.parse(new Date())
        }
      })
    })
  },
  //加载用户列表
  [types.LOAD_USER_LIST]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.userList({ room_id: state.roomInfo.room_id, page: 1 }, res => {
      commit(types.UPDATE_ROOM_INFO, {
        userData: {
          userList: res.list || [],
          userFull: res.full || false,
          userTotal: res.total || 0,
          userReg: res.reg || 0,
          userGuest: res.guest || 0,
          last: Date.parse(new Date())
        }
      })
    })
  },
  //摇奖
  [types.LOAD_YJLOTTERY]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.openLottery({}, resp => {
      var resCon = resp.data;
      //resCon.lottery.lottery_type == 2   摇奖结束，等待下一轮
      commit(types.UPDATE_ROOM_INFO, {
        yjInfo: {
          lotteryObj: resCon.lottery,
          yjStep: resCon.lottery.lottery_type == 2 ? 2 : (resCon.lottery.lottery_type == 1 && resCon.count_down > 0 ? 1 : 0),
          countDown: resCon.count_down,
          titleMsg: resCon.lot_config.hint_msg || '',
          firstShow: false,
          lastAwardList: resCon.win_user || []
        },
      })
    }, resp => {
      if (resp.code == 403) { //首次没有数据的请求
        var resCon = resp.data;
        commit(types.UPDATE_ROOM_INFO, {
          yjInfo: {
            firstShow: true,
            yjStep: 2,
            titleMsg: resCon.lot_config.hint_msg || '',
            lotteryObj: {
              prize_name: resCon.lottery.prize_name || '',
            },
            lastAwardList: resCon.win_user || []
          },
        })
      }
    })
  },
  // 加载 房间基本信息
  [types.LOAD_ROOM_INFO]({ commit, dispatch, state, getters }, payload) {
    dms.LiveApi.roomInfo({ room_id: state.roomInfo.room_id }, res => {
      commit(types.UPDATE_USER_INFO, {
        hotTeacherName: res.hotTeacherName || ''
      })
      commit(types.INIT_CHAT_LIST, {
        chatList: res.chatList || [],
      })
      commit(types.UPDATE_ROOM_INFO, {
        giftCates: res.giftCates || [],
        giftList: res.giftList || [],
        giftV2s: res.giftV2s || [],
        prePast: res.prePast || 0,
        real_robot_num: res.real_robot_num || 0,
        robot_num: res.robot_num || 0,
        robotsInfo: {
          myrobotList: res.myRobots || []
        },
        roomUserSysMsgData: res.rtList || [],
        startCourseTeachers: res.teachers || [],
        next_past_timeout: res.next_past_timeout,
      })

      setInterval(() => {
        if (state.roomInfo.next_past_timeout > 0) {
          state.roomInfo.next_past_timeout -= 1;
        }
      }, 1000)

      setTimeout(() => {
        dmsReg(commit, dispatch, state);
      }, 1000)
    })

    // 获取宝箱信息
    dms.LiveApi.userTreasure({}, res => {
      commit(types.UPDATE_ROOM_INFO, {
        treasureInfo: {
          code: res.code || 0,
          treasureIndex: res.data.treasureIndex || 0,
          treasurnStatus: res.data.treasureStatus || 0
        }
      })
    })

    //讲师列表  用于 点赞 动态变动  需放入 state
    setTimeout(() => {
      dms.LiveApi.teacherAgree({}, res => {
        commit(types.UPDATE_ROOM_INFO, {
          teachersList: res.teacherInfos || [],
          //agree_opend: res.list.agree_opend || 0,   TODO
        })
      })
    }, 1000)

    // 增加 延时 load 预先准备数据 优化用户体验
    // 延时可以设置很久  无数据时  组件也会尝试加载数据
    // getters[types.tabMenus].find(i => i.tag == 'RANKING_HOT') && setTimeout(() => {
    //   dispatch(types.LOAD_RANKING_HOT)
    // }, 10 * 1000)

    // getters[types.tabMenus].find(i => i.tag == 'LEAVE_RANK') && setTimeout(() => {
    //   dispatch(types.LOAD_RANKING_LEAVE)
    // }, 1 * 1000)


    //if (getters[types.tabMenus].find(i => i.tag == 'RANKING_LIST')) {
    // getters[types.tabRanks].find(i => i.tag == 'RANK_JF') && setTimeout(() => {
    //   dispatch(types.LOAD_RANK_JF)
    // }, 11 * 1000)
    // getters[types.tabRanks].find(i => i.tag == 'RANK_GIFTSEND') && setTimeout(() => {
    //   dispatch(types.LOAD_RANK_GIFT_SEND)
    // }, 12 * 1000)
    // getters[types.tabRanks].find(i => i.tag == 'RANK_GIFTGOT') && setTimeout(() => {
    //   dispatch(types.LOAD_RANK_GIFT_GOT)
    // }, 13 * 1000)
    // }


    //初始化 红包信息
    // getters[types.moreOptions].find(i => i.tag == 'HONGBAO') && setTimeout(() => {
    //   dispatch(types.LOAD_USERPACKETINFO)
    // }, 8 * 1000)

    //抽奖
    $_BROWSER.versions.mobile && getters[types.innerMenus].find(i => i.tag == 'FORTUNE') && setTimeout(() => {
      dispatch(types.LOAD_FORTUNEINFO)
    }, 11 * 1000)

    //讲师团队
    // $_BROWSER.versions.mobile && getters[types.innerMenus].find(i => i.tag == 'TeacherJudge') && setTimeout(() => {
    //   dispatch(types.LOAD_TEACHER_JUDGE)
    // }, 5 * 1000)

    // 操作建议
    // getters[types.innerMenus].find(i => i.tag == 'OPTIONS') && setTimeout(() => {
    //   dispatch(types.LOAD_SUGGESSOPTIONS)
    // }, 15 * 1000)

    // 课程
    getters[types.innerMenus].find(i => i.tag == 'COURSE') && setTimeout(() => {
      dispatch(types.LOAD_LESSON)
    }, 10 * 1000)

    // 摇奖
    // getters[types.innerMenus].find(i => i.tag == 'YjLottery') && setTimeout(() => {
    //   dispatch(types.LOAD_YJLOTTERY)
    // }, 10 * 1000)

  },
  /**
   *发彩条  http://1015.f1.wenshunsoft.com/chat/send/1015
   {type:2
   message:[http://f1.wenshunsoft.com/assets/v2/img/upload/geili-xg.gif]
   font_size:14
   font_color:#333
   font_weight:0
   toUid:
   plat:pc
   vType:0}

   {type:1
   font_color:"#333"
   font_size:"14"
   font_weight:"normal"
   message:"gfd"
   plat:"mobile"
   toUid:2
   vType:0}

   *pc端  发彩条 发普通消息
   */
  [types.DO_MSG_SEND_PC]({ commit, dispatch, state }, payload) {

    var initParamsData = {
      uid: state.userInfo.uid,
      name: state.userInfo.name,
      avatar: state.userInfo.pic,
      role_id: state.userInfo.role_id,

      meClass: "chat-me",
      isRobot: false,
      message: payload.message, //消息
      type: payload.type //消息的类型  1为普通消息;2为彩条
    }

    var _tempRobotList = state.roomInfo.robotsInfo.myrobotList.slice()
    var selNum = state.roomInfo.robotsInfo.cur_sel_Num //当前选中机器人的数量
    var selRobotId = state.roomInfo.robotsInfo.selRobotObj.cur_sel_robotid //当前默认选中机器人
    var rTime = state.roomInfo.robotsInfo.msg_delaytime ? state.roomInfo.robotsInfo.msg_delaytime * 1000 : 0; //用户选择的延时的时间

    var robotOption = {}

    if (selNum > 0 && _tempRobotList.length > 0) {
      //选择机器人聊天的情况
      initParamsData.isRobot = true;
      initParamsData.meClass = '';

      for (var i = 0; i < selNum; i++) {
        setTimeout(() => {
          if (_tempRobotList.length <= 0) {
            return;
          }
          var index = Math.floor(Math.random() * _tempRobotList.length); //在机器人的长度范围内生成一个随机索引
          robotOption = _tempRobotList[index]
          _tempRobotList.splice(index, 1);

          initParamsData.avatar = robotOption.pic ? robotOption.pic : '';
          initParamsData.role_id = robotOption.role_id;
          initParamsData.uid = robotOption.uid;
          initParamsData.name = robotOption.name;

          dispatch(types.DO_MSG_SEND_REAL, {
            initParamsData: initParamsData,
          })
        }, dms.getRandomNum(0, rTime));
      }
    } else {
      //当前有选中机器人的id
      if (selRobotId && _tempRobotList.length > 0) {
        initParamsData.isRobot = true;
        initParamsData.meClass = '';

        robotOption = _tempRobotList.find(i => i.uid == selRobotId)
        initParamsData.avatar = robotOption.pic || "";
        initParamsData.role_id = robotOption.role_id;
        initParamsData.uid = robotOption.uid;
        initParamsData.name = robotOption.name;
      }
      setTimeout(() => {
        dispatch(types.DO_MSG_SEND_REAL, {
          initParamsData: initParamsData
        })
      }, dms.getRandomNum(0, rTime));
    }
  },
  //真正发送
  [types.DO_MSG_SEND_REAL]({ commit, state }, payload) {
    var options = payload.initParamsData

    var toUid = state.roomInfo.selChatMsgItem.toUid
    var toName = state.roomInfo.selChatMsgItem.toName
    //字体配置
    var fontColor = state.baseConfig.theme.msg_color ? baseConfig.theme.msg_color : "#333";
    var fontWeight = state.baseConfig.theme.msg_bold ? 1 : 0;
    var size = state.baseConfig.theme.msg_size ? state.baseConfig.theme.msg_size : "14"

    var messageData = {
      type: options.type || 1,
      message: options.message,
      font_size: size,
      font_color: fontColor,
      font_weight: fontWeight,
      toUid: toUid,
      plat: window.LIVE_PLAT, // state.baseConfig.chat_plat
    };
    if (options.isRobot) {
      messageData.robot_id = options.uid;
      if (toUid == options.uid) {
        toUid = null;
        toName = null;
      }
    }

    var tmp_id = options.uid + '_' + new Date().getTime() + '_id';
    var data = {
      id: tmp_id,
      uid: options.uid,
      name: options.name,
      avatar: options.avatar,
      font_size: size,
      font_color: fontColor,
      font_weight: fontWeight,
      meClass: options.meClass,
      top: 0,
      message: options.message,
      type: options.type || 1, // 1是普通消息（机器人跟真人），2是发彩条
      role_id: options.role_id,
      to_uid: toUid,
      to_name: toName,
      to_role_id: state.roomInfo.selChatMsgItem.toType,
      selfShow: true,
      vipLevel: state.userInfo.level,
      room_id: state.roomInfo.room_id,
      time: dms.date('H:i'),
      send_type: options.isRobot ? 2 : 1,
    }

    if (state.baseConfig.hotcfg.chat_add_hot) {
      if (options.isRobot) {
        var _myRobotList = state.roomInfo.robotsInfo.myrobotList.slice();
        var _curRobotInd = _myRobotList.findIndex(i => i.uid == options.uid);
        var _robotName = _myRobotList[_curRobotInd].teacherName || '';
        if (_curRobotInd > -1 && _robotName.length > 0) {
          data.name += "（" + _robotName + "）";
        }
      } else {
        if (state.userInfo.hotTeacherName) {
          data.name += "（" + state.userInfo.hotTeacherName + "）"
        }
      }
    }

    state.roomInfo.chatList.push(data);
    state.roomInfo.is_robot = options.isRobot;

    dms.LiveApi.sendChat(messageData, (text) => {
      var idx = state.roomInfo.chatList.findIndex(d => d.id == text.id);
      if (idx != -1) {
        return;
      }

      var idx_tmp = state.roomInfo.chatList.findIndex(d => d.id == tmp_id)
      if (idx_tmp != -1) { //已经存在 删除
        var _tempData = {
          ...state.roomInfo.chatList[idx_tmp],
          id: text.id,
          is_audited: text.is_audited
        }
        state.roomInfo.chatList.splice(idx_tmp, 1, _tempData);
      }
    }, text => {
      if (text.code == 5) {
        var idx_tmp = state.roomInfo.chatList.findIndex(d => d.id == tmp_id)
        if (idx_tmp != -1) {
          state.roomInfo.chatList.splice(idx_tmp, 1);
        }
        this.$layer.msg(text.msg, { time: 2 });
      } else if (text.code == 1) { //消息被屏蔽

      }
    })
  },
  /**
   * 私聊消息发送
   */
  [types.DO_PRI_MSG_SEND]({ commit, state }, payload) {
    var toUid = state.roomInfo.selPriChatMsgItem.toUid // payload.toUid;
    var toName = state.roomInfo.selPriChatMsgItem.toName //payload.toName;

    if (!toUid) {
      return;
    }
    var jsonObject = { msg: payload.message, toUid: toUid };
    if (payload.message.length == 0) {
      return;
    }
    //sendPrichat ($room_id, $toUid, $msg)
    dms.LiveApi.sendPrichat(jsonObject, res => {
      var dataMsg = {
        id: res.msgid,
        curuid: state.userInfo.uid,
        curname: state.userInfo.name,
        uid: toUid,
        name: toName,
        pic: state.roomInfo.selPriChatMsgItem.toPic,
        time: dms.date('H:i'),
        message: payload.message,
        msgtype: 'send_pri_msg'
      };
      var _tempArr = state.roomInfo.priChatList.slice();
      _tempArr.push(dataMsg)

      commit(types.UPDATE_ROOM_INFO, {
        priChatList: _tempArr
      })
    }, res => {
      console.warn(res.msg)
    })

  },
  //查看用户信息
  [types.DO_USERINFO_LOOK]({ commit, state }, payload) {
    //如果点击的不是当前用户
    var offset = payload.x && payload.x ? { x: payload.x, y: payload.y, from: payload.from } : {}
    state.userInfo.uid != payload.uid &&
      dms.LiveApi.userInfo({ uid: payload.uid }, res => {
        commit(types.UPDATE_ROOM_INFO, {
          selectUser: {
            ...res.user,
            ...offset
          }
        })
      })
  },
  //删除消息
  [types.DO_MSG_DEL]({ commit, state }, payload) {
    var ind = state.roomInfo.chatList.findIndex(i => {
      return i.id == payload.id
    })

    ind != -1 && dms.LiveApi.delChat({ id: payload.id }, res => {
      console.log("=====res.msg====", res.msg);
    })
  },
  //审核消息
  [types.DO_MSG_CHECK]({ commit, state }, payload) {
    var ind = state.roomInfo.chatList.findIndex(i => {
      return i.id == payload.id
    })
    if (ind == -1) return;

    var _tempArr = state.roomInfo.chatList.slice()
    _tempArr[ind].is_audited = 1;

    dms.LiveApi.passChat({ id: payload.id }, res => {

      //改变当前消息的状态
      commit(types.UPDATE_ROOM_INFO, {
        chatList: _tempArr
      })
    }, resp => {

    })
  },
  //封杀ip
  [types.DO_KILL_IP]({ commit, state }, payload) {
    //0 没有封杀;1已经封杀
    var then_killip = payload.killip ? 0 : 1;
    dms.LiveApi.opKillip({
      uid: payload.uid,
      killip: then_killip
    }, resp => {
      commit(types.UPDATE_ROOM_INFO, {
        selectUser: {
          killip: then_killip
        }
      });
    });
  },
  //踢出
  [types.DO_USER_KICK]({ commit, state }, payload) {
    //0 没有踢出;1已经踢出
    var then_kick = payload.kick ? 0 : 1;
    dms.LiveApi.opKick({
      uid: payload.uid,
      kick: then_kick
    }, resp => {
      commit(types.UPDATE_ROOM_INFO, {
        selectUser: {
          kick: then_kick
        }
      });
    });
  },
  //是否 禁言
  [types.DO_USER_GAG]({ commit, state }, payload) {
    //0 没有禁言;1已经禁言
    var then_gag = payload.gag ? 0 : 1;
    dms.LiveApi.opGag({
      uid: payload.uid,
      gag: then_gag
    }, resp => {
      commit(types.UPDATE_ROOM_INFO, {
        selectUser: {
          gag: then_gag
        }
      });
    });
  },
  //是否 观看视频
  [types.DO_USER_LOOKVIDEO]({ commit, state }, payload) {
    //0 可以看;1已经禁看
    var then_lookvideo = payload.lookvideo ? 0 : 1;
    dms.LiveApi.opLookvideo({
      uid: payload.uid,
      lookvideo: then_lookvideo
    }, () => {
      commit(types.UPDATE_ROOM_INFO, {
        selectUser: {
          lookvideo: then_lookvideo
        }
      });
    });
  }
}

export default actions