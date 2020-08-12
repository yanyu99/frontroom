<template>
  <div v-if="tab.tag == roomInfo.active_menu" class="pane" :style="{backgroundColor:$c('#2f2e2e##该块背景颜色', __FILE__)}">
    <div class="rank-tab">
      <ul>
        <template v-for="(tab,index) in tabRanks">
          <li :key="tab.tag" :style="{color:tab.tag==roomInfo.active_rank? $c('#fe9901##排行榜选中文本颜色', __FILE__):$c('#fff##排行榜文本颜色', __FILE__)}" @click="selectTab(tab, index)">
            {{tab.title}}
          </li>
        </template>
      </ul>
    </div>

    <div class="rank-con-warp">
      <template v-for="(tab, index) in tabRanks">
        <component :is=" tab.tag " :index="index" :key="tab.tag" v-show="tab.tag==roomInfo.active_rank">
        </component>
      </template>
    </div>
  </div>
</template>

<style scoped>
  .pane {
    color: #fff;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .rank-tab {
    padding: 0px 10px;
    height: 88px;
    display: flex;
  }

  .rank-con-warp {
    display: flex;
    flex: 1;
    flex-direction: column;
  }

  .rank-tab ul li {
    display: inline-block;
    height: 88px;
    line-height: 88px;
    padding: 0px 10px;
    font-size: 30px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import RANK_JF from "@/mobile_views/_/rank/RANK_JF";
  import RANK_GIFTSEND from "@/mobile_views/_/rank/RANK_GIFTSEND";
  import RANK_GIFTGOT from "@/mobile_views/_/rank/RANK_GIFTGOT";
  export default {
    data() {
      return {
        tabRanks: [],
      }
    },
    props: {
      tab: Object
    },
    created() {
      this.tabRanks = [{
        tag: 'RANK_JF',
        title: this.baseConfig.textcfg.rank_jf,
      }, {
        tag: 'RANK_GIFTSEND',
        title: this.baseConfig.textcfg.rank_giftsend,
      }, {
        tag: 'RANK_GIFTGOT',
        title: this.baseConfig.textcfg.rank_giftgot,
      }];
      if (!this.roomInfo.active_rank) {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_rank: this.tabRanks[0].tag
        });
      }
      //this.$store.dispatch(types.LOAD_RANK_JF);

      var dispatch = this.$store.dispatch
      this.lazyWatch(
        'jfRankOption',
        'roomInfo.active_rank',
        (n, o) => n == 'RANK_JF',
        () => dispatch(types.LOAD_RANK_JF)
      )
      this.lazyWatch(
        'giftSendRank',
        'roomInfo.active_rank',
        (n, o) => n == 'RANK_GIFTSEND',
        () => dispatch(types.LOAD_RANK_GIFT_SEND)
      )
      this.lazyWatch(
        'giftGotRank',
        'roomInfo.active_rank',
        (n, o) => n == 'RANK_GIFTGOT',
        () => dispatch(types.LOAD_RANK_GIFT_GOT)
      )
    },

    methods: {
      selectTab(tab, index) {
        //当前的颜色选中
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_rank: tab.tag
        });
      }
    },
    components: {
      RANK_JF,
      RANK_GIFTSEND,
      RANK_GIFTGOT
    }
  };
</script>