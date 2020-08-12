<template>
  <div class="menu-box" id="PICROLL">
    <div class="menu-main">
      <div class="boxsli" :style="{width:args.width+'px',height:args.height+'px'}">
        <div class="swiper-container-warps swiper-container swiper-container-horizontal swiper-container-wp8-horizontal">
          <div class="swiper-wrapper">
            <div class="swiper-slide" v-for="item in args.imgurls" :key="item">
              <img :src="item" style="width:100%;height:100%">
            </div>
          </div>

          <div v-if="args.imgurls && args.imgurls.length>1" class="swiper-pagination swiper-pagination-bullets"></div>
        </div>
      </div>
    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    border-radius: 6px;
  }

  .boxsli {
    position: relative;
    width: 100%;
    height: 300px;
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

  .swiper-slide img {
    width: 100%;
    background-size: 100%;
  }

  .swiper-container-warps {
    overflow: hidden;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    props: ["args"],
    data() {
      return {
        curpicInd: 0,
        timer: false //可以执行
      };
    },
    mounted() {
      // 根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id; //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style')

      var _speed = 10 * 1000;

      $(".boxsli").wait(function () {
        var swiper = new Swiper(".swiper-container-warps", {
          slidesPerView: 1,
          spaceBetween: 0,
          loop: true,

          pagination: {
            el: ".swiper-pagination",
            clickable: true
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
          },
          autoplay: {
            delay: _speed,
            disableOnInteraction: false
          }

        });
      });
    },
    created() {
      this.autoChange()
    },
    methods: {
      styBanner() {
        return {
          width: _px(200) + "px",
          heigth: _px(100) + "px",
          position: "relative"
        };
      },
      autoChange() {
        var _roleTime = 10; //  TODO this.baseConfig.sysConfig.module_banner_interval
        var max = this.args.imgurls;
        setInterval(() => {
          this.curpicInd = (this.curpicInd + 1) % max;
          console.log(max + "===" + this.curpicInd);
        }, (_roleTime >= 1 ? _roleTime : 10) * 1000);
      },
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>