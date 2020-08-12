<template>
  <div class="mobile-room">
    <video-player></video-player>
    <dan-mu></dan-mu>
    <gift-display v-if="baseConfig.eventcfg.gift_opend"></gift-display>
    <main-content></main-content>
    <another-content v-show="userInfo.logined && userInfo.anotherContent"></another-content>
    <more-menu v-show="roomInfo.inner_menu_isshow"></more-menu>
    <video-timeout-bar v-if="!userInfo.logined && parseInt(baseConfig.logincfg.login_pop)"></video-timeout-bar>
  </div>
</template>

<style scoped>
  .mobile-room {
    background-color: grey;
    height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: column;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import dmsReconnect from "@/store/dms_reconnect";

  import pageloadMixin from "@/mixins/pageloadMixin";

  import VideoPlayer from "@/mobile_views/_/VideoPlayer";
  import MainContent from "@/mobile_views/_/MainContent";
  import AnotherContent from "@/mobile_views/_/AnotherContent";

  import GiftDisplay from "@/mobile_views/_/gift/GiftDisplay";
  import MoreMenu from "@/mobile_views/_/menu/MoreMenu";
  import VideoTimeoutBar from "@/mobile_views/_/coupon/VideoTimeoutBar";

  import POPAD from "@/mobile_views/_/menu/POPAD";
  import FORTUNE from "@/mobile_views/_/menu/FORTUNE";
  import DanMu from "@/mobile_views/_/DanMu";

  export default {
    data() {
      return {
        lifeTimer: null
      };
    },
    mixins: [pageloadMixin],
    mounted() {
      this.$watch('baseConfig.pagecfg.title', function (newVal, oldVal) {
        window.document.title = newVal;
      });
      this.$watch("baseConfig.pagecfg.description", function (newVal, oldVal) {
        $(".web-des").attr('content', newVal);
      });
      this.$watch("baseConfig.pagecfg.keywords", function (newVal, oldVal) {
        $(".web-kword").attr('content', newVal);
      });

      //是否开启弹出广告
      if (
        this.baseConfig.popcfg.mobile_pop_img &&
        (this.baseConfig.logincfg.mobile_pop_ad == 1 ||
          (baseConfig.logincfg.mobile_pop_ad == 2 && !userInfo.logined))
      ) {
        this.pageHandle(POPAD);
      }
      if (this.baseConfig.containFortune && this.baseConfig.popUpFortune) {
        this.$store.dispatch(types.LOAD_FORTUNEINFO);
        this.pageHandle(FORTUNE);
      }
    },
    methods: {
      pageHandle(item) {
        // this.$store.commit(types.UPDATE_ROOM_INFO, {
        //   active_inner_menu: item //当前活动的菜单
        // });
        //以组件的 弹出
        let _id = this.$layer.iframe({
          content: {
            content: item,
            parent: this,
            data: {}
          },
          area: ["95%"] //弹出框的宽度
        });

        $("#" + _id).addClass("bgborder");
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_pop_curBoxId: _id
        });
      }
    },
    components: {
      VideoPlayer,
      MainContent,
      AnotherContent,
      GiftDisplay,
      MoreMenu,
      VideoTimeoutBar,
      DanMu
    }
  };
</script>