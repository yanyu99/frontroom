<template>
  <div>
    <div class="userinfo-box">
      <div class="userinfo-con">
        <p>用户信息</p>
        <span>
          <label>用户昵称:</label>
          <font>{{userInfo.name}}</font>
        </span>
        <span>
          <label>用户{{baseConfig.textcfg.reg_account_tag}}:</label>
          <font>{{userInfo.name}}</font>
        </span>
        <span>
          <label>用户角色:</label>
          <font v-if="userInfo.role_id && baseConfig.roles[userInfo.role_id]">{{baseConfig.roles[userInfo.role_id].role_name}}</font>
        </span>

        <span class="sp-btn">
          <a class="a-login" @click="userLogin">登录</a>
          <template v-if="baseConfig.regcfg.reg_open">
            <template v-if="baseConfig.syscfg.reg_mod == 2">
              <a class="a-ret" @click="userGetCoupon">领券</a>
            </template>
            <template v-else-if="baseConfig.syscfg.reg_mod == 1">
              <a class="a-ret" @click="userReg">注册</a>
            </template>
          </template>
        </span>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .userinfo-bg {
    position: absolute;
    z-index: 99;
    /*background-color: #fff;*/
    opacity: 0.9;
    width: 100%;
    padding: 10px;
    right: 0;
    top: 0px;
    height: 100%;
    background-size: cover;
  }

  .userinfo-box {

  }

  .userinfo-con {
    padding: 10px 15px;
  }

  .userinfo-con p {
    font-size: 42px;
    color: #fe9a01;
    text-align: center;
    border-bottom: 1px solid #ebebeb;
    line-height: 100px;
    height: 100px;
  }

  .userinfo-con span {
    display: block;
    font-size: 30px;
    width: 90%;
    margin: 0 auto;
    height: 68px;
    line-height: 68px;
    vertical-align: middle;
  }

  .userinfo-con span label {
    color: #939393;
  }

  .userinfo-con span font {
    color: #1f1f1f;
  }

  .userinfo-con span.sp-btn {
    height: 98px;
    margin: 15px auto;
    text-align: center;
  }

  .sp-btn a {
    display: inline-block;
    width: 280px;
    height: 98px;
    line-height: 98px;
    text-align: center;
    /* float: left; */
    color: #fff;
    margin-left: 5px;
    font-size: 36px;
    border-radius: 7px;
  }

  .sp-btn a.a-login {
    background-color: #307ac5;
  }

  .sp-btn a.a-ret {
    background-color: #00aeee;
  }
</style>

<script>
  import * as types from "@/store/types";
  export default {
    methods: {
      userLogin() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId)
        window.location.hash = "/login";
      },
      userReg() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId)
        window.location.hash = "/register";
      },
      userGetCoupon() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId)
        window.location.hash = "/getcoupon";
      }
    }

  };
</script>