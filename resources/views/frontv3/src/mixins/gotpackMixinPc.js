import * as types from "@/store/types"
import PocketSuc from "@/pc_views/_/packet/PacketSuc";

var timer = null;
export default {
  data() {
    return {
      goting: false
    };
  },
  created() {
    if (timer) {
      clearInterval(timer);
      timer = null;
    }
    var timer = setInterval(() => {
      if (this.goting) {
        this.goting = false;
      }
    }, 1500)
  },
  methods: {
    _gotLuckMoney(luck_id) {
      var _tempData = this.roomInfo.packArr.slice();
      var _ind = _tempData.findIndex(i => i.luck_id == luck_id);
      _ind >= 0 && _tempData.splice(_ind, 1);

      this.$store.commit(types.UPDATE_ROOM_INFO, {
        packArr: _tempData
      })
    },
    getPacket(clickType, _lmid) {
      var _lmid = _lmid || '';
      if (clickType == "popicon") {
        var _tmpArr = this.roomInfo.packArr.slice();
        var tmpData = _tmpArr.shift();
        var _lmid = tmpData.luck_id;
      }
      this._getPacket(_lmid);

    },
    _getPacket(_lmid) {
      if (!this.userInfo.role.f_got_luck_money) {
        return;
      }
      if (this.goting) {
        return;
      }
      this.goting = true;
      var self = this;
      if (this.roomInfo.luckmoney_need_phone) {
        dms.LiveApi.checkLuckMoney({
          luck_id: _lmid
        }, resp => {
          if (!resp.needPhone) {
            self._gotLuckMoney(_lmid);
          }

          if (resp.needPhone) { //调用手机模板
            this.dialogMsgAlign("领取成功");
          }
        }, resp => {
          if (!resp.needPhone) {
            self._gotLuckMoney(_lmid);
          }
          if (resp.code == 401 || resp.code == 404) {
            this.popShow("PacketNone");
            //this.dialogMsgAlign("抱歉红包已经被抢完啦！", "红包");
          } else {
            this.dialogMsgAlign("你已经抢过改红包了", "红包");
          }
        });
      } else {
        dms.LiveApi.gotLuckMoney({
          luck_id: _lmid,
          room_id: this.roomInfo.room_id,
        }, resp => {
          self._gotLuckMoney(_lmid);

          //以组件的 弹出 成功领取红包 模板
          let _id = this.$layer.iframe({
            content: {
              content: PocketSuc,
              parent: this,
              data: {
                args: resp
              }
            },
            btn: "确定"
          });
          //存储当前弹出框的id
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            curlayer_pop_id: _id
          });
        }, resp => {
          self._gotLuckMoney(_lmid);
          if (resp.code == 403) {
            //抱歉红包已经被抢完啦！
            this.popShow("PacketNone");
          } else if (resp.code == 110) {
            this.dialogMsgAlign(resp.msg, "红包");
          } else {
            this.dialogMsgAlign(resp.msg, "红包");
          }
        }, null, null, {
          error(xhr, status, error) {
            this.dialogMsgAlign("系统繁忙");
          }
        });
      }
    },

  }

}