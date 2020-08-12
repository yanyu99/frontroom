<template>
  <div class="main-video bor-left ">
    <div id="js-room-info " class="teacher-info-wrap " :style="{'background-color': $c('rgba(0,0,0,0.5)##视频头部导航颜色值透明度',__FILE__),height:$t('40##房间头部导航高度', __FILE__)+'px'}">
      <div class="videoFunc-top">
        <ul class="video-left-ul">
          <li id="js-live-btn" v-html="$t('视频直播##显示的视频直播文字',__FILE__)"></li>
          <li id="js-vod-list" v-if="baseConfig.sitecfg.vod_opend1" @click="popShow('VIDEO',{text:'视频库'})" v-html="$t('视频库##显示的视频库文字',__FILE__)"></li>
          <li v-show="!baseConfig.channelInfo.alone_video || (baseConfig.channelInfo.alone_video && baseConfig.sitecfg.alone_video_teacher_opend) " style="width:auto; position: relative;">
            <span class="teacher-info-content-name" @mouseenter="showTeacherImg = true" @mouseleave="showTeacherImg = false">
              <template v-if="baseConfig.channelInfo.living && roomInfo.teacher">
                {{baseConfig.textcfg.teacher_pre}}
                <span :style="{'color':roomInfo.teacher.name_color?roomInfo.teacher.name_color:''}">{{ roomInfo.teacher.name?roomInfo.teacher.name:'无'}}</span>
              </template>
            </span>
            <template v-if="userInfo.role.f_video_op && roomInfo.parent_room_id == roomInfo.room_id">
              <a href="javascript:;" style="color: red;" :data-state="baseConfig.channelInfo.living" id="js-start-video" @click="changePlayState(baseConfig.channelInfo.living)">
                {{baseConfig.channelInfo.living ? "停止讲课" :"开始讲课"}}
              </a>
            </template>
            <div class="dropdown-menus" v-show="showTeacherImg" :style="{width:'auto',left:'1px',padding: '0',
      opacity:roomInfo.teacher || !roomInfo.teacher.showimg || !baseConfig.channelInfo.living ? '1' : '' }">
              <img id="js-teacher-img" style="max-width: 600px;" v-if="roomInfo.teacher" :src="roomInfo.teacher?roomInfo.teacher.showimg : ''" alt>
            </div>
          </li>
        </ul>
      </div>
      <div class="room-info-right-fun">
        <div class="room-top-btn-item refash-btn" id="js-refash-video" :style="btnBg" v-show="roomInfo.videoUrl.length" @click="refashVideo">
          <i></i> 刷新
        </div>

        <!-- 课程安排 -->
        <template v-if="parseInt(baseConfig.extcfg.showLessonV2)">
          <div class="room-top-btn-item lesson-text" v-show="!baseConfig.channelInfo.alone_video" id="idLessonV2" @mouseenter="isShowCourse = true" @mouseleave="isShowCourse = false" :style="btnBg">
            <span class="dropdown-toggle" data-hover="dropdown">
              <i></i>{{baseConfig.textcfg.lesson_pre}}</span>
            <div class="dropdown-menu  lesson-con" v-show="isShowCourse" style="width: 700px;height: 450px;right: 0px;left: auto;padding: 0;margin: 0; display:block;">
              <course-pop :noClose="true"></course-pop>
            </div>
          </div>
        </template>

        <div class="room-top-btn-item down-load-btn" :style="btnBg">
          <i></i>
          <a :href="'/siteurl/'+roomInfo.room_id+'?name='+baseConfig.pagecfg.title" v-html="$t('下载到桌面##显示的下载到桌面文字',__FILE__)"></a>
        </div>

        <!-- 老师点赞排行榜 -->
        <div v-if="baseConfig.eventcfg.agree_opend" class='teacher-agrees'>
          <a class="a-teacher-agrees dropdown-toggle" data-hover="dropdown">
            <span class="icon-teacher-agrees">&nbsp;</span>
          </a>
          <ul class="teacher-agree-warp dropdown-menu pull-right" v-show="isShow">
            <template v-for="(item,index) in  roomInfo.teachersList">
              <li :key="index" :class="'item-'+(index+1)" style="">{{item.name}}获得{{(item.total+item.total_base)}}个点赞</li>
            </template>
          </ul>
        </div>
      </div>
    </div>

    <div class="main-video-player" :style="{height:baseConfig.pgsizecfg.video_h+'%'}">
      <gift-display></gift-display>
      <video-timeout-bar v-if="!userInfo.logined &&  parseInt(baseConfig.logincfg.login_pop)"></video-timeout-bar>
      <video-player></video-player>
    </div>
    <room-bot-info class="bor-top"></room-bot-info>

  </div>
</template>

<style scoped>
  .main-video {
    /* z-index: 0;  导致倒计时弹出登录 没有盖住聊天区 */
    display: flex;
    flex-direction: column;
  }

  .teacher-info-wrap {
    position: relative;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  /**视频头部功能按钮样式*/
  .room-top-btn-item {
    height: 28px;
    line-height: 28px;
    vertical-align: middle;
    border: 1px solid #fff !important;
    font-size: 14px;
    display: inline-block;
    padding: 0px 5px;
    text-align: center;
    border-radius: 3px;
    margin-top: 6px !important;
    margin-right: 3px;
    color: #fff;
    cursor: pointer;
  }

  .room-top-btn-item i {
    display: inline-block;
    width: 22px;
    height: 22px;
    margin-right: 2px;
    vertical-align: text-bottom;
  }

  .refash-btn i {
    background: url("/assets/img/icon-reflush.png") no-repeat left;
  }

  .down-load-btn i {
    background: url("/assets/img/icon-download.png") no-repeat left;
  }

  .lesson-text i {
    background: url("/assets/img/icon-course.png") no-repeat left;
  }

  .dropdown-menus {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 999;
    display: block;
    float: left;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
  }

  .teacher-agrees {
    position: relative;
  }

  .teacher-agrees1 {
    position: absolute;
    right: 1px;
    top: 52px;
    z-index: 3;
    height: 40px;
  }

  .a-teacher-agrees {
    display: inline-block;
    height: 24px;
  }

  .teacher-agree-warp {
    max-height: 376px;
    display: block;
    overflow: hidden;
    z-index: 3;
  }

  .room-info-right-fun {
    text-align: right;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import GiftDisplay from '@/pc_views/_/gift/GiftDisplay'
  import VideoPlayer from '@/pc_views/_/midcontent/VideoPlayer'
  import VideoTimeoutBar from "@/pc_views/_/header/VideoTimeoutBar"
  import RoomBotInfo from '@/pc_views/_/midcontent/RoomBotInfo'
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import CoursePop from "@/pc_views/_/navmenupop/COURSE";
  export default {
    data() {
      return {
        btnBg: { 'background-color': $c('transparent##房间头部按钮背景颜色', __FILE__) },
        showTeacherImg: false,
        isShow: false,
        isShowCourse: false
      }
    },
    mounted() {
      var self = this
      var tipsTimer = null;
      $(".teacher-agrees").wait(function () {
        $('.teacher-agrees').mouseenter(function () {
          self.isShow = true;
        }).mouseleave(function () {
          tipsTimer = setTimeout(function () {
            self.isShow = false;
          }, 500);
        });
        $('.teacher-agree-warp').mouseenter(function () {
          if (tipsTimer) {
            clearTimeout(tipsTimer);
            tipsTimer = null;
          }
        }).mouseleave(function () {
          self.isShow = false;
        });
      })
    },
    methods: {
      refashVideo() {
        if (!this.baseConfig.channelInfo.needPwd) {
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            videoUrl: "/video?room_id=" + this.roomInfo.room_id + "&token=" + this.roomInfo.token + "&_t" + new Date().getTime(),
            videoStatus: {
              is_show_video: true
            }
          })
        }
      },
      changePlayState(_state) {
        dms.LiveApi.stateVideo({
          live_state: _state ? 0 : 1
        }).then(resp => {
          this.$store.state.baseConfig.channelInfo.living = !_state;
        }).catch(resp => {
          this.dialogMsg(resp.msg);
        });
      }
    },
    mixins: [layercommMixinPc],
    components: {
      GiftDisplay,
      VideoPlayer,
      VideoTimeoutBar,
      RoomBotInfo,
      CoursePop
    }
  }
</script>