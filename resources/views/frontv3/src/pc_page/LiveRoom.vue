<template>
  <div class="page-viewer">
    <another-content v-show="userInfo.logined &&  userInfo.anotherContent"></another-content>
    <head-banner v-if="baseConfig.popcfg.pc_banner_cfg.length"></head-banner>
    <div class="page-container" id="main" :style="{backgroundImage:baseConfig.theme.backgroundImg ?'url('+baseConfig.theme.backgroundImg +')' :(baseConfig.roombgs[0] ? 'url('+baseConfig.roombgs[0].imgurl +')' : '')  }">
      <dan-mu></dan-mu>
      <head-main></head-main>
      <div class="page-part-body bor-right bor-bottom">
        <left-block :style="{'order':baseConfig.theme.leftblock =='right' ? 1:0}"></left-block>
        <div class="page-body">
          <div class="page-body-main">
            <side-main :style="{'order':baseConfig.theme.layoutsider=='layout-sider-right' ? 1:0}"></side-main>
            <user-list-left v-if="innerMenus.filter(i=>i.pos==4 && i.type==4200).length" v-show="roomInfo.is_show_left_userlist"></user-list-left>
            <div class="main-content">
              <video-block :style="{width:baseConfig.pgsizecfg.video_w+'%','order':baseConfig.theme.layout=='layout-video-right' ? 1:0}"></video-block>
              <chat-block :style="{width: (100 - baseConfig.pgsizecfg.video_w)+'%'}"></chat-block>
            </div>
          </div>
          <bottom-pannel></bottom-pannel>
        </div>
      </div>
    </div>
    <user-card v-show="roomInfo.selectUser.uid "></user-card>
    <pri-chat v-show="roomInfo.is_show_pri_box"></pri-chat>
  </div>
</template>
<style scoped>
  .page-viewer {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    min-height: 100vh;
    height: 100vh;
    width: 100vw;
  }

  .page-container {
    /* overflow: hidden; */
    background-repeat: no-repeat;
    background-size: cover;
    color: #fff;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex: 1;
    flex-direction: column;
    flex-wrap: nowrap;
  }

  .page-part-body {
    overflow: hidden;
    display: flex;
    flex: 1;
    flex-direction: row;
    flex-wrap: nowrap;
  }

  .vl-notify .vl-notify-content {
    padding: 0px;
  }

  .page-body {
    margin-top: 3px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .page-body-main {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex: 1;
  }

  .main-content {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex: 1;
    height: 100%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import pageloadMixin from "@/mixins/pageloadMixin";
  import AnotherContent from "@/pc_views/_/AnotherContent";
  import HeadMain from "@/pc_views/_/header/HeadMain";
  import SideMain from "@/pc_views/_/side/SideMain";
  import UserCard from "@/pc_views/_/side/UserCard";
  import PriChat from "@/pc_views/_/side/PRICHAT";
  import HeadBanner from "@/pc_views/_/header/HeadBanner";
  import UserListLeft from "@/pc_views/_/side/UserListLeft"
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import DanMu from "@/pc_views/_/DanMu";
  import BottomPannel from "@/pc_views/_/BottomPannel";
  import VideoBlock from "@/pc_views/_/VideoBlock";
  import ChatBlock from "@/pc_views/_/ChatBlock";
  import LeftBlock from "@/pc_views/_/LeftBlock";

  export default {
    mixins: [pageloadMixin, layercommMixinPc],
    mounted() {
      this.$watch("baseConfig.pagecfg.title", function (newVal, oldVal) {
        window.document.title = newVal;
      });
      this.$watch("baseConfig.pagecfg.description", function (newVal, oldVal) {
        $(".web-des").attr('content', newVal);
      });
      this.$watch("baseConfig.pagecfg.keywords", function (newVal, oldVal) {
        $(".web-kword").attr('content', newVal);
      });
      this.$watch("baseConfig.pagecfg.icon", function (newVal, oldVal) {
        $(".web-icon").attr('href', newVal);
      });
      //是否开启弹出广告
      if (
        this.baseConfig.popcfg.pop_img &&
        (this.baseConfig.logincfg.pop_ad == 1 ||
          (this.baseConfig.logincfg.pop_ad == 2 && !userInfo.logined))
      ) {
        this.popShow("POPAD");
      }
      if (this.baseConfig.containFortune && this.baseConfig.popUpFortune) {
        this.popShow("FORTUNE");
      }
    },
    computed: {
      ...Vuex.mapGetters([types.innerMenus]),
    },
    components: {
      AnotherContent,
      HeadMain,
      SideMain,
      UserCard,
      HeadBanner,
      PriChat,
      UserListLeft,
      DanMu,
      BottomPannel,
      VideoBlock,
      ChatBlock,
      LeftBlock
    }
  };
</script>