<template>
  <!-- V1 不显示讲师信息  v2显示讲师信息 -->
  <div class="menu-box" id="TEACHER">
    <div class="menu-main">
      <div class="menu-contain">
        <div id="root" class="root">
          <menu class="menu_tab list" id="list_teacher">
            <a v-for="(item,index) in roomInfo.teachersList" :key="item.tid" :id="item.tid"  :class="{'active':indexShow ==index}">{{item.name}}</a>
          </menu>
        </div>
        <div class="menu_tab_content">
          <!--start-->
          <div class="tab-con" v-for="(item,index) in roomInfo.teachersList" :key="item.tid" v-show="indexShow == index">
            <!-- 信息部分 -->
            <div class="teacherinfo-box weui-media-box_appmsg" v-if="baseConfig.eventcfg.agree_opend != 2">
              <div class="weui-media-box__hd" v-if="item.imgurl">
                <img class="teacher-img" :src="item.imgurl ? item.imgurl : '/assets/v3/images/phone/teacher.png' " alt>
              </div>
              <div class="weui-media-box__bd">
                <label class="teacher-lb_title">{{item.j_name}}</label>
                <div class="teacher-p_desc  p_scroll" v-html="item.introduction"></div>
              </div>
            </div>

            <!-- 点赞部分 -->
            <template v-if="baseConfig.eventcfg.agree_opend && baseConfig.eventcfg.agree_opend != 3">
              <div class="teacher-zan-info">
                <div class="teacher-zan-left">
                  <p class="teacher-p-remark">喜欢{{item.name}}，就给他点个赞吧！</p>

                  <div class="div-progress">
                    <div class="div-progress_bar">
                      <div class="inner-bar" :style="{'width':item.base && ((item.total+item.total_base)*100/item.base < 100)?
                         (item.total+item.total_base)*100/item.base+'%' :'100%'  }"></div>
                    </div>
                  </div>
                  <p style="color: #a4a4a4;font-size: 14px;padding-top: 26px;" v-if="baseConfig.eventcfg.agree_opend == 1">今日获赞：{{item.today+item.today_base}} 累计获赞：{{item.total+item.total_base}}</p>
                </div>
                <div style="margin-left:10px;flex:1">
                  <span class="sp-zan" @click="specialist_vote(item)">
                    <img src="/assets/v3/images/phone/icon_zan.png">
                  </span>
                </div>
              </div>
            </template>
          </div>
          <!--end-->
        </div>
      </div>
    </div>
    <div class="close-layer" @click="closeLayer">×</div>
  </div>
</template>
<style scoped>
  .menu-box {
    width: 98%;
    border-radius: 6px;
  }

  .menu-main {
    width: 100%;
    height: 100%;
    border: 1px solid #002e66;
    overflow: hidden;
    padding: 18px;
  }

  .menu-main .p-tit {
    display: inline-block;
    color: #fe9901;
    font-size: 20px;
    font-weight: 700;
    text-align: center;
    height: 50px;
    line-height: 50px;
    vertical-align: middle;
    border-bottom: 1px solid #fe9901;
    width: 100%;
  }

  .menu-contain {
    border: 1px solid #002e66;
  }

  .menu-contain ul {
    position: relative;
    overflow: hidden;
  }

  /* =====================公共部分 end==================*/

  a.weui-media-box {
    color: #000000;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  }

  .weui-media-box_appmsg {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .teacherinfo-box {
    padding: 20px;
    position: relative;
  }

  .weui-media-box_appmsg .weui-media-box__hd {
    margin-right: 0.8em;
    width: 196px;
    height: 246px;
    line-height: 246px;
    text-align: center;
  }

  .weui-media-box_appmsg .teacher-img {
    width: 100%;
    max-height: 100%;
    vertical-align: top;
  }

  a img {
    border: 0;
  }

  .weui-media-box_appmsg .weui-media-box__bd {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
    min-width: 0;
    height: 288px;
  }

  .teacher-lb_title {
    font-weight: 400;
    width: auto;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    word-wrap: normal;
    word-wrap: break-word;
    word-break: break-all;
    font-size: 18px;
    color: #0099cc;
    text-align: center;
  }

  .teacher-p_desc {
    color: #6b6b6b;
    font-size: 14px;
    line-height: 2;
    overflow-y: scroll;
    height: 214px;
  }

  .menu_tab {
    height: 35px;
    line-height: 35px;
    padding: 0px 10px;
    border-bottom: 1px solid #fe9901;
  }

  .menu_tab a {
    border-right: 1px solid #194474;
    float: left;
    position: relative;
    left: 0;
    top: 0;
    padding: 0px 20px;
    cursor: pointer;
  }

  a.active {
    color: #fe9901;
  }

  a,
  a:active,
  a:hover {
    text-decoration: none;
  }

  .active {
    color: #fe9901;
  }

  .teacher-p-remark {
    color: #666;
    font-size: 18px;
    height: 34px;
    text-align: left;
  }

  .div-progress {
    width: 90%;
  }

  .div-progress_bar {
    background-color: #ebebeb;
    height: 15px;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .inner-bar {
    background: #ecbd00;
    height: 100%;
    width: 80%;
    float: left;
    height: 21px;
  }

  .teacher-zan-info {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    padding: 33px 20px;
  }

  .teacher-zan-left {
    -webkit-box-flex: 4;
    -webkit-flex: 4;
    flex: 4;
  }

  .sp-zan {
    display: inline-block;
    width: 61px;
    height: 61px;
    border-radius: 50%;
    background-color: #ff6600;
    text-align: center;
    line-height: 55px;
    vertical-align: middle;
    padding-top: 12px;
    cursor: pointer;
  }

  .sp-zan img {
    width: 39px;
    height: 41px;
    margin: 0 auto;
    padding: 5px 6px;
    vertical-align: top;
  }

  /*=============滑动===*/

  #root {
    background: #162b40;
    color: #fff;
    font-size: 18px;
    height: 48px;
    line-height: 48px;
    text-align: center;
  }

  .root:before {
    display: block;
    content: "";
    width: 20px;
    height: 100%;
    position: absolute;
    top: 0;
  }

  .list {
    transition: all 1s;
    height: 48px;
    line-height: 2.5;
  }

  .list li {
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
  }

</style>
<style>
  #TEACHER {
    width: 920px;
    height: auto;
    background: #ebf1f7;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        indexShow: 0
      };
    },
    mounted() {
      var id = this.roomInfo.curlayer_pop_id; //当前弹出层的id
      $("#" + id)
        .find(".vl-notice-title")
        .hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).css({
        height: "526px"
      });
      $("#" + id)
        .find(".vl-notify-content")
        .addClass("padding-style");

      var self = this;
      $("#root").wait(function () {
        var slide = new Slide();
        $("#list_teacher a").on("click", function () {
          self.indexShow = $(this).index();
        });
      });
    },

    methods: {
      specialist_vote(item) {
        dms.LiveApi.sendAgree({ tid: item.tid },
          res => {
            this.dialogMsgAlign(this.baseConfig.hotcfg.vote_title + "成功");
            this.$store.commit(types.UPDATE_ROOM_INFO, {
              teachersZan: {
                total: res.total,
                base: res.base,
                today: res.today
              }
            });
          }, resp => {
            this.dialogMsgAlign(resp.msg);
          }
        );
      },
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>