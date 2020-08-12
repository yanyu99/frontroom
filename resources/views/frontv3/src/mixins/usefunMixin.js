import Vuex from "vuex";
import * as types from "@/store/types";

export default {
  data() {
    return {
      todayTime: 0,
      allTime: 0,
    }
  },
  created() {
    this.$watch("roomInfo.selectUser.uid", (newVal, oldVal) => {
      var _time = this.roomInfo.selectUser.todayLife || 0;
      this.todayTime = dms.timeFormatStr(_time * 1000, 3) || 0; //天
      var _allTime = this.roomInfo.selectUser.allLife || 0;
      this.allTime = dms.timeFormatStr(_allTime * 1000, 3) || 0; //累计
    });
  },
  computed: {
    killipText() {
      return !this.roomInfo.selectUser.killip ? '封杀ip' : '解除封杀'
    },
    lookvideoText() {
      return this.roomInfo.selectUser.lookvideo == 0 ? '看视频' : '禁视频'
    },
    kickText() {
      return this.roomInfo.selectUser.kick == 0 ? '踢出' : '解除踢出'
    },
    gagText() {
      return this.roomInfo.selectUser.gag == 0 ? '禁言' : '解除禁言'
    },
  },
  methods: {
    //阻止事件冒泡函数
    stopBubble(event) {
      if (event && event.stopPropagation)
        event.stopPropagation()
      else
        window.event.cancelBubble = true
    },
    killIp() {
      this.$store.dispatch(types.DO_KILL_IP, {
        killip: this.roomInfo.selectUser.killip,
        uid: this.roomInfo.selectUser.uid
      })
    },
    lookVideo() {
      this.$store.dispatch(types.DO_USER_LOOKVIDEO, {
        lookvideo: this.roomInfo.selectUser.lookvideo,
        uid: this.roomInfo.selectUser.uid
      })
    },
    userKick() { //踢出
      this.$store.dispatch(types.DO_USER_KICK, {
        kick: this.roomInfo.selectUser.kick,
        uid: this.roomInfo.selectUser.uid
      })
    },
    userGag() {
      this.$store.dispatch(types.DO_USER_GAG, {
        gag: this.roomInfo.selectUser.gag,
        uid: this.roomInfo.selectUser.uid
      })
    },
    closeLayer() {
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        selectUser: { ...types.emptyUserInfo }
      });
    },
  }
}