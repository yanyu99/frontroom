<template>
  <div class="menu-box">
    <div class="menu-main">
      <p class="p-tisi" v-if="qqts">{{qqts}}</p>
      <div class="menu-contain nice-scroll-h" v-if="qqData.length >0">
        <ul class="contain-ul nice-scroll-h">
          <li v-for="(item,ind) in qqData" :key="item.id">
            <a v-if="item.which == 2" @click="showWeChat(ind)" :key="item.id" @mouseenter="showWeChat(ind)" @mouseleave="showWeChat(-1)">
              <img class="icon-img1" :src="item.imgurl ? item.imgurl : '/assets/img/wechat.png'" :title="item.qq" />
              <img class="icon-img2" src="/assets/img/qqs/wxjt.png" :title="item.qq" />
              <p>{{item.name}}</p>
              <div class="wx_qr_img" style="text-align: center;" v-show="curInd == ind" @mouseenter="showWeChat(ind)">
                <img :src="item.qr_img" />
              </div>
            </a>
            <a v-else @click="linkTo(item)" target="_blank">
              <img class="icon-img1" :src="item.imgurl ? item.imgurl : '/assets/img/qqs/default.png'" :title="item.qq" />
              <img class="icon-img2" src="/assets/img/qqs/qqjt.png" :title="item.qq" />
              <p>{{item.name}}</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    background-color: #fff;
    border-radius: 6px;
    position: relative;
    width: 600px;
  }

  .menu-main {
    height: 500px;
    overflow: hidden;
  }

  .menu-contain {
    height: 450px;
    overflow-y: scroll;
  }

  .menu-contain::-webkit-scrollbar {
    display: none
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
  }

  .contain-ul li {
    padding: 10px;
    width: 25%;
  }

  .icon-img1{
    width: 76px;
    height: 76px;
    display: block;
    margin: 0 auto;
  }

  .icon-img2 {
    width: 74px;
    height: 22px;
    display: block;
    margin: 5px auto;
  }

  .wx_qr_img {
    width: 120px;
  }

  .contain-ul li .wx_qr_img img {
    width: 120px;
  }

  .contain-ul li p {
    font-size: 16px;
    text-align: center;
    display: inline-block;
    width: 70px;
    height: 26px;
    line-height: 13px;
    vertical-align: middle;
    color: #000;
    word-wrap: break-word;
  }

  .p-tisi {
    font-size: 16px;
    line-height: 25px;
    color: #333333;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        curInd: -1,
      }
    },
    props: ["qqData", "qqts"],
    methods: {
      linkTo(item) {
        var url = 'http://wpa.qq.com/msgrd?v=3&uin=' + item.qq + '&site=qq&menu=yes';
        window.open(url);
      },
      showWeChat(ind) {
        this.curInd = this.curInd == ind ? -1 : ind
      }
    },
  };
</script>