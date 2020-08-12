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
              <div class="item" :key="index" :data-id="item.prize_id">
                <div class="gift ">
                  <img :src="item.prize_img" :title="item.prize_title" />
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
      <!-- 滚动部分 -->
      <div class="right">
        <marquee scrollamount="2" direction="up">
          <div class="roll-info">
            <div class="roll-info-box">
              <ul>
                <li v-for="(val,index) in roomInfo.lotteryInfo.backList" :key="index" :class="{active: index == actvieIndex}">
                  <font>{{ baseConfig.jf_hide_user? val.fixed_nick :val.nick}}</font>{{val.dsc}}
                </li>
              </ul>
            </div>
          </div>
        </marquee>

      </div>
    </div>
    <div class="close-layer" @click="closeLayer"></div>
  </div>
</template>
<style scoped>
  .wheel-main {
    position: relative;
    float: left;
  }

  .wheel-pointer-box {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 100;
    -webkit-transform: translate(-50%, -60%);
    transform: translate(-50%, -60%);
    width: 134px;
    height: 171px;
  }

  .wheel-pointer {
    width: 134px;
    height: 171px;
    background: url(/assets/img/fortune/img01.png) no-repeat center top;
    background-size: 95%;
    -webkit-transform-origin: center 60%;
    transform-origin: center 60%;
    cursor: pointer;
    z-index: 1000;
  }

  .roll-info {
    height: 268px;
  }

  .roll-info-box {
    /* height: 300px; */
    margin-top: 10px;
    /* overflow: hidden; */
  }

  .roll-info-box ul li {
    height: 38px;
    line-height: 38px;
    text-align: center;
    color: #fff;
    border-radius: 6px;
    font-size: 16px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .notify .notify-main {
    background-color: none;
    border: 0px none;
  }

  .menu-box {
    width: 800px;
    height: 479px;
    background-repeat: no-repeat;
    background-image: url(/assets/img/fortune/bg2.png);
    overflow: hidden;
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
    float: right;
    margin-top: 120px;
    margin-left: 23px;
    height: 275px;
    overflow: hidden;
    width: 280px;
  }

  #idTable {
    width: 283px;
    color: #fff;
  }

  #idTable td {
    padding: 3px 2px;
  }

  .bg {
    width: 478px;
    height: 478px;
    overflow: hidden;
    margin: 0 auto;
    float: left;
  }

  .yuan {
    width: 478px;
    height: 478px;
    border-radius: 478px;
    overflow: hidden;
    background-image: url(/assets/img/fortune/yuan.png);
    position: relative;
    border: 13px solid #d0310b;
  }

  .gift {
    width: 140px;
    height: 138px;
    margin-top: 79px;
    margin-left: 45px;
    -webkit-transform: rotate(-70deg);
    transform: rotate(-70deg);
    background-size: 136px 134px;
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
    width: 78px;
    height: 76px;
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
    background: #E0110B;
    color: #fff !important;
    border-radius: 32px;
    line-height: 25px;
    text-align: center;
    height: 32px;
    width: 32px;
    font-size: 20px;
    padding: 1px;
    top: 44px;
    right: -14px;
    position: absolute;
    z-index: 99;
    border: 2px solid #fff;
    cursor: pointer;
  }

  .close-layer::before {
    content: "\2716";
  }

  .right ul li {
    color: #fff;
  }
</style>
<style>
  .bgborder {
    box-shadow: 0 0 0 rgba(0, 0, 0, 0) !important;
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
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style');
      $("#" + id + " .vl-notify.vl-notify-main").addClass("bgborder");
    },

    methods: {
      closeLayer() {
        var _tmpid = $("#FORTUNE").parents(".vl-notify").attr("id");
        this.$layer.close(_tmpid || this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>