<template>
  <div id="LeaveMsg" class="LeaveMsg">
    <div class="LeaveMsg_title">
      留言板
    </div>
    <span class="LeaveMsg_close" @click="closePop"></span>

    <div>
      <p class="p-top-info">
        <span class="sp-curtea" style="font-size:16px;">
          <label>
            <img src="/assets/v3/images/pc/teacher-icon.png" class="teacher-icon" /> {{$t('讲师##留言榜列表称呼配置', __FILE__)}}:</label>
          <font class="f-teacher-name">
            <label style="color:#009acf">{{curTname}}</label>
          </font> (共{{totalNum}})条
        </span>
        <span class="checkmy" @click="getLeaveList(1,true)" :class="{'isactive':datatype == 1}">我的留言</span>
        <span class="checkmy" @click="getLeaveList(0,true)" :class="{'isactive':datatype == 0}">全部留言</span>
      </p>
      <ul class="ul-con" v-if="dataList.length">
        <li v-for="item in dataList" :key="item.id">
          <p class="p-user">
            <font class="f-user-name">{{item.uname}}</font> 问:</p>
          <span class="sp-con">{{item.message}}</span>
          <template v-if="item.reply">
            <p class="p-teacher">{{$t('讲师##留言榜列表称呼配置', __FILE__)}}答复：</p>
            <span class="sp-con">{{item.reply}}</span>
          </template>
        </li>
      </ul>
    </div>
    <div class="pages-container" style=" height:40px; float:right; width:100%; text-align:right; " v-if="Math.ceil(totalNum / pageSize)">
      <mo-paging :page-index="pageIndex" :total="totalNum" :page-size="pageSize" :per-Pages='5' @change="pageChange"></mo-paging>
    </div>
    <div style="margin-top:60px;">
      <div class="leavemsg-input">
        <span>
          <label>我要留言：</label>
          <textarea class="textarea-input" v-model="txtMsg"></textarea>
        </span>
      </div>
      <p class="p-confirm-info">
        <span class="p-teacher msg-info">每条最多留言50个文字</span>
        <span class="leave-btn" @click="sendLeaveMsg">确定留言</span>
      </p>
    </div>
  </div>
</template>
<style scoped>
  .LeaveMsg {
    width: 580px;
    background: #fff;
    height: 695px;
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

  .teacher-icon {
    width: 20px;
    vertical-align: text-bottom !important;
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

  .ul-con {
    max-height: 380px;
    overflow-y: scroll;
  }

  ul.ul-con li {
    background: #f9f9f9;
    border-bottom: 1px dotted #d8d8d8;
    padding-bottom: 10px;
    margin-bottom: 10px;
  }

  .sp-con {
    color: #81898c;
  }

  .f-user-name {
    color: #009acf;
  }

  .f-teacher-name {
    color: #373330;
  }

  .p-user {
    margin-bottom: 0px;
  }

  .p-teacher {
    color: #fe6601;
    margin-top: 5px;
    margin-bottom: 0px;
  }

  .msg-info {
    display: inline-block;
    float: left;
  }

  .leavemsg-input {
    margin-bottom: 6px;
    overflow: hidden;
  }

  .textarea-input {
    border: 1px solid #bbb;
    width: 460px;
    height: 80px;
    vertical-align: top;
    float: right;
    padding-left: 2px;
  }

  .leave-btn {
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

  .p-top-info span {
    display: inline-block;
  }

  .p-top-info {
    margin-top: 10px;
  }

  .checkmy {
    float: right;
    cursor: pointer;
    margin-left: 10px;
    background: #d8d8d8;
    color: #fff;
    height: 30px;
    line-height: 30px;
    padding: 0px 10px;
    border-radius: 4px;
  }

  .isactive {
    background-color: #009acf;
  }
</style>
<script>
  import MoPaging from '@/pc_views/_/util/paging'
  export default {
    data() {
      return {
        txtMsg: '',
        dataList: [],
        pageIndex: 1,
        pageSize: 10, //每页显示10条数据
        totalNum: 0, //总记录数
        datatype: 0,
        curTname: '',
      }
    },
    created() {
      this.getLeaveList(0);
    },
    props: ['obj'],
    // watch: {
    //   pageIndex(newVal) {
    //     console.log("page change", newVal);
    //     if (newVal != this.pageIndex) {
    //       this.pageIndex = newVal;
    //       this.getLeaveList(this.datatype)
    //     }
    //   }
    // },
    methods: {
      //页面改变
      pageChange(page) {
        this.pageIndex = page
        this.getLeaveList(this.datatype)
      },

      getLeaveList(type, isVal) {
        this.datatype = type;
        this.dataList = [];
        if (isVal) {
          this.pageIndex = 1;
        }

        var _params = {
          page: this.pageIndex,
          size: this.pageSize,
          type: type,
          tid: this.obj
        }
        dms.getLeaves(_params, resp => {
          this.dataList = resp.list || [];
          this.totalNum = resp.list_num || 0;
          this.curTname = resp.tName || '';
        }, res => {

        })
      },
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
          tid: this.obj,
          message: this.txtMsg
        }, resp => {
          this.dialogMsgAlign("留言成功，请等待回复！");
          this.$layer.close(this.roomInfo.curlayer_pop_id);
        }, resp => {
          this.dialogMsgAlign("留言失败！");
        })
      },
      closePop() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
    },
    components: {
      MoPaging,
    }

  }
</script>
