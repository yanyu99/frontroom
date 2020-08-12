import * as types from "./types"
import dmsReconnect from "./dms_reconnect"
import Vue from 'vue'

let anotherContentTimer = null;

export default (commit, dispatch, state) => {

  dms.initDmsConfig({
    ...state.userInfo.dmsConfig,
    enter_suc() { // DMS 连接成功 通过后台接口发送 用户进入消息
      anotherContentTimer && clearTimeout(anotherContentTimer)
      anotherContentTimer = null
      commit(types.UPDATE_USER_INFO, { anotherContent: false })
    },
    losed() { // 连接丢失 判断用户没有多开的情况下 尝试重新连接
      !state.userInfo.anotherContent && setTimeout(() => {
        // dmsReconnect()
      }, 3000)
    },
    reconnect() {
      !state.userInfo.anotherContent && setTimeout(() => {
        dmsReconnect()
      }, 3000)
    },
    connectold() { // 发生连接挤占 被挤掉的连接 设置用户为被挤占 隐藏视频
      anotherContentTimer && clearTimeout(anotherContentTimer)

      anotherContentTimer = setTimeout(() => {
        commit(types.UPDATE_USER_INFO, { anotherContent: true })
        hideVideo()
      }, 5000)
    },
    enter_fail() {
      !state.userInfo.anotherContent && setTimeout(() => {
        dmsReconnect()
      }, 3000)
    },
  })

  const removeSysMsg = () => {
    var rm_len = state.roomInfo.roomUserSysMsgData.length - 30;
    if (rm_len <= 30) {
      return;
    }
    state.roomInfo.roomUserSysMsgData.splice(0, rm_len);
  }


  dms.onMsg('sync_content', (topic, data) => {
    var content_key = data.content_key || '';
    var cfg = data.cfg || {};
    if (!content_key) {
      return;
    }
    if (content_key == 'pc_views' || content_key == 'mobile_views') {
      if ((LIVE_PLAT == 'pc' && content_key == 'pc_views') || (LIVE_PLAT == 'mobile' && content_key == 'mobile_views')) {
        Object.keys(cfg.component_cfg).forEach(path => {
          var item = cfg.component_cfg[path];
          Object.keys(item).forEach(key => {
            Vue.set(window.D.componentCfg[path], key, item[key]);
          });
        });
      }
      return;
    }

    // 同步全局配置
    if (!data.room_id) {
      Object.keys(cfg).forEach(key => {
        Vue.set(state.baseConfig[content_key], key, cfg[key]);
      });
      return;
    }

    // 收到 本房间发送过来的 配置
    if (data.room_id == state.roomInfo.room_id) {
      Object.keys(cfg).forEach(key => { // 每一个 配置项都是计算过后的 全部可以用来更新
        Vue.set(state.baseConfig[content_key], key, cfg[key]);
      });
      state.baseConfig[content_key].__parent_keys__ = cfg.__parent_keys__ || ''; // 更新 parent_keys
      return;
    }

    // 收到主房间发送过来的 配置  只有子房间 才会走到这里
    if (data.room_id == state.roomInfo.parent_room_id) {
      var parent_keys = (state.baseConfig[content_key].__parent_keys__ || '').split(',');
      Object.keys(cfg).forEach(key => {
        if (parent_keys.findIndex(k => k == key) >= 0) { // 在 parent_keys中的 配置项 是 需要更新的配置项
          Vue.set(state.baseConfig[content_key], key, cfg[key]);
        }
      });
    }
  });

  /**
   * 当前用户
   * topic:__present__r_testv3_chat_1015;
   * data:{"cmd":"present","clientId":"testv3|1015_7054_mobile","state":1,"time":1523169512,"total":3}
   */
  dms.onMsg('present', (topic, data) => {
    if (data.state == 0) {
      commit(types.ON_USER_LEAVE, {
        clientId: data.clientId,
        state: data.state,
        time: data.time,
        total: data.total,
      })
    }
    state.roomInfo.realUserTotal = data.total || 0
  })

  dms.onMsg('presenttick', (topic, data) => {
    var cidMap = data.map || {};
    for (var cid in cidMap) {
      if (cidMap.hasOwnProperty(cid)) {
        if (cidMap[cid] == 0) {
          commit(types.ON_USER_LEAVE, {
            clientId: cid
          })
        }
      }
    }
    state.roomInfo.realUserTotal = data.total || 0
  })
  /**
   *
   */
  dms.onMsg('del_user', (topic, data) => {
    window.location.reload();
  }, (topic, data) => {
    return state.userInfo.uid && data.uid && data.uid == state.userInfo.uid;
  })

  /**
   * data:{"cmd":"block_ip","ip":"127.0.0.1","op_uid":7054,"time":"14:43","roomId":1015}
   */
  dms.onMsg('block_ip', (topic, data) => {
    window.location.reload();
  }, (topic, data) => {
    return state.userInfo.ip && data.ip && data.ip == state.userInfo.ip;
  })


  /**
   * 聊天
   * topic：
   * data：{"uid":6081,"name":"lyy1","type":1,"userType":1,"message":"fdsf","send_roomid":"1015","plat":"mobile","vtype":0,
   * "font_size":"14","font_weight":1,"font_color":"#333","is_audited":1,
   * "origin_audit":1,"room_id":"1015","id":80459,"hasFilter":0,"time":"14:29","sendUid":6081,"cmd":"chat"}
   */
  dms.onMsg('chat', (topic, data) => {
    commit(types.ON_MSG_CHAT, {
      data: data,
    })
  })

  //有用户进入
  /**
   * {"cmd":"enter","user":{"name":"游客3ZY86U64","uid":1000003304,"pic":"/assets/img/avatar/t3/32/22.png",
   * "type":100,"gag":0,"kick":0,"plat":"mobile","role":{"f_privatechat":0}},"time":1523168585}
   */
  dms.onMsg('enter', (topic, data) => {
    commit(types.ON_USER_ENTER, data.user);

    if (state.userInfo.role.f_realtime) { //当前用户开启实时动态
      var dataMsg = {
        uid: data.user.uid,
        name: data.user.name,
        time: dms.date('H:i'),
        _type: 'Enter',
      }
      state.roomInfo.roomUserSysMsgData.push(dataMsg);
      removeSysMsg();
    }

    // 登录用户是 管理员500 并有私聊权限 且当前进入用户没有私聊权限
    if (!data.user.role.f_privatechat && state.userInfo.role.f_privatechat && state.userInfo.role_id == 500) {
      //尝试在用户列表中 寻找 id更小的管理员
      var userListArr = state.roomInfo.userData.userList.filter(n => {
        n.type == 500 && n.uid < state.userInfo.uid
      });
      var mySelf = userListArr.length == 0; // 是否需要 对新进入的用户 发送一条 系统私聊 如果找到了 则不需要发送
      if (mySelf) {

        //当前用户 追加 私聊系统消息
        dms.LiveApi.sendPriChatDef({ toUid: data.user.uid }, (resp) => {})
      }
    }
  })

  /**
   * {"uid":7054,"name":"test_super","pic":"/assets/img/avatar/t3/32/08.png","message":"ceshi","cmd":"prichat","time":"14:26","id":584}
   */
  dms.p2pMsg('prichat', (topic, data) => { //私聊
    var isLook = state.roomInfo.selPriChatMsgItem.toUid && state.roomInfo.selPriChatMsgItem.toUid == data.uid ? false : true; //判断消息是否查看
    var priobj = {
      uid: data.uid,
      name: data.name,
      pic: data.pic,
      message: data.message,
      cmd: data.cmd,
      time: data.time,
      id: data.id,

      curuid: state.userInfo.uid,
      curname: state.userInfo.name,
      msgtype: 'rec_pri_msg',
      islook: isLook,
    }

    var _tempArr = state.roomInfo.priChatList.slice()
    _tempArr.push(priobj)

    //用户私聊列表
    var _toPriTempArr = state.roomInfo.priChatToList.slice()
    var _ind = _toPriTempArr.findIndex(i => i.uid == data.uid)
    _ind == -1 ? _toPriTempArr.push(priobj) : _toPriTempArr[_ind].islook = isLook


    if (_toPriTempArr.length == 1) {
      commit(types.UPDATE_ROOM_INFO, {
        selPriChatMsgItem: {
          from: "on_rec_pri_msg",
          toName: data.name,
          toUid: data.uid,
          toPic: data.pic,
        }
      })
    }
    if ($_BROWSER.versions.mobile && state.roomInfo.active_menu != "CHAT_PRIVATE") {
      state.roomInfo.menusMapIsNew.CHAT_PRIVATE = true;
    }
    commit(types.UPDATE_ROOM_INFO, {
      is_show_pri_box: true, //pc版本
      priChatList: _tempArr,
      priChatToList: _toPriTempArr,
    });
  })


  /**
   *  data:{"cmd":"leave","user":{"name":"test_super","uid":7054,"pic":"/assets/img/avatar/t3/32/08.png","type":1000,"plat":""},"time":1523169807}
   */
  dms.onMsg('leave', (topic, data) => {
    if (state.userInfo.role.f_realtime) {
      var dataObj = {
        time: dms.date("H:i"),
        name: data.user.name,
        _type: 'Leave',
        text: data.user.name + "离开！",
      }

      if (state.userInfo.type >= 400) { //讲师级别以上的显示
        state.roomInfo.roomUserSysMsgData.push(dataObj);
        removeSysMsg();
      }
    }
  })

  const addUserSysMsg = (data, dtype, strDes) => {
    if (!state.userInfo.role.f_realtime) {
      return
    }
    var dataMsg = {
      time: dms.date("H:i"),
      name: data.name,
      _type: dtype,
      text: strDes,
    }
    state.roomInfo.roomUserSysMsgData.push(dataMsg);
    removeSysMsg();
  }

  dms.onMsg('user_tick', (topic, data) => { //重新加载
    var curInUserArr = data.in_users || [];
    for (var i = 0; i < curInUserArr.length; i++) {
      var _tmpinArr = curInUserArr[i];
      commit(types.ON_USER_ENTER, _tmpinArr);
      addUserSysMsg(_tmpinArr, 'Enter', _tmpinArr.name + '进入！');

      // 登录用户是 管理员500 并有私聊权限 且当前进入用户没有私聊权限
      if (!_tmpinArr.role.f_privatechat && state.userInfo.role.f_privatechat && state.userInfo.role_id == 500) {
        //尝试在用户列表中 寻找 id更小的管理员
        var userListArr = state.roomInfo.userData.userList.filter(n => {
          n.role_id == 500 && n.uid < state.userInfo.uid
        });
        var mySelf = userListArr.length == 0; // 是否需要 对新进入的用户 发送一条 系统私聊 如果找到了 则不需要发送
        mySelf && dms.LiveApi.sendPriChatDef({ toUid: _tmpinArr.uid }, (resp) => {}); //当前用户 追加 私聊系统消息
      }
    }

    var _curOutUser = data.out_users || [];
    _curOutUser.length && _curOutUser.forEach(i => {
      commit(types.ON_USER_LEAVE, {
        uid: i.uid,
        plat: i.plat,
      })
      state.userInfo.role_id >= 400 && addUserSysMsg(i, 'Leave', i.name + '离开！');
    });

    //计算数量
    if (state.userInfo.role.f_ul_select) {
      var _tmpArr = state.roomInfo.optSearchArr.slice();
      _tmpArr.forEach(ele => {
        if (ele.role_id == 100) {
          ele.num = data.guest_num || 0
        } else if (ele.role_id == 1) {
          ele.num = data.customer_num || 0
        } else if (ele.role_id == 500) {
          ele.num = data.mgr_num || 0
        } else if (ele.role_id == 400) {
          ele.num = data.teacher_num || 0
        }
      });
      state.roomInfo.optSearchArr = _tmpArr
    }
    state.roomInfo.realUserTotal = data.total || 0;
  })

  dms.onMsg('cmd_reload', (topic, data) => { //重新加载
    var _time = Math.floor(Math.random() * 65537) % 10 * 1000; //生成的随机数
    setTimeout(() => {
      window.location.reload();
    }, _time);
  })
  dms.onMsg('close_site', (topic, data) => { //站点关闭
    var _time = Math.floor(Math.random() * 65537) % 10 * 1000; //生成的随机数
    setTimeout(() => {
      window.location.reload();
    }, _time);

  })
  dms.onMsg('del_msg', (topic, data) => { //删除消息
    var ind = state.roomInfo.chatList.findIndex(d => d.id == data.id)
    ind >= 0 && state.roomInfo.chatList.splice(ind, 1);
  })

  /**
   * data:{"cmd":"del_chat","id":"80460"}
   */
  dms.onMsg('del_chat', (topic, data) => { //删除消息
    var ind = state.roomInfo.chatList.findIndex(d => d.id == data.id);
    ind >= 0 && state.roomInfo.chatList.splice(ind, 1);
  })

  //更新用户
  dms.onMsg('updateUser', (top, data) => {
    commit(types.ON_USER_UPDATE, {
      data: data
    })
  })


  //讲师改变  alone_video 是否是独立视频房间， alone_video_teacher_opnd为1，且当前用户是独立视频房间，不处理主房间发出的teacherChange

  dms.onMsg('teacherChange', (top, data) => {
    var _opend = state.baseConfig.sitecfg.alone_video_teacher_opend || 0; //独立视频讲师是否开启
    if (state.baseConfig.channelInfo.alone_video && _opend == 1 && top == state.userInfo.dmsConfig.parentTopic) {
      return;
    }
    //更改当前选中的讲师

    state.roomInfo.teacher = !data.noteacher ? data.teacher : types.emptyTeacher;
    $_BROWSER.versions.mobile && commit(types.UPDATE_ROOM_INFO, {
      selChatMsgItem: {
        toUid: !data.noteacher ? data.teacher.tid : 0,
        toName: !data.noteacher ? data.teacher.name : 0,
        from: 'teacher_change',
        toType: 400
      }
    })
  })
  //讲师离开
  dms.onMsg('teacherEmpty', (top, data) => {
    state.roomInfo.teacher = types.emptyTeacher;
    !$_BROWSER.versions.mobile && commit(types.UPDATE_ROOM_INFO, {
      selChatMsgItem: types.emptyChatTo
    })
  })

  /**
   * 观看视频
   * {"cmd":"lookVideo","lookvideo":0,"uid":6081,"name":"test_super","srcName":"lyy1","time":"14:29","roomId":""}
   */
  dms.onMsg('lookVideo', (top, data) => {
    commit(types.UPDATE_USER_INFO, {
      lookvideo: data.lookvideo,
    })
    if (state.userInfo.lookvideo) {
      showVideo();
    } else {
      hideVideo();
    }
    //window.location.reload();
  }, (top, data) => data.uid == state.userInfo.uid)


  /**
   * 踢出房间
   * {"cmd":"killYou","uid":6081,"name":"test_super","srcName":"lyy1","time":"14:29","roomId":"","show":0}
   */
  dms.onMsg('killYou', (top, data) => {
    if (data.uid == state.userInfo.uid) {
      //当前课程停止
      stopVideo();
      if (window.LIVE_PLAT != 'pc') {
        var url = location.protocol + "//" + location.host + location.search + "&_t" + new Date().getTime();
        window.location.href = url;
      } else {
        window.location.reload(true);
      }
    } else {
      if (data.roomId == state.roomInfo.room_id && data.show) {
        var sysMsg = {
          text: data.srcName + "被" + data.name + "请出房间",
          time: data.time,
          _type: 'SystemMsgItem',
        }
        var _tempArr = state.roomInfo.chatList.slice()
        _tempArr.push(sysMsg)
        commit(types.UPDATE_ROOM_INFO, {
          teacher: types.emptyTeacher, //更改讲师
          selChatMsgItem: types.emptyChatTo
        })
      }
    }
  })

  /**
   * killIp
   *  data:{"cmd":"killIp","uid":"6081","name":"test_super","srcName":"lyy1","time":"14:43","roomId":"1015","show":0}
   */

  dms.onMsg("killIp", (top, data) => {
    if (data.uid == state.userInfo.uid) {
      //当前课程停止
      stopVideo();
      window.location.reload(true);
    } else {
      if (data.roomId == state.roomInfo.room_id && data.show) {
        var sysMsg = {
          text: data.srcName + "被" + data.name + "封杀IP",
          time: data.time,
          _type: 'SystemMsgItem',
        }
      }
    }
  })
  //base_user  __base_num__
  dms.onMsg("base_user", (top, data) => {
    state.baseConfig.logincfg.base_user = parseInt(data.base_user || 0)
  })
  //robot_num  __base__
  dms.onMsg("robot_num", (top, data) => {
    state.roomInfo.robot_num = parseInt(data.robot_num || 0);
  })

  /**
   *签到 cmd_past 用户签到 接受到消息
   cmd:"cmd_past"
   name:"aaa"
   num:1
   time:"11:25"
   uid:1000003594
   unixTime:1510802721
   */
  dms.onMsg('cmd_past', (topic, data) => { //签到
    var tmp_id = data.uid + '_' + dms.uniqueId()
    var textMsg = data.uid == state.userInfo.uid ? "恭喜你签到成功！" + "连续签到" + data.num + "天！" : "恭喜" + data.name + "签到成功！"
    var sysPastMsg = {
      id: tmp_id,
      text: textMsg,
      time: data.time,
      _type: 'SystemMsgItem',
      from: 'sysOnUserPast'
    }
    var _tempArr = state.roomInfo.chatList.slice();
    state.roomInfo.chatList.findIndex(i => i.id == tmp_id) == -1 && _tempArr.push(sysPastMsg)

    commit(types.UPDATE_ROOM_INFO, {
      chatList: _tempArr,
      next_past_timeout: data.next_past_timeout
    })
  })

  // hj_time
  dms.onMsg('hj_time', (topic, data) => {
    var tempObj = {
      hj_hm: data.start + " " + data.end,
      hj_bg: data.imgurl,
      hj_opend: data.opend
    }
    commit(types.UPDATE_BASECONFIG_INFO, {
      extcfg: tempObj
    })
  })


  /**
   * cmd_giftv2 接收礼物  data数据
   *  avatar:"/assets/img/avatar/t3/32/09.png"
   cmd:"cmd_giftv2"
   giftName:"幸运草"
   giftPath:"http://static.wenshunsoft.com/red_test/upload/admin/DnGhCVseveNMoxGkWtPoiAABB.png"
   id:5
   num:"1"
   time:"14:35"
   user:"bbb"
   */
  const _procGift = (data) => {
    var _curChoose = state.roomInfo.recGift.displayList.findIndex(i => {
      return i.giftName == data.giftName && i.user == data.user
    });


    var clear = () => {
      var tmp = state.roomInfo.recGift.displayList.slice()
      var _idx = tmp.findIndex(i => {
        return i.giftName == data.giftName && i.user == data.user
      })

      tmp.splice(_idx, 1)
      data.timer && clearTimeout(data.timer)
      commit(types.UPDATE_ROOM_INFO, {
        recGift: {
          displayList: tmp
        }
      })
    }

    if (_curChoose >= 0) { // 已经显示的礼物  数量加1
      console.log("_curChoose====", _curChoose);
      var tmp = state.roomInfo.recGift.displayList.slice()
      tmp[_curChoose].num += 1
      tmp[_curChoose].timer && clearTimeout(tmp[_curChoose].timer)
      tmp[_curChoose].timer = setTimeout(clear, 4000)
      return commit(types.UPDATE_ROOM_INFO, {
        recGift: {
          displayList: tmp
        }
      })
    }

    data._key = data.giftName + data.user
    data.num = 1
    if (state.roomInfo.recGift.displayList.length < state.roomInfo.recGift.displayNum) {
      // 显示 数组未满  加入显示列表
      // 延时 4秒之后 移除该礼物显示
      data.timer = setTimeout(clear, 4000)
      var tmp = state.roomInfo.recGift.displayList.slice()
      tmp.push(data)
      return commit(types.UPDATE_ROOM_INFO, {
        recGift: {
          displayList: tmp
        }
      })
    }

    // 显示数组已满  加入队列延时处理
    state.roomInfo.recGift.giftQueue.push(data);

    // 延迟200ms 重新尝试处理该消息
    setTimeout(() => {
      var tmp = state.roomInfo.recGift.giftQueue.slice()
      if (tmp.length == 0) {
        return;
      }
      var data = tmp.shift()
      commit(types.UPDATE_ROOM_INFO, {
        recGift: {
          giftQueue: tmp
        }
      })
      _procGift(data)
    }, 200)
  }

  /**
   * {"cmd":"cmd_giftv2","time":"17:05","giftName":"太阳","user":"游客OR9LYSQ6","num":"1",
   * "avatar":"/assets/img/avatar/t3/32/26.png",
   * "giftPath":"http://static.wenshunsoft.com/red_test/upload/admin/PymSFSeAtgWMdNYpuaLdnyJIQ.png","id":3}
   */
  dms.onMsg('cmd_giftv2', (topic, data) => { //接收礼物  phone
    _procGift(data)
  })

  dms.onMsg('notice_msg', (topic, data) => {
    state.baseConfig.noticecfg.notice_msg = data.msg;
  })

  //cmd_fortune  //收到中奖的消息
  /**
   *
   *  cmd:"cmd_fortune"
   dsc:"中得100元话费"
   fixed_nick:"aa***a"
   nick:"aaa"
   */
  dms.onMsg('cmd_fortune', (topic, data) => {
    commit(types.UPDATE_ROOM_INFO, {
      lotteryInfo: {
        backList: [...state.roomInfo.lotteryInfo.backList, {
          dsc: data.dsc,
          fixed_nick: data.fixed_nick,
          nick: data.nick,
        }]
      }
    })
  })


  /**
   * cmd_hot_send 人气榜投票返回
   * {"cmd":"cmd_hot_send",
    "teachers":[
    {"id":1,"fired":1,"room_id":1015,"imgurl":"","name":"股龙","name_color":"#FF00FF","name_bold":1,"hide_vote_num":1,
    "j_name":"股龙123","sort":0,"total_base":1000,"base":0,"today_base":100,"total":251,"today":0,"show":1,"showimg":"",
    "hot_base":333,"hot_got":2437,"is_vote":1,"jf_got":6940}]
    }
   */
  dms.onMsg('cmd_hot_send', (topic, data) => {
    //更新数据
    state.roomInfo.hotRank.teacherList = data.teachers || [];
  })

  //留言 列表返回
  dms.onMsg('cmd_message_board', (topic, data) => {
    //更新数据
    state.roomInfo.leaveRank.teacherList = data.teachers || [];
  })

  /**
   * ==============================PC============================================
   */

  /**
   * 发送红包 的接收消息
   * cmd:"sendLuckMoney"
   luck_id:19
   text:"恭喜发财"
   time:"20:22"
   user:{
     name:"aaa"
     role_id:500
     uid:1000003594
    }
   */
  dms.onMsg('sendLuckMoney', (topic, data) => {
    //渲染效果
    var _sendInfo = {
      id: "hb_" + dms.uniqueId(),
      isLuckMoney: 1,
      _type: "PacketItem",
      luck_id: data.luck_id,
      text: data.luck_note,
      time: data.time,
      user: {
        name: data.user.name,
        role_id: data.user.role_id,
        uid: data.user.uid,
      }
    }
    state.roomInfo.packArr.push(data);
    var _ind = state.roomInfo.chatList.findIndex(i => i.luck_id == data.luck_id && i.text == data.luck_note)
    if (_ind != -1) return;

    state.roomInfo.chatList.splice(_tempArr.length, 1, _sendInfo);
  })

  /**
   * code:0
   fromUid:1000003594
   left_num:2
   luck_id:34
   money:0.37
   msg:"SUC"
   name:"aaa"
   selfUid:1000005356
   */
  //领取红包之后接收到的系统消息
  dms.onMsg('gotLuckMoney', (topic, data) => {

    var _tempArr = state.roomInfo.chatList.slice()

    var textMsg = data.user.uid == state.userInfo.uid ? "恭喜 您 抢到 " + data.fromName + " 的红包" : "恭喜 " + data.user.name + " 抢到 " + data.fromName + " 的红包";
    var got_id = 'got_luck_moneys_id_' + data.got_luck_moneys_id
    var sysMsg = {
      id: got_id,
      text: textMsg,
      time: data.time,
      _type: 'SystemMsgItem',
      from: 'gotLuckMoney'
    }
    state.roomInfo.chatList.findIndex(i => i.id == got_id) == -1 && _tempArr.push(sysMsg)

    if (data.left_num == 0) {
      if (state.userInfo.uid != data.user.uid) { //红包已经被领完，并且不是自己
        var _ind = state.roomInfo.packArr.findIndex(i => i.luck_id == data.luck_id);
        _ind >= 0 && state.roomInfo.packArr.splice(_ind, 1);
      }
      var sysTextMsg = data.fromUid == state.userInfo.uid ? "您发的红包已被抢完！" : data.fromName + "的红包已被领完！"
      var got_num_id = 'got_luck_moneys_num_id_' + data.luck_id
      var sysMsgGet = {
        id: got_num_id,
        text: sysTextMsg,
        time: data.time,
        _type: 'SystemMsgItem',
        from: 'gotLuckMoney'
      }
      state.roomInfo.chatList.findIndex(i => i.id == got_num_id) == -1 && _tempArr.push(sysMsgGet);
      var _idx = state.roomInfo.chatList.findIndex(i => i.luck_id == data.luck_id);
      _idx >= 0 && _tempArr.splice(_idx, 1); // state.roomInfo.chatList.splice(_idx, 1);
    }

    commit(types.UPDATE_ROOM_INFO, {
      chatList: _tempArr
    })
  })


  /**
   * {"cmd":"update_teacher","tid":"2","total":151,"base":0,"today":2}
   */
  dms.onMsg('update_teacher', (topic, data) => {
    //更新对应的讲师团队信息
    var tid = data.tid;
    var _ind = state.roomInfo.teachersList.findIndex(i => i.tid == tid)
    if (_ind > -1) {
      state.roomInfo.teachersList.splice(_ind, 1, {
        ...state.roomInfo.teachersList[_ind],
        //base: data.base,
        today: data.today,
        total: data.total,
      })
    }

    //更新人气榜的信息
    var _hotInd = state.roomInfo.hotRank.teacherList.findIndex(i => i.tid == tid)
    if (_hotInd != -1) {
      state.roomInfo.hotRank.teacherList.splice(_ind, 1, {
        ...state.roomInfo.hotRank.teacherList[_hotInd],
        //base: data.base,
        today: data.today,
        total: data.total,
      })
    }
  })

  // proposing //视频相关
  dms.onMsg('proposing', (topic, data) => {
    // $('.icon_prop').attr("src", window.D.cdn + "/assets/img/fxts/fxts.gif")
    // playMp3(window.D.cdn + "/assets/img/fxts/wz.mp3", window.D.cdn + "/assets/img/fxts/wz.wav");
    // function playMp3(mp3Url, wavUrl) {
    //   $("#idMp3Warp").html('<audio onended="playEnd();" autoplay="true"><source src="' + mp3Url + '" type="audio/mp3"> <source src="' + wavUrl + '" type="audio/wav"></audio>')
    // }
  })

  /**
   * 发送需要审核消息
   * {"cmd":"audit_chat","uid":6081,"name":"lyy1","type":1,"userType":1,"message":"456","send_roomid":"1015","plat":"mobile",
   * "vtype":0,"font_size":"14","font_weight":1,"font_color":"#333","is_audited":0,"origin_audit":0,
   * "room_id":"1015","id":80490,"hasFilter":0,"time":"15:57","sendUid":6081}
   */
  dms.onMsg('audit_chat', (topic, data) => {
      if (data.sendUid == state.userInfo.uid && data.plat == 'pc') {
        return;
      }
      if (!state.userInfo.role.f_audit_boardcast) {
        if (data.room_id != state.roomInfo.room_id) {
          return;
        }
      }
      state.roomInfo.chatList.push(data);
    })
    // child_enter
    !$_BROWSER.versions.mobile && dms.onMsg('child_enter', (topic, data) => {
      addUserSysMsg(data.user, 'Enter', "欢迎" + data.user.name + "进入频道！");

    })
    // child_leave
    !$_BROWSER.versions.mobile && dms.onMsg('child_leave', (topic, data) => {
      data.user.type >= 400 && addUserSysMsg(data.user, 'Leave', data.user.name + "离开频道！");
    })

  // cmd_sshd  实时建议
  dms.onMsg('cmd_sshd', (topic, data) => {
    //操作建议追加数据
    state.roomInfo.suggestOption.optionList.push(data);
    // commit(types.UPDATE_ROOM_INFO, {
    //   suggestOption: {
    //     optionList: [
    //       ...state.roomInfo.suggestOption.optionList,
    //       data
    //     ]
    //   }
    // })
  })


  dms.onMsg('update_room_proxy', (topic, data) => {
    if (data.target_room_id != dms.room_id || !data.source_room_id) {
      return;
    }
    dms.dmsConfig.proxyTopicMap[data.source_room_id] = data.state || 0;
  })

  /**
   * pc 聊天框左侧底部显示   TODO
   * {"cmd":"notify_msgs","m_uid":7054,"msg":"3"}
   */
  dms.onMsg('notify_msgs', (topic, data) => {
    var str_msg = data.msg || '';
    state.baseConfig.noticecfg.chat_top_msg = str_msg;
  })

  //现金礼物成功返回  区分pc
  dms.onMsg('gift_order', (topic, data) => {
    //手机端不做处理
    if (window.LIVE_PLAT != 'pc') {
      return;
    }
    // if (data.room_id == state.roomInfo.room_id && data.order_id) {
    // }
  })

  dms.onMsg('refresh_vote', (topic, data) => {
    state.roomInfo.hotRank.userTidMap = {};
  })

  /**
   * danmu_msg
   * {"cmd":"danmu_msg","id":"5ac9ea5d4f41a","m_uid":6081,"msg":"fdsf","font_color":"red"}
   */


  //手机摇奖
  dms.onMsg('lottery_start', (topic, data) => {
    if (state.userInfo.role_id == 100) {
      return;
    }
    commit(types.UPDATE_ROOM_INFO, {
      yjInfo: {
        yjStep: 1,
        lotteryObj: data.lottery,
        countDown: data.count_down,
        cur_result_type: 0,
        firstShow: false
      },
    });
  })

  dms.onMsg('lottery_end', (topic, data) => {
    if (state.userInfo.role_id == 100) {
      return;
    }
    commit(types.UPDATE_ROOM_INFO, {
      yjInfo: {
        yjStep: 0,
        lotteryObj: data.lottery,
        countDown: data.count_down,
      },
    })
  })

  dms.onMsg('lottery_win_users', (topic, data) => {
    if (state.userInfo.role_id == 100) {
      return;
    }
    commit(types.UPDATE_ROOM_INFO, {
      yjInfo: {
        yjStep: 3,
        lotteryObj: data.lottery,
        win_user_list: data.users,
        win_user_uids: data.uids,
      },
    })
  })
  dms.onMsg('cmd_judge_send', (topic, data) => {
    state.roomInfo.judgeTeacher.judgeList = data.teachers || [];
  })
}