const fs = require("fs");
const path = require("path");
const tParser = require("./tParser.js");
const util = require("./util.js");

var componentParser = new tParser();

function buildComponentText(inPath) {
  var fileMap = util.scanFiles(inPath, function (f_name) {
    return f_name.substr(-4) == '.vue';
  }, function (dir_name) {
    return dir_name.indexOf('\\_\\') < 0;
  });
  var component_map = {};
  for (var f_path in fileMap) {
    if (!fileMap.hasOwnProperty(f_path)) {
      continue;
    }
    var r_path = f_path.replace(inPath + '\\', '');
    r_path = r_path.replace('.vue', '');
    var tmp_arr = r_path.split("\\");
    if (tmp_arr.length < 2) {
      continue;
    }
    var r_tag = tmp_arr[0];
    var r_name = tmp_arr.slice(1).join("\\");
    component_map[r_name] = component_map[r_name] || {};

    var template = fs.readFileSync(f_path, 'utf8');
    var tmp = componentParser.parse(template);
    if (tmp && tmp.length > 0) {
      component_map[r_name][r_tag] = tmp;
    } else {
      component_map[r_name][r_tag] = [];
    }
  }
  return component_map;
}

var pcPath = path.resolve(__dirname, '../src/pc_views');
console.log('buildComponentText args', pcPath);
var pcRet = buildComponentText(pcPath);
var pcRetStr = JSON.stringify(pcRet);

var mobilePath = path.resolve(__dirname, '../src/mobile_views');
console.log('buildComponentText args', mobilePath);
var mobileRet = buildComponentText(mobilePath);
var mobileRetStr = JSON.stringify(mobileRet);

var out_file = path.resolve(__dirname, '../../../../public/assets/front-views-config.js');

var tplNameMap = {
  'default': '默认模版',
  'test123': '测试模版'
};
var tplNameStr = JSON.stringify(tplNameMap);

var pcViewsName = [
  ['AnotherContent', '帐号被挤占提示'],
  ['BottomPannel', '页面底部'],
  ['DanMu', '弹幕'],
  ['VideoBlock', '视频区域'],
  ['ChatBlock', '聊天区域'],
  ['LeftBlock', '左边栏'],
  ['chat\\ChatMsgBox', '消息--消息box'],
  ['chat\\ChatMsgItem', '消息--通用消息模板'],
  ['chat\\HistoryItem', '消息--历史消息模板'],
  ['chat\\MsgOption', '消息--操作'],
  ['chat\\PacketItem', '消息--红包模板'],
  ['chat\\SystemMsgItem', '消息--系统消息模板'],
  ['chatbar\\ChatGift', '积分礼物'],
  ['chatbar\\ChatInput', '聊天输入及菜单栏'],
  ['chatblock\\ChatBarMain', '聊天区底部模块'],
  ['chatblock\\ChatTopNav', '聊天区头部导航'],
  //['chatblock\\GiftShow', ''],
  ['chatmsg\\ChatMsgBox', '消息模板2--消息box'],
  ['chatmsg\\ChatMsgItem2', '消息模板2--通用消息'],
  ['chatmsg\\PacketItem', '消息模板2--红包消息'],
  ['chatmsg\\SystemMsgItem2', '消息模板2--系统消息'],
  ['chatpop\\HONGBAO', '弹出发红包模块'],
  ['chatpop\\TREASURE', '宝箱领取模块'],
  ['coupon\\GetCoupon', '领取积分'],
  ['gift\\GiftDisplay', '积分礼物弹出显示'],
  ['header\\CoupLoginPage', '领券登录页面'],
  ['header\\CouponLogin', '领券登录弹窗'],
  ['header\\HeadBanner', '头部banner块'],
  ['header\\HeadMain', '头部主块'],
  ['header\\HeadRight', '头部右侧模块'],
  ['header\\Login', '登录弹框'],
  ['header\\LoginPage', '登录页面'],
  ['header\\Register', '注册弹框'],
  ['header\\RegisterPage', '注册页面'],
  ['header\\ThemeMenu', '皮肤主题'],
  ['header\\UserInfo', '用户头像悬浮弹出'],
  ['header\\VideoTimeoutBar', '视频计时器'],
  ['midcontent\\RoomBotInfo', '视频块--底部'],
  // ['midcontent\\RoomBotSel', '房间底部单一块'],
  // ['midcontent\\RoomBotTab', '房间底部多个tab块'],
  ['midcontent\\VideoPlayer', '视频块--视频内容块'],
  ['navmenupop\\CONTASTCOURSE', '模块--赛季课程表'],
  ['navmenupop\\COURSE', '模块--课程表'],
  ['navmenupop\\DFCF', '模块--东方财富'],
  ['navmenupop\\DOWNLOAD', '模块--下载'],
  ['navmenupop\\ECO_CALENDER', '模块--日历'],
  ['navmenupop\\FORTUNE', '模块--大转盘'],
  ['navmenupop\\INCOME', '模块--收益排行榜'],
  ['navmenupop\\INNERJOIN', '模块--内参'],
  //['navmenupop\\LeaveMsg', '留言榜留言'],
  ['navmenupop\\NEWS', '模块--新闻资讯'],
  ['navmenupop\\OPTIONS', '模块--操作建议'],
  ['navmenupop\\PICROLL', '模块--轮播图'],
  ['navmenupop\\POPAD', '模块--首次弹出广告'],
  ['navmenupop\\QQHELPER', '模块--QQ助理'],
  ['navmenupop\\QQPIC', '模块--'],
  ['navmenupop\\QRCODE', '模块--二维码弹框'],
  ['navmenupop\\RobotAutoModal', '机器人自动发言'],
  ['navmenupop\\SHARE', '模块--分享'],
  ['navmenupop\\STOCKPOOL', '模块--股池'],
  ['navmenupop\\TEACHER', '讲师投票模式'],
  ['navmenupop\\TEACHERINFO', '模块--内参详情'],
  ['navmenupop\\TeacherReward', '模块--审判评论'],
  ['navmenupop\\VIDEO', '视频库'],
  ['packet\\PacketSuc', '红包--领取成功'],
  ['rank\\RANK_GIFTGOT', '排行榜--收礼排行榜'],
  ['rank\\RANK_GIFTSEND', '排行榜--送礼排行榜'],
  ['rank\\RANK_HOTTING', '排行榜--投票'], //？？？
  ['rank\\RANK_JF', '排行榜--积分排行榜'],
  ['side\\AnswerQues', '侧边栏--点赞回答问题投票'],
  ['side\\PRICHAT', '侧边栏--弹出私聊模块'],
  ['side\\SideLogin', '侧边栏--登录模块'],
  ['side\\SideMain', '侧边栏主块'],
  //['side\\TeacherJudge', '侧边栏--审判团'],
  //['side\\LeaveList', '侧边栏--留言模块'],
  //['side\\StockNews', '侧边栏--股票代码'],
  //['side\\TeacherList', '侧边栏--讲师团队'],
  //['side\\VoteList', '侧边栏--人气排行榜'],
  ['side\\UserCard', '用户列表弹出卡片'],
  ['side\\UserList', '侧边栏--用户列表'],
  ['side\\UserListLeft', '用户列表左侧悬浮'],
  ['usercenter\\UserMain', '个人中心'],
  ['usercenter\\EditPwd', '个人中心--编辑密码'],
  ['usercenter\\JfRecord', '个人中心--积分列表'],
  ['usercenter\\PacketList', '个人中心--红包流水'],
  ['usercenter\\Recommend', '个人中心--推广记录'],
  ['usercenter\\SetInfo', '个人中心--设置用户信息'],
  ['util\\CommonNav', '公共组件--页面菜单导航'],
  ['util\\CommQq', '公共组件--qq模块相同提取'],

  ['yjlottery\\YjContent', '摇奖'],
  // ['yjlottery\\WaitNext', '摇奖--等待开启下一轮'],
  // ['yjlottery\\WinUser', '摇奖--中奖用户'],
  // ['yjlottery\\YjEnd', ''],
  // ['yjlottery\\YjGoing', ''],
  // ['yjlottery\\YjStart', '']

  //['cashgift\\CashGift', '现金礼物'],
  //['cashgift\\CreateOrder', ''],
  //['chat\\CashGiftItem', ''],
  // ['util\\paging', '分页组件'],
  // ['votecon\\StartVote', ''],
  // ['votecon\\UserVote', ''],
  // ['votecon\\VotePecent', ''],
  // ['votecon\\VoteSelect', ''],
];
var pcNameStr = JSON.stringify(pcViewsName);

var mobileViewsName = [
  ['AnotherContent', '帐号被挤占提示'],
  ['DanMu', '弹幕'],
  ['Login', '登录界面'],
  ['MainContent', '手机进入主界面'],
  ['Register', '注册页面'],
  ['VideoPlayer', '视频块'],
  ['chat\\CashGiftItem', '现金礼物系统消息'],
  ['chat\\ChatMsgBox', '消息--容器'],
  ['chat\\ChatMsgItem', '消息--普通模板'],
  ['chat\\MsgOption', '消息--操作'],
  ['chat\\PacketItem', '消息--红包'],
  ['chat\\PriChatItem', '消息--私聊'],
  ['chat\\SystemMsgItem', '消息--系统'],
  ['chat\\UserInfoCheck', '查看用户信息弹出框'],
  ['chatbar\\ChatBar', '发送--菜单公聊区'],
  ['chatbar\\ChatBarPri', '发送--私聊区'],
  ['chatbar\\ChatTo', '对谁说'],
  ['chatbar\\CurPattern', '底部当前模式'],
  ['chatbar\\MoreAction', '发送更多操作'],
  ['coupon\\CouponLogin', '领券--登录'],
  ['coupon\\GetCoupon', '领券--联系'],
  ['coupon\\VideoTimeoutBar', '计时器'],
  ['gift\\GiftDisplay', '积分礼物显示块'],
  ['menu\\CONTASTCOURSE', '模块--赛程安排'],
  ['menu\\COURSE', '模块--课程安排'],
  ['menu\\CommQq', 'QQ联系公共模块'],
  ['menu\\DFCF', '模块--东方财富'],
  ['menu\\ECO_CALENDER', '模块--电子日历'],
  ['menu\\FORTUNE', '模块--大转盘'],
  ['menu\\INCOME', '模块--收益排行'],
  ['menu\\INNERJOIN', '模块--内参'],
  ['menu\\MoreMenu', '更多隐藏菜单'],
  ['menu\\NEWS', '模块--资讯'],
  ['menu\\OPTIONS', '模块--操作建议'],
  ['menu\\PICROLL', '模块--图片滑动'],
  ['menu\\POPAD', '模块--图片广告'],
  ['menu\\QQHELPER', '模块--QQ助理'],
  ['menu\\RoomTabs', '模块--房间tab'],
  ['menu\\SHARE', '模块--分享收藏'],
  ['menu\\STOCKPOOL', '模块--股池'],
  ['menu\\TEACHER', '模块--讲师投票模式'],
  ['menu\\TEACHERINFO', '模块--内参详情'],
  ['menu\\TeacherReward', '模块--审判评论'],
  //['moreoptions\\CASHGIFT', '现金礼物'],
  ['moreoptions\\HONGBAO', '更多操作--发送红包'],
  ['moreoptions\\ROBOT', '更多操作--机器人选择'],
  ['packet\\PacketSuc', '红包领取成功'],
  ['pay\\GiftPay', ''],
  ['pop\\ChatGift', '积分礼物列表'],
  ['pop\\PubRightFunc', '公聊右侧浮动'],
  ['rank\\RANK_GIFTGOT', '排行榜--收礼排行榜'],
  ['rank\\RANK_GIFTSEND', '排行榜--送礼排行榜'],
  ['rank\\RANK_JF', '排行榜--积分排行榜'],
  ['tab\\AnswerQues', '回答问题投票'],
  ['tab\\CHAT_PRIVATE', 'Tab--私聊'],
  ['tab\\CHAT_PUBLIC', 'Tab--公聊块'],
  ['tab\\RANKING_HOT', 'Tab--人气榜'],
  ['tab\\RANKING_LIST', 'Tab--排行榜'],
  ['tab\\USER_LIST', 'Tab--用户列表'],
  ['tab\\VOD_LIST', 'Tab--视频列表'],
  //['tab\\JUDGE_LIST', 'Tab--审判团'],
  //['tab\\LEAVE_RANK', 'Tab--留言榜'],
  //['leavemsg\\LeaveList', '留言板'],
  //['leavemsg\\SendLeave', '发送留言'],
  ['usercenter\\EditNick', '个人中心--修改昵称'],
  ['usercenter\\EditPwd', '个人中心--修改密码'],
  ['usercenter\\JfRecord', '个人中心--积分流水'],
  ['usercenter\\LuckMoney', '个人中心--红包流水'],
  ['usercenter\\Recommend', '个人中心--推广流水'],
  ['usercenter\\UserInfos', '个人中心--用户信息'],
  ['usercenter\\UserMain', '个人中心主页'],

  ['yjlottery\\WaitNext', '摇奖--等待下一轮'],
  ['yjlottery\\WinUser', '摇奖--中奖用户'],
  ['yjlottery\\YjEnd', '摇奖--结束'],
  ['yjlottery\\YjLottery', '摇奖--主页面'],
  ['yjlottery\\YjStart', '摇奖--开始'],
  // ['votecon\\UserVote', ''],
  // ['votecon\\VotePecent', ''],
  // ['votecon\\VoteSelect', ''],
];
var mobileNameStr = JSON.stringify(mobileViewsName);

var out_str = `
window.D = typeof window.D != 'undefined' ? window.D : {};
window.D.tplNameMap = ${tplNameStr};
window.D.pcViewsConfig = ${pcRetStr};
window.D.pcViewsName = ${pcNameStr};
window.D.mobileViewsConfig = ${mobileRetStr};
window.D.mobileViewsName = ${mobileNameStr};
`;
fs.writeFileSync(out_file, out_str);

console.log('buildComponentText save', out_file);