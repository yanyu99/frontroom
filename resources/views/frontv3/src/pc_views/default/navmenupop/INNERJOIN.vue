<template>
  <div class="menu-box p_scroll" id="INNERJOIN">
    <template v-if="!isLoadingData">
      <div class="menu-contain" v-if=" userInfo.logined && dataList.length">
        <table>
          <thead class="contain-ul">
            <tr>
              <th class="sp-tit">{{$t('标题##标题备注', __FILE__)}}</th>
              <th class="sp-teacher">{{$t('推荐人##推荐人备注', __FILE__)}}</th>
              <th class="sp-status">{{$t('发布时间##发布时间备注', __FILE__)}}</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,index) in dataList" :key="index">
              <td class="sp-tit">{{item.title}}</td>
              <td class="sp-teacher">{{item.teacher ? item.teacher.name :''}}</td>
              <td class="sp-status-con">{{item.pub_at}}</td>
              <td class="sp-des" @click.stop="checkInfo(item.id)">查看</td>
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
      <template v-if="!userInfo.logined && dataList.length == 0 && qqMap.LEADIN.length >0">
        <comm-qq :qqData="qqMap.LEADIN" qqts="会员查看请登录，非会员请联系下方老师助理领取登录密码"></comm-qq>
      </template>
    </template>
    <div class="loading-layer" v-if="isLoadingData">
      <span></span>
    </div>

  </div>
</template>
<style scoped>
  #INNERJOIN {
    height: 446px;
  }

  .page-con {
    width: 100%;
    height: auto;
  }

  table {
    font-size: 13px;
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
    cursor: pointer;
    color: blue;
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
  import TEACHERINFO from "./TEACHERINFO"
  import CommQq from "@/pc_views/_/util/CommQq"

  export default {
    data() {
      return {
        pageSize: 10, //每页显示20条数据
        pageIndex: 1, //当前页码
        totalNum: 0, //总记录数
        dataList: [],
        isLoadingData: false,
        components: {
          TEACHERINFO
        },
      };
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap])
    },
    created() {
      userInfo.logined && this.getList();
    },
    methods: {
      pageChange(page) {
        this.pageIndex = page
        this.getList()
      },
      getList() {
        this.isLoadingData = true;
        types.internalInfoListSelect({
          page: this.pageIndex,
          num: this.pageSize
        }).then(resp => {
          var _tmpData = resp.data.room.internalInfoList || {};
          this.totalNum = _tmpData.pageInfo.total || 0;
          this.dataList = _tmpData.rows || [];
          this.pageSize = _tmpData.pageInfo.num || this.pageSize; //显示的条数
        }).catch(e => {
          console.warn(e);
        }).finally(resp => {
          this.isLoadingData = false;
        });
      },
      checkInfo(tid) {
        types.queryNavInternalById({ id: tid }).then(resp => {
          var _tmpInfo = resp.data.navInternalInfo || {};
          var dataInfo = _tmpInfo.content || ''

          let _id = this.$layer.iframe({
            content: {
              content: this.components.TEACHERINFO,
              parent: this,
              data: {
                args: dataInfo
              }
            },
            title: "内参详情",
          });
          //存储当前弹出框的id
          this.$store.state.roomInfo.curlayer_pop_id = _id;
        }).catch(e => {
          console.warn(e);
        })
      },
    },
    components: {
      MoPaging,
      CommQq
    },
  };
</script>