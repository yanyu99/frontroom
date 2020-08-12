<template>
  <div class="menu-box" id="FORTUNE">
    <div class="guessbox">
      <div class="close-icon">
        <button i="close" class="ui-dialog-close" title="cancel"></button>
      </div>

      <div class="wheel-main">
        <!-- 中间抽奖按钮 -->
        <div class=" wheel-pointer-box" id="idChou">
          <div class="chou wheel-pointer" @click="chou" :style="{transform:rotate_angle_pointer,transition:rotate_transition_pointer}"></div>
        </div>

        <div class="bg" :style="{transform:rotate_angle,transition:rotate_transition}">
          <!-- 抽奖部分 -->
          <div class="yuan">
            <template v-for="(item,index) in roomInfo.lotteryInfo.lists">
              <div class="item" :key="index" :data-idx="item.prize_id" :data-name="item.prize_title" :data-show="item.show">
                <div class="gift ">
                  <img :src="item.prize_img" :title="item.prize_title" />
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>

      <!-- 滚动部分 -->
      <div class="roll-info-box">
        <ul>
          <li v-for="(val,index) in roomInfo.lotteryInfo.backList" :key="index" :class="{active: index == actvieIndex}">
            <font>{{ baseConfig.jf_hide_user? val.fixed_nick :val.nick}}</font>{{val.dsc}}
          </li>
        </ul>
      </div>

    </div>
    <div class="close-layer" @click="closeLayer"></div>
  </div>
</template>

<style scoped>
  .wheel-main {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: relative;
  }

  .wheel-pointer-box {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 100;
    -webkit-transform: translate(-50%, -60%);
    transform: translate(-50%, -60%);
    width: 120px;
    height: 147px
  }

  .wheel-pointer {
    width: 120px;
    height: 147px;
    background: url(/assets/img/fortune/img01.png) no-repeat center top;
    background-size: 95%;
    -webkit-transform-origin: center 60%;
    transform-origin: center 60%;
  }

  .guessbox {
    height: 660px;
  }

  .roll-info-box {
    height: 76px;
    line-height: 76px;
    margin-top: 10px;
    overflow: hidden;
    background: #d0310b;
  }

  .roll-info-box ul li {
    height: 76px;
    line-height: 76px;
    text-align: center;
    color: #fff;
    border-radius: 6px;
    background-color: #d0310b;
    font-size: 30px;
  }

  .notify .notify-main {
    background-color: none;
    border: 0px none;
  }

  .menu-box {
    padding: 15px 10px;
    /* width: 700px; */
    border-radius: 6px;
  }

  .menu-main .p-tit {
    display: inline-block;
    color: #fe9901;
    font-size: 20px;
    font-weight: 700;
    text-align: center;
    height: 50px;
    line-height: 50px;
    vertical-align: middle;
    border-bottom: 1px solid #fe9901;
    width: 100%;
  }


  .menu-contain ul {
    position: relative;
    overflow: hidden;
  }

  .menu-contain ul {}

  .menu-contain ul li {
    position: relative;
    float: left;
    box-sizing: border-box;
    text-align: center;
    margin: 0 auto;
    text-align: center;
    position: relative;
  }

  /* =====================公共部分 end==================*/

  .contain-ul li {
    padding: 10px;
    width: 25%;
  }

  .contain-ul li img {
    width: 58px;
    height: 58px;
    display: block;
    margin: 0 auto;
  }

  .contain-ul li label {
    font-size: 13px;
    text-align: center;
    display: inline-block;
    /* line-height: 21px; */
    width: 70px;
    height: 27px;
    line-height: 27px;
    vertical-align: middle;
    margin-top: 5px;
    background-color: #0099cc;
    border-radius: 4px;
    color: #fff;
  }

  /*========================之前样式=========================*/

  .right {
    float: left;
    margin-top: 116px;
    margin-left: 43px;
    height: 275px;
    overflow: hidden;
  }

  #idTable {
    width: 283px;
    color: #fff;
  }

  #idTable td {
    padding: 3px 2px;
  }

  .bg {
    width: 552px;
    height: 552px;
    overflow: hidden;
    margin: 0 auto;
  
  }

  .yuan {
    margin: 0 auto;
    width: 520px;
    height: 520px;
    border-radius: 520px;
    overflow: hidden;
    background-image: url("/assets/img/fortune/yuan.png");
    position: relative;
    /* float: left; */
    background-size: 100%;
    border: 16px solid #d0310b;
  }

  .gift {
    width: 136px;
    height: 134px;
    margin-top: 120px;
    margin-left: 38px;
    transform: rotate(-70deg);
    background-size: 106px 98px;
    background-repeat: no;
  }

  .item {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0px;
    left: 0px;
  }

  .item img {
    width: 116px;
    height: 114px;
  }

  .yuan .item:first-child {
    transform: rotate(90deg);
  }

  .yuan .item:nth-child(2) {
    transform: rotate(135deg);
  }

  .yuan .item:nth-child(3) {
    transform: rotate(180deg);
  }

  .yuan .item:nth-child(4) {
    transform: rotate(225deg);
  }

  .yuan .item:nth-child(5) {
    transform: rotate(270deg);
  }

  .yuan .item:nth-child(6) {
    transform: rotate(315deg);
  }

  .yuan .item:nth-child(7) {
    transform: rotate(360deg);
  }

  .yuan .item:nth-child(8) {
    transform: rotate(405deg);
  }

  .notitle-dialog-new .ui-dialog-close {
    top: 41px;
    right: -15px;
    position: absolute;
    opacity: 1;
    z-index: 5;
    display: block;
    color: rgba(0, 0, 0, 0);
    width: 36px;
    height: 36px;
    background: url(/assets/img/sprite.png) no-repeat;
  }

  .ui-dialog-close {
    position: relative;
    _position: absolute;
    float: right;
    top: 13px;
    right: 13px;
    _height: 26px;
    padding: 0 4px;
    font-size: 21px;
    font-weight: bold;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: 0.2;
    filter: alpha(opacity=20);
    cursor: pointer;
    background: transparent;
    _background: #fff;
    border: 0;
    -webkit-appearance: none;
  }

  /*================覆盖样式==================*/

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
    top: 5px;
    right: 5px;
    position: absolute;
    z-index: 99;
  }

  /* use cross as close button */

  .close-layer::before {
    content: "\2716";
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import fortuneMixin from "@/mixins/fortuneMixin"
  export default {
    mixins: [fortuneMixin],

    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id).css('top', '72%');
    },
    created() {
      $(".roll-info-box").wait(function () {
        setInterval(() => {
          $(".roll-info-box")
            .find("ul")
            .animate({
              marginTop: "-39px"
            }, 500, function () {
              $(this)
                .css({ marginTop: "0px" })
                .find("li:first")
                .appendTo(this);
            });
        }, 3000);
      });
    },

    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
      }
    }
  };
</script>