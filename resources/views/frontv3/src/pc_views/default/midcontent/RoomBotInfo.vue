<template>
  <div class="main-room-info">
    <!-- if判断TODO <cash-gift v-if="parseInt(sizePc.cash_gift.height)"></cash-gift> -->

    <!-- if判断TODO-->
    <!-- <room-bot-tab v-if="!parseInt(baseConfig.sitecfg.is_no_tab && baseConfig.roomtabs.filter(i => i.show_when_no_tab == 1).length)"></room-bot-tab> -->
    <div class="room-info-bottom-warp" v-if="!parseInt(baseConfig.sitecfg.is_no_tab && baseConfig.roomtabs.filter(i => i.show_when_no_tab == 1).length)">
      <div class="line-menu">
        <ul role="tablist">
          <li v-for="(item,index) in roominfoBot" :key="index" :style="{'background-color':item.tag==curTag ? $c('rgba(0, 0, 0, 0.5)##选中--房间信息导航颜色透明度',__FILE__):$c('rgba(0, 0, 0, 0.8)##未选中--房间信息导航颜色透明度',__FILE__)}" :class="{'active':item.tag==curTag}" @click="showTag(item)">
            <a aria-controls="boards" role="tab" data-toggle="tab">
              <span class="text">{{item.title}}</span>
              <span class="number"></span>
            </a>
          </li>
        </ul>
      </div>
      <div class="tab-content" :style="{'background-color': $c('rgba(0, 0, 0, 0.5)##选中--房间信息颜色透明度',__FILE__)}">
        <template v-if="userInfo.role.f_realtime">
          <div role="tabpanel" class="nice-scroll tab-pane chat-status-event" :class="{'active':'DynesNotice'==curTag}" v-show="'DynesNotice'==curTag" id="tab-content-dynamic">
            <ul id="js-chat-status-event" class="">
              <li class="chat-message-status" v-for="(item,index) in roomInfo.roomUserSysMsgData" :key="index">
                <span class="chat-message-time"> {{item.time}} </span>
                <template v-if="item._type == 'Enter'"> 欢迎
                  <span class="chat-message-name">{{item.name}}</span> 进入频道
                </template>
                <template v-else-if="item._type == 'Leave'">
                  <span class="chat-message-name"> {{item.name}}</span> 离开频道
                </template>
              </li>
            </ul>
          </div>
        </template>

        <template v-for="(item,indx) in baseConfig.roomtabs">
          <template v-if="item.type_id == 2">
            <div role="tabpanel" :key="indx" class="tab-pane  nice-scroll" :class="{'active':'RoomTabs_'+item.id==curTag}" v-show="'RoomTabs_'+item.id==curTag">
              <div class="boards-content js-tab-select-img">
                <ul id="Ul_dscontent" class="dscontent">
                  <li v-for="(it,inds) in JSON.parse(item.tab_text)" :key="inds" style="width: 100%; display: list-item;overflow-x:hidden;" v-show="inds == curTagBannerNum">
                    <img class="chat-pic" style="height: auto; width: 100%;" :src="it">
                  </li>
                </ul>
                <div class="banner-num">
                  <ul id="Ul_Pop" style="margin-bottom:0px;margin-left: -50%">
                    <li v-for="(it,inds) in JSON.parse(item.tab_text)" :key="inds" :data-id="inds" :class="{'on':inds==curTagBannerNum}" @click="curTagBannerNumFun(inds,'RoomTabs_'+item.id,item)">{{inds+1}}</li>
                  </ul>
                </div>
              </div>
            </div>
          </template>
          <template v-else>
            <div :key="indx" role="tabpanel" class="nice-scroll tab-pane" :id="'marquee-box-'+item.id" :class="{'active':'RoomTabs_'+item.id==curTag}" v-show="'RoomTabs_'+item.id==curTag">
              <div class="boards-content js-tab-select-img roomTabs" :id="'marquee-content-'+item.id" v-html="item.tab_text"></div>
            </div>
          </template>
        </template>
      </div>
    </div>

    <!-- 模式二 单一模式 -->
    <!-- <room-bot-sel v-if="parseInt(baseConfig.sitecfg.is_no_tab && baseConfig.roomtabs.filter(i => i.show_when_no_tab == 1).length)"></room-bot-sel> -->
    <div class="room-info-bottom-warp" v-if="parseInt(baseConfig.sitecfg.is_no_tab && baseConfig.roomtabs.filter(i => i.show_when_no_tab == 1).length)">
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
                <li v-for="(it,inds) in JSON.parse(curData.tab_text)" :key="inds" :data-id="inds" :class="{'on':inds==curTagBannerNum}" @click="curTagBannerNumFun(inds,null,curData)">{{inds+1}}</li>
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

  </div>
</template>
<style scoped>
  .main-room-info {
    position: relative;
    overflow: hidden;
    display: flex;
    flex: 1;
  }

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

  .room-info-bottom-warp,
  .tab-content {
    width: 100%;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .line-menu ul>li a {
    height: 33px;
    line-height: 33px;
    display: block;
    text-align: center;
  }

  .line-menu {
    height: 33px;
  }

  .chat-message-time,
  .chat-message-name {
    margin-right: 3px;
  }

  #js-chat-status-event {
    margin-bottom: 0px;
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
        curTag: '',
        time: dms.date("H:i")
      }
    },
    computed: {
      ...Vuex.mapGetters([types.roominfoBot]),
    },
    created() {
      if (!parseInt(baseConfig.sitecfg.is_no_tab && baseConfig.roomtabs.filter(i => i.show_when_no_tab == 1).length)) {
        this.showTag();
        this.$watch('roomInfo.roomUserSysMsgData', (newVal, oldVal) => {
          this.userInfo.role.f_realtime && setTimeout(() => {
            this.rollBottom(newVal);
          }, 1000)
        });
      } else {
        //单一模式 TODO
        this.curData = this.baseConfig.roomtabs.filter(i => i.show_when_no_tab == 1)[0];
        if (!this.curData) return;
        if (this.curData.type_id == 2) {
          this.itemTabChange(this.curData);
        } else
          this.curData.is_roll && this.marqueeMove(this.curData);
      }

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
      rollBottom(val) {
        $(".chat-status-event").scrollTop($(".chat-status-event")[0].scrollHeight + 99999);
      },
      showTag(item) {
        var item = item || this.roominfoBot[0];
        if (!item) {
          return;
        }
        this.curTag = item.tag;
        item.is_roll && this.marqueeMove(item);
        if (item.tag == this.curTag) {
          this.curTagBannerNum = 0;
          this.itemTabChange(item, item.tab_text);
        }
      },
      curTagBannerNumFun(ind, tag, item) {
        this.curTagBannerNum = ind;
        this.curTag = tag || '';
        this.itemTabChange(item, item.tab_text);
      },
      itemTabChange(item, text) {
        var self = this;
        if (item.type_id != 2 || !text) return;
        var _timenum = $t("10##房间底部图片切换的速度", __FILE__); // (this.baseConfig.sysConfig.bottom_banner_interval >= 1 ? this.baseConfig.sysConfig.bottom_banner_interval : 10) * 1000;
        var _arr = JSON.parse(text) || [];
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
  };
</script>