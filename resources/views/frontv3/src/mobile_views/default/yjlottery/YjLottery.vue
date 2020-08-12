<template>
  <div id="YjLottery">
    <div class="yj-box">
      <div class="yj-close" @click="closeLottery">
        <img src="/assets/img/yj/close.png" alt="">
      </div>
      <div id="yj-content">
        <wait-next v-if="roomInfo.yjInfo.yjStep == 2"></wait-next>
        <win-user v-if="roomInfo.yjInfo.yjStep ==3 "></win-user>
        <yj-start v-if="roomInfo.yjInfo.yjStep ==1"></yj-start>
        <yj-end v-if="roomInfo.yjInfo.yjStep ==0"></yj-end>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .yj-box {
    width: 600px;
    height: 532px;
    background: url(/assets/img/yj/bg1.png) center center no-repeat;
    background-size: contain;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    z-index: 1000;
  }

  .yj-close {
    width: 30px;
    height: 30px;
    position: absolute;
    top: 43px;
    right: 50px;
    cursor: pointer;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import WaitNext from "@/mobile_views/_/yjlottery/WaitNext";
  import WinUser from "@/mobile_views/_/yjlottery/WinUser";
  import YjStart from "@/mobile_views/_/yjlottery/YjStart";
  import YjEnd from "@/mobile_views/_/yjlottery/YjEnd";

  export default {
    data() {
      return {};
    },
    created() {
      this.$store.dispatch(types.LOAD_YJLOTTERY);
    },
    components: {
      WaitNext,
      WinUser,
      YjStart,
      YjEnd
    },
    methods: {
      closeLottery() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_pop_curBoxId: "",
        });
      }
    }
  };
</script>