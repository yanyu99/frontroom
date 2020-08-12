<template>
  <div class="warp" style="height:500px;">
    <div class="title">
      <span>{{$t("推广记录##推广记录文本",__FILE__)}}</span>
    </div>
    <div class="content p_scroll">
      <table style="width: 100%;max-height: 442px;">
        <thead>
          <tr style="border-bottom: 2px solid #ddd;">
            <th>{{$t("被推广人账号##被推广人账号文本",__FILE__)}}</th>
            <th>{{$t("昵称##昵称文本",__FILE__)}}</th>
            <th>{{$t("推广时间##推广时间文本",__FILE__)}}</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(item,index) in dataList">
            <tr :key="index">
              <td>{{item.uid}}</td>
              <td>{{item.name}}</td>
              <td>{{item.created_at}}</td>
            </tr>
          </template>
        </tbody>
      </table>
      <div style="color: #ccc">共{{totalNum}}条数据</div>

      <div class="pages-container" style=" height:40px; float:right; width:100%; text-align:right; " v-if="Math.ceil(totalNum / pageSize)">
        <mo-paging :page-index="pageIndex" :total="totalNum" :page-size="pageSize" :per-Pages="5" @change="pageChange"></mo-paging>
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
    /* height: 10px; */
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
  import * as types from "@/store/types";
  import MoPaging from "@/pc_views/_/util/paging";
  export default {
    data() {
      return {
        pageIndex: 1,
        dataList: [],
        totalNum: 0,
        pageSize: 10,
      };
    },
    created() {
      this.getList();
    },
    methods: {
      pageChange(page) {
        this.pageIndex = page;
        this.getList();
      },
      getList() {
        types.userRecommenderSelect({
          recommender_id: parseInt(this.userInfo.uid),
          page: this.pageIndex,
          num: this.pageSize
        }, res => {
          this.dataList = res.curUser.userList.rows || [];
          this.totalNum = res.curUser.userList.pageInfo.total || 0;
          this.pageSize = res.curUser.userList.pageInfo.num || this.pageSize; //显示的条数
        }, res => {});
      }
    },
    components: {
      MoPaging
    }
  };
</script>