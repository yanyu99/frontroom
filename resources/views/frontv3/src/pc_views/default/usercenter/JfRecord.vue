<template>
  <div id="JfRecord" class="warp " style="height:500px;">
    <div class="title">
      <span>我的{{baseConfig.textcfg.jf_txt_tit}}
      </span>
    </div>
    <div class="content p_scroll">
      <div class="jfuse">
        当前可用{{baseConfig.textcfg.jf_txt_tit}}：
        <span>{{jf_cur}}</span> ，送礼{{baseConfig.textcfg.jf_txt_tit}}：
        <span>{{jf_giftsend}}</span>
      </div>
      <table style="width: 100%; max-height: 442px;" class="">
        <thead>
          <tr style="border-bottom: 2px solid #ddd;">
            <th>{{baseConfig.textcfg.jf_txt_tit}}</th>
            <th>{{$t("类别##类别文本",__FILE__)}}</th>
            <th>{{$t("描述##描述文本",__FILE__)}}</th>
            <th>{{$t("时间##时间文本",__FILE__)}}</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(item,index) in dataList">
            <tr :key="index">
              <td>{{item.jf_num}}</td>
              <td>{{item.jf_num ? '增加' :'消耗'}}</td>
              <td>{{item.jf_note}}</td>
              <td>{{item.created_at}}</td>
            </tr>
          </template>
        </tbody>
      </table>
      <div class="total-count-data" style="color: #ccc">共{{totalNum}}条数据</div>

      <div class="pages-container" style=" height:40px; float:right; width:100%; text-align:right; " v-if="Math.ceil(totalNum / pageSize)">
        <mo-paging :page-index="pageIndex" :total="totalNum" :page-size="pageSize" :per-Pages='5' @change="pageChange"></mo-paging>
      </div>
    </div>
    <div>

    </div>
  </div>
</template>
<style scoped>
  table th,
  table td {
    font-size: 14px;
  }

  .jfuse {
    font-size: 14px;
  }

  .total-count-data {
    color: rgb(204, 204, 204);
    font-size: 14px;
    line-height: 30px;
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
        jf_cur: '',
        jf_giftsend: ''
      };
    },

    created() {
      types.userExtSelect({}, resp => {
        this.jf_cur =
          (resp.curUser.ext && resp.curUser.ext.jf_cur) || 0;
        this.jf_giftsend =
          (resp.curUser.ext && resp.curUser.ext.jf_giftsend) || 0;
      });
      this.getList();
    },
    methods: {
      pageChange(page) {
        this.pageIndex = page
        this.getList()
      },
      getList() {
        types.userJfRecordSelect({
          page: this.pageIndex,
          num: this.pageSize
        }).then(resp => {
          this.dataList = resp.curUser.userJfRecord.rows || [];
          this.totalNum = resp.curUser.userJfRecord.pageInfo.total || 0;
        }).catch(e => {
          console.warn(e);
        })
      },
    },
    components: {
      MoPaging
    }
  };
</script>