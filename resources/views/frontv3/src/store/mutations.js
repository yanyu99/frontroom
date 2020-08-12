import * as types from "./types"
import Vue from 'vue'

var removeChatTimer = null;

var real_ON_USER_ENTER = (state, payload) => {
  var userListArr = {
    gag: payload.gag,
    room_id: payload.room_id,
    kick: payload.kick,
    //lookvideo: payload.lookvideo,
    name: payload.name,
    pic: payload.pic, //
    plat: payload.plat || {},
    role: {
      role_id: payload.role_id,
      ...payload.role
    },
    role_id: payload.role_id,
    uid: payload.uid,
  }

  const sortUserList = (userListArr) => {
    var _curEnterRoleId = userListArr.role_id
    if (_curEnterRoleId >= 500 || _curEnterRoleId == 400) { //超管  一级管理员员  讲师
      if (_curEnterRoleId == 1000) {
        state.roomInfo.userData.userList.unshift(userListArr);
      } else {
        if (_curEnterRoleId == 500) {
          var f_idx = state.roomInfo.userData.userList.findIndex(d => d.role_id && d.role_id == 1000);
          var f_skip = f_idx < 0 ? 0 : state.roomInfo.userData.userList.filter(d => d.role_id && d.role_id == 1000).length;
        } else if (_curEnterRoleId == 400) {
          var f_idx = state.roomInfo.userData.userList.findIndex(d => d.role_id && d.role_id >= 500);
          var f_skip = f_idx < 0 ? 0 : state.roomInfo.userData.userList.filter(d => d.role_id && d.role_id >= 500).length;
        }
        state.roomInfo.userData.userList.splice(f_skip, 0, userListArr);
      }
    } else if (userListArr.role.f_privatechat) {
      var f_idx = state.roomInfo.userData.userList.findIndex(d => d.role_id && (d.role_id == 400 || d.role_id >= 500));
      var f_skip = f_idx < 0 ? 0 : state.roomInfo.userData.userList.filter(d => d.role_id && (d.role_id == 400 || d.role_id >= 500)).length;
      state.roomInfo.userData.userList.splice(f_skip, 0, userListArr);
    } else {
      var f_idx = state.roomInfo.userData.userList.findIndex(d => (d.role_id && (d.role_id == 400 || d.role_id >= 500)) || (d.role && d.role.f_privatechat));
      var f_skip = f_idx < 0 ? 0 : state.roomInfo.userData.userList.filter(d => (d.role_id && (d.role_id == 400 || d.role_id >= 500)) || (d.role && d.role.f_privatechat)).length;
      state.roomInfo.userData.userList.splice(f_skip, 0, userListArr);
    }
  }

  if (state.userInfo.role.f_ul_ht_self) { // 开启 f_ul_ht_self 权限的用户  只处理 room_id 为 0 和 room_id 为本房间的用户进入
    if ((!userListArr.room_id || (userListArr.room_id == parseInt(state.roomInfo.room_id))) && state.roomInfo.userData.userList.findIndex(d => d.uid == userListArr.uid) == -1) {
      sortUserList(userListArr);
    }
  } else if (state.roomInfo.userData.userList.findIndex(d => d.uid == userListArr.uid) == -1) {
    sortUserList(userListArr);
  }

  if (state.roomInfo.userData.userList.length > 400) {
    state.roomInfo.userData.userList.splice(400, 10);
  }
}

/**
 * present 当前的聊天人数状况
 clientId:"test|1015_1000004994_mobile"
 plat:"mobile"
 uid:"1000004994"
 */
var real_ON_USER_LEAVE = (state, payload) => {
  var obj = payload; //dms.parseUid(payload.clientId);
  var idx = state.roomInfo.userData.userList.findIndex(d => d.uid == obj.uid && d.plat == obj.plat);
  if (idx != -1) {
    state.roomInfo.userData.userList.splice(idx, 1);
  }
}

var userActionBuffer = [];
var userListTimer = null;

userListTimer = setInterval(() => {
  while (userActionBuffer.length) {
    var item = userActionBuffer.pop();
    if (item.key == 'enter') {
      real_ON_USER_ENTER(item.state, item.payload);
    } else {
      real_ON_USER_LEAVE(item.state, item.payload);
    }
  }
}, 1000);

const mutations = {
  [types.UPDATE_USER_INFO](state, payload) {
    Object.keys(payload).map(k => {
      var tmp = dms.deepExtend(state.userInfo[k], payload[k])
      Vue.set(state.userInfo, k, tmp)
      if (Object.prototype.toString.call(tmp) === '[object Object]') {
        Object.keys(tmp).map(kk => {
          Vue.set(state.userInfo[k], kk, tmp[kk])
        })
      }
    })
  },
  [types.UPDATE_ROOM_INFO](state, payload) {
    Object.keys(payload).map(k => {
      var tmp = dms.deepExtend(state.roomInfo[k], payload[k])
      Vue.set(state.roomInfo, k, tmp)
      if (Object.prototype.toString.call(tmp) === '[object Object]') {
        Object.keys(tmp).map(kk => {
          Vue.set(state.roomInfo[k], kk, tmp[kk])
        })
      }
    })
  },
  [types.UPDATE_BASECONFIG_INFO](state, payload) {
    Object.keys(payload).map(k => {
      var tmp = dms.deepExtend(state.baseConfig[k], payload[k])
      Vue.set(state.baseConfig, k, tmp)
      if (Object.prototype.toString.call(tmp) === '[object Object]') {
        Object.keys(tmp).map(kk => {
          Vue.set(state.baseConfig[k], kk, tmp[kk])
        })
      }
    })
  },
  //初始化聊天
  [types.INIT_CHAT_LIST](state, payload) {
    var chatList = payload.chatList ? payload.chatList.reverse() : []
    chatList.map(value => {
      if (value.uid == state.userInfo.uid) {
        value.meClass = 'chat-me'
      }
      //消息
      if (value.type == 3) {
        value.text = value.message;
        value._type = 'CashGiftItem';
      }
      if (value.isLuckMoney == 1) {
        state.roomInfo.packArr.push(value);
      }
      //value.message = value.message.replace('\n', "<br>")
    })
    var _tempChatList = chatList.slice();
    if (window.LIVE_PLAT == "pc") {
      _tempChatList.push({
        text: "以上为历史消息",
        time: dms.date('H:i'),
        _type: 'HistoryItem',
      });
    }

    Vue.set(state.roomInfo, 'chatList', _tempChatList)

    if (state.baseConfig.noticecfg.dynamic_msg) {
      var sysMsg = {
        text: state.baseConfig.noticecfg.dynamic_msg,
        time: dms.date('H:i'),
        _type: 'SystemMsgItem',
      }
      state.roomInfo.chatList.push(sysMsg)
    }
  },
  /**
   *接收消息
   */

  [types.ON_MSG_CHAT](state, payload) {

    var data = payload.data
    console.log("data.hasFilter===========", data.hasFilter, data);
    if (data.sendUid == state.userInfo.uid) {
      return;
    }

    data.message = data.message.replace('\n', "<br>");

    if (data.type == 3) {
      data._type = 'CashGiftItem';
    }

    if (data.uid == state.userInfo.uid) {
      data.meClass = 'chat-me'; // 对我说的消息 TODO
    }

    if (data.hasFilter && !state.userInfo.isManager) {
      return; // 被过滤的消息 当前不是管理员 放弃处理
    }

    if (data.id == undefined) {
      data.id = dms.uniqueId() + "_" + data.uid;
    }

    var lastMsgIdx = state.roomInfo.chatList.findIndex(d => d.id == data.id && data.id != "undefined")
    if (lastMsgIdx > 0) {
      state.roomInfo.chatList[lastMsgIdx] = data;
      return;
    }
    var lastNoIdMsgIdx = state.roomInfo.chatList.lastIndexOf(d => !d.id)

    if (lastNoIdMsgIdx > 0) {
      state.roomInfo.chatList[lastNoIdMsgIdx] = data;
      return;
    }
    state.roomInfo.chatList.push(data);

    if (removeChatTimer) {
      return;
    }
    removeChatTimer = setInterval(() => {
      var rm_len = state.roomInfo.chatList.length - 100;
      if (rm_len <= 100) {
        return;
      }
      state.roomInfo.chatList.splice(0, rm_len);
    }, 2000);
  },


  /**
   *  enter 用户进入追加
   */
  [types.ON_USER_ENTER](state, payload) {
    userActionBuffer.push({
      key: 'enter',
      state: state,
      payload: payload
    });
  },

  /**
   * present 当前的聊天人数状况
   clientId:"test|1015_1000004994_mobile"
   plat:"mobile"
   uid:"1000004994"
   */
  [types.ON_USER_LEAVE](state, payload) {
    userActionBuffer.push({
      key: 'leave',
      state: state,
      payload: payload
    });
  },

  //更新用户
  [types.ON_USER_UPDATE](state, payload) {
    // $warp = $('#idUserList');
    // $('#user_' + user.uid + "_" + user.plat).remove();
    // $warp.prepend($CHAT_USER_ITEM_TMPL.render(user));
    // //$warp.find('.user-item[data-name="' + user.name + '"]').find('.dropdown-menu').dropdownHover();
    // $warp.prepend($('.has-prichat').remove());
  },


}

export default mutations