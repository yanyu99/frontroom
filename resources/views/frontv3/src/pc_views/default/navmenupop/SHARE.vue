<template>
  <div class="menu-box" id="SHARE">

    <div class="menu-main">
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
  /* =====================公共部分 start==================*/
  .menu-box {
    width: 500px;
    border-radius: 6px;
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

  .contain-ul {
    margin: 15px;
  }

  .contain-ul li {
    padding: 10px;
    width: 33.33333%;
  }

  .contain-ul li img {
    width: 62px;
    height: 62px;
    display: block;
    margin: 0 auto;
  }

  .contain-ul li label {
    font-size: 18px;
    text-align: center;
    display: inline-block;
    width: 100%;
    height: 30px;
    line-height: 30px;
    vertical-align: middle;
    margin-top: 5px;
    color: #434343;
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
    font-size: 16px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import shareMixin from "@/mixins/shareMixin"
  export default {
    mixins: [shareMixin],
    created() {},
    methods: {
      postWb() {
        this.postToXinLang(this.descTitle, this.phoneUrl);
      },
      postQQ() {
        this.postToQQ(this.descTitle, this.phoneUrl);
      },
      postQQKJ() {
        this.postToQzone(this.descTitle, this.phoneUrl);
      }
    }
  };
</script>