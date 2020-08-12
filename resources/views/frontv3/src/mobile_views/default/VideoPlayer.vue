<template>
  <div class="video-player-block">
    <div class="surface-container" :style="size.video">
      <div id="playBtn" class="play-btn" onclick="playVideo();"></div>
      <iframe class="video-iframe" id="video-iframe" frameborder="no" border="0" v-if=" roomInfo.videoUrl.length" :src=" roomInfo.videoUrl " style="width:100%;height:100%;" @load=" videoIframeLoad "></iframe>

      <!-- 验证密码观看 -->
      <template v-if="baseConfig.channelInfo.needPwd ">
        <div id="js-video-player-pwd" style=" width:200px;margin: auto;margin-top: 20%;z-index:9999">
          <div class="input-group">
            <input type="password" class="form-control" id="js-video-password" name="password" v-model="videoPwdTxt" value="" placeholder="请输入视频密码">
            <span class="input-group-btn">
              <button id="js-video-pwd-btn" class="btn btn-success" @click="videoPwd">观看视频</button>
            </span>
          </div>
        </div>
      </template>

      <!-- 视频消息 -->
      <div id="idVideoMsg" class="video-msg-info" v-show="!roomInfo.videoStatus.is_show_video"></div>

      <!-- 背景图片 -->
      <div id="idVideoBg" v-show="!roomInfo.videoStatus.is_show_video" style="position: absolute;width: 100%;height: 100%;top: 0px;z-index:100;">
        <img class="surface-container-img" width="100%" height="100%" v-if="lookVideoImg.length" :src="lookVideoImg">
      </div>

      <template v-if="baseConfig.extcfg.hj_opend">
        <div id="js-hj-bg" style="position: absolute;width: 100%;height: 100%;z-index:101;">
          <img class="surface-container-img" width="100%" height="100%" v-if="baseConfig.extcfg.hj_bg.length" :src=" baseConfig.extcfg.hj_bg ">
        </div>
      </template>
    </div>

    <!-- 显示当前讲师 -->
    <div v-show=" roomInfo.teacher.tid > 0" class="live-info" v-if="!baseConfig.channelInfo.alone_video || (baseConfig.channelInfo.alone_video && baseConfig.sitecfg.alone_video_teacher_opend)">
      <span>
        {{baseConfig.textcfg.teacher_pre}}
        <span :style="{color: roomInfo.teacher.name_color}">
          {{roomInfo.teacher.name}}
        </span>
      </span>
    </div>

  </div>
</template>

<style scoped>
  .video-iframe {
    position: relative;
  }

  .video-player-block {
    background-color: black;
    position: relative;
    overflow: hidden;
  }

  .surface-container {
    position: relative;
    /* pointer-events: none; */
  }

  .live-info {
    background-color: rgba(0, 0, 0, 0.1);
    color: #FFFFFF;
    position: absolute;
    left: 10px;
    top: 20px;
    font-size: 26px;
    z-index: 2;
  }

  .live-info label {
    display: block;
  }

  .huya-iframe {
    margin-top: -100px;
    border: 0;
    width: 100%;
    height: 500px;
  }

  video {
    display: none;
  }

  #js-video-player-pwd {
    position: absolute;
    top: 10%;
    left: 20%;
  }

  .input-group {
    position: relative;
    display: table;
    border-collapse: separate;
  }

  .form-control {
    display: block;
    width: 100%;
    padding: 12px 24px;
    font-size: 28x;
    line-height: 40px;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  }

  .input-group .form-control,
  .input-group-addon,
  .input-group-btn {
    display: table-cell;
  }

  .input-group .form-control {
    position: relative;
    z-index: 2;
    float: left;
    width: 100%;
    margin-bottom: 0;
  }

  .input-group-btn {
    position: relative;
    font-size: 0;
    white-space: nowrap;
    width: 1%;
    white-space: nowrap;
    vertical-align: middle;
  }

  .input-group-btn:last-child>.btn,
  .input-group-btn:last-child>.btn-group {
    z-index: 2;
    margin-left: -1px;
  }

  .input-group .form-control:last-child,
  .input-group-addon:last-child,
  .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,
  .input-group-btn:first-child>.btn:not(:first-child),
  .input-group-btn:last-child>.btn,
  .input-group-btn:last-child>.btn-group>.btn,
  .input-group-btn:last-child>.dropdown-toggle {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  .input-group-btn>.btn {
    position: relative;
  }

  .btn {
    background-color: #107bcf;
    display: inline-block;
    padding: 12px 24px;
    margin-bottom: 0;
    font-size: 28x;
    font-weight: 400;
    line-height: 40px;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        videoPwdTxt: ""
      }
    },
    mounted() {
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        videoUrl: "/video?room_id=" + this.roomInfo.room_id + "&token=" + this.roomInfo.token
      })
    },
    computed: {
      ...Vuex.mapGetters([types.size]),
      lookVideoImg() {
        if (this.roomInfo.videoStatus.is_show_video) { //显示视屏的状态
          return "";
        } else { //隐藏视屏情况
          $('#idVideoMsg').html("当前暂无直播");
          if (!this.userInfo.lookvideo) {
            return this.baseConfig.channelInfo.videoBgImg
          }
          return this.baseConfig.channelInfo.videoBgImg
        }
      },
    },
    methods: {
      videoIframeLoad() {
        window.videoWin = document.getElementById('video-iframe').contentWindow;
      },
      videoPwd() {
        if (this.videoPwdTxt == "") {
          dialog({ title: "提示", content: "请输入视频密码", quickClose: true }).show();
          return;
        }
        dms.LiveApi.pwdVideo({ 'pwd': this.videoPwdTxt }, resp => {
          window.__checked_video_pwd__ = 1;
          $("#js-video-player-pwd").hide();
          showVideo();
        }, resp => {
          dialog({ title: "提示", content: resp.msg, quickClose: true }).show();
        })
      }
    },
  };
</script>