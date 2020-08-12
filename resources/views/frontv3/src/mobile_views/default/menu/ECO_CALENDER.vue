<template>
  <div class="menu-box" id="ECO_CALENDER">
    <div class="menu-main">
      <span>
        <p class="p-tit">财经日历</p>
      </span>
      <div class="menu-contain" v-if="userInfo.role.f_cjrl">
        <iframe src="https://www.jin10.com/example/jin10.com.html">
        </iframe>
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
    overflow: scroll;
    background: #fff;
  }
  .menu-main .p-tit {
    display: inline-block;
    color: #fe9901;
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    height: 100px;
    line-height: 100px;
    vertical-align: middle;
    border-bottom: 1px solid #e6e6e6;
    width: 100%;
  }
  .menu-contain {
    height: 460px;
    -webkit-overflow-scrolling: touch;
    overflow-y: scroll;
  }

  .menu-contain iframe {
    height: 100%;
    width: 100%;
  }
  .menu-contain ul {
    position: relative;
    overflow: hidden;
  }
  .menu-contain ul li {
    position: relative;
    float: left;
    box-sizing: border-box;
    text-align: center;
    margin: 5px auto;
    text-align: center;
  }

  .contain-ul-chat li {
    padding: 10px;
    width: 25%;
  }

  .contain-ul-chat li img {
    width: 116px;
    height: 116px;
    display: block;
    margin: 0 auto;
  }

  .contain-ul-chat li label {
    font-size: 28px;
    text-align: center;
    display: inline-block;
    /* line-height: 21px; */
    width: 140px;
    height: 54px;
    line-height: 54px;
    vertical-align: middle;
    margin-top: 5px;
    background-color: #0099cc;
    border-radius: 6px;
    color: #fff;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/mobile_views/_/menu/CommQq";
  export default {
    components: {
      CommQq
    }
  };
</script>