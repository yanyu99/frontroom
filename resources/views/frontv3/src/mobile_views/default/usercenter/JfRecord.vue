<template>
  <div style="background:#f1f1f1;">

    <div class="rec_head">
      <router-link :to=" '/usermain'" class="_back">
        <div class="back" style="background: url('/assets/img/user/arrowL.png') center center no-repeat;background-size: contain;float:left; ">
        </div>
        <div class="title">
          我的{{baseConfig.textcfg.jf_txt_tit}}
        </div>
      </router-link>

    </div>
    <div class="rec_content">
      <div class="rec_title">
        当前可用{{baseConfig.textcfg.jf_txt_tit}}
        <span>{{ jf_cur}}</span>
          送礼{{baseConfig.textcfg.jf_txt_tit}}
          <span>{{jf_giftsend}}</span>
      </div>
    </div>

    <div class="demo-wrapper">
      <div class="nav_type">
        <span class="sp-num">{{baseConfig.textcfg.jf_txt_tit}}</span>
        <span class="sp-ty">类别</span>
        <span class="sp-dsc">描述</span>
        <span class="sp-time">时间</span>
      </div>
      <div class="demo-inner">
        <div style=" ">
          <ul>
            <li v-for="(item,index) in dataList" :key="index">
              <span class="sp-num">{{item.jf_num}}</span>
              <span class="sp-ty">{{item.jf_num ? '增加' :'消耗'}}</span>
              <span class="sp-dsc">{{item.jf_note}}</span>
              <span class="sp-time">{{item.created_at}}</span>
            </li>
          </ul>
          <infinite-loading @infinite="infiniteHandler">
            <span slot="no-more">
              加载完毕
            </span>
            <span slot="no-results">
              暂无数据
            </span>
          </infinite-loading>

        </div>
      </div>
    </div>

  </div>
</template>
<style scoped>
  .demo-inner li {
    display: flex;
  }

  .demo-inner span,
  .nav_type span {
    text-align: center
  }

  .sp-num {
    width: 13%;
  }

  .sp-ty {
    width: 15%
  }

  .sp-dsc {
    width: 40%;
    overflow: hidden
  }

  .sp-time {
    width: 30%;
    overflow: hidden
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

  .rec_title {
    width: 100%;
    height: 1.44rem;
    background-color: #fff;
    color: #949595;
    font-size: 0.4533rem;
    line-height: 1.44rem;
    padding-left: 0.6rem;
  }

  .rec_title>span {
    color: #fc7700;
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
    margin-top: 0.2667rem;
    width: 0.4533rem;
    height: 0.6533rem;
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
    width: 15%;
    height: 1.0133rem;
    font-size: 0.4rem;
    color: #101010;
    text-align: center;
    line-height: 1.0133rem;
  }

  .rec_content table .head>th:nth-child(1) {
    width: 15%;
  }

  .rec_content table .head>th:nth-child(2) {
    width: 15%;
  }

  .rec_content table .head>th:nth-child(3) {
    width: 30%;
  }

  .rec_content table .head>th:nth-child(4) {
    width: 30%;
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
    width: 15%;
    height: 1.0933rem;
    font-size: 0.3467rem;
    text-align: center;
  }

  #div-iscroll {
    position: absolute;
    bottom: 0px;
    top: 2.6133rem;
    width: 100%;
    overflow-y: auto;
    overflow-x: hidden;
  }

  body {
    margin: 0;
  }

  .example-list-item {
    margin: 0;
    padding: 0 10px;
    font-size: 14px;
    line-height: 40px;
    color: #666;
    background-color: #fafafa;
    border-top: 1px solid #fff;
    border-bottom: 1px solid #e3e3e3;
  }

  .example-list-item::before {
    content: "Line: ";
  }

  .demo-wrapper {}

  .demo-inner {
    height: 1000px;
    overflow: auto;
    margin-bottom: 10px;
  }

  .demo-inner ul li {
    margin: 0;
    padding: 0 15px;
    font-size: 26px;
    line-height: 50px;
    color: #666;
    background-color: #fafafa;
    border-top: 1px solid #fff;
    border-bottom: 1px solid #e3e3e3;
  }

  .demo-inner ul li:last-child {
    border-bottom: none;
  }

  .demo-inner ul li span {
    display: inline-block;
    margin-right: 7px;
    font-size: 26px;
  }

  .demo-inner ul li span:first-child {
    width: 60px;
  }

  .nav_type {
    background: #fff;
    margin-top: 10px;
    margin-bottom: 1px;
    display: flex;
  }

  .nav_type span {
    height: 100px;
    line-height: 100px;
    font-size: 30px;
    text-align: center;
    display: inline-block;
  }
</style>

<script>
  import * as types from '@/store/types'
  import InfiniteLoading from 'vue-infinite-loading';

  export default {
    data() {
      return {
        page: 0,
        pageSize: 10,
        dataList: [],

        jf_cur: 0,
        jf_giftsend: 0
      }
    },
    created() {
      types.userExtSelect({}, resp => { 
        this.jf_cur =
          (resp.curUser.ext && resp.curUser.ext.jf_cur) || 0;
        this.jf_giftsend =
          (resp.curUser.ext && resp.curUser.ext.jf_giftsend) || 0;
      })
    },
    methods: {
      infiniteHandler($state) {
        setTimeout(() => {
          this.page += 1;
          types.userJfRecordSelect({
            page: this.page,
            num: this.pageSize
          }).then(resp => {
            if (resp.curUser.userJfRecord.rows.length) {
              this.dataList = this.dataList.concat(resp.curUser.userJfRecord.rows);
              $state.loaded();
            } else {
              $state.complete();
            }
          }).catch(e => {
            $state.complete();
            console.warn(e);
          })
        }, 1000);
      },
    },
    components: {
      InfiniteLoading,
    },
  }
</script>