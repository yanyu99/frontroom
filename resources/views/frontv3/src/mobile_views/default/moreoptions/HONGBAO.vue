<template>
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
  </div>
</template>
<style scoped>
  .send-packet {
    height: 666px;
  }
  .send-packet-con {
    background-color: white;
    z-index: 1002;
    overflow: auto;
    text-shadow: 2px;
    background: url("/assets/v3/images/phone/packet_bg.png") no-repeat center;
    width: 574px;
    height: 664px;
    background-size: 100%;
  }

  .packet-main {
    padding-top: 28%;
    margin: 0 auto;
    width: 420px;
    text-align: center;
  }

  .packet-main span {
    display: inline-block;
    width: 100%;
    padding: 8px 0px;
  }

  .packet-main span label {
    display: inline-block;
    width: 86px;
    font-size: 30px;
    text-align: left;
  }

  .txt-inp {
    font-size: 30px;
    width: 318px;
    height: 68px;
    line-height: 68px;
    vertical-align: middle;
    border: 2px solid #ded3ca;
    border-radius: 8px;
    padding-left: 3px;
  }

  .f-money {
    display: inline-block;
    float: left;
    font-size: 48px;
    color: #d84e43;
    font-weight: bold;
  }

  .remain-money {
    font-size: 34px;
    color: #616161;
    vertical-align: middle;
    line-height: 70px;
  }

  .sendpacket-btn {
    background-color: #d84e43;
    color: #fff;
    width: 420px;
    height: 92px;
    line-height: 92px;
    text-align: center;
    border-radius: 6px;
    font-size: 30px;
  }

  .notify-main {
    width: none !important;
  }
</style>
<style>
  .bgborder {
    background-color: transparent !important;
    border: 0 none !important;
    top: 66% !important;
  }
</style>
<script>
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
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id).addClass('bgborder');
    },
    methods: {
      sendPacket() {
        //发送红包
        this.roomInfo.userPacketInfo.money ? dms.LiveApi.sendLuckMoney({
          money: this.txtMoney,
          num: this.txtNum,
          luck_note: this.txtRemark
        }, res => {
          //更新用户红包数据
          this.$store.dispatch(types.LOAD_USERPACKETINFO)
        }) : this.dialogMsgAlign("金额不足！");

        this.$layer.close(this.roomInfo.inner_menu_pop_curBoxId);
      }
    }
  };
</script>
