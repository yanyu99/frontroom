<template>
  <div class="menu-box" id="QQHELPER">
    <div class="menu-main">
      <p class="p-tit">QQ助理</p>
      <comm-qq :qqData="baseConfig.roomqqs" qqts=''></comm-qq>
    </div>
    <div class="close-layer" @click="closeLayer"></div>
  </div>
</template>
<style scoped>
  .menu-box {
    padding: 15px 10px;
    background-color: #fff;
    border-radius: 6px;
    position: relative;
  }

  .close-layer {
    background: red;
    color: #fff !important;
    border-radius: 40px;
    line-height: 40px;
    text-align: center;
    height: 40px;
    width: 40px;
    font-size: 28px;
    padding: 1px;
    top: 0px;
    right: 0px;
    position: absolute;
    z-index: 99;
  }

  /* use cross as close button */

  .close-layer::before {
    content: "\2716";
  }

  .menu-main {
    height: 500px;
    overflow: auto;
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
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/mobile_views/_/menu/CommQq";
  export default {
    data() {
      return {
        toUrl: ''
      }
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id + " .notify .notify-main").css('top', '70%')
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
      }
    },
    components: {
      CommQq
    }
  };
</script>