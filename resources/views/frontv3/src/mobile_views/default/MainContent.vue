<template>
  <div class="main-content">
    <div id="chattitle" class="chat-title" :style="{
        color: $c('#7F7F7F##字体颜色', __FILE__),
        background: $c('#181818##背景颜色', __FILE__),
        borderBottom: '1px solid ' + $c('#fe9a01##激活样式', __FILE__)}">
      <div class="tit-warp">
        <span v-for="(tab,index) in tabMenus" class="chat-title-span" :id="'menu_'+tab.tag" :style="{
          background: tab.tag==roomInfo.active_menu ? $c('#fe9a01##激活样式', __FILE__) : '',
          color: tab.tag==roomInfo.active_menu ? '#fff' : $c('#7F7F7F##字体颜色', __FILE__),
        }" :key="tab.tag" @click="selectTab(tab,index)">
          <img v-show=" roomInfo.menusMapIsNew[tab.tag]" class="new-message" :src="$m('/assets/img/phone/new.png##新消息图标', __FILE__)">
          {{tab.text}}
        </span>
      </div>
      <span class="tab-header" style="float:right;" data-type="usernum" @click="showUserInfo">
        <img class="user-center-icon" :src="userInfo.logined ? (userInfo.pic || '/assets/img/avatar/default.png') : $t('/assets/img/logintxt.jpg##未登录默认图标',__FILE__)" alt="用户">
      </span>
    </div>

    <div class="panes">
      <template v-for="tab in tabMenus">
        <component :is=" tab.tag " :tab=" tab " :key="tab.tag" v-show="tab.tag==roomInfo.active_menu"></component>
      </template>
      <user-info-check v-show="roomInfo.selectUser.uid"></user-info-check>
    </div>
  </div>
</template>

<style scoped>
  .chat-title {
    background: #181818;
    color: #7f7f7f;
    font-size: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: row;
    align-items: center;
    height: 82px;
    justify-content: space-between;
  }

  .chat-title span {
    display: inline-block;
    float: left;
    padding: 0px 10px;
    z-index: 999px;
    font-size: 30px;
    font-weight: bold;
    height: 82px;
    line-height: 82px;
    vertical-align: middle;
    position: relative;
    z-index: 99;
  }

  .chat-title img {
    font-size: 12px;
    height: 12px;
    position: absolute;
    background-size: 12px;
    z-index: 1;
    right: -3px;
    top: 0px;
  }

  .chat-title span.tab-header {
    display: flex;
    align-items: center;
    margin-right: 10px;
    padding: 0px 5px;
  }

  .chat-title span.tab-header img {
    width: 65px;
    height: 65px;
    vertical-align: middle;
    background-size: 65px;
    border-radius: 65px;
    position: relative;
  }

  .main-content {
    z-index: 1;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .panes {
    position: relative;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import CHAT_PRIVATE from "@/mobile_views/_/tab/CHAT_PRIVATE";
  import CHAT_PUBLIC from "@/mobile_views/_/tab/CHAT_PUBLIC";
  import USER_LIST from "@/mobile_views/_/tab/USER_LIST";
  import RANKING_HOT from "@/mobile_views/_/tab/RANKING_HOT";
  import RANKING_LIST from "@/mobile_views/_/tab/RANKING_LIST";
  import VOD_LIST from "@/mobile_views/_/tab/VOD_LIST";

  import UserInfos from "@/mobile_views/_/usercenter/UserInfos";
  import UserInfoCheck from "@/mobile_views/_/chat/UserInfoCheck"; //删审查看
  import LEAVE_RANK from "@/mobile_views/_/tab/LEAVE_RANK";
  import JUDGE_LIST from "@/mobile_views/_/tab/JUDGE_LIST";

  export default {
    data() {
      return {
        tabMenus: []
      }
    },

    mounted() {
      var self = this;
      $(".main-content").wait(function () {
        $(".main-content").bind("click", function (e) {
          dms.callFuncGroup('main-content');
        });
      });
    },
    created() {
      this.getTabs();
      if (!this.roomInfo.active_menu) {
        this.$store.state.roomInfo.active_menu = this.tabMenus[0].tag;
      }
    },

    methods: {
      getTabs() {
        var _tabMenus = [{
          tag: 'CHAT_PUBLIC',
          text: $t('公聊##公聊文本', __FILE__)
        }, {
          tag: 'CHAT_PRIVATE',
          text: $t('私聊##公聊文本', __FILE__)

        }];

        if (this.userInfo.role.f_userlist) {
          _tabMenus.push({
            tag: 'USER_LIST',
            text: $t('用户列表##用户列表文本', __FILE__)
          })
        }
        if (this.baseConfig.eventcfg.hot_opend) {
          _tabMenus.push({
            tag: 'RANKING_HOT',
            text: $t('人气榜##人气榜文本', __FILE__)
          })
        }
        if (this.baseConfig.hotcfg.show_rank) {
          _tabMenus.push({
            tag: 'RANKING_LIST',
            text: $t('排行榜##排行榜文本', __FILE__)
          })
        }
        if (this.baseConfig.sitecfg.vod_opend1) {
          _tabMenus.push({
            tag: 'VOD_LIST',
            text: $t('视频##视频文本', __FILE__)
          })
        }

        //讲师审核 TODO
        // if (this.baseConfig.site.teacher_judge_opend) {
        //   _tabMenus.push({
        //     tag: 'JUDGE_LIST',
        //   })
        // }
        this.tabMenus = _tabMenus;
      },
      selectTab(tab, index) {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_menu: tab.tag,
          menusMapIsNew: {
            [tab.tag]: false
          }
        });
      },
      showUserInfo() {
        if (this.userInfo.logined) {
          //判断用户是否登录   进入用户中心
          window.location.hash = '#/usermain';
          return;
        }
        //以组件的 弹出
        let _id = this.$layer.iframe({
          content: {
            content: UserInfos,
            parent: this,
            data: {
              check: "我是参数"
            }
          },
          area: ["95%"] //弹出框的宽度
        });
        this.$store.state.roomInfo.inner_menu_pop_curBoxId = _id
      }
    },
    components: {
      CHAT_PRIVATE,
      CHAT_PUBLIC,
      USER_LIST,
      RANKING_HOT,
      RANKING_LIST,
      VOD_LIST,
      UserInfoCheck,
      LEAVE_RANK,
      JUDGE_LIST
      // UserInfos //用户信息
    }
  };
</script>