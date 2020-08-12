export default {
  mounted() {
    typeof this.afterAppend === 'function' && this.afterAppend(this.msg_id);
  },
  computed: {
    msg_id() {
      return "msg_" + dms.uniqueId();
    }
  },
  methods: {
    userImgSrc(msgItemData) { 
      var _type = msgItemData.role_id || (msgItemData.user ? msgItemData.user.role_id : 0);
      if (!_type || typeof this.baseConfig.roles[_type] === 'undefined') {
        return;
      }
      var imgSrc = this.baseConfig.roles[_type].role_pic ? this.baseConfig.roles[_type].role_pic : '';
      return imgSrc;
    },
    userImgStyle(msgItemData) {
      var _type = msgItemData.role_id || (msgItemData.user ? msgItemData.user.role_id : 0);
      if (!_type || typeof this.baseConfig.roles[_type] === 'undefined') {
        return;
      }
      return {
        width: ((this.baseConfig.roles[_type]["role_picw"]) / 24 * 27) + "px",
        height: '27px',
        'vertical-align':'middle'
      };
    },
  },
}