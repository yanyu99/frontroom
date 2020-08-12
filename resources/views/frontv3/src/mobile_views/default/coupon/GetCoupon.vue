<template>
  <div class="container" style="max-width: 520px">
    <h1>
      <router-link to="/" class="back-a"></router-link>
      <span class="sp-tit">{{$t("领取入场券##领取入场券描述",__FILE__)}}</span>
    </h1>

    <comm-qq :qqData="qqlist" :qqts='baseConfig.textcfg.coupon_txt_tit_qq'></comm-qq>
    <template v-if="qqImg.imgurl">
      <h4>{{baseConfig.textcfg.coupon_txt_tit_wx}}</h4>
      <img v-show="qqImg.imgurl" :src="qqImg ?qqImg.imgurl :'' " width="140px" height="140px">
    </template>
  </div>

</template>
<style scoped>
  .imgBigShow {
    width: 600px;
    height: 332px;
    background: #ffffff;
    background-size: contain;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    z-index: 1000;
  }

  .sp-tit {
    font-size: 38px;
  }

  h1 {
    display: flex;
    justify-content: space-around;
    width: 100%;
  }

  .back-a {
    display: inline-block;
    float: left;
    color: #666;
    background: url(/assets/img/user/arrowL.png) center center / contain no-repeat;
    float: left;
    width: 34px;
    height: 70px;
    line-height: 70px;
    vertical-align: middle;
    margin-top: 16px;
  }

  h4 {
    font-size: 28px;
    line-height: 70px;
  }

  .container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
  }

  .container a.coupon-a,
  .container a.coupon-a img {
    display: inline-block;
    height: 160px;
    width: 160px;
    margin: 5px 8px 16px;
  }

  .container a img {
    width: 160px;
  }

  h1,
  .h-tit {
    display: inline-block;
    color: #0062b4;
    font-weight: 800;
    font-size: 34px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
    height: 100px;
    line-height: 100px;
    vertical-align: middle;
    text-align: center;
  }

  .form-body {
    background: #f6f6f6;
    border-radius: 5px;
    padding-top: 15px;
    margin-bottom: 25px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .btn-submit {
    width: 150px;
  }

  .Validform_checktip {
    margin-left: 0px;
    position: absolute;
  }

  .placeholder {
    color: #aaa;
  }
  .menu-main{ height: auto;}
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types"
  import CommQq from "@/mobile_views/_/menu/CommQq";
  export default {
    data() {
      return {
        qqlist: [],
        qqImg: {},
      }
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap])
    },

    mounted() {
      this.getQQList()
      this.qqImgCode()
    },
    methods: {
      getQQList() {
        var qqListData = this.qqMap.COUPON || [];
        qqListData = qqListData.filter(i => i.which == 0);
        this.qqlist = qqListData.splice(0, 2) || []
      },
      qqImgCode() {
        var qqListData = this.qqMap.COUPON || [];
        qqListData = qqListData.filter(i => i.which == 1);
        this.qqImg = qqListData.splice(0, 1)[0] || [];
      }
    },
    components: {
      CommQq
    }
  }
</script>
