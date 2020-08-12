<template>
  <div class="gift-panel">
    <ul class="gift-tab">
      <li v-for="(tabCat,index) in roomInfo.giftCates" :key="tabCat.cate_id" :class="{'on': index == active}" @click.stop='changeTab(tabCat,index)'>
        {{tabCat.cate_name}}
      </li>
    </ul>

    <div class="gift-group gift-con">
      <div class="M-arrow-scroll" v-for="(tab,index) in roomInfo.giftCates" :key="tab.cate_id ">
        <div class="con clearfix gift-page active  gift-grids" :data-page="index" v-show="index == active">
          <a v-for="item in roomInfo.giftV2s" :key="item.gift_id" v-if="tab.cate_id == item.cate_id" style="cursor: pointer;" class="gift gift-grid" @mouseenter="showActive(item)" @mouseleave="showActive(item)" @click="realSendGift(item,$event)">

            <span style="cursor: pointer;" class="gift-pic">
              <img style="cursor: pointer;width: 60px;height: 60px;" :src='item.gift_pic'>
            </span>
            <div class="MR-gift-tip" v-show="showIndex == item.gift_id">
              <div class="tip-content">
                <img class="tip-img" :src="item.gift_pic">
                <div class="gift-tip-con">
                  <span class="gift-tip-name">{{item.gift_name}}</span>
                  <span class="gift-tip-price">{{item.gift_price}}{{baseConfig.textcfg.jf_txt_tit}}</span>
                </div>
                <div class="gift-tip-desc">&nbsp;</div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .gift-panel {
    display: flex;
    flex-direction: column;
  }

  .clearfix {
    clear: both;
  }

  .gift-grids {
    position: relative;
    border-left: 1px solid #e8e8e8;
    border-top: 1px solid #e8e8e8;
  }

  .gift-grid {
    position: relative;
    float: left;
    width: 20.2%;
    box-sizing: border-box;
    text-align: center;
    border: 1px solid #e8e8e8;
    margin: 0px -1px -1px -1px;
  }

  a {
    text-decoration: none;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  }

  .MR-gift {
    overflow: initial !important;
  }

  .MR-gift-tip {
    position: absolute;
    left: 0px;
    top: 30px;
    width: 166px;
    height: 40px;
  }

  .MR-gift-tip .tip-content {
    background: #221D20;
    padding: 5px 10px;
    line-height: 40px;
    height: 40px;
  }

  .MR-gift-tip .gift-tip-con,
  .MR-gift-tip .gift-tip-desc {
    line-height: 30px;
  }

  .MR-gift-tip .gift-tip-con,
  .MR-gift-tip .gift-tip-desc {
    margin-left: 20px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import chatJfGift from "@/mixins/chatJfGift"

  export default {
    mixins: [chatJfGift],
  };
</script>