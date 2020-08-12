<template>
  <div class="containers  loginpage-container" style="max-width: 674px;padding:0" id="Register">
    <div class="lf-img">

      <img :src="baseConfig.bgcfg.reg_slider_bg?baseConfig.bgcfg.reg_slider_bg : '/assets/img/regbg.jpg' " width="298" height="408">
    </div>
    <div class="reg-view-box">
      <h1>注册</h1>
      <form id="frmRegister" class="form-signin form-horizontal">
        <div class="form-body clearfix">

          <div class="col-xs-12">
            <div class="form-group">
              <label for="name" class="col-xs-4 control-label">
                {{ baseConfig.textcfg.reg_account_tag }}
                <span class="required">*</span>
              </label>
              <div class="col-xs-8">

                <input type="text" name="name" v-model="name" datatype='username' class="form-control" :placeholder=" baseConfig.textcfg.reg_account_tag+ '（不可输入纯数字）'" value="" required autofocus>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-xs-4 control-label">
                密码
                <span class="required">*</span>
              </label>
              <div class="col-xs-8">

                <input type="password" datatype='*6-16' id="password" name="password" v-model="password" class="form-control" placeholder="密 码" value="" required>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-xs-4 control-label">
                确认密码
                <span class="required">*</span>
              </label>
              <div class="col-xs-8">

                <input type="password" id="passwordConfirm" name="passwordConfirm" v-model="passwordConfirm" recheck="password" class="form-control" placeholder="确认密码" required value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-4 control-label">
                QQ:
              </label>
              <div class="col-xs-8">
                <input id="email" name="qq" type="text" v-model="txtQQ" class="form-control" placeholder="输入QQ号码" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-4 control-label">
                手机:
                <!-- <span class="required" v-if="baseConfig.roompower.phone_check">*</span> -->
              </label>
              <div class="col-xs-8">
                <input id="mobile" name="phone" v-model="phone"  type="text" class="form-control" placeholder="输入手机号码" />
              </div>
            </div>
            <div class="form-group">
              <label for="code" class="col-xs-4 control-label">
                验证码
                <span class="required">*</span>
              </label>
              <div class="col-xs-4  ">
                <input type="text" v-model="captcha" id="captcha" datatype='*5-5' name="captcha" class="form-control" placeholder="验证码" required>
              </div>
              <div class="col-xs-4" style="padding-left:0px">
                <img class="weui-vcode-img" id="js-validate-code" :src="captchaUrl" @click="captchaCode" height="36" width="100%">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-submit user-login-btn" type="button" @click="userReg" v-if="baseConfig.regcfg.reg_open">
              注 册
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>
<style scoped>
  #Register {
    background: #fff;
    width: 700px;
  }

  .containers {
    height: 586px;
    background-color: #fff;
  }

  .containers .lf-img {
    float: left;
    width: 298px;
    height: 586px;
    float: left;
  }

  .containers .lf-img img {
    width: 298px;
    height: 586px;
    overflow: hidden;
  }

  .reg-view-box {
    float: right;
    width: 348px;
    padding-right: 22px;
    float: left;
    margin-left: 26px;
  }

  h1 {
    color: #1d1d1d;
    font-weight: 800;
    font-size: 17px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
    font-size: 24px;
    line-height: 45px;
  }

  .btn {
    width: 96%;
    height: 50px;
    line-height: 27px;
    font-size: 20px;
    border: 0px none;
  }

  .btn-primary {
    background: #ff8a00;
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
        captcha: "", //验证码输入
        txtQQ: "",
        captchaUrl: "/auth/captcha",
      };
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).css({
        height: '590px'
      });
      $("#" + id).find('.vl-notify-content').addClass('padding-style')
      this.captchaCode();
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
      captchaCode() {
        var dateTime = new Date().getTime();
        this.captchaUrl = "/auth/captcha?_t=" + dateTime;
      },
      userReg() {
        //验证输入
        dms.LiveApi.userReg({
          name: this.name,
          room_id: this.roomInfo.room_id,
          password: this.password,
          passwordConfirm: this.passwordConfirm,
          phone: this.phone,
          captcha: this.captcha, //验证码
          back: "",
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