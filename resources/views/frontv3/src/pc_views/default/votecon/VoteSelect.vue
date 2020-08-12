<template>
  <div class="vote-con" id="VoteSelect">
    <section>
      <label class="lb-left">选项：</label>
      <div class="con-ri">

        <p v-for="(item,ind) in roomInfo.userVoteInfo.options" :key="item.id">
          <template v-if="roomInfo.userVoteInfo.voteInfo.type == 2">
            <label :for="'rdOptions'+ind">
              <input type="checkbox" :value="item.id" :id="'rdOptions'+ind" class="rd-input" v-model="rdOptions" /> {{item.content}}
            </label>
          </template>
          <template v-else>
            <label :for="'rdOptions'+ind">
              <input type="radio" :value="item.id" :id="'rdOptions'+ind" class="rd-input" v-model="rdOptions" /> {{item.content}} </label>
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

  .lb-left {
    display: inline-block;
    float: left;
    width: 50px;
  }

  .con-ri {
    display: inline-block;
    float: right;
    width: 488px;
    color: #656565;
  }

  .con-ri label {
    font-weight: normal;
    width: 460px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  section {
    display: block;
    width: 100%;
    overflow: hidden;
    margin-top: 11px;
  }

  .rd-input {
    vertical-align: middle;
    vertical-align: text-top;
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
          this.$layer.msg("投票成功啦！", { time: 1 });
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