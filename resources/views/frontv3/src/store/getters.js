import * as types from "./types"

const getters = {
  [types.size](state) {
    var v_width = state.roomInfo.sizeConfig.videotWidth;
    //计算视频的高度
    var _pecentStr = state.baseConfig.playercfg.phone_video;
    var _tmpArr = _pecentStr ? _pecentStr.split(':') : []; //0.5625
    var pecent = parseInt(_tmpArr[1]) && parseInt(_tmpArr[0]) ? parseFloat(parseInt(_tmpArr[1]) / parseInt(_tmpArr[0])) : 0.5625;
    var v_height = parseInt(_tmpArr[1]) > 0 ? parseFloat(parseFloat(v_width * pecent).toFixed(4)) : 0;

    return {
      cdn: state.D.cdn,
      ver: state.D.ver,
      video: { // 视频宽高 单位为 px
        width: v_width + 'px',
        height: v_height + 'px',
      },
    }
  },

  [types.innerMenus](state) {
    const emptyNav = { // 无
      tag: 'EMPTY',
      text: '无',
      imgUrl: ''
    };
    var innerMenusMap = {
      4000: {
        tag: 'EmptyType',
        plate: 'pc',
      }, // 无
      4015: emptyNav, // 不添加   积分商城
      4200: {
        tag: 'UserList', //用户列表
        plate: 'pc',
      },
      4002: {
        tag: 'QQPIC', //图片模块
        plate: 'pc',
      },
      4003: { //跳转链接
        tag: 'LINKTO',
      },
      4500: { //网页助理
        tag: 'QQ',
        plate: 'pc',
      },
      4009: {
        tag: 'DOWNLOAD',
        imgUrl: "",
        plate: 'pc',
      },
      4014: { //课程安排
        tag: 'COURSE',
      },
      4004: { // 导航助理
        tag: 'QQHELPER',
      },
      4020: { //抽奖  (转盘)    TODO
        tag: 'FORTUNE',
      },
      4010: { // 分享收藏
        tag: 'SHARE',
      },
      4012: { // 财经日历
        tag: 'ECO_CALENDER',
      },
      4001: { //股池  TODO
        tag: 'STOCKPOOL',
      },
      4013: { // 专家团队
        tag: 'TEACHER',
      },
      4016: { // 行情资讯
        tag: 'NEWS',
      },
      4100: { // 内参
        tag: 'INNERJOIN',
      },
      4017: { // 轮播图
        tag: 'PICROLL',
      },
      4007: { // 操作建议
        tag: 'OPTIONS',
      },
      4300: { //课程赛事
        tag: 'CONTASTCOURSE',
      },
      4400: { //收益榜
        tag: 'INCOME',
      },
      4600: { //东方财富
        tag: 'DFCF',
      },
      4800: { //签到模块
        tag: 'SIGNIN',
        plate: 'pc',
      },
      5000: {
        tag: 'UserVote',
      },
      5100: {
        tag: 'TeacherReward',
      }
    };

    var menus = [] // 默认增加签到选项
    //TODO
    // if (state.baseConfig.roomUI.yjlottery) {
    //   menus.push({
    //     key: 'YjLottery_0',
    //     tag: 'YjLottery',
    //     text: "摇奖",
    //     imgUrl: state.LM.INNER_MENU_ICON.YjLottery
    //   })
    // }

    //tab管理  //TODO
    // if (state.baseConfig.roomtabs.length) {
    //   menus.push({
    //     key: 'RoomTabs',
    //     tag: 'RoomTabs',
    //     text: state.LM.INNER_MENU_ICON.ROOMTABS_TXT,
    //     imgUrl: state.LM.INNER_MENU_ICON.ROOMTABS,
    //     plate: 'phone',
    //   })
    // }
    // //讲师审核 TODO
    // if(state.baseConfig.site.teacher_judge_opend){
    //   menus.push({
    //     key: 'TeacherJudge',
    //     tag: 'TeacherJudge',
    //     text: state.LM.INNER_MENU_ICON.TEACHERJUDGE_TEXT,
    //     imgUrl: state.LM.INNER_MENU_ICON.TEACHERJUDGE,
    //     plate: 'phone',
    //   })
    // }


    for (var nav of state.baseConfig.roomnavs) {
      var tmp = innerMenusMap[nav.nav_type];
      if (nav.nav_type == 5100 && !state.baseConfig.site.reward_opend) {
        continue;
      }
      tmp && tmp.tag != 'EMPTY' && menus.push({
        ...tmp,
        key: tmp.tag + "_" + nav.id,
        id: nav.id,
        text: nav.nav_title || tmp.nav_text,
        args: nav.nav_config || {},
        pos: nav.nav_pos,
        icon: nav.nav_icon || "",
        type: nav.nav_type || 0
      })
    }
    return menus
  },
  [types.userCenter](state) {
    var userCenterList = [
    {
      tag: "我的" + state.baseConfig.textcfg.jf_txt_tit,
      pic: '/assets/img/user/icon_02.png',
      href: '/jfrecord',
      icon: '1',
      compon: 'JfRecord',
      palte: 'all',
    },
    {
      tag: "红包记录",
      pic: '/assets/img/user/icon_03.png',
      href: '/luckmoney',
      icon: '2',
      compon: 'PacketList',
      palte: 'all',
    },
    {
      tag: "推广记录",
      pic: '/assets/img/user/icon_04.png',
      href: '/recommend',
      icon: '3',
      compon: 'Recommend',
      palte: 'all',
    }, ]
    if (state.baseConfig.regcfg && state.baseConfig.regcfg.change_pwd) {
      userCenterList.push({
        tag: "修改密码",
        pic: '/assets/img/user/icon_05.png',
        href: '/editpwd',
        icon: '4',
        compon: 'EditPwd',
        palte: 'all',
      })
    }
    if (state.baseConfig.regcfg && baseConfig.regcfg.change_name) {
      userCenterList.push({
        tag: "修改昵称",
        pic: '/assets/img/user/icon_06.png',
        href: '/editnick',
        icon: '5',
        compon: 'EditNick',
        palte: 'phone',
      })
    }
    return userCenterList
  },
  [types.treasureArr](state) {
    if (window.LIVE_PLAT != 'pc') {
      return {};
    }
    var ret = [];
    var curTreasureNum = 6; // state.baseConfig.roomUI.treasureTimes;
    for (var i = 0; i < curTreasureNum; i++) {
      var tmp = {};
      var curInd = i;
      tmp.idx = curInd; //当前索引
      tmp._info = state.baseConfig.jfcfg.treasure_config['gj_ts' + curInd] || 0;

      if (curInd < 4) {

        if (curInd < state.roomInfo.treasureInfo.treasureIndex) {
          tmp.btnClass = 'yet-btn';
          tmp.desBtn = "已经领取";
          tmp.spClass = 'yet'

        } else if (state.roomInfo.treasureInfo.treasureIndex == curInd && state.roomInfo.treasureInfo.treasurnStatus == 1) {
          tmp.btnClass = 'may-btn';
          tmp.desBtn = "可领取";
          tmp.spClass = 'may-get'
        } else {
          tmp.btnClass = 'next-btn';
          tmp.desBtn = "礼物专享";
          tmp.spClass = 'wait-get'
        }
      } else {
        if (curInd < state.roomInfo.treasureInfo.treasureIndex) {
          tmp.btnClass = 'yet-btn';
          tmp.desBtn = "已经领取";
          tmp.spClass = 'yet'
        } else if (state.roomInfo.treasureInfo.treasureIndex == curInd && state.roomInfo.treasureInfo.treasurnStatus == 1) {
          tmp.btnClass = 'may-btn';
          tmp.desBtn = "可领取";
          tmp.spClass = 'cq-get'
        } else {
          tmp.btnClass = 'next-btn';
          tmp.desBtn = "酬勤专享";
          tmp.spClass = "w-cq-get"
        }
      }
      if (state.roomInfo.treasureInfo.treasureIndex == curInd && state.roomInfo.treasureInfo.treasurnStatus == 0) {
        tmp.btnClass = 'next-btn';
        tmp.desBtn = "等待中";
      }

      ret.push(tmp);
    }
    return ret
  },
  [types.qqMap](state) {
    const typeMap = {
      "5000": { 'name': "导航助理", 'shortName': "LEADIN" },
      '5001': { 'name': "股池助理", 'shortName': "STOCKPOOL" },
      '5002': { 'name': "聊天助理", 'shortName': "CHAT" },
      '5004': { 'name': "入场券", 'shortName': "COUPON" },
    }
    var qq_map = {}
    for (var typeKey of Object.keys(typeMap)) {
      qq_map[typeMap[typeKey].shortName] = state.baseConfig.roomqqs.filter(i => i.room_id == state.roomInfo.room_id && i.qq_type == typeKey)
    }
    return qq_map;
  },


  // 1，超管在最上面
  // 2.有私聊权限的第二位
  // 3.注册账号第三位
  // 4.游客第四位

  [types.sortUserList](state) {
    //return state.roomInfo.userData.userList;
    // 暂时 屏蔽 用户列表 排序逻辑 防止 浏览器性能消耗过大
    if (!state.roomInfo.userData.filterStrParam && !state.roomInfo.userData.filterSelParam) {
      return state.roomInfo.userData.userList;
    }

    var _userList = state.roomInfo.userData.userList.slice();
    var _strTemp = state.roomInfo.userData.filterStrParam;
    var _strSel = state.roomInfo.userData.filterSelParam;

    var _newArr = [];
    if (!!_strTemp) {
      _userList.map((i, ind) => {
        if (i.name.toLowerCase().indexOf(_strTemp.toLowerCase()) != -1) {
          _newArr.push(i)
        }
      })
      _userList = _newArr;
    }

    if (!!state.roomInfo.userData.filterSelParam) {
      if (_strSel == 1) { //会员
        _userList = _userList.filter(i => i.role_id && (i.role_id != 500 && i.role_id != 400 && i.role_id != 100) && (i.isRobot || 0) != 1)
      } else {
        _userList = _userList.filter(i => i.role_id == _strSel)
      }
    }
    return _userList;
  },

  //roominfobot
  [types.roominfoBot](state) {
    if (window.LIVE_PLAT != 'pc') {
      return {};
    }

    var _infoArr = [];
    if (state.userInfo.role.f_realtime) {
      _infoArr.push({
        tag: 'DynesNotice',
        title: "实时动态",
        tab_text: '',
      })
    }
    for (var item of state.baseConfig.roomtabs) {
      _infoArr.push({
        tag: 'RoomTabs_' + item.id,
        id: item.id,
        is_roll: item.is_roll,
        roll_speed: item.roll_speed,
        type_id: item.type_id,
        title: item.tab_title,
        tab_text: item.tab_text,
        sort: item.tab_sort
      })
    }
    return _infoArr;
  },
}

export default getters

/*
	const USERTYPE_VIP_ID = 1; //注册用户默认角色
	const USERTYPE_GUEST_ID = 100; //游客
	const USERTYPE_ROBOT_ID = 120; //机器人
	const USERTYPE_CS_ID = 300; //'客服'
	const USERTYPE_ZL_ID = 301;
	const USERTYPE_XG_ID = 302;
	const USERTYPE_TEACHER_ID = 400; //"讲师"
	const USERTYPE_MGR_ID = 500; //"管理员"
	const USERTYPE_SUPER_MGR_ID = 1000; //"超级管理员"

<select name="pos" id="typePos" class="form-control">
    <option value="1">导航</option>
    <option value="2">聊天区</option>
    <option value="3">侧边栏</option>
    <option value="4">左侧栏</option>
    <option value="5">功能开关</option>
    1 导航  2 聊天区  3 侧边栏  4 左侧栏 
</select>
<select id="typeSelect" name="type" class="form-control">
  <option value="4000">无</option>
  <option value="4002">图片</option>
  <option value="4003">跳转链接</option>
  <option value="4017">轮播图</option>
  <option value="4500">网页助理</option>
  <option value="4004">导航助理</option>
  <option value="4001">股池</option>
  <option value="4005">有奖竞猜</option>
  <option value="4007">操作建议</option>
  <option value="4014">课程安排</option>
  <option value="4009">文件下载</option>
  <option value="4010">分享收藏</option>
  <option value="4012">财经日历</option>
  <option value="4013">专家团队</option>
  <option value="4015">积分商城</option>
  <option value="4016">行情资讯</option>
  <option value="4020">抽奖</option>
  <option value="4100">内参</option>
  <option value="4200">用户列表</option>
</select>
*/
/**
 * 礼物发送
 * 转播消息
 */