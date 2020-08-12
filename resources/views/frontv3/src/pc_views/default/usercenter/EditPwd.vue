<template>
  <div id="EditPwd" class="warp">
    <div class="title">
      <span>修改密码
      </span>
    </div>
    <div class="content">

      <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
          <div class="weui-cell__hd">
            <label class="weui-label">原始密码</label>
          </div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="password" id="old_pasw" v-model="oldPwd" placeholder="请输入原密码" required>
          </div>
        </div>
        <div class="weui-cell">
          <div class="weui-cell__hd">
            <label class="weui-label">新密码</label>
          </div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="password" id="new_pasw" v-model="newPwd" placeholder="请输入新密码" required>
          </div>
        </div>

        <div class="weui-cell">
          <div class="weui-cell__hd">
            <label class="weui-label">新密码确认</label>
          </div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="password" id="repeat_pasw" v-model="repeatPwd" placeholder="再次输入新密码" required>

          </div>
        </div>
      </div>

      <section class="sec-box">
        <a class="btn-ui btn-register  btn-comm" @click="submitPwd">确认修改</a>
      </section>
    </div>
  </div>
</template>
<style scoped>
  .sec-box {
    background: #fff;
    padding: 20px 15px;
    width: 166px;
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
    line-height: 2.5;
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
    background-color: #ffffff;
    line-height: 1.47;
    font-size: 17px;
    overflow: hidden;
    position: relative;
    border-bottom: 1px solid #ebebeb;
  }

  .weui-cell {
    height: 50px;
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
    font-size: 15px;
    display: block;
    padding-left: 30px;
    width: 170px;
    word-wrap: break-word;
    word-break: break-all;
    font-weight: normal;
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
    width: 60%;
    border: 0;
    outline: 0;
    -webkit-appearance: none;
    background-color: transparent;
    font-size: inherit;
    color: inherit;
    /* height: 24px;
    line-height: 24px; */
    font-size: 15px;

    border: 1px solid #f3f3f3;
    line-height: 35px;
    height: 35px;
    text-indent: 0.5em;
    border-radius: 4px;
  }

  .weui-cell__ft {
    text-align: right;
    color: #999999;
  }

  .btn-comm {
    height: 40px;
    line-height: 40px;
    font-size: 16px;
  }

  .warp .title {
    height: 40px;
    border-bottom: 1px solid #EEE;
    line-height: 40px;
  }

  .warp .title span {
    line-height: 26px;
    padding-left: 10px;
    display: inline-block;
    border-left: 2px solid #189ccf;
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
          if (resp.code && resp.code == 0) {
            this.$layer.msg("修改成功!", { time: 2 });
          }
        }, resp => {
          this.dialogMsgAlign(resp.msg)

        }, null, null, function error() {

        })
      },

    }

  }
</script>