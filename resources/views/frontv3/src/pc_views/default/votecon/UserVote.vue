<template>
  <div id="UserVote" class="UserVote">
    <div class="LeaveMsg_title">
      投票
    </div>
    <span class="LeaveMsg_close" @click="closePop"></span>
    <div style="margin-top:20px">

      <div class="vote-con">
        <p style="font-weight:700;">投票主题</p>
        <section>
          <span class="sp-img">
            <img :src="roomInfo.userVoteInfo.voteInfo.pic || '/assets/v3/images/pc/vote_def.jpg'" width="170" height="100" />
          </span>
          <div class="sp-des">{{roomInfo.userVoteInfo.voteInfo.topic}}</div>
        </section>

        <template>

          <vote-pecent v-if="roomInfo.userVoteInfo.isVoted == 1"></vote-pecent>
          <vote-select v-if="roomInfo.userVoteInfo.isVoted == 0"></vote-select>

        </template>

      </div>
    </div>

  </div>
</template>
<style scoped>
  .UserVote {
    width: 580px;
    background: #fff;
    /* height: 595px; */
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

  .btn-click {
    display: inline-block;
    float: right;
    color: #fff;
    background-color: #0099cb;
    border-radius: 4px;
    padding: 0px 25px;
    height: 36px;
    line-height: 36px;
    cursor: pointer;
  }

  .p-confirm-info {
    margin-top: 10px;
  }

  .lb-left {
    display: inline-block;
    float: left;
    widows: 70px;
  }

  .con-ri {
    display: inline-block;
    float: right;
    width: 500px;
  }

  .con-ri label {
    font-weight: normal;
  }

  .sp-img {
    display: inline-block;
    float: left;
    width: 170px;
  }

  .sp-des {
    display: inline-block;
    float: right;
    width: 350px;
    height: 99px;
    line-height: 20px;
    color: #656565;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    word-wrap: break-word;
    word-break: break-all;
  }

  section {
    display: block;
    width: 100%;
    overflow: hidden;
    margin-top: 10px;
  }
</style>
<script>
  import VotePecent from "@/pc_views/_/votecon/VotePecent"
  import VoteSelect from "@/pc_views/_/votecon/VoteSelect"

  export default {
    methods: {
      closePop() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
    },
    components: {
      VotePecent,
      VoteSelect,

    }
  }
</script>