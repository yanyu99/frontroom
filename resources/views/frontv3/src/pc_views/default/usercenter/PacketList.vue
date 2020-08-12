<template>
  <div class="warp" style="height:500px;">
    <div class="title">
      <span>红包记录
      </span>
    </div>
    <div class="content p_scroll">
      <table style="width: 100%;max-height: 442px;">
        <thead>
          <tr style="border-bottom: 2px solid #ddd;">
            <th>{{$t("发送方##发送方文本",__FILE__)}}</th>
            <th>{{$t("获得金额##获得金额文本",__FILE__)}}</th>
          </tr>
        </thead>
        <tbody style="height:400px;">
          <template v-for="(item,index) in dataList">
            <tr :key="index">
              <td>{{item.user?item.user.name :''}}</td>
              <td>{{item.money ?(item.money) : 0}}</td>
            </tr>
          </template>
        </tbody>
      </table>
      <div style="color: #ccc">共{{totalNum}}条数据</div>

      <div class="pages-container" style=" height:40px; float:right; width:100%; text-align:right; " v-if="Math.ceil(totalNum / pageSize)">
        <mo-paging :page-index="pageIndex" :total="totalNum" :page-size="pageSize" :per-Pages='5' @change="pageChange"></mo-paging>
      </div>
    </div>

  </div>
</template>
<style scoped>
  table th,
  table td {
    font-size: 14px;
  }

  .warp .title {
    height: 40px;
    border-bottom: 1px solid #eee;
    line-height: 40px;
  }

  .warp .title span {
    line-height: 26px;
    padding-left: 10px;
    display: inline-block;
    border-left: 2px solid #189ccf;
  }

  .warp .content {
    clear: both;
  }

  a {
    text-decoration: inherit;
    color: #333;
  }

  .sider a {
    display: block;
    width: 100%;
    text-align: center;
    line-height: 38px;
    height: 38px;
    font-size: 16px;
    color: #0293ca;
  }

  .sider .on {
    background-color: #0293ca;
    color: #eee;
  }
</style>
<script>
  import * as types from "@/store/types"
  import MoPaging from '@/pc_views/_/util/paging'
  export default {
    data() {
      return {
        pageSize: 10, //每页显示20条数据
        pageIndex: 1, //当前页码
        totalNum: 0, //总记录数
        dataList: [],
      };
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

        types.luckMoneyRunningListSelect({
          page: this.pageIndex,
          num: this.pageSize
        }).then(resp => { 
          var _tmpObj = resp.curUser.luckMoneyRunningList;
          this.dataList = _tmpObj.rows || [];;
          this.totalNum = _tmpObj.pageInfo.total || 0;
          this.pageSize = _tmpObj.pageInfo.num || this.pageSize; //显示的条数
        })
      },
    },
    components: {
      MoPaging
    }
  };
</script>