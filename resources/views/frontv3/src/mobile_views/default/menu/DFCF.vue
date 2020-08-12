<template>
  <div class="menu-box" id="DFCF">
    <div class="menu-main">
      <div class="menu-contain" v-if="userInfo.role.f_cjrl">
        <p>暂未开放,敬请期待！</p>
        <!-- <iframe src="http://wap.eastmoney.com/iphone/default.shtml" scrolling='no'></iframe> -->
      </div>
      <div class="menu-contain" v-else>
        <comm-qq :qqData="baseConfig.roomqqs" qqts="当前无权限，请联系相关人员"></comm-qq>
      </div>
    </div>
  </div>
</template>


<style scoped>
  .menu-box {
    padding: 15px 10px;
    border-radius: 6px;
    background: #fff;
    overflow: hidden;
  }

  .menu-contain p {
    display: inline-block;
    color: #fe9901;
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    height: 100px;
    line-height: 100px;
    vertical-align: middle;
    /* border-bottom: 1px solid #e6e6e6; */
    width: 100%;
  }

  .menu-contain {
    height: 460px;
    overflow: hidden;
  }

  .menu-contain iframe {
    /* overflow: hidden; */
    /* height: 100%;
    width: 100%; */
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/mobile_views/_/menu/CommQq";
  export default {
    mounted() {
      var self = this
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $(".vl-notify-mask").click(function () {
        self.$store.state.roomInfo.inner_menu_pop_curBoxId = "";
        self.$layer.close(self.roomInfo.inner_menu_pop_curBoxId);
      })
    },
    components: {
      CommQq
    }
  };
</script>