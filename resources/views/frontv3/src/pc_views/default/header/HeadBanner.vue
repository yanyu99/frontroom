<template>
  <div class="pc-banner" v-if="parseInt(bannerHeight)" :style="{'height':bannerHeight+'px'}">
    <div class="swiper-container swiper-container-ad swiper-container-horizontal swiper-container-wp8-horizontal">
      <div class="swiper-wrapper">
        <template v-for="(item,index) in baseConfig.popcfg.pc_banner_cfg" style="width: 100%;" v-show="curpicInd == index">
          <div class="swiper-slide" style="text-align:center" :key="index">
            <img :src="item" class="swiper-lazy" style="width: 100%;height: 100%" />
          </div>
        </template>
      </div>
      <div v-if="baseConfig.popcfg.pc_banner_cfg && baseConfig.popcfg.pc_banner_cfg.length>1" class="swiper-pagination swiper-pagination-ad swiper-pagination-bullets" id="swiper-pagination-id"></div>
    </div>
    <div class="head-banner-right-wrap">
      <head-right></head-right>
    </div>
  </div>

</template>
<style scoped>
  .head-banner-right-wrap {
    position: fixed;
    top: 0px;
    right: 0px;
    height: 50px;
    z-index: 999;
    min-width: 400px;
    width: auto;
  }

  .head-banner-right-wrap .header-right-menu {
    height: 50px;
    background: rgba(0, 0, 0, .2);
  }

  .pc-banner {
    position: relative;
  }

  .swiper-container {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
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

  .swiper-slide a {
    display: block;
    width: 100%;
    height: 100%;
  }

  .swiper-slide img {
    width: 100%;
    background-size: 100%;
  }
</style>
<script>
  import Vuex from "vuex"
  import * as types from "@/store/types"
  import HeadRight from "@/pc_views/_/header/HeadRight"
  export default {
    data() {
      return {
        curpicInd: 0,
        bannerHeight: $t('0##头部banner的高度', __FILE__)
      }
    },
    mounted() {
      this.baseConfig.popcfg.pc_banner_cfg.length > 1 && this.activeSwiperAd();
    },
    methods: {
      activeSwiperAd() {
        var swiper = new Swiper(".swiper-container-ad", {
          slidesPerView: 1,
          spaceBetween: 0,
          loop: true,
          autoplay: {
            delay: 6 * 1000,
            disableOnInteraction: false
          }
        });
      }
    },
    components: {
      HeadRight
    },
  }
</script>