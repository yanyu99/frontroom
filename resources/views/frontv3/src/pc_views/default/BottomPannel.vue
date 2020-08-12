<template>
  <div class="p-bottom-warp " v-if="isShowBottom" :style="{'background-color': $c('rgba(0,0,0,0.5)##页面底部颜色值透明度',__FILE__),height:curViewHeight+'px'}">
    <marquee :scrollamount="$t('4##页面底部栏滚动速度', __FILE__)" onMouseOut="this.start()" onMouseOver="this.stop()">
      <ul v-if="bottomStockText.length">
        <li class="guzhi-item" v-for="(item,index) in dataList" :key="index"  >
          <span class="item arrow-right"></span>
          <span class="name">{{item.name ? item.name : '加载中'}}</span>
          <div style="" class="d-num">
            <span class="num" :class="{'green':item.change<0,'red':item.change >0,'gray':item.change == 0}">{{ !isNaN(item.price) ? item.price :' 00.0' }}</span>
              <span class="per-num" :class="{'green_Bg':item.change<0,'red_Bg':item.change >0,'gray_Bg':item.change == 0}">{{ !isNaN(item.per)?item.per + '%' : '0%'}}</span>
          </div>
        </li>
      </ul>

      <span class="m-txt" v-if="bottomText.length" v-html="bottomText"></span>
    </marquee>
  </div>
</template>
<style scoped>
  .p-bottom-warp {
    overflow: hidden;
    vertical-align: middle;
    margin-top: 3px;
    margin-left: 3px;
    border: 0 none;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
    align-content: center;
  }

  .p-bottom-warp ul {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
    align-content: center;
  }

  .p-bottom-warp ul li {
    border-right: 1px solid;
    border-color: rgba(0, 0, 0, .2);
    margin-right: 10px;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
    align-content: center;
  }

  ul {
    margin-bottom: 0px;
  }

  ul li .name {
    color: #F0F239;
    margin-right: 10px;
  }

  .per-num {
    padding: 2px 4px;
    color: #fff;
    border-radius: 2px;
    margin-right: 10px;
    background: #0a0;
    /* padding: 0px 5px; */
  }

  .d-num {
    float: right;
    margin-right: 10px;
  }

  .item {
    clear: both;
    /* margin-bottom: 23px; */
  }

  /* 向右的箭头 */

  .arrow-right {
    font-size: 0;
    line-height: 0;
    border-width: 6px;
    border-color: #F0F239;
    border-right-width: 0;
    border-style: dashed;
    border-left-style: solid;
    border-top-color: transparent;
    border-bottom-color: transparent;
    vertical-align: middle;
    margin-right: 10px;
  }
</style>
<script>
  import Vuex from "vuex"
  import * as types from "@/store/types";
  import stockData from "@/mixins/side/stockData"
  var stockTimer = null;

  export default {
    data() {
      return {
        dataList: [],
        curViewHeight: $t('33##页面底部高度', __FILE__),
        bottomStockText: $t('##股票字符串，逗号分隔', __FILE__),
        bottomText: $t('##底部滚动文字', __FILE__),
        isShowBottom: false
      }
    },
    mixins: [stockData],
    created() {
      if (parseInt(this.curViewHeight) > 0 && (this.bottomStockText.length || this.bottomText.length)) {
        this.isShowBottom = true
        var self = this
        var str_StockCode = $.trim(self.bottomStockText);
        if (str_StockCode.length > 0) {
          if (!stockTimer) {
            stockTimer = setInterval(self.getStockData(str_StockCode), 5000);
          }
        }
      }
    },
  }
</script>