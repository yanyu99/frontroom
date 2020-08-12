<template>
  <div>
    <div class="menu-mask" @click="closeBox"></div>
    <div class="menubox " :style="{backgroundColor:$c('#000##底部弹出框背景的颜色', __FILE__)}">
      <ul class="menu-grids">
        <li v-for="item in innerMenus" :key="item.key" v-if="item.plate != 'pc'" @click=" pageHandle(item)" :data-tag=" item.tag ">
          <img :src="innerMenusArr[item.type].imgUrl || ''">
          <font :style="{color:$c('#fff##(更多功能跟菜单)弹出层文本的颜色', __FILE__)}">{{item.text}}</font>
        </li>
      </ul>
    </div>
  </div>

</template>

<style scope>
  .menu-mask {
    background-color: #000;
    opacity: 0.4;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
  }

  .menubox {
    position: absolute;
    bottom: 92px;
    left: 0px;
    width: 100%;
    z-index: 1000;
    max-height: 444px;
    overflow: scroll;
  }

  .menu-grids {
    /* position: relative;
  overflow: hidden; */
  }

  .menubox ul li {
    position: relative;
    float: left;
    padding: 15px 10px;
    width: 25%;
    box-sizing: border-box;
    text-align: center;
    margin: 0 auto;
    text-align: center;
    position: relative;
  }

  a {
    text-decoration: none;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  }

  .menubox {
    width: 100%;
  }

  .menubox ul li img {
    width: 83px;
    height: 83px;
    display: block;
    margin: 0 auto;
  }

  .menubox ul li font {
    display: inline-block;
    font-size: 24px;
    color: #fff;
    text-align: center;
    height: 30px;
    line-height: 30px;
    vertical-align: middle;
  }

  .ovfHiden {
    overflow: hidden;
    height: 100%;
  }

  /*==================vue-layer start==========================*/

  .vl-notice-title {
    display: none;
    height: 0px;
  }

  .vl-notify {
    top: 68%;
    /* bottom: -20% !important; */
  }

  .vl-notify-msg {
    background-color: #fff !important;
    color: #000 !important;
    font-size: 30px;
  }

  .vl-notify-mask {
    z-index: 400;
    background-color: #000;
    opacity: .4;
  }

  .vl-notify .loading-layer {
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    width: 100%;
    min-height: 200px;
    height: 200px;
    margin-top: 100px;
  }

  .vl-notify .loading-layer span {
    display: inline-block;
    width: 60px;
    height: 60px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #999;
    border-right: 4px solid #999;
    border-radius: 50%;
    -webkit-animation: loading 1s infinite linear;
    animation: loading 1s infinite linear;
  }
</style>
<style>
  .vl-notify .vl-notify-content {
    padding: 0px;
    height: auto !important;
  }

  .bgborder {
    background-color: transparent !important;
    border: 0 none !important;
    padding-bottom: 0px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  import QQHELPER from "@/mobile_views/_/menu/QQHELPER";
  import SHARE from "@/mobile_views/_/menu/SHARE";
  import ECO_CALENDER from "@/mobile_views/_/menu/ECO_CALENDER";
  import TEACHER from "@/mobile_views/_/menu/TEACHER";
  import NEWS from "@/mobile_views/_/menu/NEWS";
  import INNERJOIN from "@/mobile_views/_/menu/INNERJOIN";
  import PICROLL from "@/mobile_views/_/menu/PICROLL";
  import OPTIONS from "@/mobile_views/_/menu/OPTIONS";

  import FORTUNE from "@/mobile_views/_/menu/FORTUNE";
  import STOCKPOOL from "@/mobile_views/_/menu/STOCKPOOL";
  import COURSE from "@/mobile_views/_/menu/COURSE";

  import CONTASTCOURSE from "@/mobile_views/_/menu/CONTASTCOURSE";
  import INCOME from "@/mobile_views/_/menu/INCOME";
  import DFCF from "@/mobile_views/_/menu/DFCF";

  import YjLottery from "@/mobile_views/_/yjlottery/YjLottery";
  import UserVote from "@/mobile_views/_/votecon/UserVote";
  import RoomTabs from "@/mobile_views/_/menu/RoomTabs";
  import TeacherReward from "@/mobile_views/_/menu/TeacherReward";
  export default {
    data() {
      return {
        innerMenusArr: {},
        components: {
          QQHELPER,
          SHARE,
          ECO_CALENDER,
          TEACHER,
          NEWS,
          INNERJOIN,
          PICROLL,
          OPTIONS,
          FORTUNE,
          STOCKPOOL,
          COURSE,
          CONTASTCOURSE,
          INCOME,
          DFCF,
          //menuboxIsShow: true,
          YjLottery,
          UserVote,
          RoomTabs,
          TeacherReward
        }
      };
    },
    created() {
      this.navImg();
      this.lazyWatch('lotteryInfo', 'roomInfo.active_inner_menu', (newVal, oldVal) => {
        return newVal == 'FORTUNE'
      }, () => {
        this.$store.dispatch(types.LOAD_FORTUNEINFO)
      }, () => {
        return this.active_inner_menu == 'FORTUNE'
      })

      this.lazyWatch('lessonInfo', 'roomInfo.active_inner_menu', (newVal, oldVal) => {
        return newVal == 'COURSE'
      }, () => {
        this.$store.dispatch(types.LOAD_LESSON)
      }, () => {
        return this.active_inner_menu == 'COURSE'
      })
    },
    computed: {
      ...Vuex.mapGetters([types.innerMenus])
    },


    methods: {
      navImg() {
        const emptyNav = {
          tag: 'EMPTY',
          text: '无',
          imgUrl: ''
        };
        var innerMenusMap = {
          4000: {
            tag: 'EmptyType',
            plate: 'pc',
          },
          4015: emptyNav, // 不添加   积分商城
          4200: {
            plate: 'pc',
          },
          4002: {
            plate: 'pc',
          },
          4003: {
            imgUrl: $m('/assets/v3/images/phone/linkto.png##链接跳转图标', __FILE__)
          },
          4500: { //网页助理
            plate: 'pc',
          },
          4009: {
            imgUrl: "",
            plate: 'pc',
          },
          4014: {
            imgUrl: $m('/assets/v3/images/phone/course.png##链接跳转图标', __FILE__)
          },
          4004: {
            imgUrl: $m('/assets/v3/images/phone/qq.png##QQhelp图标', __FILE__)
          },
          4020: {
            imgUrl: $m('/assets/v3/images/phone/lottery.png##大转盘图标', __FILE__)
          },
          4010: {
            imgUrl: $m('/assets/v3/images/phone/share.png##分享图标', __FILE__)
          },
          4012: {
            imgUrl: $m('/assets/v3/images/phone/calendar.png##财经日历图标', __FILE__)
          },
          4001: {
            imgUrl: $m('/assets/v3/images/phone/stock.png##股池图标', __FILE__)
          },
          4013: {
            imgUrl: $m('/assets/v3/images/phone/teacher.png##讲师团队图标', __FILE__)
          },
          4016: {
            imgUrl: $m('/assets/v3/images/phone/news.png##行情资讯图标', __FILE__)
          },
          4100: {
            imgUrl: $m('/assets/v3/images/phone/neican.png##内参图标', __FILE__)
          },
          4017: {
            imgUrl: $m('/assets/v3/images/phone/picroll.png##轮播图片图标', __FILE__)
          },
          4007: {
            imgUrl: $m('/assets/v3/images/phone/suggest.png##操作建议图标', __FILE__)
          },
          4300: {
            imgUrl: $m('/assets/v3/images/phone/contastcourse.png##赛程安排图标', __FILE__)
          },
          4400: {
            imgUrl: $m('/assets/v3/images/phone/income.png##收益排行榜图标', __FILE__)
          },
          4600: {
            imgUrl: $m('/assets/v3/images/phone/dfcf.png##东方财富图标', __FILE__)
          },
          4800: {
            plate: 'pc',
          },
          5000: {
            imgUrl: $m('/assets/v3/images/phone/vote-icon.png##用户投票图标', __FILE__)
          },
          5100: {
            imgUrl: $m('/assets/v3/images/phone/reward-icon.png##用户打赏图标', __FILE__)
          }
        };
        this.innerMenusArr = innerMenusMap
      },

      pageHandle(item) {
        if (item.tag == "LINKTO") {
          window.open(item.args.url);
          return;
        }
        if (item && item.tag == 'UserVote') { //投票检测
          dms.openVote({}, resp => {
            this.$store.commit(types.UPDATE_ROOM_INFO, {
              userVoteInfo: {
                isVoted: resp.data.isVoted || 0,
                options: resp.data.options || [],
                voteInfo: resp.data.vote || {}
              }
            })
            this._pageHandle(item);

          }, resp => {
            item.tag == 'UserVote' && this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
            this.dialogMsgAlign(resp.msg);
            return;
          })
        } else {
          this._pageHandle(item);
        }
      },
      _pageHandle(item) {
        console.log("item====================", item.tag, item);
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_inner_menu: item.tag, //当前活动的菜单
          inner_menu_pop_curBoxId: '',
        });

        //以组件的 弹出
        let _id = this.$layer.iframe({
          content: {
            content: this.components[item.tag],
            parent: this,
            data: {
              check: item,
              args: item.args,
              obj: item
            },
            tipsMore: false, //是否允许多个tips
            shade: true, //是否显示遮罩
          },
          area: ["95%"], //弹出框的宽度
          btn: "确定"
        });

        if (item.tag == "YjLottery") {
          $("#" + _id + "_mask").hide();
        }

        $("#" + _id).addClass('bgborder');
        $("#" + item.tag).attr("tabindex", "0") //tabindex="0"
        $('html,body').addClass('ovfHiden'); //使网页不可滚动

        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_pop_curBoxId: _id, //存储当前弹出框的id
          inner_menu_isshow: false, //关闭菜单按钮
        });
      },
      closeBox(e) {
        $('html,body').removeClass('ovfHiden'); //使网页恢复可滚
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_isshow: false
        });
        e.preventDefault()
      },
    },
  };
</script>