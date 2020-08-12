import Vue from "vue";
import Router from "vue-router";
import LiveRoom from "@/pc_page/LiveRoom";

import LoginPage from "@/pc_views/_/header/LoginPage";
import RegisterPage from "@/pc_views/_/header/RegisterPage";
import CoupLoginPage from "@/pc_views/_/header/CoupLoginPage";

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
    component: baseConfig.syscfg.reg_mod == 2 ? CoupLoginPage : LoginPage,
    beforeEnter: aleardyLogin
  }, //登录
  {
    path: "/register",
    name: "Register",
    component: RegisterPage,
    beforeEnter: aleardyLogin
  }, //注册
];

export default new Router({
  routes: [
    {
      path: "/",
      name: "LiveRoom",
      component: LiveRoom,
      beforeEnter: checkLogin
    },
    ...NoCheckRouter
  ]
})