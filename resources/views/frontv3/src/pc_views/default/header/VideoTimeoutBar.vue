<template>
  <div class="countbox" id="VideoTimeoutBar">
    <!-- 倒计时 -->
    <div class="video-timeout-bar">
      <div class="pull-right">
        <span style="float:left!important; line-height:50px;">剩余观看时间:</span>
        <div id="countdown" v-html="countdownTime">
        </div>
        <p id="note"></p>
      </div>
    </div>

    <!-- 倒计时弹出层 -->
    <div class="login-tips-wrap" v-show="roomInfo.is_show_logintips">
      <div class="login-tips-content" :style="{backgroundImage: baseConfig.popcfg.login_pop_img ?'url('+baseConfig.popcfg.login_pop_img+')' :
      'url(/assets/v3/images/phone/HuanYingJR.jpg)'}">
        <span class="login-close" v-if=" parseInt(baseConfig.logincfg.login_pop) == 2 ||  parseInt(baseConfig.logincfg.login_pop) == 4"></span>

        <a class="login-btn js-login-dialog" @click="toLogin" :style="{'background-image':baseConfig.popcfg.login_tips_login_btn ?'url('+baseConfig.popcfg.login_tips_login_btn+')' :'url(/assets/v3/images/phone/login.png)'}"></a>
        <template v-if="baseConfig.regcfg.reg_open">
          <a class="signup-btn js-sigup-dialog" @click="popShow('Register')" v-if="baseConfig.syscfg.reg_mod == 1" :style="{'background-image':baseConfig.popcfg.login_tips_reg_btn ?'url('+baseConfig.popcfg.login_tips_reg_btn+')' : 'url(/assets/img/reg.png)'}"></a>
          <a class="coupon-btn js-coupon-dialog getcoupon" @click="popShow('GetCoupon',{text:'领取入场券'})" v-if="baseConfig.syscfg.reg_mod == 2" :style="{'background-image':baseConfig.popcfg.login_tips_coupon_btn ?'url('+baseConfig.popcfg.login_tips_coupon_btn+')' : 'url(/assets/v3/images/phone/coupon.png) '}"></a>
        </template>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .video-timeout-bar {
    height: 100px;
    top: 0px;
    padding: 4px;
    position: absolute;
    left: 0;
    right: 0;
    /* z-index: 998; */
    z-index: 2;
  }

  .video-timeout-main {
    float: right !important;
    display: flex;
    margin-right: 10px;
  }

  .sp-font {
    color: #666;
    flex: 1;
    font-size: 30px;
    line-height: 72px;
    vertical-align: middle;
  }

  .login-tips-box {
    position: relative;
  }

  .login-tips-sp-fun {
    position: absolute;
    top: 380px;
    width: 100%;
  }

  .login-tips-sp-fun a {
    display: inline-block;
  }

  .login-btn {
    float: left;
  }

  .coupon-btn {
    float: right;
  }

  .login-close {
    position: absolute;
    top: 0px;
    right: 0px;
    cursor: pointer;
    background-image: url(/assets/v3/images/phone/banner_close.png);
    background-size: 40px 40px;
    display: inline-block;
    width: 40px;
    height: 40px;
  }

  .login-tips-wrap {
    background: rgba(0, 0, 0, 0.9);
    position: fixed;
    top: 0;
    bottom: 0;
    width: 100%;
    right: 0;
    /* z-index: 9999; */
    z-index: 501;
    filter: progid:DXImageTransform.Microsoft.gradient(startcolorstr=#E5000000, endcolorstr=#E5000000);
  }

  .login-tips-content {
    /* background-image: url(/assets/v3/images/phone/HuanYingJR.jpg); */
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }

  .login-btn {
    height: 60px;
    width: 332px;
    /* background-image: url(/assets/v3/images/phone/login.png?_v=0.1); */
    background-repeat: no-repeat;
  }

  .signup-btn {
    height: 82px;
    width: 162px;
    /* background-image: url(/assets/img/reg.png); */
    background-repeat: no-repeat;
  }

  .position {
    display: inline-block;
    height: 1.6em;
    overflow: hidden;
    position: relative;
    width: 1.05em;
  }
</style>

<style>
  #countdown {
    margin: 0 auto;
    font: 15px/1.5 'Open Sans Condensed', sans-serif;
    text-align: center;
    letter-spacing: -3px;
    width: 320px;
    font-family: "微软雅黑"
  }

  .sp-time-item {
    display: inline-block;
    width: 1.2em;
    background-color: #D9534F;
    border-radius: 0.2em;
    text-align: center;
    color: #fff;
    letter-spacing: -1px;
    font-size: 16px;
  }

  /* 计时器的样式 */

  .countdownHolder {
    width: 400px;
    margin: 0 auto;
    font: 15px/1.5 'Open Sans Condensed', sans-serif;
    text-align: center;
    letter-spacing: -3px;
    background: orange;
  }

  .position {
    display: inline-block;
    height: 1.6em;
    overflow: hidden;
    position: relative;
    width: 1.05em;
  }

  .sp-time-item {
    display: inline-block;
    width: 0.9em;
    padding: 1px;
    background-color: #D9534F;
    border-radius: 0.2em;
    text-align: center;
    color: #fff;
    letter-spacing: -1px;
    margin-left: 2px;
  }

  .sp-time-item {
    box-shadow: 1px 1px 1px rgba(4, 4, 4, 0.35);
    background-image: linear-gradient(bottom, #D9534F 50%, #D9534F 50%);
    background-image: -o-linear-gradient(bottom, #D9534F 50%, #D9534F 50%);
    background-image: -moz-linear-gradient(bottom, #D9534F 50%, #D9534F 50%);
    background-image: -webkit-linear-gradient(bottom, #D9534F 50%, #D9534F 50%);
    background-image: -ms-linear-gradient(bottom, #D9534F 50%, #D9534F 50%);
    background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.5, #D9534F), color-stop(0.5, #D9534F))
  }

  .sp-spl {
    display: inline-block;
    width: 20px;
    height: 20px;
    position: relative;
    color: #D9534F;
    padding: 2px;
    font-size: 26px;
  }

  .sp-spl:before,
  .sp-spl:after {
    width: 20px;
    height: 20px;
    background-color: #D9534F;
    border-radius: 50%;
    left: 50%;
    margin-left: -3px;
    top: 0.5em;
    box-shadow: 1px 1px 1px rgba(4, 4, 4, 0.5);
    content: '';
    font-size: 20px;
  }

  .sp-spl:after {
    top: 0.9em;
  }
</style>
<script>
  import * as types from "@/store/types"
  import layercommMixinPc from "@/mixins/layercommMixinPc"
  import videotimeoutMixin from "@/mixins/videotimeoutMixin"

  export default {
    mixins: [layercommMixinPc,videotimeoutMixin],
  }
</script>