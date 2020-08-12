<template>
  <div class="inpage" style="background:#f1f1f1;">
    <!-- 头部 -->
    <div class="per_banner">
      <img src="/assets/img/user/topbg.jpg" width="100%" height="100%">
      <div class="user">
        <img :src="userInfo.pic ||'/assets/img/user/user.png'" />
      </div>
      <div class="name">{{userInfo.name}}</div>
      <div class="bottom">
        <div class="left">
          <span>我的角色 : </span>
          <div class="grade">{{baseConfig.roles[userInfo.role_id] ?baseConfig.roles[userInfo.role_id].role_name :''}}</div>
        </div>
        <a class="right" @click="userLogout">
          登出
        </a>
      </div>
    </div>

    <ul class="per_content">
      <template v-for="(item,index) in userCenter">
        <li :class="item.icon" :key="index">
          <router-link :to="item.href">
            <div class="img">
              <img class="item-icon-img" :src="item.pic " alt="">
            </div>
            <span>{{item.tag}}</span>
            <div class="go"></div>
          </router-link>
        </li>
      </template>
    </ul>

    <!-- 页脚 -->
    <div class="per_foot">
      <router-link to="/">
        <div id="broadcast">
          <div class="broadcast"></div>
          <span>直播间</span>
        </div>
      </router-link>

      <router-link to="usermain">
        <div>
          <div class="user"></div>
          <span>个人中心</span>
        </div>
      </router-link>
    </div>
  </div>

</template>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  export default {
    computed: {
      ...Vuex.mapGetters([types.userCenter])
    },
    methods: {
      userLogout() {
        dms.LiveApi.userLogout({}, resp => {
          window.location.hash = "";
          window.location.reload(true);
        })
      }
    },
  };
</script>
<style scoped>
  html,
  body,
  p,
  ul,
  li {
    padding: 0;
    border: 0;
    margin: 0;
    font-family: "微软雅黑";
    font-size: 0.1867rem;
  }

  a {
    text-decoration: none;
  }

  .inpage,
  body {
    background-color: #f1f1f1;
  }

  body,
  html {
    height: 100%;
    -webkit-tap-highlight-color: transparent;
  }

  .per_content {
    width: 100%;
    height: auto;
    margin-top: 0.2667rem;
  }

  .per_content>li {
    width: 100%;
    height: 1.4133rem;
    background-color: white;
    border: 1px solid #e4e4e4;
    line-height: 1.4133rem;
  }

  .per_content>li:nth-child(4) {
    margin-top: 0.2667rem;
  }

  .per_content>li>a {
    color: #575757;
    font-size: 0.4267rem;
    display: block;
    display: flex;
    display: -webkit-flex;
    flex-wrap: nowrap;
    -webkit-flex-wrap: nowrap;
    -webkit-align-items: center;
  }

  .per_content>li>a>.img {
    /* width: 0.7333rem; */
    height: 0.95rem;
    /*  background: url("{{$cdn}}/assets/img/user/icon.png") center center no-repeat; */
    background-size: contain;
    margin-left: 0.5333rem;
    margin-right: 0.2667rem;
    display: flex;
    display: -webkit-flex;
    -webkit-align-items: center;
  }

  .item-icon-img {
    height: 0.95rem;
    width: 0.95rem;
  }

  .per_content>li>a>.go {
    width: 0.4267rem;
    height: 0.6667rem;
    background: url("/assets/img/user/arrowR.png") center center no-repeat;
    background-size: contain;
    margin-left: 6rem;
  }

  .per_banner {
    width: 100%;
    height: 4.9867rem;
    position: relative;
  }

  .per_banner>img {
    position: absolute;
    width: 100%;
    height: 100%;
  }

  .per_banner .user {
    width: 1.8667rem;
    height: 1.8667rem;
    position: absolute;
    top: 0.5733rem;
    left: 50%;
    -webkit-transform: translate(-50%, 0);
    z-index: 1;
    border: 0.04rem solid #fff;
    border-radius: 50%;
  }

  .per_banner .user img {
    width: 1.8667rem;
    height: 1.8667rem;
    border-radius: 1.8667rem;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
  }

  .per_banner .name {
    width: 100%;
    height: 0.4267rem;
    text-align: center;
    line-height: 0.4267rem;
    color: #fff;
    font-size: 0.4267rem;
    position: absolute;
    top: 2.9733rem;
    z-index: 1;
  }

  .per_banner .bottom {
    width: 100%;
    height: 1.6rem;
    display: flex;
    display: -webkit-flex;
    position: relative;
    top: 3.9333rem;
    z-index: 1;
  }

  .per_banner .bottom .left {
    -webkit-flex: 7;
    display: flex;
    display: -webkit-flex;
    -webkit-justify-content: center;
    padding: 0 0 0 0.4rem;
  }

  .per_banner .bottom .left .grade {
    margin-left: 0.3rem;
  }

  .per_banner .bottom .right {
    -webkit-flex: 4;
  }

  .per_banner .bottom>a,
  .per_banner .bottom {
    color: white;
    font-size: 26px;
  }

  .per_foot {
    width: 100%;
    height: 1.6rem;
    background-color: white;
    border: 1px solid #e4e4e4;
    position: fixed;
    bottom: 0;
    left: 0;
  }

  .per_foot>a {
    width: 50%;
    height: 100%;
    float: left;
    display: flex;
    display: -webkit-flex;
    -webkit-align-items: center;
    -webkit-justify-content: center;
  }

  .per_foot>a>div {
    width: 2rem;
    height: 100%;
    display: flex;
    display: -webkit-flex;
    flex-wrap: wrap;
    -webkit-flex-wrap: wrap;
    -webkit-align-items: center;
    -webkit-justify-content: center;
  }

  .per_foot>a .broadcast {
    width: 1.0133rem;
    height: 0.88rem;
    background: url("/assets/img/user/tabicon_02.png") center center no-repeat;
    background-size: contain;
  }

  .per_foot>a .user {
    width: 1.0133rem;
    height: 0.88rem;
    background: url("/assets/img/user/tabicon_03.png") center center no-repeat;
    background-size: contain;
  }

  .per_foot>a .broadcast+span {
    font-size: 0.3733rem;
    color: #818181;
  }

  .per_foot>a .user+span {
    font-size: 0.3733rem;
    color: #00aeee;
  }
</style>