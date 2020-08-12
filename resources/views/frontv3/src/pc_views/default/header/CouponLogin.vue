<template>
  <div id="CouponLogin">
    <div class="container" :style="{backgroundImage: baseConfig.syscfg.reg2_pc_bg ?
     'url('+baseConfig.syscfg.reg2_pc_bg+')' :'url(/assets/img/coupon_bg.jpg)'}">

      <label class="lb-ckbox">
        <input type="checkbox" class="txt-ck" v-model="isRemember" /> 保持15天登录 </label>
      <input class="login-name" type="text" id="name" name="login" v-model="login" value="" required="" autofocus="">
      <input class="login-pwd" type="password" id="password" name="password" v-model="password" required="" @keyup.enter="userLogin" />
      <button class="login-btn" @click="userLogin"></button>
    </div>

    <div class="close-layer" @click="closeLayer">×</div>
  </div>

</template>
<style scoped>
  body {
    font: 14px/1.4 'STHeiti', 'Microsoft YaHei', '宋体', 'arial';
    background: #eee;
    overflow: hidden;
  }

  h3 {
    color: #0062b4;
    font-weight: 800;
    font-size: 17px;
  }

  .container {
    /* background-image: url('/assets/img/coupon_bg.jpg'); */
    width: 1080px;
    height: 383px;
    filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')";
    -moz-background-size: 100% 100%;
    background-size: 100% 100%;
  }

  .login-name {
    position: absolute;
    top: 301px;
    left: 882px;
    width: 97px;
    border: none;
    height: 26px;
    vertical-align: middle;
    line-height: 26px;
    background: rgba(0, 0, 0, 0);
    color: #fff;
    padding-left: 2px;
  }

  .login-pwd {
    position: absolute;
    top: 340px;
    left: 882px;
    border: none;
    width: 97px;
    border: none;
    height: 26px;
    vertical-align: middle;
    line-height: 26px;
    background: rgba(0, 0, 0, 0);
    color: #fff;
    padding-left: 2px;
  }

  .login-btn {
    position: absolute;
    left: 990px;
    top: 300px;
    width: 69px;
    height: 69px;
    background: url('/assets/img/login-btn.png');
    border: none;
  }

  .login-error {
    position: absolute;
    left: 845px;
    top: 277px;
    color: red;
  }

  .lb-ckbox {
    position: absolute;
    right: 146px;
    bottom: 86px;
    font-size: 12px;
    font-weight: normal;
    vertical-align: middle;
    color: #fff;
  }

  .txt-ck {
    vertical-align: text-bottom;
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
    mounted() {
      // 根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id; //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style')
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
          back: '', // "/auth/pref"
          isRemember: this.isRemember ? 1 : 0
        }, resp => {
           window.location.reload(true);
        }, resp => {
          this.dialogMsgAlign(resp.msg);
        });
      },
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>