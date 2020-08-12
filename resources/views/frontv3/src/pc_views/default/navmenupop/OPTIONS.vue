<template>
  <div class="menu-box p_scroll" id="OPTIONS">
    <template v-if="!isLoadingData">
      <div class="menu-contain">
        <table>
          <thead class="contain-ul">
            <tr>
              <th>{{$t('标题##标题备注', __FILE__)}}</th>
              <th>{{$t('状态##状态备注', __FILE__)}}</th>
              <th>{{$t('品种##品种备注', __FILE__)}}</th>
              <th>{{$t('方向##方向备注', __FILE__)}}</th>
              <th>{{$t('成本价##成本价备注', __FILE__)}}</th>
              <th>{{$t('止损价##止损价备注', __FILE__)}}</th>
              <th>{{$t('目标价##目标价备注', __FILE__)}}</th>
              <th>{{$t('建仓时间##建仓时间备注', __FILE__)}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,index) in dataList" :key="index">
              <td>{{item.title}}</td>
              <td>{{item.manual_type}}</td>
              <td>{{item.variety}}</td>
              <td>{{item.mr_mc=="1" ?'买进':'卖出'}}</td>
              <td>{{item.cb_price}}</td>
              <td>{{item.zs_price}}</td>
              <td>{{item.mb_price}}</td>
              <td>{{item.created_at}}</td>
            </tr>
          </tbody>
        </table>

        <div class="page-con">
          <div style="color: #ccc">共{{totalNum}}条数据</div>
          <div class="pages-container" style=" height:40px; float:right; width:100%; text-align:right; " v-if="Math.ceil(totalNum / pageSize)">
            <mo-paging :page-index="pageIndex" :total="totalNum" :page-size="pageSize" :per-Pages='5' @change="pageChange"></mo-paging>
          </div>
          <p class="p-remark">{{$t("以上仅为研究部观点，不作为具体操作建议，据此操作盈亏自负，股市有风险，投资需谨慎！##操作建议备注文本",__FILE__)}}</p>
        </div>
      </div>

      <template v-if="dataList.length == 0 &&qqMap.CHAT.length >0">
        <comm-qq :qqData="qqMap.CHAT" qqts="暂无权限查看此内容，如有疑问，请联系客服。"></comm-qq>
      </template>
    </template>

    <div class="loading-layer" v-if="isLoadingData">
      <span></span>
    </div>

  </div>
</template>
<style scoped>
  #OPTIONS {
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

  .menu-contain {
    font-size: 13px;
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
    font-size: 14px;
    text-align: center;
    color: red;
  }

  ul.contain-ul li:first-child {
    color: #e5b60a;
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
        pageSize: 20, //每页显示20条数据
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
        types.tradeManualListSelect({
          page: this.pageIndex,
          num: this.pageSize
        }).then(resp => {
          var _tmpData = resp.data.room.tradeManualList || {};
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