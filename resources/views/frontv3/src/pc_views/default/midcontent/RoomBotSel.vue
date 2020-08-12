<template>
  <div class="room-info-bottom-warp">
    <template v-if="curData &&curData.type_id == 2">
      <div role="tabpanel" class="tab-pane  nice-scroll active">
        <div class="boards-content js-tab-select-img">
          <ul id="Ul_dscontent" class="dscontent">
            <li v-for="(it,inds) in JSON.parse(curData.tab_text)" :key="inds" style="width: 100%; display: list-item;overflow-x:hidden;" v-show="inds == curTagBannerNum">
              <img class="chat-pic" style="height: auto; width: 100%;" :src="it">
            </li>
          </ul>
          <div class="banner-num">
            <ul id="Ul_Pop" style="margin-bottom:0px;margin-left: -50%">
              <li v-for="(it,inds) in JSON.parse(curData.tab_text)" :key="inds" :data-id="inds" :class="{'on':inds==curTagBannerNum}" @click="curTagBannerNumFun(inds)">{{inds+1}}</li>
            </ul>
          </div>
        </div>
      </div>
    </template>
    <template v-else>
      <div role="tabpanel" class="nice-scroll tab-pane active" :id="'marquee-box-'+curData.id">
        <div class="boards-content js-tab-select-img roomTabs" :id="'marquee-content-'+curData.id" v-html="curData.tab_text"></div>
      </div>
    </template>

  </div>
</template>
<style scoped>
  .room-info-bottom-warp {
    display: flex;
    flex: 1;
  }

  .dscontent {
    margin-bottom: 0px;
  }

  .dscontent img {
    width: 100%;
    background-size: 100%;
  }

  .roomTabs img {
    width: 100% !important;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  var timer = null;
  export default {
    data() {
      return {
        curData: [],
        curTagBannerNum: 0,
      }
    },
    created() {
      //TODO
      this.curData = this.baseConfig.roomtabs.filter(i => i.show_when_no_tab == 1)[0];
      if (!this.curData) return;
      if (this.curData.type_id == 2) {
        this.itemTabChange(this.curData);
      } else
        this.curData.is_roll && this.marqueeMove(this.curData);
    },
    methods: {
      marqueeMove(item) {
        $('#marquee-box-' + item.id).wait(function () {
          $('#marquee-box-' + item.id).marqueeMove(
            parseInt(item.roll_speed), () => {
              return $('#marquee-content-' + item.id).height();
            });
        })
      },
      curTagBannerNumFun(ind) {
        this.curTagBannerNum = ind;
        this.itemTabChange(this.curData);
      },
      itemTabChange(item) {
        var self = this;
        var _timenum = $t("10##房间底部图片切换的速度", __FILE__);
        var _arr = JSON.parse(item.text);
        var maxLen = _arr.length;
        if (timer) {
          clearInterval(timer);
          timer = null;
        }

        timer = setInterval(() => {
          self.curTagBannerNum = (self.curTagBannerNum + 1) % maxLen;
        }, (_timenum >= 1 ? _timenum : 10) * 1000);
      },
    }
  }
</script>