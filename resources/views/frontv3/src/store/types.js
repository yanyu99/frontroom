// action
export const LOAD_ROOM_INFO = "LOAD_ROOM_INFO" //初始化 房间数据

// tab 栏 信息 数据加载
export const LOAD_RANKING_HOT = "LOAD_RANKING_HOT" //初始化  人气榜
export const LOAD_RANKING_LEAVE = "LOAD_RANKING_LEAVE"
export const LOAD_TEACHER_JUDGE = "LOAD_TEACHER_JUDGE" //讲师审判
export const LOAD_RANK_JF = "LOAD_RANK_JF" //初始化 积分榜
export const LOAD_RANK_GIFT_SEND = "LOAD_RANK_GIFT_SEND" //初始化  送礼排行榜
export const LOAD_RANK_GIFT_GOT = "LOAD_RANK_GIFT_GOT" //初始化  收礼排行榜

export const LOAD_USER_LIST = "LOAD_USER_LIST" //加载用户列表
export const LOAD_YJLOTTERY = "LOAD_YJLOTTERY" //摇奖信息

// 更多菜单 数据加载
export const LOAD_FORTUNEINFO = "LOAD_FORTUNEINFO" //初始化  抽奖
export const LOAD_LESSON = "LOAD_LESSON" //课程

// 更多操作  数据加载
export const LOAD_USERPACKETINFO = "LOAD_USERPACKETINFO" //初始化 红包信息

export const DO_MSG_SEND_PC = "DO_MSG_SEND_PC" //发送消息
export const DO_MSG_SEND_REAL = "DO_MSG_SEND_REAL" //真正发送
export const DO_PRI_MSG_SEND = "DO_PRI_MSG_SEND" //发送私聊消息
export const DO_MSG_DEL = "DO_MSG_DEL" //删除消息
export const DO_USERINFO_LOOK = "DO_USERINFO_LOOK" //查看用户消息
export const DO_MSG_CHECK = "DO_MSG_CHECK" //审核消息
export const DO_KILL_IP = "DO_KILL_IP" //封杀ip
export const DO_USER_KICK = "DO_USER_KICK" //踢出
export const DO_USER_GAG = "DO_USER_GAG" //禁言
export const DO_USER_LOOKVIDEO = "DO_USER_LOOKVIDEO" //用户看视频 //禁视频

// mutation
export const INIT_CHAT_LIST = 'INIT_CHAT_LIST' //初始化 聊天列表

// DMS 接收到不同的消息
export const ON_MSG_CHAT = "ON_MSG_CHAT" //接收 聊天消息
export const ON_USER_LEAVE = 'ON_USER_LEAVE' //有用户离开
export const ON_USER_ENTER = 'ON_USER_ENTER' //有用户进入
export const ON_USER_UPDATE = 'ON_USER_UPDATE' //更新用户

// 原有配置型 不推荐使用
export const D = 'D'
export const baseConfig = 'baseConfig'

// state 页面状态 用于 state 中
export const userInfo = 'userInfo'
export const roomInfo = 'roomInfo'


// state 更新操作  用于 mutaction  单纯的合并对象
export const UPDATE_USER_INFO = 'UPDATE_USER_INFO'
export const UPDATE_ROOM_INFO = 'UPDATE_ROOM_INFO'
export const UPDATE_BASECONFIG_INFO = 'UPDATE_BASECONFIG_INFO'
export const UPDATE_LM = 'UPDATE_LM'
export const UPDATE_LC = 'UPDATE_LC'
export const UPDATE_LP = 'UPDATE_LP'

// getters  无法更改  只需要通过修改 state 中的数据  会自动对应变化
export const size = 'size'
export const innerMenus = 'innerMenus'
export const userCenter = "userCenter" //用户中心
export const qqMap = 'qqMap' //QQ
export const navMenu = 'navMenu' //pc端的导航
export const roominfoBot = 'roominfoBot'
export const treasureArr = "treasureArr"
export const sortUserList = "sortUserList"
export const lazyLoad = {
  last: 0, // 上一次加载数据的时间 单位 ms
  timer: null, // 定时器 定时跟新数据
  refresh: 30 * 1000 // 默认刷新间隔 30 秒
}

//当前讲师  空的对象
export const emptyTeacher = {
  base: 0,
  created_at: "",
  fired: 0,
  hot_base: 0,
  hot_got: 0,
  tid: 0,
  imgurl: "",
  introduction: "",
  is_vote: 0,
  j_name: "",
  jf_got: 0,
  name: "",
  name_bold: 0,
  hide_vote_num: 0,
  name_color: "#ffffff",
  room_id: 0,
  show: 0,
  showimg: "",
  sort: 0,
  today: 0,
  today_base: 0,
  total: 0,
  total_base: 0,
  updated_at: "",
}

//当前查看的用户  空的对象
export const emptyUserInfo = {
  account: "",
  add_uid: "",
  created_at: "",
  description: "",
  gag: 0, //禁言
  kick: 0, //踢出
  last_login: 0,
  lookvideo: 0, //是否禁视频
  luck: "",
  name: "",
  parent: 0,
  phone: "",
  pic: "",
  qq: "",
  recommend_num: 0,
  recommend_reg: 0,
  robot: false,
  room_id: 0,
  seo: null,
  theme: "",
  type: 0,
  uid: 0,
  updated_at: "",
  killip: 0,
}

export const emptyChatTo = {
  toUid: 0,
  toName: '大家',
  from: '',
  toType: 0
}
export const optionSearchArr = [
  { id: 1, des: "全部", role_id: 0, name: 'all', num: 0 },
  { id: 2, des: "管理员", role_id: '500', name: 'mgr', num: 0 },
  { id: 3, des: "讲师", role_id: '400', name: 'teacher', num: 0 },
  { id: 4, des: "会员", role_id: '1', name: 'reg', num: 0 },
  { id: 5, des: "游客", role_id: '100', name: 'guest', num: 0 },
]

export const fixEmoji = (message, strClass) => {
  return dms.parseEmotion(message, strClass);
}

export const dialogMsgAlign = (msg, title, btn, time) => {
  msg = msg || '操作成功';
  title = title || '提示';
  btn = btn || '我知道啦';
  var align_dom = document.getElementById('chattitle');
  var args = {
    title: title,
    align: 'bottom',
    content: msg,
    quickClose: true
  };
  if (btn !== 'hide') {
    args['button'] = [{
      value: btn,
      callback: function () {
        return true;
      },
      autofocus: true
    }];
  }
  dialog(args).show(align_dom);
  time && setTimeout(() => {
    dialog.getCurrent().close();
  }, (time || 1) * 1000);
}

export const dialogMsg = (msg, title, btn, time) => {
  msg = msg || '操作成功';
  title = title || '提示';
  btn = btn || '确认';

  var args = {
    title: title,
    align: 'bottom',
    content: msg,
    quickClose: true
  };
  if (btn !== 'hide') {
    args['button'] = [{
      value: btn,
      callback: function () {
        return true;
      },
      autofocus: true
    }];
  }
  dialog(args).show();
  time && setTimeout(() => {
    dialog.getCurrent().close();
  }, (time || 1) * 1000);
}

//彩条
export const caitiaoArr = [{
  "tag": "xh",
  "title": "送花",
  "name": "[彩条-鲜花V3]",
  "iconUrl": window.D.cdn + window.baseConfig.caitiaocfg.xh_icon + "?v=" + window.D.ver,
  "imgUrl": window.D.cdn + window.baseConfig.caitiaocfg.xh_imgurl + "?v=" + window.D.ver
}, {
  "tag": "gl",
  "title": "给力",
  "name": "[彩条-给力V3]",
  "iconUrl": window.D.cdn + window.baseConfig.caitiaocfg.gl_icon + "?v=" + window.D.ver,
  "imgUrl": window.D.cdn + window.baseConfig.caitiaocfg.gl_imgurl + "?v=" + window.D.ver
},
{
  "tag": "gz",
  "title": "鼓掌",
  "name": "[彩条-鼓掌V3]",
  "iconUrl": window.D.cdn + window.baseConfig.caitiaocfg.gz_icon + "?v=" + window.D.ver,
  "imgUrl": window.D.cdn + window.baseConfig.caitiaocfg.gz_imgurl + "?v=" + window.D.ver
},
{
  "tag": "dq",
  "title": "顶起",
  "name": "[彩条-顶起V3]",
  "iconUrl": window.D.cdn + window.baseConfig.caitiaocfg.dq_icon + "?v=" + window.D.ver,
  "imgUrl": window.D.cdn + window.baseConfig.caitiaocfg.dq_imgurl + "?v=" + window.D.ver
},
{
  "tag": "dz",
  "title": "点赞",
  "name": "[彩条-点赞V3]",
  "iconUrl": window.D.cdn + window.baseConfig.caitiaocfg.dz_icon + "?v=" + window.D.ver,
  "imgUrl": window.D.cdn + window.baseConfig.caitiaocfg.dz_imgurl + "?v=" + window.D.ver
}];

const searchVariablesArgsTFunc = (searchConst, isRoom) => {
  var ret = [];
  for (const t of Object.keys(searchConst)) {
    searchConst[t] =
      typeof searchConst[t] == "string" ? {
        type: searchConst[t]
      } :
      searchConst[t];
    var type = searchConst[t].type;
    ret.push(searchConst[t].notnull ? `$${t}: ${type}!` : `$${t}: ${type}`);
  }
  return isRoom ? ('$room_id: Int!, ' + ret.join(", ")) : ret.join(", ");
};

const searchVariablesArgsRFunc = searchConst => {
  var ret = [];
  for (const t of Object.keys(searchConst)) {
    ret.push(`${t}: $${t}`);
  }
  return ret.join(", ");
};

const pageInfo = `
pageInfo{
  total page num hasNextPage hasPreviousPage
}
`

// dms.modnc 内参
export const internalInfoListSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'internalInfoListSelect';
  var isRoom = true;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      room(room_id: $room_id) {
        internalInfoList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows {
            id
            tid
            title
            content
            pub_at
            teacher {
              name
              j_name
            }
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}
export const stockPoolListSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'stockPoolListSelect';
  var isRoom = true;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      room(room_id: $room_id) {
        stockPoolList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows {
            id
            room_id
            stock_code
            buy_time
            buy_pri
            sell_time
            sell_pri
            trade_gains
            trade_reason
            tid
            pub_at
            teacher {
              name
              j_name
            }
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}

export const downloadFileListSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'downloadFileListSelect';
  var isRoom = true;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      room(room_id: $room_id) {
        downloadFileList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows {
            id
            room_id
            filename
            filesize
            filepath
            download_num
            pub_at
            jf_num
            created_at
            adder{
              name
            }
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}

export const vodListSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'vodListSelect';
  var isRoom = true;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      room(room_id: $room_id) {
        vodList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows {
            id
            vod_url
            vod_pic
            vod_title
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}

//  dms.userRecommend
export const userRecommenderSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    recommender_id: 'Int',
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'userRecommenderSelect';
  var isRoom = false;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      curUser {
        userList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows{
            name uid created_at
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}


export const luckMoneyRunningListSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'f_luckMoneyRunningList';
  var isRoom = false;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      curUser {
        luckMoneyRunningList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows{
            luck_id
            room_id
            uid
            money
            created_at
            user {
              uid
              name
            }
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}

export const userLuckMoneyListSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'userLuckMoneyListSelect';
  var isRoom = false;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      curUser {
        luckMoneyList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows{
            luck_id
            room_id
            uid
            money
            left_money
            luck_note
            num
            left_num
            created_at
            user {
              uid
              name
            }
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}

// dms.userJfRecord
export const userJfRecordSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'userJfRecordSelect';
  var isRoom = false;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      curUser {
        ext {
          jf_cur
          jf_giftsend
          jf_total
          view_total
        }
        userJfRecord(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows {
            id
            uid
            jf_num
            jf_note
            jf_type
            prize_id
            created_at
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}

export const userExtSelect = (args, success, failure) => {
  var selectName = 'userExtSelect';
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName} {
      curUser {
        uid
        name
        ext {
          jf_cur
          jf_giftsend
          jf_total
          view_total
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}


export const tradeManualListSelect = (args, success, failure) => {
  args = args || {};
  args.num = args.num || 20;
  args.page = args.page || 1;

  var argsT = {
    page: 'Int',
    num: 'Int'
  };
  var selectName = 'tradeManualListSelect';
  var isRoom = true;
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}(${searchVariablesArgsTFunc(argsT, isRoom)}) {
      room(room_id: $room_id) {
        tradeManualList(${searchVariablesArgsRFunc(argsT)}) {
          ${pageInfo}
          rows {
            id
            title
            variety
            manual_type
            cb_price
            zs_price
            mb_price
            mr_mc
            jc_at
            pc_at
            pub_at
            created_at
            teacher {
              tid
              name
            }
          }
        }
      }
    }
    `,
    operationName: selectName,
    variables: args
  }, success, failure);
}


export const queryNavInternalById = (args, success, failure) => {
  args = args || {};
  args.id = args.id;
  var selectName = 'navinternalSelect';
  return dms.GraphQLApi.exec({
    query: `
    query ${selectName}{
      navInternalInfo(id:${args.id}){
        id
        tid
        title
        content
        pub_at
        created_at
        updated_at
        teacher{
           tid 
           name
        }
      }
    }`,
    operationName: selectName,
    variables: args
  }, success, failure);
}