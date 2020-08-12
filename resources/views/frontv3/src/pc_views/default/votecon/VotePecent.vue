<template>

  <div class="vote-con" id="VotePecent">
    <section>
      <label class="lb-left">选项：</label>
      <div class="con-ri p_scroll">


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
  .UserVote {
    width: 580px;
    background: #fff;
    height: 595px;
    padding: 10px 20px;
  }

  .LeaveMsg_title {
    height: 48px;
    border-bottom: 1px solid #E4E4E4;
    font-size: 18px;
    text-align: center;
    line-height: 48px;
    margin: 0 auto;
    color: #515151;
    font-weight: bold;
  }

  .LeaveMsg_close {
    background-image: url(/assets/img/close.png);
    position: absolute;
    top: 17px;
    right: 15px;
    display: block;
    width: 18px;
    height: 18px;
    cursor: pointer;
  }

  .msg-info {
    color: #fe6601;
    margin-top: 5px;
    margin-bottom: 0px;
    display: inline-block;
    float: left;
  }

  .vote-con {
    margin-bottom: 6px;
    overflow: hidden;
    margin-top: 20px;
  }

  .div-progress {
    margin-bottom: 10px;
    overflow: hidden;
  }

  .div-progress_bar {
    background-color: #ebebeb;
    height: 18px;
    border-radius: 4px;
    width: 80%;
    float: left;
    margin-bottom: 10px;
  }

  .inner-bar {
    background: #F19000;
    height: 100%;
    width: 0%;
    float: left;
    border-radius: 4px;
  }

  section {
    display: block;
    width: 100%;
    overflow: hidden;
    margin-top: 11px;
  }

  .div-num {
    float: right;
    margin-left: 4px;
    text-align: left;
    width: 80px;
    color: #453c35;
  }

  .vote-opt {
    height: 20px;
    line-height: 20px;
    width: 82%;
    margin-bottom: 4px;
    color: #656565;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .lb-left {
    display: inline-block;
    float: left;
    width: 50px;
  }

  .con-ri {
    display: inline-block;
    float: right;
    width: 488px;
    border-bottom: 1px solid #e0e0e0;
    max-height:300px ;
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
    .p_scroll {
    overflow-x: hidden;
    overflow-y: auto;
    color: #000;
    font-size: .7rem;
    font-family: "\5FAE\8F6F\96C5\9ED1", Helvetica, "黑体", Arial, Tahoma;
    height: 100%;
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
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
    }
  }
</script>