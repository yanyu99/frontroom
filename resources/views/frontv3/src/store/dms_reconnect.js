var __restartChatConnect__ = false;

export default () => {
  if (__restartChatConnect__) {
    return;
  }
  __restartChatConnect__ = true;
  dms.LiveApi.mqttToken({ clientId: userInfo.dmsConfig.clientId, pubKey: userInfo.dmsConfig.pubKey }, resp => {
    var data = resp.data || {};
    if (data.dms_host && data.dms_host !== ROP.ICS_ADDR) {
      ROP.ICS_ADDR = resp.dms_host;
    }
    if (data.dms_port && data.dms_port !== ROP.ICS_ADDR) {
      ROP.ICS_PORT = resp.dms_port;
    }
    dms.ReEnter(data)
    __restartChatConnect__ = false
  }, resp => {
    __restartChatConnect__ = false
  }, null, null, {
    error(xhr, textStatus) {
      __restartChatConnect__ = false
    }
  })
}
