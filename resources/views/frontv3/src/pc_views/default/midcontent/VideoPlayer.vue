<template>
  <div class="index-video-wrap">
    <div class="main-video-player" style="width:100%;height:100%;">
      <div class="player-box">
        <iframe class="video-iframe" id="video-iframe" frameborder="no" border="0" v-if=" roomInfo.videoUrl.length " :src=" roomInfo.videoUrl " style="width:100%;height:100%;" @load=" videoIframeLoad "></iframe>
      </div>

      <template v-if=" baseConfig.channelInfo.needPwd">
        <div id="js-video-player-pwd">
          <div class="input-group">
            <input type="password" class="form-control" id="js-video-password" name="password" v-model="videoPwdTxt" placeholder="请输入视频密码" @keyup.enter="videoPwd">
            <span class="input-group-btn">
              <button id="js-video-pwd-btn" class="btn btn-success" type="button" @click="videoPwd">观看视频</button>
            </span>
          </div>
        </div>
      </template>

      <div id="js-no-video-contanier" class="video-player-wrap" v-show="!baseConfig.channelInfo.living &&!roomInfo.videoUrl.length">
        <div class="mod_video">
          <div id="js-no-video-tip" class="ntext">当前暂无直播,请关注下节课</div>
        </div>
      </div>

      <!-- 老师点赞 -->
      <template v-if="baseConfig.eventcfg.agree_opend">
        <div v-if="baseConfig.eventcfg.agree_opend == 3" class="pao">
          <img id="idTeacherCurAgree" @click="agreeTeacher" src="/assets/img/agree/agree_v2.png">
        </div>
        <img v-else id="idTeacherPopAgree" @click="popShow('TEACHER')" src="/assets/img/agree/agree_v2.png">
      </template>

      <!-- 视频配置 -->
      <div id="idVideoBg" class="VideoBg" v-show="!roomInfo.videoUrl.length">
        <img width="100%" height="100%" v-if="lookVideoImg" :src="lookVideoImg">
      </div>
      <div id="js-hj-bg" v-show="baseConfig.extcfg.hj_opend && hj_start <= now && hj_end>= now">
        <img width="100%" height="100%" v-if="baseConfig.extcfg.hj_bg" :src="baseConfig.extcfg.hj_bg">
      </div>
    </div>
  </div>
</template>

<style scoped>
  .index-video-wrap {
    height: 100%;
  }

  .player-box {
    background-color: #111;
    width: 100%;
    height: 100%;
    position: absolute;
  }

  .video-iframe {
    z-index: 1;
    position: relative;
  }

  .video-player-wrap {
    width: 100%;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #111;
  }

  #js-video-player-pwd {
    width: 250px;
    z-index: 9;
    margin: 0 auto;
    margin-top: 150px;
  }

  #js-hj-bg {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 91;
  }

  .VideoBg {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    /* z-index: 90; */
  }

  .pao {
    width: 50px;
    height: 50px;
    position: absolute;
    bottom: 30px;
    right: 10px;
  }

  #idTeacherCurAgree {
    cursor: pointer;
    position: absolute;
    bottom: 0px;
    right: 0px;
    z-index: 99;
  }

  #idTeacherPopAgree {
    cursor: pointer;
    position: absolute;
    bottom: 30px;
    right: 10px;
    z-index: 99;
  }

  .main-video-player {
    height: 100%;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import layercommMixinPc from "@/mixins/layercommMixinPc";

  export default {
    data() {
      return {
        videoPwdTxt: "",
        now: "",
        hj_start: "",
        hj_end: ""
      };
    },
    created() {
      this.now = dms.date("H:m");
      this.hj_start = baseConfig.extcfg.hj_hm.split(" ")[0];
      this.hj_end = baseConfig.extcfg.hj_hm.split(" ")[1];
    },
    mixins: [layercommMixinPc],
    mounted() {
      if (
        (this.baseConfig.channelInfo.needPwd && window.__checked_video_pwd__) ||
        !this.baseConfig.channelInfo.needPwd
      ) {
        if (this.roomInfo.videoStatus.is_show_video) {
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            videoUrl: "/video?room_id=" +
              this.roomInfo.room_id +
              "&token=" +
              this.roomInfo.token +
              "&_t" +
              new Date().getTime(),
            videoStatus: {
              is_show_video: true
            }
          });
        }
      }
    },
    computed: {
      lookVideoImg() {
        var _imgUrl = "";
        $("#idVideoMsg").html("当前暂无直播");
        if (!this.userInfo.lookvideo) {
          _imgUrl = this.baseConfig.channelInfo.videoBgImg;
        }
        _imgUrl = this.baseConfig.channelInfo.videoBgImg;
        return _imgUrl;
      }
    },
    methods: {
      videoIframeLoad() {
        window.videoWin = document.getElementById("video-iframe").contentWindow;
      },
      videoPwd() {
        if (this.videoPwdTxt == "") {
          dialog({
            title: "提示",
            content: "请输入视频密码",
            quickClose: true
          }).show();
          return;
        }
        dms.LiveApi.pwdVideo({
          pwd: this.videoPwdTxt
        }, resp => {
          window.__checked_video_pwd__ = 1;
          $("#js-video-player-pwd").hide();
          showVideo();
        }, resp => {
          dialog({ title: "提示", content: resp.msg, quickClose: true }).show();
        });
      },
      agreeTeacher() {
        var cur_teacher = this.roomInfo.teacher.tid;
        cur_teacher = parseInt(cur_teacher);
        if (cur_teacher <= 0) {
          this.$layer.msg("当前没有讲师", { time: 2 });
          return;
        }

        var pp = {
          pl: 0, //left定位
          step: 500
        };
        dms.LiveApi.sendAgree({
          tid: cur_teacher
        }, resp => {
          var time;
          paopao();

          function paopao() {
            var html =
              '<div class="paopao " style="position:absolute;left: ' +
              pp.pl +
              'px;"><img style="width:25px;height:25px" src="/assets/img/heart.png" alt=""></div>';
            $(".pao").append(html);
            pp.pl = Math.round((Math.random() * 100) / 3);
            $(".paopao").each(function () {
              if ($(this).index() % 2 == 0) {
                pp.step = 100;
              } else if ($(this).index() % 3 == 0) {
                pp.step = 200;
              } else {
                pp.step = 300;
              }
              if (!$(this).is(":animated")) {
                $(this).animate(
                  {
                    top: "-150px",
                    opacity: "0"
                  },
                  (500 - pp.step) * 10,
                  function () {
                    $(this).remove();
                  }
                );
              }
            });
            time = setTimeout(paopao, pp.step);
          }
          setTimeout(function () {
            clearTimeout(time);
          }, 1000);
        }, resp => {
          if (resp.code == 401) {
            this.baseConfig.syscfg.reg_mod == 2 ?
              this.popShow("CouponLogin") :
              this.popShow("Login");
          } else {
            this.$layer.msg(resp.msg, { time: 2 });
          }
        });
      }
    }
  };
</script>