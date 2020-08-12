<template>
  <div class="menu-box" id="POPAD">
    <div class="menu-main">
      <div class="boxsli">
        <div class="swiper-container ">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img :src="baseConfig.popcfg.pop_img" width="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>
<style scoped>
  .boxsli {
    position: relative;
    width: 100%;
  }

  .menu-main {
    position: relative;
  }

  .swiper-container {}

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
    width: auto;
  }

  .notify .notify-main {
    /* min-height: 100px !important; */
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    methods: {
      closeLayer() {
        var _tmpid = $("#POPAD").parents(".vl-notify").attr("id");
        this.$layer.close(_tmpid || this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>