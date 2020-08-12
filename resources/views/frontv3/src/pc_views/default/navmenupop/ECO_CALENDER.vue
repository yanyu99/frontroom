<template>
  <div class="menu-box" id="ECO_CALENDER">
    <div class="menu-main" v-if="userInfo.role.f_cjrl">
      <span>
        <p class="p-tit">财经日历</p>
      </span>
      <div class="menu-contain nice-scroll-h">
        <iframe src="https://www.jin10.com/example/jin10.com.html">
        </iframe>
      </div>
    </div>
    <div v-else>
      <comm-qq :qqData="baseConfig.roomqqs" qqts="当前无权限，请联系相关人员"></comm-qq>
    </div>


  </div>
</template>

<style scoped>
  .menu-box {
    width: 600px;
    border-radius: 6px;
  }


  .menu-main .p-tit {
    display: inline-block;
    color: #fe9901;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    height: 50px;
    line-height: 50px;
    vertical-align: middle;
    border-bottom: 1px solid #e6e6e6;
    width: 100%;
  }

  .menu-contain {
    height: 460px;
    -webkit-overflow-scrolling: touch;
  }

  .menu-contain iframe {
    height: 100%;
    width: 100%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/pc_views/_/util/CommQq"

  export default {
    components: {
      CommQq
    }
  };
</script>