<template>
  <div style="position:relative;">
    <div @click="showTeasure = true" class="treasure chat-float-model-item">
      <i class="close-treasure-box hidden"></i>
      <div class="treasure-box " :style="treasurnStatusImg"></div>
      <div class="treasure-count-down">
        <span>{{curTime}}</span>
      </div>
    </div>
    <div id="TREASURE" v-show="showTeasure" :class="{'treasure-box-panel':true,'leftfloat':(baseConfig.theme.layout == 'layout-video-right' && baseConfig.theme.layoutsider == 'layout-sider-right')}">
      <div class="close-btn right-top" @click="showTeasure = false">×</div>
      <ul class="cb-list">
        <li v-for="item in treasureArr" :key="item.idx" @click="updateTreasure">
          <span :class="item.spClass "></span>
          <a :class="item.btnClass">
            {{item.desBtn}}
          </a>
        </li>
      </ul>
      <div v-show="roomInfo.treasureInfo.treasurnStatus==0" class="c-txt get-state-ard">别着急，奖励正在准备中……</div>
    </div>
  </div>
</template>
<style scoped>
  .leftfloat {
    left: 70px;
  }

  .treasure-box {
    background-size: 100%;
  }

  .treasure-box-panel {
    position: absolute !important;
    top: 0px;
    right: 70px;
    display: block;
  }
</style>
<script>
  import * as types from "@/store/types"
  import Vuex from "vuex";
  export default {
    data() {
      return {
        showTeasure: false,
        timer: null,
        curTime: "00:00:00",
      }
    },
    created() {
      this.$watch('roomInfo.treasureInfo.treasureIndex', (newVal, oldVal) => {
        this.startTimer(newVal)
      })
    },
    computed: {
      ...Vuex.mapGetters([types.treasureArr]),
      treasurnStatusImg() {
        var _icon_close = $m('/assets/v3/images/phone/treasure.png##宝箱关闭图标', __FILE__);
        var _icon_open = $m('/assets/v3/images/phone/open_treasure.png##宝箱打开图标', __FILE__);
        return {
          'background-image': (this.roomInfo.treasureInfo.treasurnStatus == 1 || this.showTeasure) ?
            'url(' + _icon_open + ')' : 'url(' + _icon_close + ')'
        }
      },
    },

    methods: {
      startTimer(idx) {
        if (
          this.roomInfo.treasureInfo.treasurnStatus == 1 ||
          idx >= 6 ||
          idx < 0
        ) {
          return;
        }

        var treasureIndex = idx + 1;
        var time = this.baseConfig.jfcfg.treasure_config['gj_ts' + treasureIndex] || 0;
        time = parseInt(time);
        if (time <= 0) {
          return;
        }

        var openTime = "00:00:00";
        var timeTotal = time * 60 * 1000;

        this.timer && clearInterval(this.timer);

        this.timer = setInterval(() => {
          if (timeTotal <= 0) {
            openTime = "00:00:00";
            dms.LiveApi.sendTreasure({}, res => {
              this.$store.commit(types.UPDATE_ROOM_INFO, {
                treasureInfo: {
                  treasureIndex: res.treasureindex || 0,
                  treasurnStatus: res.treasurestatus || 1,
                }
              })
            });
            this.timer && clearInterval(this.timer);
            //弹出框

          } else {
            timeTotal = timeTotal - 1000;
            openTime = dms.timeFormat(timeTotal);
          }
          this.curTime = openTime;
        }, 1000);
      },

      updateTreasure() {
        if (this.roomInfo.treasureInfo.treasurnStatus != 1) {
          this.dialogMsgAlign("当前无宝箱，请耐心等待！");
          return;
        }
        dms.LiveApi.openTreasure({}, res => {
          var str = "恭喜你已领取了<b>" + res.jf_num + "</b>" + this.baseConfig.textcfg.jf_txt_tit + "，" + this.$t('挂机##\'挂机\'字样', __FILE__) + "可获更多" + this.baseConfig.textcfg.jf_txt_tit + "！";
          this.dialogMsgAlign(str);
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            treasureInfo: {
              treasureIndex: res.data.treasureIndex,
              treasurnStatus: 0,
            }
          });
        }, resp => {
          this.dialogMsgAlign(resp.msg);
          return;
        });
      }
    },
  }
</script>