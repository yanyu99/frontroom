<template>
  <div class="menu-box" id="STOCKPOOL">
    <div class="menu-main" v-if="!isLoadingData">
      <template v-if="dataList.length >0">
        <div class="menu-contain">
          <ul class="contain-ul">
            <li>
              <span class="sp-tit">{{$t('名称##名称备注', __FILE__)}}</span>
              <span class="sp-time">{{$t('买入时间##买入时间备注', __FILE__)}}</span>
              <span class="sp-price">{{$t('买入价格##买入价格备注', __FILE__)}}</span>
              <span class="sp-time">{{$t('卖出时间##卖出时间备注', __FILE__)}}</span>
              <span class="sp-price">{{$t('卖出价格##卖出价格备注', __FILE__)}}</span>
              <span class="sp-price">{{$t('收益##收益备注', __FILE__)}}</span>
              <span class="sp-tj">{{$t('推荐人##推荐人备注', __FILE__)}}</span>
              <span class="sp-des">{{$t('描述##描述备注', __FILE__)}}</span>
            </li>
          </ul>

          <div class="demo-wrapper">
            <div class="demo-inner list">
              <div style=" ">
                <ul>
                  <li v-for="(item,index) in dataList" :key="index">
                    <span class="sp-tit">{{item.stock_code}}</span>
                    <span class="sp-time">{{item.buy_time}}</span>
                    <span class="sp-price">{{item.buy_pri}}</span>
                    <span class="sp-time">{{item.sell_time}}</span>
                    <span class="sp-price">{{item.sell_pri}}</span>
                    <span class="sp-price">{{item.trade_gains}}</span>
                    <span class="sp-tj">{{item.teacher ? item.teacher.name : ""}}</span>
                    <span class="sp-des">{{item.trade_reason}}</span>

                  </li>
                </ul>
                <div v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="30" style="text-align:center">
                  <p class="pagemsg" v-show="busy" v-html="msgInfo"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>

      <comm-qq v-if="!dataList.length &&qqMap.STOCKPOOL.length >0" :qqData="qqMap.STOCKPOOL" qqts=''></comm-qq>
    </div>
    <div class="loading-layer" v-if="isLoadingData">
      <span></span>
    </div>
  </div>
</template>
<style scoped>
  .demo-inner {
    height: 500px;
    margin-bottom: 30px;
    scroll-behavior: contain;
  }

  .menu-box {
    background: #fff;
    padding: 15px 10px;
    border-radius: 6px;
    overflow-y: auto;
    overflow-x: scroll;
  }

  .list {
    height: 400px;
  }

  .menu-main {
    width: 700px;
    -webkit-overflow-scrolling: touch;
    overflow-x: scroll;
  }

  .menu-contain {
    width: 1880px;
  }

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

  .menu-contain ul li {
    float: left;
    box-sizing: border-box;
    line-height: 40px;
  }

  .contain-ul li {
    overflow-x: scroll;
  }

  .contain-ul li span {
    display: inline-block;
    font-size: 28px;
    color: #333333;
    height: 50px;
    line-height: 50px;
    vertical-align: middle;
    text-align: center;
    padding: 0px 10px;
  }

  .sp-tit {
    width: 160px;
  }

  .sp-price {
    width: 160px;
  }

  .sp-time {
    width: 200px;
  }

  .sp-tj {
    width: 160px;
  }

  .sp-des {
    width: 400px;
  }

  .p-remark {
    margin-top: 20px;
    font-size: 16px;
    text-align: center;
  }

  .list ul li {
    background-color: #fff;
  }

  .list ul li {
    vertical-align: middle;
    zoom: 1;
    border-bottom: 1px solid #e8e8e8;
    overflow-x: scroll;
  }

  .list ul li span {
    /* width: 33%; */
    height: 50px;
    line-height: 50px;
    text-align: center;
    float: left;
    display: inline-block;
    font-size: 26px;
    padding: 0px 10px;
    overflow: hidden;
  }

  .pagemsg {
    font-size: 28px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import InfiniteLoading from 'vue-infinite-loading';
  import CommQq from "@/mobile_views/_/menu/CommQq";

  export default {
    data() {
      return {
        busy: false,
        page: 1,
        num: 10,
        dataList: [],
        msgInfo: "加载中...",
        isRoll: true,
        isLoadingData: true
      }
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id + " .notify .notify-main").css('top', '72%')
      this.getDataList();
    },

    computed: {
      ...Vuex.mapGetters([types.qqMap]),
    },
    methods: {
      getDataList(flag) {
        types.stockPoolListSelect({
          page: this.page,
          num: this.num
        }).then(resp => {
          var _tmpData = resp.data.room.stockPoolList || {};
          if (flag) {
            // 多次加载数据
            if (!_tmpData.pageInfo.hasNextPage) {
              this.busy = true; //没有更多数据
              this.msgInfo = "加载完毕";
              this.isRoll = false;
            } else {
              this.busy = false;
            }
          }
          this.dataList = this.dataList.concat(_tmpData.rows);
        }).catch(e => {
          this.busy = true; //没有更多数据
          this.msgInfo = "加载完毕";
          this.isRoll = false;
          console.warn(e);
        }).finally(() => {
          this.isLoadingData = false;
        });
      },
      loadMore() {
        this.busy = true;
        // 多次加载数据
        this.isRoll && setTimeout(() => {
          this.page++; //从第二页开始
          this.getDataList(true);
        }, 1000);
      }
    },
    components: {
      CommQq
    }
  };
</script>