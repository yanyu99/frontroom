<template>
  <!-- V1 不显示讲师信息  v2显示讲师信息  v3可以点赞但只能给当前的讲师投票，其他无效-->
  <div class="menu-box" id="TEACHER">
    <div class="menu-main">
      <div class="menu-contain">
        <div id="root" class="root">
          <menu class="menu_tab list" id="list_teacher">
            <a v-for="(item,index) in roomInfo.teachersList" :key="item.tid" :id="item.tid" :class="{'active':indexShow ==index}">{{item.name}}</a>
            <!-- <a>>></a> -->
          </menu>
        </div>
        <div class="menu_tab_content">
          <!--start-->
          <div class="tab-con" v-for="(item,index) in roomInfo.teachersList" :key="item.tid" v-show="indexShow == index">
            <!-- 信息部分 -->
            <div class="teacherinfo-box weui-media-box_appmsg" v-if="baseConfig.eventcfg.agree_opend != 2">
              <div class="weui-media-box__hd">
                <img class="teacher-img" :src="item.imgurl ? item.imgurl : '/assets/v3/images/phone/teacher.png' " alt>
              </div>
              <div class="weui-media-box__bd">
                <label class="teacher-lb_title">{{item.j_name}}</label>
                <div class="teacher-p_desc" v-html="item.introduction"></div>
              </div>
            </div>

            <!-- 点赞部分 -->
            <template v-if="baseConfig.eventcfg.agree_opend">
              <div class="teacher-zan-info">
                <div class="teacher-zan-left">
                  <p class="teacher-p-remark">喜欢{{item.name}}，就给他点个赞吧！</p>

                  <div class="div-progress">
                    <div class="div-progress_bar">
                      <div class="inner-bar" :style="{'width':item.base && ((item.total+item.total_base)*100/item.base < 100)?
                         (item.total+item.total_base)*100/item.base+'%' :'100%'  }"></div>
                    </div>
                  </div>
                  <p v-if="baseConfig.eventcfg.agree_opend == 1">今日获赞：{{item.today+item.today_base}} 累计获赞：{{item.total+item.total_base}}</p>
                </div>
                <div style="margin-left:10px;">
                  <span class="sp-zan" @click.stop="specialist_vote(item)">
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
  </div>
</template>
<style scoped>
  .menu-box {
    padding: 15px 10px;
    width: 98%;
    border-radius: 6px;
    background: #fff;
  }

  .menu-main {}

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

  .menu-contain {}

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
    padding: 15px;
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
    height: 246px;
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
    font-size: 28px;
    color: #0099cc;
    text-align: center;
  }

  .teacher-p_desc {
    color: #6b6b6b;
    font-size: 22px !important;
    line-height: 1.2;
    height: 196px;
    overflow-y: scroll;
  }

  .teacher-p_desc p {
    color: #6b6b6b;
    font-size: 22px !important;
    line-height: 1.2;
  }

  .teacher-p_desc p span {
    font-size: 20px !important;
  }

  .menu_tab {
    height: 70px;
    line-height: 70px;
    padding: 0px 10px;
    border-bottom: 1px solid #fe9901;
  }

  .menu_tab a {
    font-size: 28px;
    font-weight: bold;
    display: inline-block;
    padding: 0px 8px;
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
    color: #333333;
    font-size: 24px;
  }

  .div-progress {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    margin: 10px 0px;
  }

  .div-progress_bar {
    background-color: #ebebeb;
    height: 30px;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .inner-bar {
    width: 0;
    height: 100%;
    background-color: #fe9901;
  }

  .teacher-zan-info {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .teacher-zan-left {
    /* background-color: #ebebeb; */
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .sp-zan {
    display: inline-block;
    width: 69px;
    height: 69px;
    border-radius: 69px;
    background-color: #ff6600;
    text-align: center;
    line-height: 69px;
    vertical-align: middle;
  }

  .sp-zan img {
    width: 38px;
    height: 43px;
    margin: 0 auto;
    line-height: 43px;
    padding: 5px 6px;
  }

  /*=============滑动===*/

  #root {
    height: 70px;
    width: 700px;
    white-space: nowrap;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    white-space: nowrap;
    position: relative;
    margin-bottom: 1px solid #e7e7e7;
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
    position: absolute;
    left: 0;
    top: 0;
    /*width: 100%;*/
    /*不能为100%，不然宽度只有父容器的宽度*/
    transition: all 1s;
    height: 100%;
    line-height: 2.5;
  }

  .list li {
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
  }

  /*==================================================*/

  /* .vl-notify {
    top: auto;
    bottom: 0px !important;
  } */
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
      var self = this;
      $("#root").wait(function () {
        var slide = new Slide();
        $("#list_teacher a").on("click", function () {
          self.indexShow = $(this).index();
          slide.changeActive($(this).index());
        });

        $("#list_teacher").on("touchstart", function (e) {
          $("#list_teacher").css({ "transition-duration": "0s" });
          slide.getTransfrom();
          var touchestartEv = e || event;
          slide.startX = touchestartEv.originalEvent.touches[0].clientX; // touchestartEv.touches[0].clientX;
        });

        $("#list_teacher").on("touchmove", function (ev) {
          var touchmoveEv = ev || event;
          var moveX = touchmoveEv.touches[0].clientX;
          var translateX = slide.startX - moveX;
          console.log("translateX======" + translateX);
          slide.translate3dX = slide.startTranform + -translateX;
          slide.boundaryCondition();
          console.log(slide.startTranform);
          $("#list_teacher").css({
            transform: "translate3d(" + slide.translate3dX + "px,0,0)"
          });
        });
      });
    },

    methods: {
      specialist_vote(item) {
        dms.LiveApi.sendAgree({ tid: item.tid, v: this.baseConfig.eventcfg.agree_opend },
          res => {
            this.dialogMsgAlign("点赞成功！");
            this.$store.commit(types.UPDATE_ROOM_INFO, {
              teachersZan: {
                total: res.total,
                base: res.base,
                today: res.today
              }
            });
          },
          resp => {
            this.dialogMsgAlign(resp.msg);
          }
        );
      }
    }
  };
</script>