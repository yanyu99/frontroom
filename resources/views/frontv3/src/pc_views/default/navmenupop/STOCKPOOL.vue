<template>
  <div class="menu-box" id="STOCKPOOL">
    <template v-if="!isLoadingData">
      <div class="menu-contain">
        <table>
          <thead class="contain-ul">
            <tr>
              <th class="sp-tit">{{$t('名称##名称备注', __FILE__)}}</th>
              <th class="sp-status">{{$t('买入时间##买入时间备注', __FILE__)}}</th>
              <th class="sp-category">{{$t('买入价格##买入价格备注', __FILE__)}}</th>
              <th class="sp-status">{{$t('卖出时间##卖出时间备注', __FILE__)}}</th>
              <th class="sp-category">{{$t('卖出价格##卖出价格备注', __FILE__)}}</th>
              <th class="sp-income">{{$t('收益##收益备注', __FILE__)}}</th>
              <th class="sp-teacher">{{$t('推荐人##推荐人备注', __FILE__)}}</th>
              <th class="sp-des">{{$t('描述##描述备注', __FILE__)}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,index) in dataList" :key="index">
              <td class="sp-tit">{{item.stock_code}}</td>
              <td class="sp-status-con">{{item.buy_time}}</td>
              <td class="sp-category-con">{{item.buy_pri}}</td>
              <td class="sp-status-con">{{item.sell_time}}</td>
              <td class="sp-category-con">{{item.sell_pri}}</td>
              <td class="sp-income">{{item.trade_gains}}</td>
              <td class="sp-teacher">{{item.teacher ? item.teacher.name :''}}</td>
              <td class="sp-des">{{item.trade_reason}}</td>
            </tr>
          </tbody>
        </table>

        <div class="page-con">
          <div style="color: #ccc">共{{totalNum}}条数据</div>

          <div class="pages-container" style=" height:40px; float:right; width:100%; text-align:right; " v-if="Math.ceil(totalNum / pageSize)">
            <mo-paging :page-index="pageIndex" :total="totalNum" :page-size="pageSize" :per-Pages='5' @change="pageChange"></mo-paging>
          </div>
        </div>
      </div>

      <template v-if="dataList.length == 0 &&qqMap.STOCKPOOL.length >0">
        <comm-qq :qqData="qqMap.STOCKPOOL" qqts="股池联系人"></comm-qq>
      </template>
    </template>

    <div class="loading-layer" v-if="isLoadingData">
      <span></span>
    </div>

  </div>
</template>
<style scoped>
  #STOCKPOOL {
    height: 446px;
  }

  .page-con {
    width: 100%;
    height: auto;
  }

  table {
    width: 100%;
    border-spacing: 0;
    border-collapse: collapse;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
  }

  th {
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
    padding: 5px 0px;
    text-align: center;
  }

  td {
    text-align: center;
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
    padding: 5px 0px;
  }

  .tab-con {
    width: 100%;
    height: 100%;
    margin-top: 10px;
  }

  .menu-box {
    width: 800px;
    overflow-y: auto;
  }



  .menu-contain ul li {
    float: left;
    box-sizing: border-box;
    text-align: center;
    margin: 0 auto;
    text-align: center;
    position: relative;
  }


  .notify .notify-main {
    border: 0;
  }

  .contain-ul li {
    width: 100%;
  }

  .contain-ul li span {
    display: inline-block;
    font-size: 16px;
    color: #333333;
    height: 50px;
    line-height: 50px;
    vertical-align: middle;
    text-align: center;
  }

  .sp-tit {
    width: 130px;
  }

  .sp-status {
    width: 110px;
  }

  .sp-status-con {
    width: 110px;
  }

  .sp-category {
    width: 80px;
  }

  .sp-category-con {
    width: 80px;
  }

  .sp-des {
    width: 180px;
  }

  .contain-ul li img {
    width: 58px;
    height: 58px;
    display: block;
    margin: 0 auto;
  }

  .contain-ul li label {
    font-size: 13px;
    text-align: center;
    display: inline-block;
    /* line-height: 21px; */
    width: 70px;
    height: 27px;
    line-height: 27px;
    vertical-align: middle;
    margin-top: 5px;
    background-color: #0099cc;
    border-radius: 4px;
    color: #fff;
  }

  .p-remark {
    margin-top: 20px;
    font-size: 16px;
    text-align: center;
  }

  ul.contain-ul li:first-child {
    color: #e5b60a;
  }

  .sp-income {
    width: 90px;
  }

  .sp-teacher {
    width: 100px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import MoPaging from '@/pc_views/_/util/paging'
  import CommQq from "@/pc_views/_/util/CommQq"

  export default {
    data() {
      return {
        pageSize: 10, //每页显示20条数据
        pageIndex: 1, //当前页码
        totalNum: 0, //总记录数
        dataList: [],
        isLoadingData: true
      };
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap])
    },
    created() {
      this.getList();
    },
    methods: {
      pageChange(page) {
        this.pageIndex = page
        this.getList()
      },
      getList() {
        types.stockPoolListSelect({
          page: this.pageIndex,
          num: this.pageSize
        }).then(resp => {
          var _tmpData = resp.data.room.stockPoolList || {};
          this.totalNum = _tmpData.pageInfo.total || 0;
          this.dataList = _tmpData.rows || [];
          this.pageSize = _tmpData.pageInfo.num || this.pageSize; //显示的条数
        }).catch(e => {
          console.warn(e);
        }).finally(resp => {
          this.isLoadingData = false;
        });
      },
    },
    components: {
      MoPaging,
      CommQq
    },
  };
</script>