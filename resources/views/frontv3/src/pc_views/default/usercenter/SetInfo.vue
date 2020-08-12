<template>
  <div class="container" id="SetInfo">
    <h1>用户设置</h1>
    <form id="js-data-form" class="form-signin form-horizontal form-body">
      <template v-if="userInfo.role_id>= 500 || baseConfig.regcfg.change_pwd">
        <div class="form-group">
          <label class="col-xs-3 control-label">
            老密码:
            <span class="text-danger">*</span>
          </label>
          <div class="col-xs-8">
            <input name="oldpwd" v-model="oldPwd" type="password" class="form-control" placeholder="可由数字、字母、中文及下划线组成" />
          </div>
        </div>

        <div class="form-group">
          <label class="col-xs-3 control-label">
            新密码:
            <span class="text-danger">*</span>
          </label>
          <div class="col-xs-8">
            <input id="confrimPassword" name="pwd" v-model="newPwd" type="password" class="form-control" placeholder="可由数字、字母、中文及下划线组成" value="" />
          </div>
        </div>

        <div class="form-group">
          <label class="col-xs-3 control-label">
            确认新密码:
            <span class="required  text-danger">*</span>
          </label>
          <div class="col-xs-8">
            <input id="password" name="pwd1" v-model="repeatPwd" type="password" class="form-control" placeholder="可由数字、字母、中文及下划线组成" value="" />
          </div>
        </div>
        <hr />
      </template>

      <template v-if="userInfo.role_id>= 500 || baseConfig.regcfg.change_name">
        <div class="form-group">
          <label class="col-xs-3 control-label">
            昵称:
            <span class="required  text-danger">*</span>
          </label>
          <div class="col-xs-8">
            <input id="name" name="name" v-model="nickName" type="text" class="form-control" />
          </div>
        </div>

        <hr />
      </template>

      <div class="form-group">
        <span class="col-xs-3 control-label">用户头像:</span>

        <div class="col-xs-9">
          <img id="js-upload-image" :src='userPic' style=" width: 100px; height: 100px; border:1px solid #ddd;" />
          <input type="hidden" name="pic" id="js-upload-input" tabindex="-1" style="width: 100%;" v-model="userPic" />
          <span id="js-picture-btn" class="btn btn-success" @click="upload">选择图片</span>
        </div>
      </div>

      <div class="form-group form－action">
        <div class="col-xs-12">
          <button class="btn btn-md btn-primary btn-submit" type="button" @click="setUserInfo">提交</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import * as types from "@/store/types"
  export default {
    data() {
      return {
        oldPwd: '',
        newPwd: '',
        repeatPwd: '',
        nickName: '',
        userPic: '',
      }
    },
    created() {
      this.nickName = this.userInfo.name;
      this.userPic = this.userInfo.pic
      var self = this;
      $('#js-picture-btn').wait(function () {
        self.upload();
        $(this).addClass("btn btn-success ");
      })

    },
    mounted() {
      $("#js-picture-btn-button").wait(function () {
        $(this).addClass("uploadify-button ")
      })

      $("#js-picture-btn").wait(function () {
        $(this).addClass("btn btn-success ");
      })
    },
    methods: {
      upload() {
        var self = this
        $('[placeholder]').placeholder();

        $('#oldPassword').focus();
        $("#js-picture-btn").uploadify({
          width: 200,
          buttonText: "请选择本地图片文件",
          swf: '/assets/js/uploadify-2.2/uploadify.swf',
          uploader: '/ajaxUpload?dir=headpic',
          fileTypeDesc: '图片文件',
          fileSizeLimit: '20K',
          fileTypeExts: '*.gif; *.jpg; *.png',
          multi: false,
          onUploadSuccess: function (file, data, response) {
            var text = '[' + data + ']';
            data = $.parseJSON(data);
            self.userPic = data.img;
          }
        });
      },
      setUserInfo() {
        var params = {
          oldpwd: this.oldPwd,
          pwd: this.newPwd,
          pwd1: this.repeatPwd,
          pic: this.userPic,
          name: this.nickName,
        };
        dms.LiveApi.editUser(params, resp => {
          this.$layer.msg("修改成功!", { time: 2 });
          this.nickName.length && this.$store.commit(types.UPDATE_USER_INFO, {
            name: this.nickName,
            pic: this.userPic || this.userInfo.pic
          })
          this.$layer.close(this.roomInfo.curlayer_pop_id)
        }, resp => {
          this.$layer.msg(resp.msg, { time: 2 });
        })
      }
    },
  }
</script>

<style scoped>
  body {
    font: 14px/1.4 'STHeiti', 'Microsoft YaHei', '宋体', 'arial';
    background: #fff;
  }

  h1 {
    color: #0062b4;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
    font-size: 18px;
  }

  .form-body {
    border-radius: 5px;
    margin-bottom: 25px;
    padding: 15px;
  }

  .form－action {
    bottom: 0;
    left: 15px;
    background: #f7f8fa;
    width: 100%;
    padding: 15px;
    margin: 0;
  }

  .container {
    width: 700px !important;
    height: 580px;
  }

  .checkbox-inline {
    padding-left: 0;
  }

  .control-label {
    line-height: 35px;
  }

  .uploadify-button {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 1px;
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
    display: inline-block;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143 !important;
    border-radius: 2px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .uploadify:hover .uploadify-button {
    color: #fff;
    background-color: #449d44;
    border-color: #398439;
  }

  .uploadify-queue {
    display: none;
  }

  .placeholder {
    color: #aaa;
  }
</style>