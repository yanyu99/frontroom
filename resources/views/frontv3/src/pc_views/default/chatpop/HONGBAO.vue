<template>
  <!-- 发红包 -->
  <div class=" send-packet" id="HONGBAO">
    <div class="send-packet-con">
      <div class="packet-main">
        <span>
          <label>金额:</label>
          <input type="text" class=" txt-inp" v-model="txtMoney" @keyup="txtMoney=txtMoney.replace(/\D/gi,'')" />
        </span>
        <span>
          <label>个数:</label>
          <input type="text" class="txt-inp txt-num" v-model="txtNum" @keyup="txtNum=txtNum.replace(/\D/gi,'')" />
        </span>
        <span>
          <label>备注:</label>
          <input type="text" class="txt-inp txt-remark" v-model="txtRemark" />
        </span>
        <span>
          <font class="f-money">￥{{txtMoney}}</font>
          <i class="remain-money">余额:{{roomInfo.userPacketInfo.money}}
          </i>
        </span>
        <span>
          <input type="button" class="sendpacket-btn" @click="sendPacket" value="发送红包" />

        </span>
      </div>

    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>
<style scoped>
  .send-packet-con {
    background-color: white;
    z-index: 1002;
    overflow: auto;
    text-shadow: 2px;
    background: url("/assets/v3/images/phone/packet_bg.png") no-repeat center;
    width: 328px;
    height: 376px;
    background-size: 100%;
  }

  .packet-main {
    padding-top: 28%;
    margin: 0 auto;
    width: 210PX;
    text-align: center;
  }

  .packet-main span {
    display: inline-block;
    width: 100%;
    padding: 8px 0px;
  }

  .packet-main span label {
    display: inline-block;
    width: 43px;
    font-size: 15px;
    text-align: left;
  }

  .txt-inp {
    font-size: 16px;
    width: 159px;
    height: 34px;
    line-height: 34px;
    vertical-align: middle;
    border: 2px solid #ded3ca;
    border-radius: 4px;
    padding-left: 3px;
  }

  .f-money {
    display: inline-block;
    float: left;
    font-size: 24px;
    color: #d84e43;
    font-weight: bold;
  }

  .remain-money {
    font-size: 17px;
    color: #616161;
    vertical-align: middle;
    line-height: 35px;
  }

  .sendpacket-btn {
    background-color: #d84e43;
    color: #fff;
    width: 210px;
    height: 46px;
    line-height: 46px;
    text-align: center;
    border-radius: 3px;
    font-size: 15px;
  }

  .notify-main {
    width: none !important;
  }
</style>
<script>
  import Vuex from "vuex"
  import * as types from "@/store/types";
  export default {
    data() {
      return {
        txtMoney: 1,
        txtNum: 1,
        txtRemark: "恭喜发财！"
      };
    },
    created() {
      this.$store.dispatch(types.LOAD_USERPACKETINFO)
    },
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
        $("#" + id).css({
        height: '380px'
      });
      $("#" + id).find('.vl-notify-content').addClass('padding-style')
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
      sendPacket() {
        //发送红包
        this.roomInfo.userPacketInfo.money ? dms.LiveApi.sendLuckMoney({
          money: this.txtMoney,
          num: this.txtNum,
          luck_note: this.txtRemark
        }, res => {
          //更新用户红包数据
          this.$store.dispatch(types.LOAD_USERPACKETINFO) //
        }) : this.dialogMsgAlign("金额不足！");
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>
