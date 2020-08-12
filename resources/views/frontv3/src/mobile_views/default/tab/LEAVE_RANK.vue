<template>
  <div v-if="tab.tag == roomInfo.active_menu" class="pane sider-hot-rank vote" :style="{backgroundColor:$c('#2f2e2e##该块背景颜色', __FILE__)}">
    <scroller>
      <ul id="idLeaveRank">

        <li v-for="(item,index) in roomInfo.leaveRank.teacherList" :key="item.id" :style="{borderBottom:'1px solid'+$c('#595858##border-bottom颜色', __FILE__)}">
          <span class="sp-ind">
            <label :style="lbIndStyle(index) ">{{index+1}}</label>
          </span>
          <span class="sp-tname" :style="{color:$c('#ffffff##昵称文本颜色', __FILE__)}">
            <font>
              <label :style="{color: item.name_color !='#ffffff'|| item.name_color !='#FFFFFF'? item.name_color :'#fff','font-weight':item.name_bold?'':''}">
                {{item.name}}
              </label>
            </font>
          </span>

          <span class="sp-zan" @click="LeaveClick(item.id)">
            <i :attr-test="$m('/assets/v3/images/phone/leavemsg_btn_bg.png##留言图片', __FILE__)" :style="{backgroundImage: 'url('+$m('/assets/v3/images/phone/leavemsg_btn_bg.png##留言图片', __FILE__) +')'}">
              {{$t('留言##按钮文字', __FILE__) || '留言'}}</i>
          </span>
        </li>
      </ul>
    </scroller>

  </div>
</template>


<style scoped>
  .fired-img {
    position: absolute;
    margin-top: -80px;
  }

  .sp-tname font {
    display: block;
  }

  .sp-tname font:nth-child(1) {
    display: block;
    width: 100%;
    height: 85px;
    line-height: 115px;
  }

  .sp-tname font:nth-child(2) {
    display: block;
    width: 100%;
    height: 22px;
    line-height: 22px;
    padding-top: 1px;
  }

  .vote {
    color: #fff;
    position: fixed;
    width: 100%;
    overflow: auto;
    position: relative;
  }

  .vote ul {}

  .vote ul li {
    display: -webkit-box;
    /* Chrome 4+, Safari 3.1, iOS Safari 3.2+ */
    display: -moz-box;
    /* Firefox 17- */
    display: -webkit-flex;
    /* Chrome 21+, Safari 6.1+, iOS Safari 7+, Opera 15/16 */
    display: -moz-flex;
    /* Firefox 18+ */
    display: -ms-flexbox;
    /* IE 10 */
    display: flex;
    /* Chrome 29+, Firefox 22+, IE 11+, Opera 12.1/17/18, Android 4.4+ */
    height: 122px;
    line-height: 122px;
    /* border-bottom: 1px solid #595858; */
    margin: 0px 12px;
  }

  .vote ul li span {
    text-align: center;
  }

  .vote ul li span.sp-ind {
    flex: 1;
  }

  .vote ul li span.sp-ind label {
    display: inline-block;
    width: 60px;
    height: 60px;
    line-height: 60px;
    font-size: 32px;
    border-radius: 32px;
    text-align: center;
  }

  .vote ul li span.sp-tname {
    flex: 3;
    font-size: 30px;
    height: 122px;
    line-height: 122px;
    text-align: left;
  }

  .vote ul li span.sp-zan {
    /* flex: 2; */
    margin-right: 10px;
  }

  .sp-zan i {
    display: inline-block;
    background-position: left;
    background-repeat: no-repeat;
    background-size: 100%;
    width: 148px;
    height: 82px;
    line-height: 86px;
    font-weight: bold;
    font-size: 28px;
    text-indent: 34px;
    cursor: pointer;
  }

  .sp-zan i.izan {
    background-size: 100%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import AnswerQues from "./AnswerQues";
  import LeaveList from "@/mobile_views/_/leavemsg/LeaveList";

  export default {
    props: {
      tab: Object
    },
    data() {
      return {
        components: {
          LeaveList
        }
      };
    },
    created() {
      this.lazyWatch(
        'leaveRank',
        'roomInfo.active_menu',
        (n, o) => n == 'LEAVE_RANK'
      )
    },
    methods: {
      load() {
        this.$store.dispatch(types.LOAD_RANKING_LEAVE)
      },
      lbIndStyle(index) {
        var _first = this.$c('#fa2c1f##第一名背景颜色', __FILE__) ? this.$c('#fa2c1f##第一名背景颜色', __FILE__) : 'red';
        var _second = this.$c('#fa2c1f##二 三 名背景颜色', __FILE__) ? this.$c('#fa2c1f##二 三 名背景颜色', __FILE__) : '#fa9000';
        var _all = this.$c('#00a0fc##其他排名背景颜色', __FILE__) ? this.$c('#00a0fc##其他排名背景颜色', __FILE__) : '#3285ED';
        return {
          backgroundColor: index == 0 ? _first : (index < 3 ? _second : _all),
        };
      },

      LeaveClick(id) {
        this.pageHandle(id);
      },

      pageHandle(tid) { //弹出框
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_inner_menu: 'LeaveList', //当前活动的菜单
          inner_menu_pop_curBoxId: '',
        });

        //以组件的 弹出
        let _id = this.$layer.iframe({
          content: {
            content: this.components.LeaveList,
            parent: this,
            data: {
              tid: tid
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
        });
      },
    },
  };
</script>