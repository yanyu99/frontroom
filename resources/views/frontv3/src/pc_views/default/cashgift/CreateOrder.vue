<template>
  <div class=" pc_pay" id="CreateOrder">
    <div class="pay_title">
      <h4>赠送支付</h4>
    </div>
    <div class="pay_content">
      <div class="step-first">
        <ul class="info">
          <li>
            <span>选择礼物：</span>
            <span class="gift_name"></span>
          </li>
          <li>
            <span>数量：</span>
            <span class="gift_num">8</span>
          </li>
          <li>
            <span>支付金额：</span>
            <span class="gift_price">8元</span>
          </li>
        </ul>
        <div class="info_pay">
          <p>
            <span class="sp-pay-tittype">请选择支付方式:</span>
            <span class="pay-sel">
              <label for="item2">
                <input id="item2" type="radio" name="item-type" value="wx" checked>
                <img src="assets/v2/img/wx-icon.png" alt="" class="small_logo"> 微信支付
              </label>
              <label for="item1">
                <input id="item1" type="radio" name="item-type" value="ali">
                <img src="/assets/v2/img/zfb-icon.png" alt="" class="small_logo"> 支付宝支付
              </label>
            </span>
          </p>
          <br/>
          <p class="btn-p">
            <input type="button" value="确认" class="inputBtn" @click="payOrder" />
          </p>
        </div>
      </div>
      <div class="step-second" style="display: none;">
        <div class="info_pay">
          <ul class="info">
            <p class="orderinfo-p" style="margin-top:20px;">
              <span>礼物名称：</span>
              <span class="gift_name">33</span>
            </p>
            <p class="orderinfo-p">
              <span>数量：</span>
              <span id="giftNum"></span>
            </p>
            <p class="orderinfo-p">
              <span>支付金额：</span>
              <span class="gift_price">6元</span>
            </p>
            <p class="orderinfo-p">
              <span>订单号：</span>
              <span class="gift_name">666666</span>
            </p>
          </ul>
          <ul class="wx_zfb">
            <li class="error-msg" style="display: none;"></li>
            <li class="pay-type" style="display: none" data-type="" isFirst="true">
              <div class="codeimg">
                <img id="code-img" src="" alt="">
              </div>
              <div class="pay_bottom">
                <img id="img-icon" src="/assets/v2/img/zfb-icon.png" alt="">
                <span id="txt-des"></span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  export default {
    data() {
      return {};
    },
    methods: {
        payOrder(){

        }
    },
  };
</script>