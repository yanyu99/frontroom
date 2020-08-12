<template>
  <div class="menu-box" id="POPAD" v-if="baseConfig.popcfg.mobile_pop_img">
    <div class="menu-main">
      <div class="boxsli">
        <div class="swiper-container swiper-container-horizontal swiper-container-wp8-horizontal">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img :src="baseConfig.popcfg.mobile_pop_img">
            </div>
          </div>

          <div class="swiper-pagination swiper-pagination-bullets"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    background: #fff;
  }

  .boxsli {
    position: relative;
    width: 100%;
  }

  .menu-main {
    position: relative;
    height: 100%;
  }

  .swiper-container {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .swiper-slide img {
    width:auto;
    max-width: 100%;
    background-size: 100%;
    max-height:560px;
  }

  .notify .notify-main {
    min-height: 100px !important;
  }
</style>
<style>
  .popboxClass {
    top: 70% !important;
    width:auto !important;
    min-height: auto !important;
    border: 0px !important;
    box-shadow: 0px 0px 0px  !important; 
    background-color: transparent !important;
  }

  .popbgborder {
    background-color: transparent !important;
    border: 0 none !important;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id + " .notify .notify-main").addClass('popboxClass popbgborder');
    },
  };
</script>