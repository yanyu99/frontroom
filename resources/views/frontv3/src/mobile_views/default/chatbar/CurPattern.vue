<template>
  <!-- 当前的模式 弹幕 -->
  <div class="curpat" v-show="roomInfo.danmu_is_open||roomInfo.is_robot">
    <span>
      <label v-show="roomInfo.danmu_is_open">弹幕</label>
      <label v-show="!roomInfo.danmu_is_open && roomInfo.is_robot">
        <template v-if="roomInfo.robotsInfo.cur_sel_Num >1 || !roomInfo.robotsInfo.selRobotObj.cur_sel_robotname">
          {{roomInfo.robotsInfo.cur_sel_Num}}个机器人
        </template>
        <template v-else>
          当前机器人:{{roomInfo.robotsInfo.selRobotObj.cur_sel_robotname}}
        </template>
      </label>
      <label @click.stop="closePattern" class="close"></label>
    </span>
  </div>

</template>

<style scoped>
  .curpat {
    z-index: 99;
    left: 15px;
    padding: 10px 15px 0px;
    width: 80%;
    display: flex;
  }

  .curpat span {
    display: inline-block;
    height: 50px;
    line-height: 50px;
    border-radius: 6px;
    padding: 0px 15px;
    position: relative;
    background-color: #ff6c00;
    color: #fff;
  }

  .close {
    background: red;
    color: #fff;
    border-radius: 26px;
    line-height: 26px;
    text-align: center;
    height: 26px;
    width: 26px;
    font-size: 18px;
    padding: 1px;
    top: -10px;
    right: -10px;
    position: absolute;
    z-index: 99;
  }

  .close::before {
    content: "\2716";
  }
</style>


<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    props: ["curType"],
    methods: {
      closePattern() {
        if (this.roomInfo.danmu_is_open) {
          this.$store.state.roomInfo.danmu_is_open = false;
        }
        if (!this.roomInfo.danmu_is_open && this.roomInfo.is_robot) {
          this.$store.state.roomInfo.is_robot = false;
          this.$store.state.roomInfo.robotsInfo.cur_sel_Num = 0; //当前选择的机器人数量
          this.$store.state.roomInfo.robotsInfo.selRobotObj.cur_sel_robotid = ""; //当前选择的机器人的 id
          this.$store.state.roomInfo.robotsInfo.selRobotObj.cur_sel_robotname = ""; //当前选择的机器人的 name
        }
      }
    }
  };
</script>