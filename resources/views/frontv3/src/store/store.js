import Vue from "vue"
import Vuex from "vuex"
import mutations from "./mutations"
import actions from "./actions"
import getters from "./getters"
import VueGettext from "./vue-gettext"
import * as types from "./types"
import layer from '@/vue-layer'

Vue.prototype.$layer = layer(Vue);
Vue.use(Vuex);
Vue.use(VueGettext);

Vue.mixin({
  computed: {
    ...Vuex.mapState([types.userInfo, types.roomInfo, types.baseConfig]),
  },
  methods: {
    _px,
    rem2px,
    px2rem,
    /*
     * key  roomInfo 状态下的 字段名  需要 扩展 lazyLoad
     * expr  需要监听的 表达式
     * filter  过滤函数  判断是否需要处理 格式为 filter(newVal, oldVal) bool
     * load  加载数据函数  格式为 load() void  默认为 this.load
     * active  判断是否激活函数  格式为 active() bool  默认为 this.active
     */
    lazyWatch(key, expr, filter, load, active) { 
      if (!this.roomInfo[key]) { return; }
      active = active || this.active
      load = load || this.load
      this.$watch(expr, (newVal, oldVal) => {
        if (!filter(newVal, oldVal)) { return; }
        Date.parse(new Date()) - this.roomInfo[key].last > this.roomInfo[key].refresh && load()
        if (this.roomInfo[key].refresh <= 0 || this.roomInfo[key].timer) { return; }
        typeof active == 'function' && this.$store.commit(types.UPDATE_ROOM_INFO, {
          [key]: {
            timer: setInterval(() => {
              active() && load()
            }, this.roomInfo[key].refresh)
          }
        })
      })
    },
    fixEmoji: types.fixEmoji,
    dialogMsgAlign: types.dialogMsgAlign,
    dialogMsg: types.dialogMsg,
  }
})

const state = {
  [types.D]: window[types.D] || {}, // 原有配置  不推荐使用
  [types.baseConfig]: window[types.baseConfig] || {},
  [types.userInfo]: {
    anotherContent: false, // 账号是否在其他页面打开  为 true 则隐藏视频 显示提示窗
    hotTeacherName: '',
    ...window[types.userInfo] || {}
  },

  [types.roomInfo]: {
    videoUrl: '',
    selectUser: { //查看用户信息
      x: 0,
      y: 0,
      from: '', //表示点击的哪里
      ...types.emptyUserInfo
    },

    is_fist_load: true, //是否第一次加载
    active_menu: '',
    active_inner_menu: '', //内部菜单当前活动的菜单
    active_more_action: '', //更多操作  当前激活  操作按钮
    active_more_isshow: false, //更多操作 是否显示
    inner_menu_isshow: false, //内部菜单框是否显示
    inner_menu_pop_curBoxId: '', //当前最新弹出框的id
    cashgift_is_show: false, //现金礼物
    jf_gift_is_show: false, //积分礼物
    inner_cur_tag: '', // 当前内部菜单活动的tag名字
    danmu_is_open: false, //弹幕开关
    is_robot: false, //是否机器人聊天
    cur_pattern: '', //当前模式 弹幕、机器人
    is_show_logintips: false, //是否显示登录提示框
    active_rank: '',
    menusMapIsNew: { CHAT_PUBLIC: false, CHAT_PRIVATE: false, USER_LIST: false, RANKING_HOT: false, RANKING_LIST: false, VOD_LIST: false },
    sizeConfig: {
      videotWidth: document.documentElement.clientWidth,
      videoHeight: parseFloat(parseFloat(document.documentElement.clientWidth / 852 * 480).toFixed(4)),
      clientWidth: document.documentElement.clientWidth,
      clientHeight: document.documentElement.clientHeight,
    },
    // 公聊 私聊
    chatList: [],
    priChatList: [], //chatData
    selChatMsgItem: { ...types.emptyChatTo },
    selPriChatMsgItem: { ...types.emptyChatTo },
    priChatToList: [], //用户私聊列表
    // 用户列表
    userData: {
      stopAt: 5, //自动加载的情况下  只会加载前 stopAt 页
      isFirstGet: true, //是否第一次已经获取数据
      userList: [],
      ...types.lazyLoad,
      refresh: 0,
      filterStrParam: '', //过滤搜索
      filterSelParam: 0, //下拉
      userReg: 0, //注册用户数（包含管理员讲师）
      userGuest: 0, //游客数量

      selCustomerNum: 0, //注册会员
      selGuestNum: 0, //游客
      selMgrNum: 0, //管理员
      selTeacherNum: 0, //讲师

    },
    treasureInfo: {
      code: 0,
      treasureIndex: -1,
      treasurnStatus: 0
    },
    //讲师团队
    teachersList: [], // 动态更新 点赞数  需要放入 state
    agree_opend: [],
    teachersZan: { //讲师点赞返回信息
      total: 0,
      base: 0,
      today: 0
    },
    // TODO
    videoStatus: {
      is_show_video: window[types.baseConfig].channelInfo.living, //是否显示视屏
    }, //视频状态
    //课程状态
    lessonInfo: {
      lessonList: [],
      ...types.lazyLoad
    },
    //人气榜
    hotRank: {
      teacherList: [],
      questionList: [],
      userTidMap: {},
      tid: 0, //投票的老师
      ...types.lazyLoad,
    },
    // 排行榜
    jfRankOption: {
      jfRankList: [],
      ...types.lazyLoad
    },
    //送礼排行榜
    giftSendRank: {
      dataList: [],
      ...types.lazyLoad
    },
    //收礼排行榜
    giftGotRank: {
      dataList: [],
      ...types.lazyLoad
    },

    // innerJoin: {
    //   // firstPage: [],
    //   // stockPools: [],
    //   qqs: [],
    //   teacherInfo: {}, //详情
    //   ...types.lazyLoad,
    // },
    //抽奖信息
    lotteryInfo: {
      lists: [],
      backList: [],
      ...types.lazyLoad
    },
    //机器人信息
    robotsInfo: {
      real_robot_num: 0, //实际机器人数量
      dataList: [], //机器人列表
      cur_sel_Num: 0, //当前选择的机器人数量
      msg_delaytime: 0,
      myrobotList: [], //当前用户创建的机器人列表
      selRobotObj: {
        cur_sel_robotid: '', //当前选择的机器人的 id
        cur_sel_robotname: '', //当前选择的机器人的 name
      },
      ...types.emptyUserInfo
    },
    //接收礼物
    recGift: {
      giftQueue: [], //礼物列表
      displayNum: 3,
      displayList: [],
    },
    //当前查看的用户信息
    lookUserInfo: { ...types.emptyUserInfo },
    //当前用户发红包获取的信息
    userPacketInfo: {
      money: 0,
      ...types.emptyUserInfo
    },

    // 人数相关   realUserTotal + __base__ + __base_num__ + __real_robot_num
    robot_num: 0, // __base__
    real_robot_num: 0, // __real_robot_num
    realUserTotal: 0,
    //当前讲师
    teacher: { ...types.emptyTeacher },
    ...window[types.roomInfo] || {},

    startCourseTeachers: [],
    //pc 迁移
    curlayer_pop_id: '',
    screenLockStatus: 0,
    is_show_left_userlist: false,
    is_show_pri_box: false, //是否显示私聊框
    giftList: [],
    roomUserSysMsgData: [], //用户进出房间系统消息
    next_past_timeout: 0,

    lottery_show: false, //最外层box
    //刷屏内容
    yjInfo: {
      lotteryObj: {},
      titleMsg: '', //返回的提示信息
      countDown: '',
      win_user_list: [], //参与摇奖用户列表
      win_user_uids: [], //中奖用户id
      cur_result_type: 0, //开奖图片 0:动图摇奖 1:中奖；2：未中奖
      yjStep: -1, //摇奖所到的步骤 4:发起摇奖 0:摇奖进行中（倒计时结束）等待开奖;1：摇奖进行中（倒计时）；2摇奖结束等待下一轮 ;3:显示中奖用户列表
      firstShow: false,
      lastAwardList: [], //上期中奖名单
    },
    //机器人自动发言
    autoRobotConfig: {
      caitiaoList: [],
      textStr: '',
      minTime: 10,
      maxTime: 20,
    },
    autoRobotEnable: false, //自动发言开关
    autoRobotDelay: 1,
    is_fist_loadMsg: true,
    packArr: [], //当前用户可领取的红包
    userVoteInfo: {
      isVoted: -1,
      options: [],
      voteInfo: {}
    },
    wait_Send_Time: 0,

    //TODO
    leaveRank: {
      teacherList: []
    },
    judgeTeacher: {
      judgeList: [],
      userTidMap: {},
    },
    //现金礼物数据
    cashGiftInfo: {
      id: 0,
      name: '',
      price: 0,
      pic: '',
    },
    optSearchArr: [...types.optionSearchArr],
  },

}

export default new Vuex.Store({
  state,
  mutations,
  actions,
  getters,
})