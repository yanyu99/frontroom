<template>
  <div class="vote-con" id="VoteSelect">
    <section>
      <label class="lb-left">选项: </label>
      <div class="con-ri ">

        <p v-for="(item,ind) in roomInfo.userVoteInfo.options" :key="item.id">
          <template v-if="roomInfo.userVoteInfo.voteInfo.type == 2">
            <label :for="'rdOptions'+ind">
              <input type="checkbox" :value="item.id" :id="'rdOptions'+ind" class="rd-input inp-ck" v-model="rdOptions" /> {{item.content}}
            </label>
          </template>
          <template v-else>
            <label :for="'rdOptions'+ind">
              <input type="radio" :value="item.id" :id="'rdOptions'+ind" class="rd-input inp-rd" v-model="rdOptions" /> {{item.content}} </label>
          </template>
        </p>

      </div>
    </section>
    <p class="p-confirm-info">
      <span class="btn-click" @click="voteConfirm">确定投票</span>
    </p>
  </div>

</template>
<style scoped>
  .p_scroll {
    overflow-x: hidden;
    overflow-y: auto;
    color: #000;
    /* font-size: .7rem; */
    font-family: "\5FAE\8F6F\96C5\9ED1", Helvetica, "黑体", Arial, Tahoma;
    height: 100%;
  }
  .vote-con {
    background: #fff;
    height: 260px;
    /* overflow-y: scroll;
    overflow-x: hidden; */
    width: 100%;
  }

  .btn-click {
    display: inline-block;
    float: right;
    color: #fff;
    background-color: #0099cb;
    border-radius: 8px;
    padding: 0px 50px;
    height: 72px;
    line-height: 72px;
    cursor: pointer;
    font-size: 30px;
  }

  .lb-left {
    display: inline-block;
    float: left;
    width: 90px;
  }

  .con-ri {
    display: inline-block;
    width: 488px;
    color: #656565;
    height: 206px;
    overflow-y: scroll;
  }

  .con-ri p {
    height: 56px;
  }

  .con-ri label {
    font-weight: normal;
    width: 460px;
    display: block;
    height: 40px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  section {
    display: block;
    width: 100%;
    overflow: hidden;
    margin-top: 10px;
  }

  .rd-input {
    vertical-align: middle;
  }

  .inp-ck {
    -webkit-appearance: checkbox !important;
  }

  .inp-rd {
    -webkit-appearance: radio !important;
  }
</style>
<script>
  import Vues from 'vuex'
  import * as types from "@/store/types"
  import VotePecent from "@/pc_views/_/votecon/VotePecent";

  export default {
    data() {
      return {
        rdOptionsArr: [],
        rdOptions: [],
        components: {
          VotePecent
        }
      }
    },
    methods: {
      voteConfirm() {

        var _optArr = this.rdOptions;
        if (_optArr.length == 0) {
          this.dialogMsgAlign('请先选择选项！');
          return;
        }
        if (this.roomInfo.userVoteInfo.voteInfo.type != 2 && _optArr.length > 1) {
          this.dialogMsgAlign('当前为单选！');
          return;
        }

        var _optStr = '';
        var optionsArr = this.roomInfo.userVoteInfo.options;
        optionsArr.forEach(ele => {
          if (this.roomInfo.userVoteInfo.voteInfo.type == 2) {
            var _checked = _optArr.findIndex(i => i == ele.id);
            if (_checked >= 0) {
              _optStr += ele.id + '|';
            }
          } else {
            if (ele.id == _optArr) {
              _optStr = ele.id;
            }
          }
        });

        dms.userVote({
          vote_id: this.roomInfo.userVoteInfo.voteInfo.id,
          optionIds: _optStr
        }, resp => {
          this.dialogMsgAlign('投票成功啦', '提示', 'hide', 1);
          dms.openVote({}, resp => {
            this.$store.commit(types.UPDATE_ROOM_INFO, {
              userVoteInfo: {
                isVoted: resp.data.isVoted || 1,
                options: resp.data.options || [],
                voteInfo: resp.data.vote || {}
              }
            })
          }, resp => {})

        }, resp => {
          this.dialogMsgAlign(resp.msg);
        })
      }
    }
  }
</script>