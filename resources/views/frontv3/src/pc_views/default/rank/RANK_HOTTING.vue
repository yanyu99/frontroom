<template>
  <div class="rank-show" id="RANK_GIFTGOT">
    <ul class="ulTitle">
      <li>
        <span class="rank-tit">{{$t("名次##名次文本",__FILE__)}}</span>
        <span class="sp-nick">{{$t("昵称##昵称文本",__FILE__)}}</span>
        <span class="sp-integral">收礼总{{baseConfig.textcfg.jf_txt_tit}}</span>
      </li>
    </ul>
    <ul class="ulCon" style="position:relative;">
      <li v-for="(item,index) in roomInfo.giftGotRank.dataList" :key="item.uid">
        <span class="rank-tit">
          <span class="sp-rank" :style="index <3 ? spIndBg(index + 1) :'' ">
            <label v-if="index >2">
              {{index + 1}}
            </label>
          </span>
        </span>
        <span class="sp-nick">{{item.name}}</span>
        <span class="sp-integral">{{item.jf_got}}</span>
      </li>
    </ul>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>

<style scoped>
  .rank-show {
    width: 600px;
    background: #fff
  }


  .rank-show ul li {
    display: inline-block;
    padding: 8px 15px;
    vertical-align: middle;
    width: 100%;
    text-align: center;
    font-size: 17px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .ulTitle {
    background-color: #1b1b1b;
  }

  .ulCon {
    height: 500px;
    overflow-y: hidden;
  }

  .rank-show ul.ulTitle li:first-child {
    color: #E5B60A
  }

  .rank-show ul li span {
    display: inline-block;
    height: 33px;
    line-height: 33px;
    vertical-align: middele;
  }

  .rank-tit {
    width: 50px;
  }

  .rank-show ul li span.sp-rank {
    width: 30px;
  }

  .rank-show ul li span.sp-nick {
    width: 40%;
  }

  .rank-show ul li span.sp-integral {
    width: 35%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    created() {
      this.load();
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style')
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
      load() {
        this.$store.dispatch(types.LOAD_RANK_GIFT_GOT)
      },
      active() {
        return this.roomInfo.active_menu == 'RANKING_LIST' && this.roomInfo.active_rank == 'RANK_GIFTGOT'
      },
      spIndBg(ind) {
        return {
          background: "url('/assets/v3/images/phone/rank" + ind + ".png') no-repeat left",
          backgroundSize: "100%"
        };
      }
    }
  };
</script>