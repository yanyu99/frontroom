<template>
  <section class="fl-sec" :style="{color:$c('#fff##右侧浮动字体颜色', __FILE__),'bottom':$t('47##聊天发送底部的高度',__FILE__)+'px'}">
    <div class="rightpop-fun" v-show="isShowRightPop">
      <template></template>
      <span class="treasure">
        <img @click="updateTreasure()" :src="treasurnStatusImg" />
        <font>{{curTime}}</font>
      </span>

      <template v-if="userInfo.role.f_tochat">
        <template v-if="baseConfig.msgcfg.mgr_to_chat">
          <span class="consult " @click="chatToTeacher">
            <img :src="$m('/assets/v3/images/phone/chat.png##咨询图标 ', __FILE__)" />
            <font>老师咨询</font>
          </span>
        </template>
      </template>

      <span class="menu" @click="innerMenuShowClick">
        <img :src="$m('/assets/v3/images/phone/menu.png##菜单图标 ', __FILE__)" />
        <font>菜单</font>
      </span>
    </div>

    <!-- 控制隐藏与显示 -->
    <span class="menu" @click="isShowRightPop = !isShowRightPop">
      <img :src="isShowRightPop ? $m('/assets/v3/images/phone/popshow.png##菜单显示图标', __FILE__) :$m('/assets/v3/images/phone/pophide.png##菜单隐藏图标', __FILE__) " />
    </span>
  </section>
</template>

<style scope>
  .fl-sec {
    position: absolute;
    right: 10px;
    width: 100px;
    z-index: 9;
  }

  .fl-sec img {
    width: 83px;
    height: 83px;
    display: block;
    margin: 0 auto;
  }

  .fl-sec span {
    display: inline-block;
    text-align: center;
    margin: 0 auto;
    width: 100px;
    text-align: center;
  }

  .rightpop-fun span {
    margin-bottom: 5px;
    padding-bottom: 5px;
  }

  .fl-sec font {
    width: 120px;
    text-align: center;
  }
</style>


<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        isShowRightPop: true,
        timer: null,
        curTime: "00:00:00",
      };
    },
    created() {
      this.$watch('roomInfo.treasureInfo.treasureIndex', (newVal, oldVal) => {
        this.startTimer(newVal)
      })
    },
    mounted() {
      this.isShowRightPop = false
      setTimeout(() => {
        this.isShowRightPop = true
      }, 100)
    },
    computed: {
      treasurnStatusImg() {
        return this.roomInfo.treasureInfo.treasurnStatus == 1 ?
          this.$m('/assets/v3/images/phone/open_treasure.png##宝箱打开图标', __FILE__) :
          this.$m('/assets/v3/images/phone/treasure.png##宝箱关闭图标', __FILE__);
      }
    },
    methods: {
      innerMenuShowClick() {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_isshow: true
        });
      },
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
                treasureindex: res.treasureindex || 0,
                treasurestatus: res.treasurestatus || 1,
              })
            });
            this.timer && clearInterval(this.timer);
            this.curTime = openTime;
          } else {
            timeTotal = timeTotal - 1000;
            openTime = dms.timeFormat(timeTotal);
            //console.log("openTime" + openTime);
            this.curTime = openTime;
          }

        }, 1000);
      },
      chatToTeacher() {
        if (!this.roomInfo.teacher.tid) {
          this.dialogMsgAlign("当前无讲师在线！")
          return;
        }
        this.roomInfo.teacher.tid &&
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            selChatMsgItem: {
              toUid: this.roomInfo.teacher.tid,
              toName: this.roomInfo.teacher.name,
              from: "pub_right_func",
              toType: 400
            }
          });
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
    components: {}
  };
</script>