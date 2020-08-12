<template>
  <div class="menu-box" id="PICROLL">
    <div class="menu-main">
      <div class="boxsli">
        <div class="swiper-container swiper-container-horizontal swiper-container-wp8-horizontal">
          <div class="swiper-wrapper">
            <div class="swiper-slide" v-for="(item,index) in args.imgurls" :key="item" style="overflow-y: scroll;">
              <img :src="item">
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
    padding: 15px 10px;
    width: 700px;
    border-radius: 6px;
    background: #fff;
  }

  .boxsli {
    position: relative;
    width: 100%;
    height: 300px;
    border: 1px solid #eee;
  }

  .menu-main {
    position: relative;
    height: 100%;
    text-align: center;
  }

  .swiper-container {
    text-align: center;
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
    -ms-flex-align: flex-start;
    -webkit-align-items: flex-start;
    align-items: flex-start;
  }

  .swiper-slide img {
    width: 100%;
    background-size: 100%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    props: ['args'],
    data() {
      return {
        curpicInd: 0,
        timer: false, //可以执行
      };
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id + " .notify .notify-main").css('top', '70%')

      $(".boxsli").wait(function () {
        var swiper = new Swiper('.swiper-container', {
          slidesPerView: 1,
          spaceBetween: 30,
          loop: true,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
      })
    },
    methods: {
      styBanner() {
        return {
          width: _px(200) + "px",
          heigth: _px(100) + "px",
          position: "relative"
        };
      },
    },

  };
</script>