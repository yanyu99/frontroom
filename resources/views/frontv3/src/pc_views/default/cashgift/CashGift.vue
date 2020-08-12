<template>
  <div class="main-cash-gift" id="CashGift ">
    <div class="box">
      <div class="arr-left prev" @click="prevBtn">
        <div class="triangle_border_left not_left_click"></div>
      </div>
      <div class="center" id="content_gift">
        <ul class="gift_box" id="content_list" style="white-space: nowrap;">
          <li v-for="(item,index) in baseConfig.roomUI.money_gifts" :key="item.id" @mouseenter="sendInfoShow(index)" @mouseleave="sendInfoHide(index)">
            <img :src="item.pic" alt>
            <div class="send-info" :id="'info-'+index" v-show="boxShow">
              <p class="p-gift">
                {{item.name}}
                <font>￥{{item.price}} 元</font>
              </p>
              <p class="p-gift-num">
                数量：
                <input type="text" name="CashGiftNum" v-model="item.num">
              </p>
              <p>
                <span class="btn-cash-gift" @click="createCashOrder">赠送</span>
              </p>
            </div>
            <create-order v-show="gift_pay"></create-order>
          </li>
        </ul>
      </div>
      <div class="arr-right next" id="next-btn" @click="nextBtn">
        <div class="triangle_border_right"></div>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import CreateOrder from "@/pc_views/_/cashgift/CreateOrder";
  var page = 1;
  var i = 4; //每版放4个图片
  export default {
    mixins: [layercommMixinPc],
    data() {
      return {
        boxShow: false,
        v_width: 0,
        len: 0,
        li_width: 0,
        page_count: 0,
        gift_pay: false
      };
    },
    mounted() {
      //TODO js改写
      var content = $("div#content_gift");
      var content_list = $("#content_list");
      this.v_width = content.width();
      this.len = content.find("li").length;
      this.li_width = content.find("li").width(); //null
      this.page_count = Math.ceil(this.len / i); //只要不是整数，就往大的方向取最小的整数  页数
      $("ul#content_list").width(this.len * this.li_width + 100);
    },
    methods: {
      sendInfoShow(index) {
        $("#info-" + index).show();
      },
      sendInfoHide(index) {
        $("#info-" + index).hide();
      },
      prevBtn() {
        var self = this;
        //TODO
        $(".triangle_border_right").removeClass("not_right_click");
        if (!$("#content_list").is(":animated")) {
          //判断“内容展示区域”是否正在处于动画
          if (page == 1) {
            //已经到第一个版面了,如果再向前，必须跳转到最后一个版面。
            $(".triangle_border_left").addClass("not_left_click");
            return;
          } else {
            $("#content_list").animate(
              {
                marginLeft: "+=" + self.v_width / 2
              },
              "slow"
            );
            page--;
            if (page == 1) {
              //已经到第一个版面了,如果再向前，必须跳转到最后一个版面。
              $(".triangle_border_left").addClass("not_left_click");
              return;
            }
          }
        }
      },
      nextBtn() {
        //TODO
        var self = this;
        $(".triangle_border_left").removeClass("not_left_click");
        if (!$("#content_list").is(":animated")) {
          //判断“内容展示区域”是否正在处于动画
          if (page == self.page_count) {
            //已经到最后一个版面了,如果再向后，必须跳转到第一个版面。
            $(".triangle_border_right").addClass("not_right_click");
            return;
          } else {
            $("#content_list").animate(
              {
                marginLeft: "-=" + self.v_width / 2 + "px"
              },
              "slow"
            ); //通过改变left值，达到每次换一个版面
            page++;
            if (page == self.page_count) {
              //已经到最后一个版面了,如果再向后，必须跳转到第一个版面。
              $(".triangle_border_right").addClass("not_right_click");
              return;
            }
          }
        }
      },
      createCashOrder() {
        this.popShow("CreateOrder");
      }
    },
    components: {
      CreateOrder
    }
  };
</script>