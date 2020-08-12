import * as types from "@/store/types";
import dmsReconnect from "@/store/dms_reconnect";

export default {
  created() {
    if (this.roomInfo.is_fist_load) {
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        is_fist_load: false
      })
    }

  },
  mounted() {
    userInfo.uid && this.$store.dispatch(types.LOAD_ROOM_INFO);
    this.$layer.loading(2, { time: window.LIVE_PLAT == 'mobile' ? 2 : 1 });
    $(window).unload(() => {
      this.lifeTimer && clearInterval(this.lifeTimer);
      var paramsObj = this.isMobile({ last: 1 });
      dms.LiveApi.userLife(paramsObj, null, null, null, null, {
        async: false,
        dataType: 'json',
      })
    });

    this.lifeTimer = setInterval(() => {
      var paramObj = this.isMobile({});
      dms.LiveApi.userLife(paramObj, data => {
        if (data.closed) {
          location.reload(true);
          return;
        }
        if (data.dms_msg_enable === 1 || data.dms_msg_enable === 0) {
          dms.dmsConfig.dms_msg_enable = data.dms_msg_enable;
        }
        if (data.ip) {
          this.$store.commit(types.UPDATE_USER_INFO, {
            ip: data.ip
          })
        }

        if ((data.dms_host && data.dms_host !== ROP.ICS_ADDR) || (data.dms_port && data.dms_port !== ROP.ICS_PORT)) {
          ROP.Leave();
          setTimeout(() => {
            console && console.log && console.log('dms host 改变 重试连接')
            dmsReconnect()
          }, 3000);
        }
      })
    }, 60 * 1000); // 每分钟轮询
    var firstParamObj = this.isMobile({ first: 1 });
    dms.LiveApi.userLife(firstParamObj)
  },
  beforeDestroy() {
    this.lifeTimer && clearInterval(this.lifeTimer)
  },
  methods: {
    isMobile(paramsObj) {
      paramsObj = paramsObj || {};
      if (window.LIVE_PLAT == 'mobile') {
        paramsObj.plat = 'mobile';
      }
      return paramsObj;
    },
  }
}
