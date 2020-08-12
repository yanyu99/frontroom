<template>
  <div id="cashgift">
    <!-- <div class="cashgift-con " :style="{backgroundColor:$c('#000##底部弹出框背景的颜色', __FILE__)}">
      <ul class="menu-grids">
        <li v-for="item in baseConfig.roomUI.money_gifts" :key="item.id" @click="sendCashGift(item)" :class="{'active':item.id == curItem}">
          <img :src="item.pic">
          <font>{{item.name}}
          </font>
          <p>
            <label>{{item.price}}元</label>
          </p>
        </li>
      </ul>
    </div> -->
  </div>

</template>

<style scope>
  /*===============更多菜单列表弹出框==================*/
  .menu-mask {
    background-color: #000;
    opacity: 0.4;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
  }

  #cashgift {
    width: 100%;
    height: 400px;
    left: 0;
    bottom: 92px;
    z-index: 999;
    display: -webkit-flex;
    display: -moz-flex;
    display: flex;
  }

  .menu-grids {}

  .cashgift-con ul li {
    position: relative;
    float: left;
    padding: 15px 10px;
    width: 25%;
    box-sizing: border-box;
    text-align: center;
    margin: 0 auto;
    text-align: center;
    font-size: 30px;
    position: relative;
  }

  .active {
    background: rgba(0, 0, 0, 0.5);
  }

  a {
    text-decoration: none;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  }

  .cashgift-con {
    width: 100%;
    overflow: scroll;
  }

  .cashgift-con ul li img {
    width: 138px;
    height: 138px;
    display: block;
    margin: 0 auto;
  }

  .cashgift-con ul li font {
    display: inline-block;
    font-size: 24px;
    color: #fff;
    text-align: center;
    height: 30px;
    line-height: 30px;
    vertical-align: middle;
  }

  p label {
    color: #fe9901
  }

  /*==================覆盖原来样式==========================*/

  .notice-title {
    display: none;
    height: 0px;
  }

  .notify .notify-main {
    top: 62%;
  }

  .notify-content {
    height: auto !important;
  }

  .notify-msg {
    background-color: #fff !important;
    color: #000 !important;
    font-size: 30px;
  }

  .ovfHiden {
    overflow: hidden;
    height: 100%;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        curItem: 0
      }
    },
    methods: {
      sendCashGift(item) {
        this.curItem = item.id;
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          cashGiftInfo: {
            id: item.id,
            name: item.name,
            price: item.price,
            pic: item.pic,
          }
        });
      },
    }
  }
</script>