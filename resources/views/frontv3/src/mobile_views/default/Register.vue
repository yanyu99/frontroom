<template>
  <div class="register-view">
    <header>
      <span>用户注册</span>
    </header>

    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">{{baseConfig.textcfg.reg_account_tag}}</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" pattern="" :placeholder="'请输入'+ baseConfig.textcfg.reg_account_tag " v-model="name">
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

      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">确认密码</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="password" placeholder="请确认密码" v-model="passwordConfirm">
        </div>
      </div>


      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">QQ</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="number" placeholder="请输入QQ号" v-model="txtQQ">
        </div>
      </div>


      <div class="weui-cell weui-cell_vcode">
        <div class="weui-cell__hd">
          <label class="weui-label">手机号</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="tel" placeholder="请输入手机号" v-model="phone">
        </div>
      </div>

      <div class="weui-cell weui-cell_vcode">
        <div class="weui-cell__hd">
          <label class="weui-label">验证码</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" placeholder="请输入验证码" v-model="captcha">
        </div>
        <div class="weui-cell__ft">
          <img class="weui-vcode-img" :src="captchaUrl" @click="captchaCode">
        </div>
      </div>
    </div>

    <section class="sec-box">
      <a class="btn-ui btn-comm btn-register" @click="userReg" v-if="baseConfig.regcfg.reg_open">注册 </a>
      <router-link class="login-a" :to="'/login'">已有{{baseConfig.textcfg.reg_account_tag}}，去登录</router-link>
    </section>
  </div>
</template>
<style scoped>
  header {
    width: 100%;
    margin: 0 auto;
    height: 138px;
    background-image: url(/assets/v3/images/phone/register-top.jpg);
    background-size: 100%;
    text-align: center;
  }

  header span {
    font-size: 54px;
    color: #fff;
    line-height: 138px;
    display: inline-block;
  }

  .sec-box {
    padding: 0px 15px;
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
    height: 104px;
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
    height: 90px;
    margin-left: 5px;
    padding: 0 0.6em 0 0.7em;
    border-left: 1px solid #e5e5e5;
    line-height: 90px;
    vertical-align: middle;
    font-size: 32px;
    color: #00aeee;
  }

  .btn-comm {
    height: 104px;
    line-height: 104px;
    font-size: 42px;
  }
</style>

<script>
  import * as types from "@/store/types";
  export default {
    data() {
      return {
        name: "",
        password: "",
        passwordConfirm: "",
        phone: "",
        captcha: "", //图形验证码输入
        txtQQ: "",
        captchaUrl: "/auth/captcha",
      };
    },
    mounted() {
      this.captchaCode();
    },
    methods: {
      captchaCode() {
        var dateTime = new Date().getTime();
        this.captchaUrl = '/auth/captcha?_t=' + dateTime
      },

      userReg() {
        dms.LiveApi.userReg({
          name: this.name,
          room_id: this.roomInfo.room_id,
          password: this.password,
          passwordConfirm: this.passwordConfirm,
          phone: this.phone,
          captcha: this.captcha, //验证码
          qq: this.txtQQ,
        }, resp => {
          window.location.hash = "";
          window.location.reload(true);
        }, resp => {
          this.captchaCode();
          this.$layer.msg(resp.msg, { time: 3 });
        });
      },
    }
  };
</script>