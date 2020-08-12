<template>
  <div id="UserVote" class="UserVote">
    <div class="LeaveMsg_title">
      投票
    </div>
    <!-- <span class="LeaveMsg_close" @click="closePop"></span> -->
    <div class="vote-warp-container">

      <div class="vote-con">
        <p style="font-weight:700;">投票主题</p>
        <section>
          <span class="sp-img">
            <img :src="roomInfo.userVoteInfo.voteInfo.pic || '/assets/v3/images/pc/vote_def.jpg'" class="img-vote" />
          </span>
          <span class="sp-des">{{roomInfo.userVoteInfo.voteInfo.topic}}</span>
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

  .img-vote {
    width: 280px;
    height: 165px;
  }

  .UserVote {
    padding: 15px 20px;
    /* width: 700px; */
    border-radius: 6px;
    background: #fff;
    height: 600px;
    padding-bottom: 45px;
  }

  .LeaveMsg_title {
    height: 86px;
    border-bottom: 1px solid #E4E4E4;
    font-size: 36px;
    text-align: center;
    line-height: 86px;
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

  .sp-img {
    display: inline-block;
    float: left;
    width: 160px;
  }

  .sp-des {
    display: inline-block;
    float: right;
    width: 380px;
    height: 175px;
    line-height: 35px;
    color: #656565;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    word-break: break-all;
  }

  section {
    display: block;
    width: 100%;
    margin-top: 10px;
    overflow: hidden;
  }
</style>
<script>
  import VotePecent from "@/mobile_views/_/votecon/VotePecent"
  import VoteSelect from "@/mobile_views/_/votecon/VoteSelect"

  export default {

    methods: {
      closePop() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
      },
    },
    components: {
      VotePecent,
      VoteSelect,

    }
  }
</script>