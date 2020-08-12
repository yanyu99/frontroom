<template>
  <div class="rank-show">

    <ul class="ulTitle" :style="{'background-color':$c('#1b1b1b##排行榜列表头部背景颜色', __FILE__),color:$c('#ffffff##排行榜列表头部文本颜色', __FILE__)}">
      <li>
        <span class="rank-tit">名次</span>
        <span class="sp-nick">昵称</span>
        <span class="sp-integral">送礼总{{baseConfig.textcfg.jf_txt_tit}}</span>
      </li>
    </ul>
    <ul class="ulCon" style="position:relative;">
      <scroller>
      <li v-for="(item,index) in roomInfo.giftSendRank.dataList" :key="item.uid" :style="{color:$c('#ffffff##列表文本颜色', __FILE__)}">
        <span class="rank-tit">
          <span class="sp-rank" :style="index <3 ? spIndBg(index + 1) :'' ">

            <label v-if="index >2">
              {{index + 1}}
            </label>
          </span>

        </span>
        <span class="sp-nick">{{item.user.name}}</span>
        <span class="sp-integral" :style="{color:$c('#ffffff##积分文本颜色', __FILE__)}">{{item.jf_giftsend}}</span>
      </li>
      </scroller>
    </ul>


  </div>
</template>

<style scoped>
  .rank-show ul {}

  .rank-show ul li {
    display: inline-block;
    padding: 10px 15px;
    vertical-align: middle;
    width: 100%;
    text-align: center;
    font-size: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
  }


  .ulCon {
     height: 500px;
    overflow-y: scroll;
  }

  .rank-show ul li:first-child {}

  .rank-show ul li span {
    display: inline-block;
    height: 66px;
    line-height: 66px;
    vertical-align: middele;
  }

  .rank-show ul li span.sp-rank {
    width: 56px;
  }

  .rank-tit,.sp-rank-first {
    width: 100px;
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
      this.lazyWatch('giftSendRank', 'roomInfo.active_menu', (newVal, oldVal) => newVal == 'RANKING_LIST')
    },
    methods: {
      load() {
        this.$store.dispatch(types.LOAD_RANK_GIFT_SEND)
      },
      active() {
        return this.roomInfo.active_menu == 'RANKING_LIST' && this.roomInfo.active_rank == 'RANK_GIFTSEND'
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