<template>
  <div class="containers loginpage-container" style="max-width: 682px;padding:0" id="Login">
    <div class="lf-img">
      <img :src=" '/assets/img/loginbg.jpg' " width="298" height="322">
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
              <input type="password" id="password" name="password" class="form-control input_s" v-model="txtPwd" placeholder="密 码" @keyup.enter="userLogin" required />
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

        </div>
      </form>
    </div>
    <div class="close-layer  close-layers" v-if=" parseInt(baseConfig.logincfg.login_pop) != 3" @click="closeLayer">
      ×
    </div>
  </div>
</template>
<style scoped>
  #Login {
    background: #fff;
    height: 322px;
    width: 682px;
  }

  .containers .lf-img {
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
    border-radius: 5px;
  }
</style>
<script>
  import * as types from "@/store/types";
  export default {
    data() {
      return {
        txtName: "",
        txtPwd: "",
        isRemember: 0
      };
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).css({
        height: '328px'
      });
      $("#" + id).find('.vl-notify-content').addClass('padding-style')
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
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
          window.location.hash = "";
          window.location.reload(true);
        }, resp => {
          this.$layer.msg(resp.msg, { time: 2 });
        });
      }
    }
  };
</script>