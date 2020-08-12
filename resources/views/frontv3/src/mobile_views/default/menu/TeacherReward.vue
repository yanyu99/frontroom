<template>
  <div class="menu-box" id="TeacherReward">
    <div class="menu-main">
      <div class="menu-contain">
        <p class="p-tit">打赏</p>
        <ul class="contain-ul">
          <li v-for="item in roomInfo.hotRank.teacherList" :key="item.tid" @click.stop="linkTo(item)">
            <span>
              <img :src="item.imgurl ? item.imgurl :'/assets/img/head.png'" />
              <img class="icon-img2" src="/assets/img/reward-btn.png" />
              <label>{{item.name}}</label>
            </span>
            <span class="wx-img" v-show="curId == item.tid ">
              <img :art="zfb" v-if="item.reward_img_zfb" :src="item.reward_img_zfb " />
              <img :art="wx" v-if="item.reward_img_wx" :src="item.reward_img_wx " />
              <img :art="no" v-if="!item.reward_img_wx.length && !item.reward_img_zfb" :src=" '/assets/img/no-code.png'" />
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<style scoped>
  /* =====================公共部分 start==================*/

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

  .wx-img {
    position: absolute;
    left: 15px;
    top: 4px;
    z-index: 999;
  }

  .contain-ul li .wx-img img {
    width: 200px;
    height: auto;
  }

  .menu-main {
    height: 500px;
    overflow: auto;
  }

  .menu-contain p {
    font-size: 28px;
    font-weight: bold;
    line-height: 60px;
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
    margin: 5px auto;
    overflow: visible;
    height: 280px;
  }

  .contain-ul li {
    padding: 10px;
    width: 33%;
  }

  .contain-ul li img {
    width: 116px;
    height: 116px;
    display: block;
    margin: 0 auto;
  }

  .contain-ul li label {
    font-size: 26px;
    text-align: center;
    display: inline-block;
    width: 140px;
    height: 50px;
    line-height: 50px;
    vertical-align: middle;
    margin-top: 5px;
    color: #000;
  }

  .contain-ul li img.icon-img2 {
    margin-top: 2px;
    width: 116px;
    height: 46px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        curId: 0,
      }
    },
    created() {
      this.$store.dispatch(types.LOAD_RANKING_HOT)
    },
    methods: {
      linkTo(item) {
        this.curId = this.curId ? 0 : item.tid;
      },
    }
  };
</script>