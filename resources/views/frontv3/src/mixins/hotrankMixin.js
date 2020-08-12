import * as types from "@/store/types";
import AnswerQues from "@/pc_views/_/side/AnswerQues";
export default {
  data() {
    return {
      vote_title: '',
      components: {
        AnswerQues
      }
    };
  },
  mounted() {
    this.vote_title = this.baseConfig.hotcfg.vote_title;
  },
  methods: {
    zanClick(tid, event) {
      dms.LiveApi.sendHot({
        tid: tid
      }, resp => {
        //开启点赞的功能
        var _mapTip = JSON.parse(JSON.stringify(this.roomInfo.hotRank.userTidMap));
        _mapTip[tid] = 1;
        this.$store.state.roomInfo.hotRank.userTidMap = _mapTip;

        this.dialogMsgAlign(resp.msg || this.baseConfig.hotcfg.vote_title + "成功"); //刷新数据 cmd_hot_send
        (this.baseConfig.hotcfg.chat_add_hot && resp.teacherName) && this.$store.commit(types.UPDATE_USER_INFO, {
          hotTeacherName: resp.teacherName
        });
      }, resp => {
        if (resp.code == 203) {
          window.D.plat != 'pc' ?
            this.pageHandle() :
            this.popShow("AnswerQues", { text: "回答问" + this.baseConfig.hotcfg.vote_title });

          this.$store.commit(types.UPDATE_ROOM_INFO, {
            hotRank: {
              questionList: resp.data.questions,
              tid: tid, //投票的老师
            }
          });
        } else {
          this.dialogMsgAlign(resp.msg)
          return
        }
      });
    },
    pageHandle() { //弹出框
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        active_inner_menu: 'AnswerQues', //当前活动的菜单
        inner_menu_pop_curBoxId: '',
      });

      //以组件的 弹出
      let _id = this.$layer.iframe({
        content: {
          content: this.components.AnswerQues,
          parent: this,
          data: {
            obj: {}
          },
          tipsMore: false,
          shade: true,
        },
        area: ["95%"],
        btn: "确定"
      });

      //$("#" + _id).addClass('bgborder');
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        inner_menu_pop_curBoxId: _id, //存储当前弹出框的id
        inner_menu_isshow: false, //关闭菜单按钮
      });
    },
  },
}