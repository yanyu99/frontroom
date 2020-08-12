<template>
  <div class="main-header" v-if=" parseInt(headHeight)" :style="{'background-color': $c('rgba(0,0,0,0.5)##头部颜色值透明度',__FILE__),'height':headHeight+'px'}">
    <div class="header-navbar" id="search">
      <img v-if="baseConfig.pagecfg.logo" class="main-logo" :src="baseConfig.pagecfg.logo" alt="logo">
      <div class="headnav" :class="{'navfloatright':headFlotRight}" :style="{'margin-right':(parseInt(headFlotRight)? headRightW :0)+ 'px'}">
        <common-nav :navMenuArr="innerMenus.filter(i=>i.pos ==1)" :classname=" 'room-nav-head'"></common-nav>
      </div>
      <!-- 右侧信息 -->
      <head-right></head-right>
    </div>
  </div>
</template>
<style scoped>
  .main-header {
    /* height: 50px; */
  }

  .main-logo {
    width: auto;
    height: 50px;
    float: left;
    margin-right: 10px;
    display: inline-block;
  }

  .header-navbar {
    display: flex;
    align-items: center;
    height: 100%;
  }

  .headnav {
    display: flex;
  }

  ul>li:first-child {
    border-left: solid #999 1px;
  }

  ul>li {
    font-size: 14px;
    float: left;
    line-height: 36px;
    height: 36px;
    margin-top: 7px;
    padding: 0 10px;
    position: relative;
    border-right: solid #999 1px;
    cursor: pointer;
  }

  ol,
  ul {
    margin-top: 0;
    margin-bottom: 0px;
  }

  .navfloatright {
    position: absolute;
    right: 0px;
    line-height: 50px;
    height: 50px;
  }

  .navfloatright ul li:first-child {
    border-left: 0 none;
  }

  .navfloatright ul li:last-child {
    border-right: 0 none;
  }
</style>
<script>
  import Vuex from "vuex"
  import * as types from '@/store/types'
  import CommonNav from "@/pc_views/_/util/CommonNav";
  import HeadRight from "@/pc_views/_/header/HeadRight"

  export default {
    data() {
      return {
        headRightW: 0,
        headHeight: $t('50##头部高度', __FILE__),
        headFlotRight: parseInt($t('0##头部菜单右浮动(默认：0，右浮动：1)', __FILE__))
      }
    },
    computed: {
      ...Vuex.mapGetters([types.innerMenus])
    },
    components: {
      CommonNav,
      HeadRight,
    },
    created() {
      var self = this;
      $(".header-right-menu").wait(function () {
        self.headRightW = $(".header-right-menu").width() + 30;
      })
    },
  }
</script>