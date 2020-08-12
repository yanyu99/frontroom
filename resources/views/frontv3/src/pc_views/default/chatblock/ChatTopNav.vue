<template>
  <div class="main-content-menu" :style="{'background-color': $c('rgba(0, 0, 0, 0.5)##聊天区头部导航颜色透明值',__FILE__),'height':$t('40##聊天区头部导航高度')+'px'}">
    <div class="user-num-warp" v-if="baseConfig.blockcfg.show_user_num" @click.stop="showInputUser = !showInputUser">
      <a href="javascript:;" class="user-num-warp" style="margin-left:0px;">
        <span class="text">
          <img src="/assets/v3/images/pc/onlineNub.png" height="29px;">
          <span style="line-height: 29px;vertical-align: -1px;display: inline-block;" id="idUserTotal">{{totalUser}}</span>
        </span>
      </a>
    </div>
    <div class="baseuserInput" v-if="userInfo.role.f_base_user" v-show="showInputUser " @mouseenter.stop="showInputUser=true">
      <input v-model="txtBaseNum" class="form-control txt-input-usernum" type="text" name="title">
      <span style="vertical-align: 0.5px;" class="btn btn-success" @click="modifyUserBase">确定</span>
    </div>

    <div class="chat-content-exFun">
      <template v-if="baseConfig.hotcfg.show_rank">
        <div style="display: inline-block; position:relative;" @click="showRank = !showRank" @mouseleave="showRank= false" @mouseenter="showRank=true">
          <span class="dropdown-toggle btn-rank" data-hover="dropdown" :style="btnColor">{{baseConfig.textcfg.rank_tit}}</span>

          <div class="dropdown-menu rankbox" v-show="showRank">
            <template v-for="item in tabRanks">
              <div :key="item.tag" class="tabranks-li" @click="popShow(item.tag)">{{item.title}}</div>
            </template>
          </div>
        </div>
      </template>

      <template v-if="baseConfig.blockcfg.show_past">
        <div style="display: inline-block;position: relative;  " @click="userPast">
          <span id="idUserPast" class="btn-past" :style="btnColor">{{$t("签到##签到文字",__FILE__)}}</span>
          <div id="idUserPastRed" class="past-pointer" v-show="!roomInfo.next_past_timeout"></div>
        </div>
      </template>

      <div id="chat-lock-screen-btn" class="chat-content-exFun-item" @click="lockScreen" :style="btnColor">
        <i class="icon" :class="{'icon-lock':roomInfo.screenLockStatus,'icon-unlock':!roomInfo.screenLockStatus}"></i>
        锁屏
      </div>
      <div id="chat-clean-screen-btn" class="chat-content-exFun-item" @click="emptyChatList" :style="btnColor">
        <i class="icon icon-trash"></i>
        清屏
      </div>
    </div>
  </div>
</template>
<style scoped>
  .main-content-menu {
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    display: flex;
    flex-direction: row;
  }

  .user-num-warp {
    height: 40px;
    line-height: 40px;
    margin-top: 0px;
    display: flex;
    position: relative;
  }

  .baseuserInput {
    position: absolute;
    width: 160px;
    display: block;
    top: 90px;
    z-index: 4;
    background-color: #fff;
    padding: 5px 2px;
    border-radius: 4px;
  }

  .txt-input-usernum {
    width: 90px;
    display: inline;
    margin-left: 5px;
  }

  .chat-content-exFun {
    height: 40px;
    line-height: 40px;
    display: flex;
    flex: 1;
    justify-content: flex-end;
  }

  .chat-content-exFun-item {
    line-height: 20px;
    margin-top: 6px;
    margin-left: 3px;
  }

  .main-content-menu {
    padding: 0px 7px;
  }

  .rankbox {
    color: #fff;
    padding: 10px;
    background-color: #000;
    border: 1px solid #fff;
    border-radius: 3px;
    display: block;
    min-width: 98px;
    top: 34px !important;
  }

  .tabranks-li {
    cursor: pointer;
    margin-bottom: 8px;
    height: 20px;
    line-height: 20px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import signinMixinPc from "@/mixins/signinMixinPc";
  export default {
    data() {
      return {
        showRank: false,
        showInputUser: false,
        isBothRobot: false,
        txtBaseNum: 0,
      };
    },
    props: ["tabRanks","btnColor"],
    mixins: [layercommMixinPc, signinMixinPc],
    computed: {
      totalUser() {
        var userNum = parseInt(this.roomInfo.robot_num || 0) +
          parseInt(this.roomInfo.real_robot_num || 0) +
          parseInt(this.roomInfo.realUserTotal || 0) +
          parseInt(this.baseConfig.logincfg.base_user || 0);
        return userNum
      },
    },
    methods: {
      lockScreen() {
        var _screenLockStatus = this.roomInfo.screenLockStatus == 0 ? 1 : 0;
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          screenLockStatus: _screenLockStatus
        });
      },
      emptyChatList() {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          chatList: []
        });
      },

      modifyUserBase() {
        this.showInputUser = false;
        var num = parseInt(this.txtBaseNum);
        if (isNaN(num) || num < 0) return;
        dms.LiveApi.setUserBase({
            user_base: num
          })
          .then(resp => {
            this.dialogMsg(resp.msg);
          })
          .catch(resp => {
            this.dialogMsg(resp.msg);
          });
      }
    }
  };
</script>