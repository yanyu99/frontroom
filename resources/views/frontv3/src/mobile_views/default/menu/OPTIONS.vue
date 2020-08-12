<template>
  <div class="menu-box" id="OPTIONS">
    <div class="menu-main" v-if="!isLoadingData">
      <span>
        <p class="p-tit">操作建议</p>
      </span>
      <template v-if="!userInfo.role.f_manual ">
        <comm-qq :qqData="qqMap.CHAT" qqts="暂无权限查看此内容，如有疑问，请联系客服。"></comm-qq>
      </template>
      <template v-else>
        <div class="menu-contain">
          <template v-if="!isDataLoading && dataList.length == 0">
            <ul class="contain-ul">
              <li>暂无数据！</li>
            </ul>
          </template>
          <template v-else>
            <ul class="contain-ul ">
              <li>
                <span class="sp-tit">标题</span>
                <span class="sp-status">状态</span>
                <span class="sp-category">品种</span>
                <span class="sp-direction">方向</span>
              </li>

              <li v-for="(item,index) in dataList" :key="index">
                <span class="sp-tit">{{item.title}}</span>
                <span class="sp-status">{{item.manual_type}}</span>
                <span class="sp-category">{{item.variety}}</span>
                <span class="sp-direction">{{item.mr_mc=="1" ?'买进':'卖出'}}</span>
              </li>
            </ul>
            <p class="p-remark">以上仅为研究部观点，不作为具体操作建议，据此操作盈亏自负，股市有风险，投资需谨慎！</p>
          </template>
        </div>
      </template>
    </div>
    <div class="loading-layer" v-if="isLoadingData">
      <span></span>
    </div>

  </div>
</template>
<style scoped>
  .menu-box {
    padding: 15px 10px;
    background: #fff;
    border-radius: 6px;
    height: 600px;
    overflow: scroll;
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

  .menu-contain {
    margin-top: 10px;
  }

  .menu-contain ul {
    position: relative;
    overflow: hidden;
  }

  .menu-contain ul li {
    position: relative;
    float: left;
    box-sizing: border-box;
    text-align: center;
    margin: 0 auto;
    text-align: center;
    position: relative;
  }

  /* =====================公共部分 end==================*/

  .list ul li {
    vertical-align: middle;
    zoom: 1;
    border-bottom: 1px solid #e8e8e8;
    width: 100%;
  }

  .contain-ul li {
    height: 60px;
    line-height: 60px;
    vertical-align: middle;
    zoom: 1;
    border-bottom: 1px solid #e8e8e8;
    width: 100%;
  }

  .contain-ul li span {
    display: inline-block;
    font-size: 28px;
    color: #333333;
    height: 30px;
    line-height: 30px;
    vertical-align: middle;
    text-align: center;
  }

  .sp-tit {
    width: 30%;
  }

  .sp-status {
    width: 20%;
  }

  .sp-category {
    width: 30%;
  }

  .sp-direction {
    width: 10%;
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
    font-size: 24px;
    text-align: center;
    color: red;
    margin-bottom: 10px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/mobile_views/_/menu/CommQq";
  export default {
    data() {
      return {
        dataList: [],
        isLoadingData: false
      }
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap])
    },
    created() {
      this.getData();
    },
    methods: {
      getData() {
        this.isDataLoading = true;
        types.tradeManualListSelect({
          page: 1,
          num: 10
        }).then(resp => {
          this.dataList = resp.data.room.tradeManualList.rows || [];
        }).catch(e => {
          this.dataList = this.dataList || []
          console.warn(e);
        }).finally(() => {
          this.isDataLoading = false;
        })
      },
    },
    components: {
      CommQq
    }
  }
</script>