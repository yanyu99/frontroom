<template>
  <div>
    <h2>
      <font></font>赠送支付</h2>
    <section>
      <p>订单号：
        <font class="font-name">{{roomInfo.cashGiftInfo.orderCode}}</font>
      </p>
      <p>赠送礼物：
        <font class="font-name">{{roomInfo.cashGiftInfo.name}}</font>
      </p>
      <p>礼物数量：
        <font class="giftNum">{{roomInfo.cashGiftInfo.num}}</font>
        <!-- <input type="text" name="giftNum" v-model="giftNum" class="giftNum" readonly/> -->
      </p>
      <p>金额：
        <font class="font-money">{{totalMoney}}元</font>
      </p>
    </section>

    <section>
      <div class="weui-cells">

        <div class="weui-cell">
          <div class="weui-cell__hd">
            <img src="/assets/v3/images/phone/zfb-icon.png" alt="" style="margin-right:5px;display:block">
          </div>
          <div class="weui-cell__bd">
            <p>支付宝支付</p>
          </div>
          <div class="weui-cell__ft">
            <input id="item1" type="radio" name="item-type" value="ali" v-model="txtType" checked>
            <label for="item1" @click="changeCheck('ali')"></label>
          </div>
        </div>
      </div>
      <div>

        <div class="weui-cell">
          <div class="weui-cell__hd">
            <img src="/assets/v3/images/phone/wx-icon.png" alt="" style="margin-right:5px;display:block">
          </div>
          <div class="weui-cell__bd">
            <p>微信支付</p>
          </div>
          <div class="weui-cell__ft">
            <input id="item2" type="radio" name="item-type" value="wx" v-model="txtType">
            <label for="item2" @click="changeCheck('wx')"></label>
          </div>
        </div>
      </div>

    </section>
    <span class="sp-button" @click="sendInfo">
      确定
    </span>
  </div>
</template>
<style scoped>
  h2:before {
    width: 40px;
    height: 80px;
    background: url(/assets/img/user/topbg.jpg) no-repeat left;
    background-size: 100%;
  }

  h2 {
    font-size: 36px;
    height: 100px;
    line-height: 100px;
    background-color: #fff;
    padding-left: 20px;
  }

  h2 font {
    display: inline-block;
    background: url(/assets/img/user/topbg.jpg) no-repeat left;
    background-size: 100%;
  }

  section {
    background: #fff;
    margin-top: 20px;
    display: block;
  }

  section p {
    line-height: 80px;
    padding: 20px;
    color: #8e8e8e;
    font-size: 30px;
  }

  .font-name {
    color: #575757
  }

  .font-money {
    color: #ff7e00;
    font-weight: bold;
  }

  .giftNum {
    height: 60px;
    line-height: 60px;
    padding-left: 4px;
  }

  .sp-button {
    display: block;
    margin: 0 auto;
    /* width: 90%; */
    height: 100px;
    color: #fff;
    line-height: 100px;
    background: #00aeee;
    text-align: center;
    font-size: 40px;
    margin: 20px;
  }

  .weui-cell {
    padding: 10px 15px;
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .weui-cells {
    margin-top: 1.17647059em;
    background-color: #FFFFFF;
    line-height: 1.47058824;
    font-size: 17px;
    overflow: hidden;
    position: relative;
    border-bottom: 1px solid #e1e1e1;
  }

  .weui-cell__bd {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .weui-cell__bd p {
    color: #414141;
  }

  .weui-cell__ft {
    text-align: right;
    color: #808080;
    position: relative;
  }

  .weui-cell__hd img {
    width: 80px;
    height: 80px;
    background-size: 100%;
    margin-right: 3px;
    display: block
  }

  input[type="radio"] {
    width: 60px;
    height: 60px;
    opacity: 0;
  }

  label {
    position: absolute;
    left: 0px;
    top: 9px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 1px solid #c8c8c8;
  }

  input:checked+label {
    background-color: #7ebc08;
    border: 1px solid #7ebc08;
  }

  input:checked+label::after {
    position: absolute;
    content: "";
    width: 15px;
    height: 20px;
    top: 14px;
    left: 18px;
    border: 4px solid #fff;
    border-top: none;
    border-left: none;
    transform: rotate(45deg)
  }
</style>

<script>
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        txtType: 'ali',
      }
    },
    computed: {
      totalMoney() {
        return (this.roomInfo.cashGiftInfo.num * this.roomInfo.cashGiftInfo.price);
      }
    },
    created() {
      if (!this.roomInfo.cashGiftInfo.orderCode && window.localStorage.cashGiftInfo) {
        this.roomInfo.cashGiftInfo = JSON.parse(window.localStorage.cashGiftInfo)
      }
      window.localStorage.cashGiftInfo = JSON.stringify(this.roomInfo.cashGiftInfo)
    },
    methods: {
      changeCheck(strType) {
        this.txtType = strType;
      },
      sendInfo() {
        dms.payCashGift({
          id: this.roomInfo.cashGiftInfo.orderCode,
          pay_type: this.txtType
        }, resp => {
          if (resp.codeUrl) {
            var toUrl = resp.codeUrl;
            console.log(toUrl);
            location.href = toUrl;
          } else {
            this.$layer.msg(resp.respDesc, { time: 2 });
          }
        }, resp => {
          this.$layer.msg(resp.msg, { time: 2 });
        })
      },
    }
  }
</script>