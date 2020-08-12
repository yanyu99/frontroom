<template>
  <div class="gift-panel">
    <ul class="gift-tab">
      <li v-for="(tabCat,index) in roomInfo.giftCates" :key="tabCat.cate_id" :class="{'on': index == active}" @click.stop='changeTab(tabCat,index)'>
        {{tabCat.cate_name}}
      </li>
    </ul>

    <div class="gift-con">
      <div class="gift-group">
        <div v-for="(tab,index) in roomInfo.giftCates" :key="tab.cate_id ">
          <div class="M-arrow-scroll">
            <div class="con">
              <div class="scroll" style="">
                <div class="clearfix gift-page active  gift-grids" data-page="0" v-show="index == active">

                  <a v-for="item in roomInfo.giftV2s" :key="item.gift_name" v-if="tab.cate_id == item.cate_id" style="cursor: pointer;" class="gift gift-grid" @mouseenter="showActive(item)" @mouseleave="showActive(item)" @click="realSendGift(item,$event)">
                    <div style="cursor: pointer;" class="gift-pic">
                      <img style="cursor: pointer;width: 60px;height: 60px;" :src='item.gift_pic'>
                    </div>
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<style scoped>
  .active {
    background-color: transparent;
  }

  .plane-gift {
    padding: 10px;
  }

  .plane-gift .gift-tab {
    height: 60px;
    margin-top: 0px;
  }

  .plane-gift .gift-tab li.on {
    color: #333;
    background: #ddd;
    border-radius: 5px;
  }

  .plane-gift .gift-tab li {
    font-size: 30px;
    color: #0a8cd2;
    float: left;
    text-align: center;
    cursor: pointer;
    position: relative;
    padding: 10px 16px;
    margin-right: 10px;
  }

  .plane-gift .con {
    padding-top: 10px;
  }

  .plane-gift .gift-page {
    display: none;
  }

  .plane-gift .gift-page.active {
    display: block;
  }

  .plane-gift .con .gift {
    float: left;
    cursor: pointer;
  }

  .plane-gift .con .gift-pic {
    margin: 0 auto;
    text-align: center;
    position: relative;
    border: 1px solid #fff;
  }

  .plane-gift .con .gift-pic:hover {
    z-index: 2;
    border: 1px solid #0095cd;
  }

  .plane-gift .gift-page-nav {
    margin-top: 10px;
    font-size: 12px;
    text-align: right;
    overflow: hidden;
  }

  .plane-gift .gift-page-nav .page {
    float: left;
    height: 22px;
    padding: 0 8px;
    color: #0a8cd2;
    margin-left: 5px;
    line-height: 22px;
    border-radius: 1px;
    background: #f2f2f2;
    text-decoration: none;
  }

  .plane-gift .gift-page-nav .active {
    color: #333;
    cursor: default;
    background: #fff;
  }

  .plane-gift .con .gift.selected .gift-pic {
    border: 1px solid #0095cd;
  }

  .gift-group-item-wrap {
    display: none;
  }

  .gift-group-item-wrap.active {
    display: block;
  }

  .hidden {
    display: none !important;
  }

  .clearfix {
    clear: both;
  }

  .gift-grids {
    position: relative;
    overflow: hidden;
    border-left: 1px solid #e8e8e8;
  }

  .gift-grid {
    position: relative;
    float: left;
    padding: 20px 10px;
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
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import chatJfGift from "@/mixins/chatJfGift"

  export default {
    mixins: [chatJfGift],
    mounted() {
      var self = this;
      var callback = function (e) {
        if ($(".bottom-wrap").css('display') == "none") {
          return;
        }
        var e = e || window.event; //浏览器兼容性
        var elem = e.target || e.srcElement;
        while (elem) {
          //循环判断至跟节点，防止点击的是div子元素
          if (elem.id && elem.id == "bottom-wrap") {
            return;
          }
          elem = elem.parentNode;
        }
        self.$parent.$emit("chatGiftClose", e); //点击的不是div或其子元素
        //e.preventDefault();
      };
      dms.registerFuncGroup('main-content', 'bottom-wrap', callback);
    },
  };
</script>