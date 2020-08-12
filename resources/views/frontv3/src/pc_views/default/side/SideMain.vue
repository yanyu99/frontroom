<template>
  <div class="main-sider-menu bor-left " v-show="parseInt(siderW) " :style="{'width':siderW+'px'}">
    <div class="side-login-warp" v-if="parseInt(baseConfig.blockcfg.show_siderlogin || 0)" :style="{'height':$t('123##侧边栏登录的高度',__FILE__)+'px','order':$t('1##登录模块位置',__FILE__)}">
      <span class="side-logo" :style="{'background':  $c('rgba(0,0,0,0.8)##侧边栏登录logo颜色透明度',__FILE__)}">
        <img v-if="baseConfig.pagecfg.logo.length" class="main-logo" :src="baseConfig.pagecfg.logo" alt="logo">
      </span>
      <div class="side-login-body" :style="{'background': 'rgba(0,0,0,'+$t('60##侧边栏登录模块透明度', __FILE__)/100+')'}">
        <side-login></side-login>
      </div>
    </div>

    <div class="sider-hot-rank bor-top votelist" v-if="parseInt(baseConfig.eventcfg.hot_opend || 0)" :style="{'order':$t('2##投票排行榜位置',__FILE__),'height':$t('227##人气榜内容高度', __FILE__)+'px'}">
      <div class="hot-rank-head" :style="{'background-color': $c('rgba(0,0,0,0.7)##人气榜标题栏颜色值透明度',__FILE__)}">
        <img :src=" '/assets/img/renqi.png' " style="width: 212px;" />
      </div>
      <div class="hot-rank-body" :style="{'position': 'relative','background-color':  $c('rgba(0,0,0,0.5)##人气榜内容颜色值透明度',__FILE__)}">
        <ul id="idHotRank" class="nice-scroll-h">

          <li v-for="(item,index) in roomInfo.hotRank.teacherList" :key="item.index" :class="['ter-hot-li',{'ter-fired':item.fired}]">
            <div class="ph-num" :style="lbIndStyle(index) ">
              {{index+1}}
            </div>
            <span class="teacher-name" style="position: relative;">
              <span :i-color="item.name_color" :style="{color: item.name_color !='#ffffff'|| item.name_color !='#FFFFFF' ?item.name_color :'#fff' }">
                <template v-if="item.name_bold">
                  <b>{{item.name}}</b>
                </template>
                <template v-else>{{item.name}}</template>
              </span>
              <span class="num">(
                <span class="hot-rank-num">{{item.hide_vote_num ? '*' : (item.hot_base +item.hot_got) }}</span>)</span>
              <template v-if="!item.fired ">
                <img v-if="item.rank == 1" :src="$m('/assets/img/third-rk.png##人气榜亚军图标',__FILE__)" class="rank-img">
                <img v-if="item.rank == 2" :src="$m('/assets/img/second-rk.png##人气榜季军图标',__FILE__)" class="rank-img">
                <img v-if="item.rank == 3" :src="$m('/assets/img/champion-rk.png##人气榜冠军图标',__FILE__)" class="rank-img">
              </template>
            </span>

            <span v-if="!item.fired && !item.rank" class="zan_teacher" :class="{'zan': (roomInfo.hotRank.userTidMap[item.tid] && !userInfo.role.f_no_vote_limit)}" @click="zanClick(item.tid,$event)" :style="{'background-color':$c('transparent##点赞按钮的背景颜色',__FILE__)}">
              {{vote_title}}
            </span>
            <div class="hot-income" v-if="item.add_info" :style="{color:item.add_info_color}">{{item.add_info}} </div>
          </li>
        </ul>
      </div>
    </div>

    <!--TODO  <leave-list :style="{'order':$t('3##留言排行榜位置',__FILE__)}"></leave-list> -->
    <!-- <teacher-judge v-if="!parseInt(baseConfig.sitecfg.teacher_judge_opend)" :style="{'order':$t('4##讲师评价位置',__FILE__)}"></teacher-judge> -->

    <div class="sider-top-new" v-if="innerMenus.filter(i=>i.pos == 3).length" :style="{'background-color': $c('rgba(0,0,0,0.5)##侧边导航栏颜色值透明度',__FILE__),'order':$t('5##侧边栏导航位置',__FILE__)}">
      <common-nav :navMenuArr="innerMenus.filter(i=>i.pos ==3)" :classname=" 'room-nav-side'"></common-nav>
    </div>

    <div class="sider-top" v-if="baseConfig.extcfg.stock_code.length" :style="{'order':$t('6##侧边栏股票代码位置',__FILE__),'background-color': $c('rgba(0,0,0,0.5)##股票整体颜色值透明度',__FILE__)}">
      <div class="title stock-tit" :style="{'background-color': $c('rgba(0,0,0,0.8)##股票头部颜色值透明度',__FILE__)}">
        <img :src="$m('/assets/img/stockIco.png##侧边栏股票title图标', __FILE__)">
        <span style="margin-left: 5px;">{{$t("行情动态##行情动态文本",__FILE__)}}</span>
      </div>

      <div class="body stock-body nice-scroll-h">
        <template v-if="!dataList.length ">
          <div class="guzhi-item" v-for="item in dataList.length" :key="item">
            <span class="name">加载中</span>
            <div style="float: right;">
              <span class="num"></span>
              <span class="per-num"></span>
            </div>
          </div>
        </template>
        <template v-else>
          <template v-for="(item,index) in getData">
            <div :key="index" class="guzhi-item" :style="{'background-color': $c('rgba(0,0,0,0.8)##股票内容颜色值透明度',__FILE__)}">
              <span class="name"> {{item.name ? item.name : '加载中'}}</span>
              <div style="float: right;">
                <span class="num" :class="{'green':item.change<0,'red':item.change >0,'gray':item.change == 0}">{{ !isNaN(item.price) ? item.price :' 00.0' }}</span>
                  <span class="per-num" :class="{'green_Bg':item.change<0,'red_Bg':item.change >0,'gray_Bg':item.change == 0}">{{ !isNaN(item.per)?item.per + '%' : '0%'}}</span>
              </div>
            </div>
          </template>
        </template>
      </div>
      <div class="bottom bottom_down" v-if="dataList.length>3" :style="{'background-color': $c('rgba(0,0,0,0.5)##股票尾部颜色值透明度',__FILE__)}" @click="changeBottom">
        <img :src="$m('assets/img/page_ic/arrow_down.png##侧边栏股票向下更多图片', __FILE__)" alt="" :style="{'transform':!this.is_showmore_stock?'rotate(360deg)':'rotate(180deg)'}">
      </div>
    </div>

    <div v-if=" parseInt(baseConfig.blockcfg.show_siderewm) " class="sider-ewm" :style="{'background-color': $c('rgba(0,0,0,0.5)##二维码头部颜色值透明度',__FILE__),'order':$t('7##侧边栏二维码位置',__FILE__)}">
      <img v-if="baseConfig.popcfg.wechat_img.length" :src="baseConfig.popcfg.wechat_img">
      <p v-else style="margin: auto;padding: 10px;padding-bottom: 7px; background-color: #fff;" id="qrcode1"></p>
    </div>

    <user-list v-if="parseInt(baseConfig.blockcfg.show_siderlist)" :style="{'order':$t('8##用户列表位置',__FILE__)}"></user-list>

    <div class="sider-teacher" v-if="parseInt(baseConfig.blockcfg.show_siderteacher || 0)" :style="{'order':$t('9##侧边栏讲师团队位置',__FILE__),'height':$t('100##讲师团队的高度',__FILE__)+'px'}">
      <div class="st-title" :style="{'background-color': $c('rgba(0,0,0,0.7)##讲师团队头部颜色值透明度',__FILE__)}">
        <span class="st-title-main">{{baseConfig.textcfg.ter_title}}</span>
        <span class="st-title-btn" :class="{'active':roomInfo.teachersList.length<=4}">{{$t("换一换##讲师切换文本",__FILE__)}}</span>
      </div>
      <div class="st-list" :style="{'background-color': $c('rgba(0,0,0,0.5)##讲师团队内容颜色值透明度',__FILE__)}">
        <div class="overflow">
          <ul>
            <li v-for="item in roomInfo.teachersList" :key="item.tid" class="st-item">
              <a href="#">
                <img :src="item.imgurl ?item.imgurl : '/assets/icon/ter_default.png'" />
                <p style="color:#fff;">{{item.name}}</p>
              </a>
              <div class="ts-info ">
                <h1>{{item.name}}</h1>
                <span class="nice-scroll-h" style="white-space: pre-wrap" v-html="item.introduction"></span>
                <div class="ts-zan">

                  <p>今日点赞数：
                    <span class="data-today">{{item.today+item.today_base}}</span>
                    &nbsp;&nbsp;累计：
                    <span class="data-total">{{item.total+item.total_base}}</span>
                  </p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</template>
<style scoped>
  .main-sider-menu {
    display: flex;
    flex-direction: column;
  }

  .votelist {
    display: flex;
    flex-direction: column;
  }


  .side-login-warp .side-logo {
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .side-logo {
    display: block;
    height: 60px;
  }

  .side-logo img {
    width: 100%;
  }

  .side-login-body {
    height: 64px;
  }

  .main-logo {
    margin-top: 5px;
    height: 60px;
  }

  .avatar {
    top: -1px;
    left: 7px;
    position: absolute;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    vertical-align: middle;
  }

  .main-logo {
    width: auto;
    height: 50px;
    float: left;
    margin-right: 10px;
    display: block;
  }

  .main-sider-menu div:nth-child(1) {
    margin-top: 0px !important;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .sider-hot-rank {
    display: flex;
    flex-direction: column;

  }

  .hot-rank-head {
    display: flex;
    height: 48px;
  }

  .hot-rank-body {
    display: flex;
    flex: 1;
  }

  .hot-rank-body ul {
    width: 100%;
  }

  .zan_teacher {
    cursor: pointer;
  }

  .fired-img {
    background: url("/assets/img/fire.png") no-repeat center;
    width: 47px;
    height: 30px;
    position: absolute;
    top: 0px;
    left: 55px;
  }

  .rank-img {
    position: absolute;
    right: -44px;
  }

  .ter-fired {
    background: url(/assets/img/firebtn.png);
    background-repeat: no-repeat;
    background-position: right 0px;
  }

  .sider-hot-rank li {
    border-bottom: 0.5px solid;
    border-bottom-color: rgba(255, 255, 255, 0.4);
  }

  .hot-rank-body {
    overflow: hidden;
  }

  .sider-top-new ul li {
    cursor: pointer;
    text-align: center;
    height: 61px;
  }

  .sider-top-new {
    margin-top: 3px;
    margin-bottom: 0px;
    padding-left: 0px;
    display: flex;
    flex-direction: row;
  }

  .sider-top-new a {
    color: #fff;
  }

  .sider-top-new ul {
    text-align: center;
  }

  .sp-text {
    display: inline-block;
    width: 100%;
    height: 19px;
    line-height: 19px;
    vertical-align: middle;
    overflow: hidden;
  }

  .sider-top {
    display: flex;
    flex-direction: column;
  }

  .stock-tit {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .stock-body {
    display: flex;
    flex-direction: column;
  }

  .guzhi-item {
    justify-content: space-between;
  }

  .sider-teacher {
    position: relative;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    margin-top: 3px;
    display: flex;
    flex-direction: column;
  }

  .st-title-btn.active {
    color: #878282;
  }

  .st-title {
    height: 30px;
    line-height: 30px;
    font-size: 14px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    display: flex;
    justify-content: space-between;
  }

  .st-title-main {
    font-size: 15px;
    float: left;
    margin-left: 10px;
  }

  .st-title-btn {
    font-size: 12px;
    float: right;
    margin-right: 12px;
    cursor: pointer;
  }

  .st-list {
    padding: 5px 0;
    display: flex;
    flex: 1;
  }

  .st-list .overflow ul {
    margin-left: 0;
    height: 100%;
    white-space: nowrap;
  }

  .st-list .overflow ul>li {
    display: inline-block;
    width: 42px;
    height: 100%;
    margin-left: 8px;
    margin-right: 8px;
  }

  .st-item img {
    width: 42px;
    height: 42px;
    border-radius: 20px;
    border: 2px solid #fff;
  }

  .st-item p {
    margin-top: 3px;
    font-size: 12px;
  }

  .ts-info {
    width: 233px;
    height: 200px;
    position: absolute;
    z-index: 100;
    left: 0;
    bottom: 103px;
    background: url(/assets/img/page_ic/intrbg.jpg) center -25px no-repeat;
    background-size: cover;
    display: none;
    overflow: hidden;
  }

  .ts-info h1 {
    width: 100%;
    height: 22px;
    text-align: center;
    font-size: 20px;
    margin-top: 15px;
  }

  .ts-info>span {
    display: block;
    width: 90%;
    margin: 0 auto;
    height: 100px;
    font-size: 14px;
    overflow-y: hidden;
    outline: none;
    text-align: left;
  }

  .ts-info .ts-zan p {
    width: 100%;
    height: 35px;
    line-height: 30px;
    color: yellow;
    position: absolute;
    bottom: -10px;
    font-size: 14px;
  }

  .ts-info .ts-zan p span {
    font-size: 18px;
  }

  .overflow {
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  .teacher-name b {
    display: inline-block;
    width: auto;
    max-width: 127px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    line-height: 23px;
    vertical-align: middle;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from '@/store/types'
  import UserList from "@/pc_views/_/side/UserList"
  import SideLogin from "@/pc_views/_/side/SideLogin"
  //import LeaveList from '@/pc_views/_/side/LeaveList'
  // import TeacherJudge from "@/pc_views/_/side/TeacherJudge"
  import CommonNav from "@/pc_views/_/util/CommonNav";

  import stockNews from "@/mixins/side/stockNews"
  import teacherList from "@/mixins/side/teacherList"
  import hotrankMixin from "@/mixins/hotrankMixin"

  var _tmpSideTeacher = parseInt(baseConfig.blockcfg.show_siderteacher || 0)
  const teacherListMixin = parseInt(_tmpSideTeacher) ? teacherList : '';

  var _tmpHotRank = parseInt(baseConfig.eventcfg.hot_opend || 0)
  const hotRankListMixin = parseInt(_tmpHotRank) ? hotrankMixin : '';

  export default {
    data() {
      return {
        siderW: 0,
      }
    },
    created() {
      this.$store.dispatch(types.LOAD_RANKING_HOT)
    },
    mixins: [stockNews, teacherListMixin, hotRankListMixin],
    computed: {
      ...Vuex.mapGetters([types.innerMenus]),
    },
    mounted() {
      (this.baseConfig.blockcfg.show_siderewm && this.baseConfig.phoneUrl.length) && this.initQrCode();
      var self = this
      $(".main-sider-menu").wait(function () {
        if ($.trim($(".main-sider-menu").html()).length) {
          self.siderW = self.baseConfig.pgsizecfg.sider_w;
        } else {
          self.siderW = 0;
        }
      })
    },
    methods: {
      initQrCode() {
        var self = this;
        var _render = 'canvas';
        try {
          if (!document.createElement('canvas').getContext) {
            _render = "table";
          }
        } catch (err) {
          _render = "table";
        }
        var wid = this.baseConfig.pgsizecfg.sider_w;
        $("#qrcode1").wait(function () {
          $('#qrcode1').empty();
          $('#qrcode1').qrcode({
            render: _render,
            width: parseInt(wid) - 36,
            height: parseInt(wid) - 36,
            text: self.baseConfig.phoneUrl,
          });
        })
      },
      lbIndStyle(index) {
        var _first = $c('#ff0000##投票排序第一行的背景颜色', __FILE__);
        var _second = $c('#fa9000##投票排序第二行的背景颜色', __FILE__);
        var _third = $c('#fa9000##投票排序第三行的背景颜色', __FILE__);
        var _four = $c('#3285ED##投票排序第四行的背景颜色', __FILE__);
        var _all = $c('#3285ED##投票排序默认的背景颜色', __FILE__);
        var _valColor = '';
        if (index == 0) {
          _valColor = _first;
        } else if (index == 1) {
          _valColor = _second;
        } else if (index == 2) {
          _valColor = _third;
        } else if (index == 3) {
          _valColor = _four;
        } else {
          _valColor = _all;
        }
        return {
          backgroundColor: _valColor,
        };
      },
    },
    components: {
      UserList,
      SideLogin,
      //LeaveList,
      //TeacherJudge,
      CommonNav
    }
  }
</script>