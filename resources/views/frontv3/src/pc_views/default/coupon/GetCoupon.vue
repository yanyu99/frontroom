<template>
  <div class="container" style="" id="GetCoupon">
    <h4>{{baseConfig.textcfg.coupon_txt_tit_qq}}</h4>
    <p>
      <template v-for="item in qqlist">
        <a class="coupon-a" :key="item.id" @click="linkTo(item.qq,url)">
          <img :src="item.imgurl ? item.imgurl : '/assets/v3/images/phone/icon_qq.png'" :title="item.qq" />
        </a>
      </template>
    </p>

    <template v-if="qqImg.imgurl">
      <h4>{{baseConfig.textcfg.coupon_txt_tit_wx}}</h4>
      <img v-show="qqImg.imgurl" :src="qqImg ?qqImg.imgurl :'' " width="140px" height="140px">
    </template>
  </div>
</template>
<style scoped>
  #GetCoupon {
    background: #fff;
    max-width: 520px;
    height: 500px;
  }

  h4 {
    font-size: 15px;
    line-height: 35px;
  }

  .container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
  }

  .coupon-a {
    padding: 5px 10px;
  }

  .coupon-a img {
    width: 48px;
    height: 48px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types"

  export default {
    data() {
      return {
        qqlist: [],
        qqImg: {},
        toUrl: '',
      }
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap])
    },
    mounted() {
      // 根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id; //当前弹出层的id
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style')

      this.toUrl = location.protocol + '//' + location.host;
      this.getQQList()
      this.qqImgCode();


    },
    methods: {
      linkTo(qq, strUrl) {
        var _url = this.LIVE_PLAT == 'mobile' ? 'mqqwpa://im/chat?chat_type=wpa&uin=' + qq + '&version=1&src_type=web&web_src=' + strUrl :
          'http://wpa.qq.com/msgrd?v=3&uin=' + qq + '&site=qq&menu=yes';
        window.open(_url);
      },
      getQQList() {
        var qqListData = this.qqMap.COUPON || [];
        qqListData = qqListData.filter(i => i.which == 0);
        this.qqlist = qqListData.splice(0, 2) || []
      },
      qqImgCode() {
        var qqListData = this.qqMap.COUPON || [];
        qqListData = qqListData.filter(i => i.which == 1);
        this.qqImg = qqListData.splice(0, 1)[0] || [];
      },
    }
  }
</script>