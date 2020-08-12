<template>
  <div id="listUserCard" class="dds-card dfdf" :style="posStyle">
    <span class="card-close" @click="closeLayer">×</span>
    <div class="card-inner">
      <div class="card-info">
        <div class="clearfix" style="zoom: 1;">
          <div class="photo-con">
            <img width="64" height="64" :src="roomInfo.selectUser.pic? roomInfo.selectUser.pic:''" />
          </div>
          <div class="user-info">
            <p>
              <span :title="roomInfo.selectUser.name" class="sp-name" style="">{{roomInfo.selectUser.name}}</span>
            </p>
            <p v-if="roomInfo.selectUser.ip" style="display: inline-block;">IP：{{roomInfo.selectUser.ip}}</p>
            <p v-if="roomInfo.selectUser.ip_location" style="display: inline-block;">地域：{{roomInfo.selectUser.ip_location}}</p>
            <template v-if="baseConfig.site_name != 'shengdacj'" && userInfo.isManager>
              <template v-if="roomInfo.room_id  == 0">
                <p v-if="roomInfo.selectUser.phone">电话：{{roomInfo.selectUser.phone}}</p>
              </template>
              <template v-else>
                <p v-if="roomInfo.selectUser.phone && roomInfo.room_id == roomInfo.selectUser.room_id">
                  电话：{{roomInfo.selectUser.phone}}</p>
              </template>
            </template>

          </div>
        </div>
        <div class="cal-num">
          <template v-if="roomInfo.selectUser.room_id != 0 && (roomInfo.room_id  == roomInfo.parent_room_id  || roomInfo.room_id == roomInfo.selectUser.room_id ) ">
            <p>当日在线：
              <label style="color:#FBCA00">{{todayTime}}</label>
            </p>
            <p>累计在线：
              <label style="color:#FBCA00">{{allTime}}</label>
            </p>
          </template>
        </div>
      </div>
      <div class="user-opt clearfix">

        <template v-if="!roomInfo.selectUser.robot ">
          <template v-if="roomInfo.selectUser.room_id != 0 && (roomInfo.room_id  == roomInfo.parent_room_id  || roomInfo.room_id == roomInfo.selectUser.room_id ) ">
            <div class="userinfo-check-bot">
              <span class="user-gag-btn" v-if="userInfo.role.f_ip" @click="killIp">{{killipText}}</span>
              <span class="user-kick-btn" v-if="userInfo.role.f_kick" @click="lookVideo">{{lookvideoText}}</span>
              <span class="user-lookvideo-btn" v-if="userInfo.role.f_kick" @click="userKick">{{kickText}}</span>
              <span class="user-ip-btn" v-if="userInfo.role.f_gag" @click="userGag">{{gagText}}</span>
            </div>
          </template>
        </template>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .sp-name {
    display: inline-block;
    white-space: nowrap;
    max-width: 148px;
    overflow: hidden;
    font-size: 14px;
  }

  .dds-card {
    position: fixed;
  }

  .cal-num {
    margin-top: 5px;
  }

  .cal-num p {
    margin-bottom: 0px;
  }
</style>
<script>
  import * as types from '@/store/types'
  import usefunMixin from "@/mixins/usefunMixin"
  export default {
    mixins: [usefunMixin],
    computed: {
      posStyle() {
        var objSty = {};
        objSty.top = this.roomInfo.selectUser.y + 'px';

        var posX = '';
        var _from = this.roomInfo.selectUser.from;
        var _layoutsider = this.baseConfig.theme.layoutsider || 'layout-sider-left';
        var _layout = this.baseConfig.theme.layout || 'layout-video-left';

        //用户列表  居左     居右
        if (_from == "userlist" && _layoutsider == "layout-sider-left") {
          objSty.left = '0px';
        } else if (_from == "userlist" && _layoutsider == "layout-sider-right") {
          objSty.right = '0px';
        } else if (_from == "chatoption" && _layout == "layout-video-left") { //视频居左
          if (_layoutsider == "layout-sider-left") {
            var _wid = this.roomInfo.selectUser.x + 276;
            if ($(window).width() >= _wid) { //没有超出浏览器
              objSty.right = ($(window).width() - this.roomInfo.selectUser.x - 20) + "px";
            } else { //超出浏览器宽度
              objSty.right = ($(window).width() - this.roomInfo.selectUser.x + 10) + "px";
            }
          } else {
            objSty.left = this.roomInfo.selectUser.x + 10 + 'px';
          }
        } else if (_from == "chatoption" && _layout == "layout-video-right") {
          objSty.left = this.roomInfo.selectUser.x + 'px'
        } else {
          objSty.left = '0px';
        }
        return objSty;
      }
    },
  }
</script>