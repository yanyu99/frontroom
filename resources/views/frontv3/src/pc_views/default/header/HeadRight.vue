<template>

  <div class="header-right-menu" :style="{'background': 'rgba(0,0,0,'+$t('0.8##头部右侧用户信息透明度', __FILE__)/100+')'}">
    <ul>
      <li class="profile-menu listitem" data-hover="dropdown" @click="userInfoShow = !userInfoShow" @mouseenter="userInfoShow = true" @mouseleave="userInfoShow =false">
        <a class="dropdown-toggle">
          <img class="avatar" :src="userInfo.pic" :alt="userInfo.name" />
          <span class="text-e">{{userInfo.name}}</span>
          <span class="caret"></span>
        </a>
        <!-- 个人中心 -->
        <user-info v-if="userInfo.logined" v-show="userInfoShow" propPos="headtheme"></user-info>
      </li>

      <template v-if="!userInfo.logined">
        <li class="integral-menu listitem">
          <template v-if="baseConfig.regcfg.reg_open">
            <a v-if="baseConfig.syscfg.reg_mod == 1" class="js-sigup-dialog" @click="popShow('Register')">注册</a>
            <a v-if="baseConfig.syscfg.reg_mod == 2" class="js-coupon-dialog" @click="popShow('GetCoupon',{text:'领取入场券'})">领劵</a>/
          </template>
          <a class="js-login-dialog" @click="userLogin">登录</a>
        </li>
      </template>

      <template v-else-if="userInfo.role.f_teacher_set && !baseConfig.extcfg.auto_lesson ">
        <template v-if="!baseConfig.channelInfo.alone_video || (baseConfig.channelInfo.alone_video && baseConfig.sitecfg.alone_video_teacher_opend)">
          <li class="integral-menu listitem" @click="showTeacherList = !showTeacherList" @mouseenter="showTeacherList = true" @mouseleave="showTeacherList = false">
            <a class="dropdown-toggle" data-hover="dropdown">上课</a>
          </li>
          <ul id="idTeachersWarp" class="dropdown-menu pull-right" :style="{'min-width':'10px',right:baseConfig.extcfg.style_opend?'40px':'0px'}" v-show="showTeacherList && roomInfo.startCourseTeachers.length" @mouseenter="showTeacherList = true" @mouseleave="showTeacherList = false">
            <li v-for="item in roomInfo.startCourseTeachers" :key="item.tid">
              <a href="javascript:;" :data-id="item.tid" class="js-teacher-list" @click="changeTeacher(item)">{{item.name}}</a>
            </li>
          </ul>
        </template>
      </template>
      <template v-if="baseConfig.extcfg.style_opend">
        <li class="theme-menu navbar-right listitem" :style="{'background': 'rgba(0,0,0,'+$t('42##主题换肤按钮透明度', __FILE__)/100+')'}" style="margin-right:0px" @click="themeShow = !themeShow" @mouseenter="themeShow = true" @mouseleave="themeShow =false">
          <a class="dropdown-toggle" data-hover="dropdown">
            <i class="icon"></i>
            <span class="text"></span>
          </a>
          <!-- 弹出 皮肤设置框  TODO-->
          <theme-menu v-show="themeShow" propPos="headtheme"></theme-menu>
        </li>
      </template>
    </ul>
  </div>
</template>
<style scoped>
  /* 0921 */

  .header-right-menu {
    position: absolute;
    right: 0px;
    line-height: 50px;
    height: 50px;
    top: 0px;
  }

  .header-right-menu>ul>li {
    float: left;
    line-height: 32px;
    margin: 0 10px;
    position: relative;
    cursor: pointer;
    font-size: 14px;
    height: 36px;
  }

  .header-right-menu>ul .listitem {
    margin: 6px 0 0 0;
    padding: 0 10px;
    border-left: 1px solid #999;
    height: 50px;
    line-height: 50px;
    margin-top: 0px;
  }

  .listitem a img {
    margin-top: 8px;
  }

  .header-right-menu>ul>.listitem:hover {
    background-color: #152B3C;
  }

  .header-right-menu>ul>li>a {
    color: #eee;
    text-decoration: none;
  }

  .header-right-menu>ul>li>a:visited {
    color: #ccc;
  }

  .text-e {
    padding-left: 38px;
  }

  .dropdown-menu {
    display: block;
  }

  .pull-right {
    right: 40px;
  }
</style>
<script>
  import Vuex from "vuex"
  import * as types from "@/store/types";
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import UserInfo from '@/pc_views/_/header/UserInfo'
  import ThemeMenu from '@/pc_views/_/header/ThemeMenu'
  export default {
    data() {
      return {
        userInfoShow: false,
        themeShow: false,
        showTeacherList: false,
      }
    },
    mixins: [layercommMixinPc],
    methods: {
      userLogin() {
        var str_popName = this.baseConfig.syscfg.reg_mod == 2 ? 'CouponLogin' : 'Login'
        this.popShow(str_popName);
      },
      showUInfo() {
        //判断用户是否登录
        if (this.userInfo.logined) {
          this.popShow('UserInfo');
        }
      },
      changeTeacher(item) {
        dms.LiveApi.startLesson({
          tid: item.tid
        }, resp => {}, resp => {

        })
      },
    },
    components: {
      UserInfo,
      ThemeMenu,
    },
  }
</script>