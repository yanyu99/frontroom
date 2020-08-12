<template>
  <div class="more-action" id="more-action" :style="{backgroundColor:$c('#000##底部弹出框背景的颜色', __FILE__)}" >
    <template v-for="item in moreOptions">
      <span class="sp-robot" :key="item.tag" @click="openLayer(item,$event)">
        <img :src='getImg(item)' />
        <font :style="{color:$c('#fff##(更多功能跟菜单)弹出层文本的颜色', __FILE__)}">{{item.text}}</font>
      </span>
    </template>
  </div>
</template>
<style scoped>
  /*==================更多功能============================*/

  .more-action {
    width: 100%;
    height: 194px;
    /* background-color: black;
    background-color: rgba(0,0,0,0.9); */
    left: 0;
    bottom: 92px;
    z-index: 999;
    display: -webkit-box;
    /* Chrome 4+, Safari 3.1, iOS Safari 3.2+ */
    display: -moz-box;
    /* Firefox 17- */
    display: -webkit-flex;
    /* Chrome 21+, Safari 6.1+, iOS Safari 7+, Opera 15/16 */
    display: -moz-flex;
    /* Firefox 18+ */
    display: -ms-flexbox;
    /* IE 10 */
    display: flex;
    /* Chrome 29+, Firefox 22+, IE 11+, Opera 12.1/17/18, Android 4.4+ */
  }

  .more-action span {
    display: inline-block;
    float: left;
    width: 25%;
    /* flex: 1; */
    padding: 34px 0px;
    text-align: center;
  }

  .more-action span img {
    width: 75px;
    height: 75px;
    vertical-align: middle;
  }

  .more-action span font {
    display: block;
    color: #fff;
    font-size: 24px;
    font-weight: bold;
    margin-top: 10px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types.js";

  import HONGBAO from "@/mobile_views/_/moreoptions/HONGBAO";
  import ROBOT from "@/mobile_views/_/moreoptions/ROBOT";

  export default {
    data() {
      return {
        components: {
          HONGBAO,
          ROBOT,
        }
      };
    },
    props: ["moreOptions"],
    created() {
      this.lazyWatch('userPacketInfo', 'roomInfo.active_more_action', (newVal, oldVal) => {
        return newVal == 'HONGBAO'
      }, () => {
        this.$store.dispatch(types.LOAD_USERPACKETINFO)
      }, () => {
        this.roomInfo.active_more_action == 'HONGBAO'
      })
    },

    mounted() {
      var self = this;
      var callback = function (e) {
        if ($("#more-action").css("display") == "none") {
          return;
        }
        var e = e || window.event; //浏览器兼容性
        var elem = e.target || e.srcElement;
        while (elem) {
          //循环判断至跟节点，防止点击的是div子元素
          if (elem.id && elem.id == "more-action") {
            return;
          }
          elem = elem.parentNode;
        }
        self.$store.commit(types.UPDATE_ROOM_INFO, {
          active_more_isshow: false,
        });
      };

      dms.registerFuncGroup('main-content', 'more-action', callback);
    },
    methods: {
      openLayer(obj, e) {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_more_action: obj.tag //当前活动的更多菜单
        });

        if (obj.tag === "CAITIAO") {
          var _ind = dms.getRandomNum(0, 4) || 0;
          var caitiaoUrl = types.caitiaoArr[_ind]["imgUrl"];
          this.$store.dispatch(types.DO_MSG_SEND_PC, {
            message: '[' + caitiaoUrl + ']',
            type: 2,
          });
        } else if (obj.tag === "DANMU") {
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            danmu_is_open: this.roomInfo.danmu_is_open ? false : true
          });
        } else {
          //红包跟机器人设置情况
          let _id = this.$layer.iframe({
            content: {
              content: this.components[obj.tag],
              parent: this,
              data: {
                check: obj
              }
            }
          });
          this.$store.state.roomInfo.inner_menu_pop_curBoxId = _id; //存储当前弹出框的id
        }
      },
      getImg(item) {
        var imgUrl =
          item.tag == "DANMU" && !this.roomInfo.danmu_is_open ?
          this.$m('/assets/v3/images/phone/shotoff.png##关闭弹幕图标', __FILE__) :
          item.imgUrl;
        return imgUrl;
      }
    }
  };
</script>