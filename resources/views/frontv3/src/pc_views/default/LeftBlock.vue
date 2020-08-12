<template>
  <div class="sider-menu-content bor-left bor-top" v-show="leftNavArr.length" :style="{'width':leftWidth+'px'}">
    <common-nav :navMenuArr="leftNavArr" :classname=" 'room-nav-left'" :leftwidth="leftWidth"></common-nav>
  </div>
</template>

<style scoped>
  .sider-menu-content {
    text-align: center;
    display: flex;
  }

  .sider-menu-content ul {
    width: 100%;
    height: 100%;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .sider-menu-content ul li {
    border-bottom: 1px solid #999;
    padding-bottom: 5px;
    cursor: pointer;
  }

  .sider-menu-content ul li img {
    width: 48px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommonNav from "@/pc_views/_/util/CommonNav";
  export default {
    data() {
      return {
        leftNavArr: [],
        leftWidth: $t('63##左侧栏的宽度', __FILE__)
      }
    },
    computed: {
      ...Vuex.mapGetters([types.innerMenus])
    },
    mounted() {
      this.leftNavArr = this.innerMenus.filter(i => i.pos == 4);
    },
    components: {
      CommonNav
    }

  }
</script>