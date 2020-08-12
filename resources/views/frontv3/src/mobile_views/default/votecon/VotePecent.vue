<template>

  <div class="vote-con" id="VotePecent">
    <section class="conbox-warp">
      <label class="lb-left">选项：</label>
      <div class="con-ri">


        <div class="div-progress" v-for="(item,ind) in roomInfo.userVoteInfo.options" :key="item.id">
          <div class="vote-opt">{{ind+1}}、{{item.content}}</div>
          <div class="div-progress_bar">
            <div class="inner-bar " :style="{'width': (item.num)*100/totalBase+'%'}"></div>
          </div>
          <div class="div-num">{{item.num}}票</div>
        </div>

      </div>

    </section>
    <div class="total-num">共{{totalBase}}票</div>
  </div>

</template>

<style scoped>
  .vote-con {
    margin-bottom: 6px;
    overflow: hidden;
    margin-top: 20px;
    background: #fff;
    height: 260px;
    overflow-y: scroll;
    width: 100%;
  }

  .conbox-warp {
    border-bottom: 1px solid #e0e0e0;
  }

  .div-progress {
    margin-bottom: 10px;
    overflow: hidden;
  }

  .div-progress_bar {
    background-color: #ebebeb;
    height: 30px;
    border-radius: 8px;
    width: 80%;
    float: left;
    margin-bottom: 10px;
  }

  .inner-bar {
    background: #F19000;
    height: 100%;
    width: 0%;
    float: left;
    border-radius: 8px;
  }

  section {
    display: block;
    width: 100%;
    overflow: hidden;
    margin-top: 10px;
  }

  .div-num {
    float: right;
    margin-left: 4px;
    text-align: left;
    width: 100px;
    color: #453c35;
  }

  .vote-opt {
    height: 36px;
    line-height: 36px;
    width: 80%;
    margin-bottom: 8px;
    color: #656565;
    overflow: hidden;
  }

  .lb-left {
    display: inline-block;
    float: left;
    width: 90px;
  }

  .con-ri {
    display: inline-block;
    width: 550px;
  }

  .con-ri label {
    font-weight: normal;
  }

  .total-num {
    float: right;
    text-align: right;
    display: block;
    height: 30px;
    padding-top: 10px;
    padding-right: 54px;
  }
</style>

<script>
  import Vuex from "vuex"
  import * as types from "@/store/types"

  export default {
    computed: {
      totalBase() {
        var baseNum = 0;
        var _tmpArr = this.roomInfo.userVoteInfo.options;
        _tmpArr.forEach(i => {
          baseNum += i.num;
        });
        return baseNum;
      }
    },
    methods: {
      closePop() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
      },
    }
  }
</script>