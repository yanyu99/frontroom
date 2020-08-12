<template>
  <div>
    <!-- 倒计时框 -->
    <div class="video-timeout-bar">
      <div class="video-timeout-main">
        <span class="sp-font" style="">剩余观看时间：</span>
        <div id="countdown" v-html="countdownTime">
        </div>
      </div>
    </div>

    <!-- 登录提示框 -->
    <div class="login-tips-wrap" v-show="roomInfo.is_show_logintips">
      <div class="login-tips-content" :style="{backgroundImage: baseConfig.popcfg.login_pop_img ?'url('+baseConfig.popcfg.login_pop_img+')' :'url(/assets/v3/images/phone/HuanYingJR.jpg)'}">
        <div class="login-tips-box">
          <span class="login-close" v-if=" parseInt(baseConfig.logincfg.login_pop) == 2 ||  parseInt(baseConfig.logincfg.login_pop) == 4"></span>

          <span class="login-tips-sp-fun">

            <router-link class="login-btn js-login-dialog" to="login" :style="{'background-image':'url(/assets/v3/images/phone/login.png)'}"></router-link>
            <template v-if="baseConfig.regcfg.reg_open">
              <router-link class="signup-btn js-sigup-dialog" to="register" v-if="baseConfig.syscfg.reg_mod == 1" :style="{'background-image':'url(/assets/img/reg.png)'}"></router-link>
              <router-link class="coupon-btn js-coupon-dialog getcoupon" to="getcoupon" v-if="baseConfig.syscfg.reg_mod == 2" :style="{'background-image':'url(/assets/v3/images/phone/coupon.png) '}"></router-link>
            </template>

          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .video-timeout-bar {
    height: 100px;
    top: 50px;
    padding: 4px;
    position: absolute;
    left: 0;
    right: 0;
    z-index: 998;
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
    /* width: 332px;
    height: 120px; */
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
    z-index: 9999;
    filter: progid:DXImageTransform.Microsoft.gradient(startcolorstr=#E5000000, endcolorstr=#E5000000);
  }

  .login-tips-content {
    position: absolute;
    top: 250px;
    left: 0px;
    height: 400px;
    width: 100%;
    /* background-image: url(/assets/v3/images/phone/HuanYingJR.jpg); */
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }

  .login-btn {
    height: 60px;
    width: 332px;
    background-image: url(/assets/v3/images/phone/login.png?_v=0.1);
    background-repeat: no-repeat;
  }

  .coupon-btn {
    height: 110px;
    width: 306px;
    background-image: url(/assets/v3/images/phone/coupon.png);
    background-repeat: no-repeat;
  }

  .signup-btn {
    height: 110px;
    width: 306px;
    background-image: url(/assets/img/reg.png);
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
  }

  .sp-time-item {
    display: inline-block;
    width: 1em;
    background-color: #D9534F;
    border-radius: 0.2em;
    text-align: center;
    color: #fff;
    letter-spacing: -1px;
    font-size: 30px;
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
    /* position: absolute; */
    display: inline-block;
    width: 1em;
    padding: 3px;
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
    width: 32px;
    height: 32px;
    position: relative;
    color: #D9534F;
    padding: 3px;
    font-size: 42px;
  }

  .sp-spl:before,
  .sp-spl:after {
    /* position: absolute; */
    width: 30px;
    height: 30px;
    background-color: #D9534F;
    border-radius: 50%;
    left: 50%;
    margin-left: -3px;
    top: 0.5em;
    box-shadow: 1px 1px 1px rgba(4, 4, 4, 0.5);
    content: '';
    font-size: 30px;
  }

  .sp-spl:after {
    top: 0.9em;
  }
</style>


<script>
  import * as types from "@/store/types"
  import UserInfos from "@/mobile_views/_/usercenter/UserInfos";
  import videotimeoutMixin from "@/mixins/videotimeoutMixin"

  var videoCountDownBar = null;
  export default {
    mixins: [videotimeoutMixin],
  }
</script>