<template>
  <div id="LeaveMsg" class="LeaveMsg">
    <div class="LeaveMsg_title">留言板</div>
    <span class="LeaveMsg_close" @click="closePop"></span>

    <div>
      <p class="p-top-info">
        <span class="sp-curtea">
          <font>{{$t('讲师##留言榜列表称呼配置', __FILE__) || '讲师'}}</font>：
          <font style="color:#009acf">{{curTname}}</font>
          <font class="f-teacher-name"></font>(共{{totalNum || 0}}条)
        </span>
        <!-- <span class="checkmy" @click="getLeaveList(0,true)" :class="{'isactive':datatype == 0}">全部留言</span> -->
        <!-- <span class="checkmy" @click="infiniteHandler($state,0)" :class="{'isactive':datatype == 0}">全部留言</span>
        <span class="checkmy" @infinite="infiniteHandler($state,1)" :class="{'isactive':datatype == 1}">我的留言</span> -->
      </p>
      <ul class="ul-con" infinite-wrapper>
        <li v-for="item in dataList" :key="item.id">
          <p class="p-user">
            <font class="f-user-name">{{item.uname}}</font> 问:</p>
          <span class="sp-con">{{item.message}}</span>
          <template v-if="item.reply">
            <p class="p-teacher">{{$t('讲师##留言榜列表称呼配置', __FILE__)}}答复：</p>
            <span class="sp-con">{{item.reply}}</span>
          </template>
        </li>
        <infinite-loading @infinite="infiniteHandler">
          <span slot="no-more">
            加载完毕
          </span>
          <span slot="no-results">
            暂无数据
          </span>
        </infinite-loading>
      </ul>
    </div>
    <div class="leavemsg-input">
      <span class="leave-btn" @click="LeaveFun()"> 我要留言</span>
    </div>

  </div>
</template>

<style scoped>
  .LeaveMsg {
    background: #fff;
    height: 643px;
    padding: 10px 20px;
  }

  .LeaveMsg_title {
    height: 86px;
    border-bottom: 1px solid #E4E4E4;
    font-size: 32px;
    text-align: center;
    line-height: 86px;
    margin: 0 auto;
    color: #ff8910;
    font-weight: bold;
  }

  .LeaveMsg_close {
    background: url(/assets/img/close.png) no-repeat center;
    position: absolute;
    top: 17px;
    right: 15px;
    display: block;
    width: 36px;
    height: 36px;
    cursor: pointer;
  }

  .ul-con {
    height: 400px;
    overflow: scroll;
    overflow: auto;
    margin-bottom: 30px;
    scroll-behavior: contain;
    display: block;
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

  .p-teacher {
    line-height: 44px;
    color: #fe6601;
    margin-top: 5px;
  }

  .msg-info {
    display: inline-block;
    float: left;
  }

  .leavemsg-input {
    margin-bottom: 6px;
    overflow: hidden;
    margin: 0 auto;
    text-align: center;
  }

  .p-top-info span {
    display: inline-block;
  }

  .p-top-info {
    margin-top: 10px;
    height: 50px;
    line-height: 50px;
  }

  .checkmy {
    float: right;
    cursor: pointer;
    margin-left: 20px;
    background: #d8d8d8;
    color: #fff;
    height: 50px;
    line-height: 50px;
    padding: 0px 20px;
    border-radius: 8px;
  }

  .isactive {
    background-color: #009acf;
  }

  .leave-btn {
    display: inline-block;
    color: #fff;
    background-color: #0099cb;
    border-radius: 4px;
    padding: 0px 50px;
    height: 60px;
    line-height: 60px;
    cursor: pointer;
    font-size: 32px;
    margin-top: 5px;
  }

  .p-user {
    line-height: 44px;
  }
</style>

<script>
  import Vuex from "vuex"
  import * as types from "@/store/types"
  import SendLeave from "@/mobile_views/_/leavemsg/SendLeave";
  import InfiniteLoading from 'vue-infinite-loading';

  export default {
    data() {
      return {
        dataList: [],
        pageIndex: 0,
        pageSize: 10,
        totalNum: 0,
        datatype: 0,
        curTname: '',
        components: {
          SendLeave
        }
      }
    },
    name: 'LeaveMsg',
    props: ['tid'],

    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id).css('top', '70%');
    },
    methods: {
      getLeaveList(type) {
        this.datatype = type;
        this.pageIndex = 0;
        this.infiniteHandler();
      },
      infiniteHandler($state, _type) {
        if (!_type) {
          _type = 0;
        }
        this.datatype = _type;
        this.pageIndex += 1;
        var _params = {
          page: this.pageIndex,
          size: this.pageSize,
          type: this.datatype,
          tid: this.tid
        }
        setTimeout(() => {
          dms.getLeaves(_params, resp => {
            if (resp.list.length) {
              this.dataList = this.dataList.concat(resp.list);
              this.totalNum = resp.list_num || 0;
              this.curTname = resp.tName || '';
              $state.loaded();
            } else {
              $state.complete();
            }
          }, resp => {
            $state.complete();
          })
        }, 1000);
      },

      // getLeaveList(type, _page) {
      //   this.datatype = type;
      //   this.dataList = [];
      //   if (_page) {
      //     this.pageIndex = 0;
      //   }
      //   this.pageIndex++;
      //   var _params = {
      //     page: this.pageIndex,
      //     size: this.pageSize,
      //     type: type,
      //     tid: this.tid
      //   }
      //   this.msgInfo = "加载更多";
      //   dms.getLeaves(_params, resp => {

      //     // 多次加载数据
      //     if (resp.list.length == 0) {
      //       this.busy = true; //没有更多数据
      //       this.msgInfo = "加载完毕";
      //       this.isRoll = false;
      //     } else {
      //       this.busy = false;
      //     }
      //     this.dataList = this.dataList.concat(res.list);
      //     this.totalNum = resp.list_num || 0;
      //     this.curTname = resp.tName || '';
      //   }, res => {
      //     this.busy = false;

      //   })
      // },


      LeaveFun() {
        if (!this.userInfo.role.f_message_board_send) {
          this.dialogMsgAlign("该用户没有权限！");
          return;
        }
        this.pageHandle(this.tid);
      },
      pageHandle(teacherId) { //弹出框
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_inner_menu: 'SendLeave', //当前活动的菜单
          inner_menu_pop_curBoxId: '',
        });

        //以组件的 弹出
        let _id = this.$layer.iframe({
          content: {
            content: this.components.SendLeave,
            parent: this,
            data: {
              tid: teacherId
            },
            tipsMore: false,
            shade: true,
          },
          area: ["95%"],
          btn: "确定"
        });

        $("#" + _id).addClass('bgborder');
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_pop_curBoxId: _id, //存储当前弹出框的id
          inner_menu_isshow: false, //关闭菜单按钮
        });
      },
      closePop() {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
      }
    },
    components: {
      InfiniteLoading
    },
  }
</script>