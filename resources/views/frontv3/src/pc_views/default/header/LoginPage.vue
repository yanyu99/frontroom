<template>
  <div>
    <div class="head">
      <div style=" margin: auto;">
        <img :src="baseConfig.popcfg.login_logo ? baseConfig.popcfg.login_logo :  baseConfig.pagecfg.logo" height="60px" style="margin-top: 7px;" />
        <div style="float: right; line-height: 80px;font-size: 14px;color: #777">{{ baseConfig.pagecfg.title}}</div>

        </div>
      </div>


      <div class="container-view" :style="{background:'url('+baseConfig.bgcfg.login_bg_img+') no-repeat center',width:'100%',height:hContainer ,backgroundSize:'cover'}">
        <div class="container loginpage-container" style="max-width: 682px;padding:0" id="Login">
          <div class="lf-img">
            <img :src="baseConfig.bgcfg.login_slider_bg ? baseConfig.bgcfg.login_slider_bg : '/assets/img/loginbg.jpg'" width="298" height="322">
          </div>
          <div class="reg-view-box">
            <form id="js-data-form" class="form-signin form-horizontal">
              <div class="modal-header" style="padding:0">
                <h3>登录</h3>
              </div>
              <div class="modal-body clearfix">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">
                      账号：
                    </span>
                    <input type="text" id="name" name="login" v-model="txtName" class="form-control input_s" :placeholder="baseConfig.textcfg.reg_account_tag" required autofocus>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon ">
                      密码：
                    </span>
                    <input type="password" id="password" name="password" class="form-control input_s" v-model="txtPwd" placeholder="密 码" required @keyup.enter="userLogin" />
                  </div>
                </div>


                <div class="form-group" style="margin-bottom:0px;color:#555">
                  <div class="input-group">
                    <span class="input-group-addon "> </span>
                    <input type="checkbox" id="ck-isremember" name="ck-isremember" v-model="isRemember" /> 保持15天登录
                  </div>
                </div>
              </div>

              <div class=" modal-footer">
                <button class="btn btn-primary user-login-btn" type="button" @click="userLogin" v-if="baseConfig.syscfg.reg_mod == 1">
                  登 录
                </button>

                <template v-if=" baseConfig.regcfg.reg_open || baseConfig.login_qq">
                  <div style="color: #777;margin-top: 10px;cursor: pointer;">
                    <template v-if="baseConfig.regcfg.reg_open">
                      <router-link class="login-a" to="register" v-if="baseConfig.regcfg.reg_open">没有{{baseConfig.textcfg.reg_account_tag}}？去注册 >></router-link>
                    </template>
                    <template v-else>
                      还没有 {{baseConfig.textcfg.reg_account_tag}}请联系
                      <a style="color: red;" :href="'http://wpa.qq.com/msgrd?v=3&uin='+baseConfig.login_qq+'&site=qq&menu=yes'" target="_blank">助理</a>

                    </template>
                  </div>
                </template>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="foot" style="min-width: 1080px;" v-html="baseConfig.copyright">
      </div>
    </div>

</template>
<style scoped>
  .login-a {
    color: #444343;
  }

  .head {
    height: 80px;
    background-color: #fff;
  }

  #Login {
    background: #fff;
  }

  .container .lf-img {
    float: left;
    width: 298px;
    height: 322px;
  }

  .reg-view-box {
    float: right;
    width: 348px;
    padding-right: 22px;
  }

  .modal-header h3 {
    font-weight: bold;
  }

  .btn {
    width: 100%;
    height: 50px;
    line-height: 27px;
    font-size: 20px;
    border: 0px none;
  }

  .btn-primary {
    background: #ff8a00;
  }

  .input-group-addon {
    width: 70px;
    background: #fff;
    border: 0;
    float: left;
    line-height: 21px;
    font-weight: bold;
    color: #000;
  }

  .input_s {
    width: 234px;
    float: left;
    border-radius: 5 px;
  }

  .container-view {
    min-width: 1080px;
    width: 100% !important;
    background-size: cover;
    padding-top: 70px;
    margin: 0 auto;
  }

  .container-view .containers {
    margin: 0 auto;
    margin-top: 0px;
    width: 740px;
    position: relative;
  }

  .foot {
    position: absolute;
    bottom: 0px;
    height: 100px;
    width: 100%;
    background-color: #fff;
    text-align: center;
    line-height: 80px;
    color: #ccc;
  }

  .container {
    position: fixed;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
  }
</style>

<script>
  import * as types from "@/store/types";
  export default {
    data() {
      return {
        txtName: "",
        txtPwd: "",
        hContainer: "",
        isRemember: 0
      };
    },
    created() {
      this.hContainer = this.roomInfo.sizeConfig.clientHeight - 180 + "px";
    },

    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id; //当前弹出层的id
      $("#" + id)
        .find(".vl-notice-title")
        .hide();
      $("#" + id).addClass("bgborder");
      $("#" + id)
        .find(".vl-notify-content")
        .addClass("padding-style");
      this.hContainer = this.roomInfo.sizeConfig.clientHeight - 180;
    },

    methods: {
      userLogin() {
        if (!this.txtName || !this.txtPwd) {
          this.dialogMsgAlign("请先输入完善！");
          return;
        }
        dms.LiveApi.userLogin({
          login: this.txtName,
          password: this.txtPwd,
          roomId: this.roomInfo.room_id,
          front: "",
          isRemember: this.isRemember ? 1 : 0
        }, resp => {
          //页面跳转
          window.location.hash = "";
          window.location.reload(true);
        }, resp => {
          this.$layer.msg(resp.msg, { time: 2 });
        });
      }
    }
  };
</script>