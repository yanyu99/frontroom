<template>
  <div style="background:#f1f1f1;">
    <div class="co_head">
     <router-link :to=" '/usermain'"  class="_back">
        <div class="back" style="background: url('/assets/img/user/arrowL.png') center center no-repeat;background-size: contain;float:left; ">
        </div>
        <div class="title">
          修改密码
        </div>
     </router-link>
    </div>



    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">原始密码</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="password" id="old_pasw" v-model="oldPwd" placeholder="请输入原密码">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">新密码</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="password" id="new_pasw" v-model="newPwd" placeholder="请输入新密码">
        </div>
      </div>

      <div class="weui-cell">
        <div class="weui-cell__hd">
          <label class="weui-label">新密码确认</label>
        </div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="password" id="repeat_pasw" v-model="repeatPwd" placeholder="再次输入新密码">

        </div>
      </div>
    </div>

    <section class="sec-box">
      <a class="btn-ui btn-register  btn-comm" @click="submitPwd">确认修改</a>
    </section>

  </div>
</template>
<style scoped>
  html,
  body,
  p,
  ul,
  li {
    padding: 0;
    border: 0;
    margin: 0;
    font-family: "微软雅黑";
    font-size: 0.1867rem;
  }

  a {
    text-decoration: none;
  }

  html,
  body {
    background-color: #f1f1f1;
  }

  .co_head {
    width: 100%;
    height: 1.1733rem;
    padding: 0 0.32rem;
    display: flex;
    display: -webkit-flex;
    -webkit-align-items: center;
    background: #fff;
  }

  .co_head ._back {
    display: block;
    float: left;
  }

  .co_head>a:visited {
    text-decoration: none;
  }

  .co_head>a:link {
    text-decoration: none;
  }

  .co_head .back {
    width: 0.4533rem;
    height: 0.6533rem;
    background: url('/assets/img/user/arrowL.png') center center no-repeat;
    background-size: contain;
    margin-top: 0.2667rem;
  }

  .co_head .title {
    width: 2.5rem;
    height: 1.1733rem;
    font-size: 0.4533rem;
    color: #3b3b3b;
    text-align: center;
    line-height: 1.1733rem;
    margin-left: 0.2rem;
  }

  header {
    width: 100%;
    margin: 0 auto;
    height: 315px;
    background-image: url(/assets/v3/images/phone/login-top.jpg);
    background-size: 100%;
    z-index: 1;
    text-align: center;
  }

  header span {
    font-size: 54px;
    color: #fff;
    line-height: 315px;
    display: inline-block;
  }

  .sec-box {
    background: #fff;
    padding: 20px 15px;
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
    border-top: 1px solid #ebebeb;
    border-bottom: 1px solid #ebebeb;
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
    width: 170px;
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
</style>
<script>
  import * as types from "@/store/types"
  export default {
    data() {
      return {
        oldPwd: '',
        newPwd: '',
        repeatPwd: '',

      }
    },
    methods: {
      submitPwd() {
        if (!this.oldPwd || !this.newPwd || !this.repeatPwd) {
          this.$layer.msg("请输入原密码和新密码!", { time: 2 });
          return;
        }
        if (this.newPwd != this.repeatPwd) {
          this.$layer.msg("两次输入的密码不一致!", { time: 2 });
          return;
        }
        dms.LiveApi.editPwd({
          old_pwd: this.oldPwd,
          new_pwd: this.newPwd,
          repeat_pwd: this.repeatPwd
        }, resp => {
          this.$layer.msg("修改成功!", { time: 2 });
          setTimeout(function () {
            //location.href = '/?_skip=1';  ???
            window.location.hash = "/usermain";
          }, 1000);
        }, resp => {
          this.dialogMsgAlign(resp.msg)

        })
      }

    }

  }
</script>