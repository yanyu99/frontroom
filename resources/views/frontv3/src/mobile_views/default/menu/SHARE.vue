<template>
  <div class="menu-box" id="SHARE">

    <div class="menu-main">
      <span>
        <p class="p-tit">分享收藏</p>
      </span>
      <div class="menu-contain">
        <ul class="contain-ul">
          <li @click="postWb">
            <img src="/assets/v3/images/phone/icon_weibo.png" />
            <label class="lb-up">微博</label>
          </li>
          <li @click="postQQ">
            <img src="/assets/v3/images/phone/icon_qq.png" />
            <label class="lb-smooth">QQ</label>
          </li>
          <li @click="postQQKJ">
            <img src="/assets/v3/images/phone/icon_qqkj.png" />
            <label class="lb-down">QQ空间</label>
          </li>
        </ul>
        <p class="p-mark">或点击界面右上角菜单按钮选择收藏或分享</p>

      </div>
    </div>
  </div>

</template>
<style scoped>

  .menu-box {
    padding: 15px 10px;
    border-radius: 6px;
    background: #fff;
  }

  .menu-main {}

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

  .menu-contain {}

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

  .contain-ul {
    margin: 15px;
  }

  .contain-ul li {
    padding: 10px;
    width: 33.33333%;
  }

  .contain-ul li img {
    width: 124px;
    height: 124px;
    display: block;
    margin: 0 auto;
  }

  .contain-ul li label {
    font-size: 30px;
    text-align: center;
    display: inline-block;
    /* line-height: 21px; */
    width: 100%;
    height: 30px;
    line-height: 30px;
    vertical-align: middle;
    margin-top: 5px;
    color: #434343;
    /*background-color: #0099CC;*/
    /*border-radius: 4px; color: #fff;*/
  }

  .contain-ul li p {
    font-size: 13px;
    line-height: 30px;
    color: #515151;
  }

  .p-mark {
    color: #6b6b6b;
    word-wrap: break-word;
    text-indent: 1em;
    margin: 20px auto;
    font-size: 20px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import shareMixin from "@/mixins/shareMixin"

  export default {
    mixins: [shareMixin],
    methods: {
      postWb() {
        this.postToXinLang(this.descTitle, this.phoneUrl);
      },
      postQQ() {
        this.postToQQ(this.descTitle, this.phoneUrl);
      },
      postQQKJ() {
        this.postToQzone(this.descTitle, this.phoneUrl);
      },


    }
  };
</script>