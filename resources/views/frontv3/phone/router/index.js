import Vue from "vue";
import Router from "vue-router";
import MobileRoom from "@/mobile_page/MobileRoom";

import Login from "@/mobile_views/_/Login";
import Register from "@/mobile_views/_/Register";

import UserMain from "@/mobile_views/_/usercenter/UserMain";
import JfRecord from "@/mobile_views/_/usercenter/JfRecord";
import LuckMoney from "@/mobile_views/_/usercenter/LuckMoney";
import Recommend from "@/mobile_views/_/usercenter/Recommend";
import EditPwd from "@/mobile_views/_/usercenter/EditPwd";
import EditNick from "@/mobile_views/_/usercenter/EditNick";

import CouponLogin from "@/mobile_views/_/coupon/CouponLogin";

import GetCoupon from "@/mobile_views/_/coupon/GetCoupon";
import GiftPay from "@/mobile_views/_/pay/GiftPay";

Vue.use(Router);

var checkLogin = function (to, from, next) {
  try {
    if (baseConfig.roompower.login_pop == 5 && dms.getCookie("ws_visitors_remind") == -1) {
      return next('/login');
    }
  } catch (e) {}

  if (parseInt(baseConfig.logincfg.login_pop_ts) == 0 && parseInt(baseConfig.logincfg.login_pop) && !userInfo.logined) {
    return next("/login");
  }
  return next();
}

var aleardyLogin = function (to, from, next) {
  if (userInfo.logined) {
    return next("/");
  }
  return next();
}


var NoCheckRouter = [
  {
    path: "/login",
    name: "Login",
    component: baseConfig.syscfg.reg_mod == 2 ? CouponLogin : Login,
    beforeEnter: aleardyLogin
  }, //登录
  {
    path: "/register",
    name: "Register",
    component: Register,
    beforeEnter: aleardyLogin
  }, //注册
  {
    path: "/getcoupon",
    name: "GetCoupon",
    component: GetCoupon
  },
];

var CheckRouter = [
  {
    path: "/",
    name: "MobileRoom",
    component: MobileRoom,
    beforeEnter: checkLogin
  }, //进入 直播间
  {
    path: "/usermain",
    name: "UserMain",
    component: UserMain,
    beforeEnter: checkLogin
  }, //个人中心
  {
    path: "/jfrecord",
    name: "JfRecord",
    component: JfRecord,
    beforeEnter: checkLogin
  }, //积分记录
  {
    path: "/luckmoney",
    name: "LuckMoney",
    component: LuckMoney,
    beforeEnter: checkLogin
  }, //红包记录
  {
    path: "/recommend",
    name: "Recommend",
    component: Recommend,
    beforeEnter: checkLogin
  }, //推广记录
  {
    path: "/editpwd",
    name: "EditPwd",
    component: EditPwd,
    beforeEnter: checkLogin
  }, //修改密码
  {
    path: "/editnick",
    name: "EditNick",
    component: EditNick,
    beforeEnter: checkLogin
  },
  {
    path: "/giftpay",
    name: "GiftPay",
    component: GiftPay,
    beforeEnter: checkLogin,
  }, //支付
]


export default new Router({
  routes: [
    ...NoCheckRouter,
    ...CheckRouter
  ],
})
