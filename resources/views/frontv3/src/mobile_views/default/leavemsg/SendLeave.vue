<template>
  <div id="SendLeave" class="SendLeave-warp">
    <div class="LeaveMsg_title">留言板</div>
    <div class="leavemsg-input">
      <p class="p-lb">我要留言：</p>
      <textarea class="textarea-input" v-model="txtMsg"></textarea>
    </div>

    <p class="p-confirm-info">
      <span class="leave-btn" @click="sendLeaveMsg">确定留言</span>
    </p>

  </div>
</template>
<style scoped>
  .SendLeave-warp {
    background: #fff;
    height: 602px;
  }

  .LeaveMsg_title {
    height: 96px;
    border-bottom: 1px solid #E4E4E4;
    font-size: 32px;
    text-align: center;
    line-height: 96px;
    margin: 0 auto;
    color: #ff8910;
    font-weight: bold;
  }

  .msg-info {
    display: inline-block;
    float: left;
  }

  .p-lb {
    line-height: 60px;
  }

  .leavemsg-input {
    margin-bottom: 6px;
    overflow: hidden;
    background: #fff;
    padding: 20px 40px;
  }

  .textarea-input {
    border: 1px solid #bbb;
    width: 600px;
    height: 200px;
    vertical-align: top;
    padding-left: 2px;
  }

  .leave-btn {
    display: inline-block;
    color: #fff;
    background-color: #0099cb;
    border-radius: 4px;
    padding: 0px 50px;
    height: 72px;
    line-height: 72px;
    cursor: pointer;
    font-size: 32px;
  }

  .p-confirm-info {
    margin-top: 10px;
    text-align: center;
  }
</style>
<script>
  export default {
    data() {
      return {
        txtMsg: '',
      }
    },
    props: ['tid'],
    methods: {
      sendLeaveMsg() {
        if (!this.userInfo.role.f_message_board_send) {
          this.dialogMsgAlign("该用户没有留言权限");
          return;
        }
        if (this.txtMsg == '') {
          this.dialogMsgAlign("请先输入内容！");
          return;
        }
        dms.sendLeaves({
          tid: this.tid,
          message: this.txtMsg
        }, resp => {
          this.dialogMsgAlign("留言成功,等待审核！");
          this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
        }, resp => {
          this.dialogMsgAlign("留言失败！");
        })
      }
    }

  }
</script>