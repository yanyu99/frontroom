<template>
  <div class="menu-box" id="NEWS" style=" height:300px;">
    <template v-if="!userInfo.role.f_cjrl">
      <comm-qq :qqData="baseConfig.roomqqs" qqts="当前无权限，请联系相关人员"></comm-qq>
    </template>
    <template v-else>
      <iframe src="https://m.wallstreetcn.com/markets" scrolling='no'></iframe>
    </template>
  </div>
</template>
<style scoped>
  .menu-box {
    padding: 15px 10px;
    border-radius: 6px;
    background: #fff;
  }

  .menu-contain {
    -webkit-overflow-scrolling: touch;
    overflow-y: scroll;
  }

  .menu-contain iframe {
    height: 100%;
    width: 100%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/mobile_views/_/menu/CommQq";
  export default {
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id + " .notify .notify-main").css('top', '72%')
    },
    components: {
      CommQq
    }
  };
</script>