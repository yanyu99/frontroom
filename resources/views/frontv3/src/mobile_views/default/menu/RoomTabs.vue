<template>
  <div class="menu-box" id="RoomTabs">
    <div id="root" class="root">
      <menu class="menu_tab list" id="list_teacher">
        <!-- @click="chageTab(index,item)" -->
        <a v-for="(item,index) in baseConfig.roomtabs" :key="item.id" :id="item.id" :class="{'active':indexShow ==index}" :data-type="item.type_id">
          {{item.title}}
        </a>
      </menu>
    </div>

    <div class="tab-con " v-for="(item,index) in baseConfig.roomtabs" :key="item.id" v-if="indexShow == index">
      <template v-if="item.type_id == 2">
        <div :class="['boxsli','boxsli'+index]">
          <div :class="['swiper-container','swiper-container-horizontal','swiper-container-wp8-horizontal','swiper-container'+index]">
            <div :class="['swiper-wrapper','swiper-wrapper'+index]">
              <div class="swiper-slide" v-for="(itv,ind) in JSON.parse(item.tab_text) " :key="ind" style="overflow-y: scroll;">
                <img :src="itv">
              </div>
            </div>
            <div :class="['swiper-pagination','swiper-pagination-bullets','swiper-pagination'+index]"></div>
          </div>
        </div>
      </template>
      <template v-else>
        <div class="art-con" v-html="item.tab_text">
        </div>
      </template>

    </div>

  </div>
</template>

<style scoped>
  .art-con {
    height: 300px;
    overflow: scroll;
    width: 100%;
  }

  .tab-con {
    margin-top: 10px;
    width: 100%;
  }

  .menu-box {
    padding: 15px 10px;
    /* width: 98%; */
    border-radius: 6px;
    background: #fff;
    display: flex;
    flex: 1;
    flex-direction: column;
  }

  .menu_tab {
    /* height: 70px;
    line-height: 70px; */
    padding: 0px 10px;
    /* border-bottom: 1px solid #fe9901; */
  }

  .menu_tab a {
    font-size: 28px;
    font-weight: bold;
    display: inline-block;
    padding: 0px 8px;
  }

  a.active {
    color: #fff;
    background: #fe9901;
  }

  a,
  a:active,
  a:hover {
    text-decoration: none;
  }

  .active {
    color: #fff;
    background: #fe9901;
  }

  /*=============滑动===*/

  #root {
    height: 70px;
    width: 700px;
    white-space: nowrap;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    white-space: nowrap;
    position: relative;
    border-bottom: 1px solid #fe9901;
  }

  .root:before {
    display: block;
    content: "";
    width: 20px;
    height: 100%;
    position: absolute;
    top: 0;
  }

  .list {
    position: absolute;
    left: 0;
    top: 0;
    /*width: 100%;*/
    /*不能为100%，不然宽度只有父容器的宽度*/
    transition: all 1s;
    /* height: 100%; */
    line-height: 2.5;
  }

  .list li {
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
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
    data() {
      return {
        indexShow: 0,
      };
    },

    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id + " .notify .notify-main").css('top', '70%')

      this.scrollRoll();
      var self = this;
      $("#root").wait(function () {
        var slide = new Slide();
        $('#list_teacher a').on('click', function () {
          self.indexShow = $(this).index();
          var _type = $(this).data('type');
          $("#root menu").width() > 350 && slide.changeActive($(this).index());
          setTimeout(() => {
            _type == 2 && self.scrollRoll();
          }, 1000)
        });
      });
    },

    methods: {
      scrollRoll() {
        var tempArr = this.baseConfig.roomtabs;
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
      }

    }
  };
</script>