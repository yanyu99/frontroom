<template>
  <div id="StartVote" class="StartVote">
    <div class="LeaveMsg_title">
      发起投票
    </div>
    <span class="LeaveMsg_close" @click="closePop"></span>

    <div style="margin-top:30px;">
      <div class="vote-con">
        <ul>
          <li class="li-text">
            <label class="lb-font">投票主题：</label>
            <section>
              <textarea class="textarea-input" v-model="txtMsg" id="textarea-input"></textarea>
            </section>
          </li>
          <li class="li-img">
            <label class="lb-font">主题图片：

            </label>
            <section style="position: relative; overflow:hidden;height:100px;">
              <img id="js-upload-image" :src="txtImg" alt="投票主题图片" style=" width: 170px; height: 100px; border:1px solid #ddd;" />
              <input type="hidden" name="pic" id="js-upload-input" tabindex="-1" style="width: 100%;" v-model="txtImg" />
              <span id="js-picture-btn" class="btn btn-success" @click="upload">选择图片</span>
              <label class="lb-msg sugges">*建议图片尺寸：170*100</label>
            </section>
          </li>

          <li class="li-sels">
            <label class="lb-font">投票选项：</label>
            <section class="p_scroll" style="min-height:100px; max-height:194px; ">
              <span class="sp-sels" v-for="(item,ind) in optionLists" :key="ind">
                <input type="text" class="input-txt" v-model="item.txt" />
              </span>
              <p>
                <font class="lb-add" @click="addSel">添加选项</font>
                <font class="lb-msg">最多添加5个选项！</font>
              </p>
            </section>
          </li>

          <li class="li-type">
            <label class="lb-font">选项类型：</label>
            <section>
              <label for="rdtype1" class="lb-rd">
                <input type="radio" value="1" name="rdtype" id="rdtype1" v-model="voteType" />单选 </label>
              <label for="rdtype2" class="lb-rd">
                <input type="radio" value="2" name="rdtype" id="rdtype2" v-model="voteType" />多选 </label>
            </section>
          </li>

          <li class="li-time">
            <label class="lb-font">截止时间：</label>
            <section>
              <input type="text" class="input-txt end-time form_datetime" id="txt-end-time" @click="dataPick" data-date-format="yyyy-mm-dd hh:ii:ss" />
              <label class="datatime-firstclick"></label>

            </section>
          </li>
        </ul>
      </div>
      <p class="p-confirm-info">
        <span class="btn-click" @click="StartVoteFunc">确定</span>
      </p>
    </div>

  </div>
</template>
<style scoped>
  .p_scroll {
    overflow-x: hidden;
    overflow-y: auto;
    color: #000;
    font-size: .7rem;
    font-family: "\5FAE\8F6F\96C5\9ED1", Helvetica, "黑体", Arial, Tahoma;
    height: 100%;
  }

  .vote-con ul li label.sugges {
    display: inline-block;
    float: right;
    width: 200px;
    text-align: right;
    font-weight: normal;
    margin: 10px auto;
    position: absolute;
    top: 46px;
    right: 0px;
  }

  .StartVote {
    width: 580px;
    background: #fff;
    min-height: 595px;
    padding: 10px 20px 44px;
  }

  .LeaveMsg_title {
    height: 48px;
    border-bottom: 1px solid #E4E4E4;
    font-size: 18px;
    text-align: center;
    line-height: 48px;
    margin: 0 auto;
    color: #515151;
    font-weight: bold;
  }

  .LeaveMsg_close {
    background-image: url(/assets/img/close.png);
    position: absolute;
    top: 17px;
    right: 15px;
    display: block;
    width: 18px;
    height: 18px;
    cursor: pointer;
  }

  .msg-info {
    color: #fe6601;
    margin-top: 5px;
    margin-bottom: 0px;
    display: inline-block;
    float: left;
  }

  .vote-con {
    margin-bottom: 6px;
    overflow: hidden;
    border-bottom: 1px solid #E4E4E4;
    padding-bottom: 10px;
  }

  .vote-con ul {}

  .vote-con ul li {
    display: inline-block;
    float: left;
    margin-bottom: 10px;
  }

  .vote-con ul li label {
    float: left;
    display: inline-block;
    width: 70px;
  }

  .vote-con ul li section {
    float: right;
    display: inline-block;
    width: 460px;
  }

  .leavemsg-input {
    margin-bottom: 6px;
    overflow: hidden;
  }

  .textarea-input {
    border: 1px solid #bbb;
    width: 460px;
    height: 76px;
    vertical-align: top;
    float: right;
    padding-left: 2px;
  }

  .sp-sels input {
    margin-bottom: 10px;
  }

  .btn-click {
    display: inline-block;
    float: right;
    color: #fff;
    background-color: #0099cb;
    border-radius: 4px;
    padding: 0px 25px;
    height: 36px;
    line-height: 36px;
    cursor: pointer;
  }

  .p-confirm-info {
    height: 36px;
    margin-right: 10px;
  }

  .input-txt {
    border: 1px solid #d8d8d8;
    height: 32px;
    line-height: 32px;
    padding-left: 2px;
    border-radius: 2px;
    width: 455px;
  }

  .lb-msg {
    color: #a6a6a6;
    display: inline-block;
    float: right;
  }

  .lb-add {
    color: #3BADE1;
    cursor: pointer;
  }

  .lb-font {
    color: #5f5f5f;
  }

  .lb-rd {
    font-weight: normal;
  }
</style>
<style>
  .uploadify-buttons {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 1px;
    color: #fff;
    background-color: #0099cb;
    border-color: #0099cb;
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

  .uploadify:hover .uploadify-buttons {
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

  #js-picture-btn {
    float: right;
    right: 0px;
    top: 30px;
    border-radius: 4px;
    display: inline-block;
    display: inline-block;
    margin-top: 18px;
  }
</style>

<script>
  import Vuex from "vuex"
  import * as types from "@/store/types"

  export default {
    data() {
      return {
        txtMsg: '',
        txtImg: '/assets/v3/images/pc/vote_def.jpg',
        voteType: 1, //单双多选
        txtSels: [],
        endTime: '',
        optionLists: [{ txt: '' }],
      }
    },

    created() {
      var _curTime = dms.date('Y-m-d');
      $(".form_datetime").wait(function () {
        $("#txt-end-time").val(_curTime + " 23:59:59")
        $(".form_datetime").click();
        $(".datatime-firstclick").click();
      })
      var self = this;
      $('#js-picture-btn').wait(function () {
        self.upload();
        $(this).addClass("btn btn-success ");
      });
    },
    mounted() {
      var self = this;
      $("#js-picture-btn-button").wait(function () {
        $(this).addClass("uploadify-buttons ")
      })

      $("#js-picture-btn").wait(function () {
        self.upload();
        $(this).addClass("btn btn-success ");
      })
    },
    methods: {
      dataPick() {
        $(".form_datetime").datetimepicker({
          format: "yyyy-mm-dd hh:ii:ss",
          autoclose: true,
          language: "zh-CN",
          todayBtn: true,
          minuteStep: 5
        });
      },
      upload() {
        var self = this;
        $('[placeholder]').placeholder();
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
            self.txtImg = data.img;
          }
        });
      },
      StartVoteFunc() {
        if (this.txtMsg == '') {
          this.dialogMsgAlign("请先输入投票主题！");
          return;
        }
        var _lenStr = dms.dataLength($.trim(this.txtMsg));
        if (_lenStr > 300) {
          this.dialogMsgAlign("投票主题内容不能超过300个字符！");
          return;
        }
        if (this.txtImg == '') {
          this.dialogMsgAlign("请先上传图片！");
          return;
        }
        if (!this.optionLists.length) {
          this.dialogMsgAlign("投票选项不能为空！");
          return;
        }
        var _endtime = $("#txt-end-time").val();
        if ($.trim(_endtime) == '') {
          this.dialogMsgAlign("结束时间不能为空！");
          return;
        }

        var _optArr = this.optionLists;
        var _optStr = '';
        // _optArr.map((i, ind) => {
        //   if (dms.dataLength(i.txt) > 25) {
        //     this.dialogMsgAlign("操作选项字数不能超过25！");
        //     break;
        //   }
        //   _optStr += i.txt + "|";

        // })

        var _boolVal = true;
        for (var i = 0; i < _optArr.length; i++) {
          if (dms.dataLength(_optArr[i].txt) > 60) {
            _boolVal = false;
            break;
          }
          _optStr += _optArr[i].txt + "|";
        }

        if (!_boolVal) {
          this.dialogMsgAlign("操作选项字数不能超过60个字符！");
          return
        }

        if (_optStr.substr(_optStr.length - 1, 1) == '|') {
          _optStr = _optStr.substr(0, _optStr.length - 1);
        }

        dms.createVote({
          topic: this.txtMsg,
          pic: this.txtImg || '/assets/v3/images/pc/vote_def.jpg',
          type: this.voteType,
          end_time: _endtime, //this.endTime,
          options: _optStr
        }, resp => {
          this.dialogMsgAlign("创建成功！");
          this.$layer.close(this.roomInfo.curlayer_pop_id);
        }, resp => {
          this.dialogMsgAlign(resp.msg);
          return;
        })
      },
      addSel() {
        if (this.optionLists.length >= 10) {
          return
        }
        this.optionLists.push({ txt: '' });
      },
      closePop() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },


    }
  }
</script>