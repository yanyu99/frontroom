<template>
  <div class="menu-main">
    <div class="menu-contain">
      <p v-if="qqts">{{qqts}}</p>
      <ul class="contain-ul">
        <li v-for="item in qqData" :key="item.id" @click.stop="linkTo(item)">
          <span>
            <img :src="item.imgurl ? item.imgurl : (item.which == 2? '/assets/img/wechat.png' :'/assets/v3/images/phone/icon_qq.png')" :title="item.qq" />
            <label>{{item.name}}</label>
          </span>
          <span class="wx-img" v-if="item.which == 2" v-show="curId ==item.id ">
            <img v-if="item.qr_img" :src="item.qr_img" @click.stop="linkTo(item)" />
          </span>
        </li>
      </ul>
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

  .wx-img {
    position: absolute;
    left: 15px;
    top: 4px;
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

  .menu-contain ul {}

  .menu-contain ul li {
    position: relative;
    float: left;
    box-sizing: border-box;
    text-align: center;
    margin: 5px auto;
    overflow: auto;
    height: 280px;
  }

  /* =====================公共部分 end==================*/

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
    font-size: 28px;
    text-align: center;
    display: inline-block;
    width: 140px;
    height: 54px;
    line-height: 54px;
    vertical-align: middle;
    margin-top: 5px;
    background-color: #0099cc;
    border-radius: 6px;
    color: #fff;
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
    props: ['qqData', 'qqts'],
    methods: {
      linkTo(item) {
        if (item.which == 2) {
          this.curId = this.curId ? 0 : item.id;
        } else {
          var strUrl = this.baseConfig.phoneUrl;
          var _url = 'mqqwpa://im/chat?chat_type=wpa&uin=' + item.qq + '&version=1&src_type=web&web_src=' + strUrl;
          window.open(_url);
        }
      },
    }
  };
</script>