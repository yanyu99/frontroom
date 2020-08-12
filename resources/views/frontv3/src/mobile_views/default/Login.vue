<template>
  <div class="login-view">
    <header>
      <img src="/assets/v3/images/phone/login-top.jpg" width="" />
      <span>用户登录</span>
    </header>

    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">{{baseConfig.textcfg.reg_account_tag}}</label>
        </div>
        <div class="weui-cell__bd">

          <input class="weui-input" type="text" :placeholder="'请输入'+ baseConfig.textcfg.reg_account_tag " v-model="login">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">密码</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="password" placeholder="请输入密码" v-model="password">
        </div>
      </div>
    </div>

    <section class="sec-box">
      <label for="weuiAgree" class="weui-agree">
        <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox" v-model="isRemember">
        <span class="weui-agree__text">
          保持15天登录
        </span>
      </label>
      <a class="btn-ui btn-register  btn-comm" @click="userLogin" v-if="baseConfig.syscfg.reg_mod == 1">登录</a>
      <router-link class="login-a" to="register" v-if="baseConfig.regcfg.reg_open">没有{{baseConfig.textcfg.reg_account_tag}}，去注册 >></router-link>
    </section>

  </div>
</template>

<style scoped>
  header img {
    width: 100%;
    margin: 0 auto;
    height: auto;
    /* background-image: url(/assets/v3/images/phone/login-top.jpg); */
    background-size: 100%;
    z-index: 1;
    text-align: center;
  }

  header span {
    position: absolute;
    left: 0;
    top: 0;
    font-size: 54px;
    padding-left: 35%;
    color: #fff;
    line-height: 265px;
    display: inline-block;
  }

  .sec-box {
    padding: 0px 15px;
    margin-top: 30px;
  }

  .btn-ui {
    background-color: #00aeee;
    font-size: 42px;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    color: #ffffff;
    line-height: 2.55555556;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    overflow: hidden;
  }

  .login-a {
    font-size: 34px;
    color: #0471bd;
    text-align: center;
    line-height: 34px;
    vertical-align: middle;
    margin: 40px auto;
    width: 100%;
    display: inline-block;
  }

  .weui-cells__title+.weui-cells {
    margin-top: 0;
  }

  .weui-cells {
    margin-top: 1.17647059em;
    background-color: #ffffff;
    line-height: 1.47058824;
    font-size: 17px;
    overflow: hidden;
    position: relative;
  }

  .weui-cell {
    height: 114px;
    padding: 10px 15px;
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    border-bottom: 1px solid #ebebeb;
  }

  .weui-cell:last-child {
    border: none 0px;
  }

  .weui-label {
    font-size: 32px;
    display: block;
    padding-left: 30px;
    width: 160px;
    word-wrap: break-word;
    word-break: break-all;
  }

  .weui-cell__bd {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .weui-cells_form input,
  .weui-cells_form textarea,
  .weui-cells_form label[for] {
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  }

  .weui-input {
    width: 100%;
    border: 0;
    outline: 0;
    -webkit-appearance: none;
    background-color: transparent;
    font-size: inherit;
    color: inherit;
    height: 1.47058824em;
    line-height: 1.47058824;
    font-size: 30px;
  }

  .weui-cell__ft {
    text-align: right;
    color: #999999;
  }

  button.weui-vcode-btn {
    background-color: transparent;
    border-top: 0;
    border-right: 0;
    border-bottom: 0;
    outline: 0;
  }

  .weui-vcode-btn {
    display: inline-block;
    height: 45px;
    margin-left: 5px;
    padding: 0 0.6em 0 0.7em;
    border-left: 1px solid #e5e5e5;
    line-height: 45px;
    vertical-align: middle;
    font-size: 17px;
    color: #00aeee;
  }

  .btn-comm {
    height: 104px;
    line-height: 104px;
    font-size: 42px;
  }

  .weui-agree {
    display: block;
    padding: .5em 0px;
    font-size: 13px;
    padding-top: 20px;
  }

  .weui-agree__checkbox {
    -webkit-appearance: checkbox;
    appearance: none;
    outline: 0;
    font-size: 0;
    border: 1px solid #D1D1D1;
    background-color: #FFFFFF;
    border-radius: 6px;
    width: 26px;
    height: 26px;
    position: relative;
    vertical-align: 0;
    top: 4px;
  }

  .weui-agree__text {
    color: #808080;
  }
</style>

<script>
  import * as types from "@/store/types";
  export default {
    data() {
      return {
        login: "",
        password: "",
        isRemember: 0
      };
    },
    methods: {
      userLogin() {
        if (!this.login || !this.password) {
          this.dialogMsgAlign("请先输入完善！");
          return;
        }
        dms.LiveApi.userLogin({
          login: this.login,
          password: this.password,
          roomId: this.roomInfo.room_id,
          isRemember: this.isRemember ? 1 : 0
        }, resp => {
          //页面跳转
          window.location.hash = "";
          window.location.reload(true);
        }, resp => {
          this.dialogMsgAlign(resp.msg);
        });
      },
    }
  };
</script>