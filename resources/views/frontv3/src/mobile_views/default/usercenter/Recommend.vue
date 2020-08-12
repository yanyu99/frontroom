<template>
  <div style="background:#f1f1f1;">
    <div class="rec_head">
      <router-link :to=" '/usermain'" class="_back">
        <div class="back" style="background: url('/assets/img/user/arrowL.png') center center no-repeat;background-size: contain;float:left; "></div>
        <div class="title">推广记录</div>
      </router-link>
    </div>

    <div class="demo-wrapper">
      <div class="list_type">
        <ul>
          <li>被推广人账号</li>
          <li>昵称</li>
          <li>推广时间</li>
        </ul>
      </div>
      <div class="demo-inner list">
        <ul>
          <li v-for="(item,index) in dataList" :key="index">
            <span>{{item.uid}}</span>
            <span>{{item.name}}</span>
            <span>{{item.created_at}}</span>
          </li>
        </ul>
        <infinite-loading @infinite="infiniteHandler">
          <span slot="no-more">加载完毕</span>
          <span slot="no-results">暂无数据</span>
        </infinite-loading>
      </div>
    </div>
  </div>
</template>
<style scoped>
  #div-iscroll {
    position: absolute;
    bottom: 0px;
    top: 1.1733rem;
    width: 100%;
    overflow-y: auto;
    overflow-x: hidden;
  }

  html,
  body,
  p {
    padding: 0;
    margin: 0;
    border: 0;
    font-family: "微软雅黑";
    font-size: 0.1867rem;
  }

  a {
    text-decoration: none;
  }

  html,
  body {
    background-color: #f1f1f1;
  }

  .rec_head {
    width: 100%;
    height: 1.1733rem;
    display: flex;
    display: -webkit-flex;
    -webkit-align-items: center;
    padding: 0 0 0 0.32rem;
    background-color: #fff;
  }

  .rec_head ._back {
    display: block;
  }

  .rec_head>a:visited {
    text-decoration: none;
  }

  .rec_head>a:link {
    text-decoration: none;
  }

  .rec_head ._back .back {
    float: left;
    width: 0.4533rem;
    height: 0.6533rem;
    margin-top: 0.2667rem;
  }

  .rec_head .title {
    width: 2.5rem;
    height: 1.1733rem;
    font-size: 0.4533rem;
    color: #3b3b3b;
    text-align: center;
    line-height: 1.1733rem;
    margin-left: 0.2rem;
  }

  .rec_content {
    width: 100%;
    height: auto;
    margin-top: 0.2667rem;
  }

  .rec_content table .head {
    width: 100%;
    height: 1.0133rem;
    background: #f1f1f1;
    border-top: 2px solid #dedede;
  }

  .rec_content table .head>th {
    width: 33.3%;
    height: 1.0133rem;
    font-size: 0.4rem;
    color: #101010;
    text-align: center;
    line-height: 1.0133rem;
  }

  .rec_content table .cont {
    width: 100%;
    height: 1.0933rem;
    background-color: #fff;
    border-top: 2px solid #dedede;
  }

  .rec_content table .cont:last-child {
    border-bottom: 2px solid #dedede;
  }

  .rec_content table .cont>td {
    width: 33.3%;
    height: 1.0933rem;
    font-size: 0.3467rem;
    color: #464646;
    text-align: center;
  }

  .list_type {
    margin-top: 10px;
    width: 100%;
    display: flex;
  }

  .list_type ul {
    display: flex;
    flex-direction: row;
    width: 100%;
  }

  .list_type ul li,
  .list_type,
  .list ul li {
    background-color: #fff;
  }

  .list ul li {
    vertical-align: middle;
    zoom: 1;
    border-bottom: 1px solid #e8e8e8;
  }

  .list ul li:first-child {
    border-top: 1px solid #e8e8e8;
  }

  .list_type ul li,
  .list ul li span {
    width: 33%;
    height: 100px;
    line-height: 100px;
    text-align: center;
    float: left;
    display: inline-block;
    font-size: 30px;
  }

  .pagemsg {
    font-size: 28px;
  }

  .demo-inner {
    height: 1100px;
    overflow: auto;
    margin-bottom: 10px;
    width: 100%;
  }

  .demo-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
</style>
<script>
  import * as types from "@/store/types";
  import InfiniteLoading from "vue-infinite-loading";
  export default {
    data() {
      return {
        page: 1,
        pageSize: 10,
        dataList: [],
      };
    },
    methods: {
      infiniteHandler($state) {
        setTimeout(() => {
          this.page += 1;
          types.userRecommenderSelect({
            recommender_id: parseInt(this.userInfo.uid),
            page: this.page,
            num: this.pageSize
          }, res => {
            var _tmpObj = res.data.curUser.userList;
            if (_tmpObj.length) {
              this.dataList = this.dataList.concat(_tmpObj.rows);
              $state.loaded();
            } else {
              $state.complete();
            }
          }, res => {
            $state.complete();
          });
        }, 1000);
      }
    },
    components: {
      InfiniteLoading
    }
  };
</script>