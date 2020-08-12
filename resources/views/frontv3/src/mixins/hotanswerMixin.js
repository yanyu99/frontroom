import * as types from "@/store/types";

export default {
  data() {
    return {
      pickedArr: [],
    };
  },
  props: ["quesData"],
  methods: {
    questionOk() {
      var allchecked = true;
      var map = { tid: this.roomInfo.hotRank.tid, ask: [], answer: [] };
      var _tmpArr = this.roomInfo.hotRank.questionList.slice()
      _tmpArr.forEach((item, index) => {
        var val = this.pickedArr[index]
        //选中的值
        if (!val) {
          allchecked = false;
        } else {
          map.ask.push(item.id);
          map.answer.push(this.pickedArr[index]);
        }
      });
      if (!allchecked) {
        this.dialogMsgAlign("请选择问题答案");
        return;
      }
      //提示框 您仅有一次投票机会，继续请确定，返回请取消
      this.hotAnswerFunc(map)
    },
    hotAnswerFunc(map) {
      //弹框
      dms.LiveApi.answerHot(map, res => {
        var _mapTip = JSON.parse(JSON.stringify(this.roomInfo.hotRank.userTidMap));
        _mapTip[map.tid] = 1;
        this.$store.state.roomInfo.hotRank.userTidMap = _mapTip;

        this.baseConfig.hotcfg.chat_add_hot && this.$store.commit(types.UPDATE_USER_INFO, {
          hotTeacherName: res.teacherName
        });
        this.quesCancel();
        this.dialogMsgAlign(res.msg || this.baseConfig.hotcfg.vote_title + "成功");
      }, resp => {
        this.dialogMsgAlign(resp.msg || this.baseConfig.hotcfg.vote_title + "失败:答案错误！");
        this.quesCancel();
      });
    },
    quesCancel() {
      if (window.D.plat == 'pc') {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
        this.$store.state.roomInfo.curlayer_pop_id = '';
      } else {
        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId)
        this.$store.state.roomInfo.inner_menu_pop_curBoxId = '';
      }
    },
  },
}