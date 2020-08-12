export default {
  mounted() {
    typeof this.afterAppend === 'function' && this.afterAppend(this.msg_id);
  },
  computed: {
    msg_id() {
      return "msg_" + dms.uniqueId();
    },
  },
  methods: {
    userImgSrc(msgItemData, hasVal) {
      var _type = msgItemData.role_id || (msgItemData.user ? msgItemData.user.role_id : 0);
      if (hasVal) {
        _type = msgItemData.to_role_id || 100;
      }
      if (!_type || typeof this.baseConfig.roles[_type] === 'undefined') {
        return;
      }
      var imgSrc = this.baseConfig.roles[_type].role_pic ? this.baseConfig.roles[_type].role_pic : ''; //baseConfig.roles[_type]['imgurl'] 
      return imgSrc;
    },

    userImgStyle(msgItemData, hasVal) {
      var _type = msgItemData.role_id || (msgItemData.user ? msgItemData.user.role_id : 0);
      if (hasVal) { 
        _type = msgItemData.to_role_id || 100; //没有就是游客
      }
      if (!_type || typeof this.baseConfig.roles[_type] === 'undefined') {
        return;
      }
      return {
        width: ((this.baseConfig.roles[_type]["role_picw"]) / 24 * 27) + "px",
        height: '27px',
      };
    },
  },
}