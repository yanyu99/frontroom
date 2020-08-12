<template>
  <div class="chatbar-bottom" style="position:relative" :style="{'background-color':$c('#252525##聊天框的背景颜色', __FILE__)}">
    <div class="chattopattern">
      <cur-pattern></cur-pattern>
      <!-- 对谁说 -->
      <chat-to :curType="'pubChat'"></chat-to>
    </div>
    <div class="dms-send-container">
      <!-- 更多功能 -->
      <more-action v-show="roomInfo.active_more_isshow && !roomInfo.cashgift_is_show" :moreOptions='moreOptionsArr'></more-action>

      <div class="dms-textarea-container" :style="{'background-color':$c('#090909##聊天消息发送底部的颜色', __FILE__),'height':$t('46##聊天发送底部的高度',__FILE__)+'px'}">
        <span id="js-showmore-btn" v-if="moreOptionsArr.length>0" @click="isShowMoreAction($event)" class="showmore-button" :style="{ background:'url('+$m('/assets/v3/images/phone/moreaction.png##更多操作图标', __FILE__)+') no-repeat center'}"></span>

        <span id="js-gift-btn" v-if="baseConfig.eventcfg.gift_opend" @click="isGiftShow($event)" class="gift-button" :style="{ background:'url('+$m('/assets/v3/images/phone/gift.png##礼物图标', __FILE__)+') no-repeat center'}"></span>

        <span id="dms-emotion-button" class="dms-emotion-button" :style="{ background:'url('+$m('/assets/v3/images/phone/emotion.png##表情图标', __FILE__)+') no-repeat center'}"></span>

        <div class="chatSend" v-show="!roomInfo.cashgift_is_show">
          <div class="dms-textarea-box">
            <input type="text" class="input-text" v-model="textMsg" id="aodianyun-dms-text" maxlength="30" placeholder="说点什么..." @keyup.enter="sendMsg" :style="{color:$c('#6f6f6f##输入框字体的颜色', __FILE__),backgroundColor:$c('#090909##输入框背景的颜色', __FILE__),border:'1px solid '+$c('#505050##输入框边框的颜色', __FILE__)}">
          </div>
          <a href="javascript:;" class="chat-send-btn" id="id-chat-btn" v-show=" waitTime == 0" @click="sendMsg" :style="{backgroundColor: $c('#fe9901##聊天发送按钮颜色', __FILE__)}">发送</a>
          <a href="javascript:;" class="chat-send-btn iswait" v-show=" waitTime != 0" :style="{backgroundColor: $c('#fe9901##聊天发送按钮颜色', __FILE__)}">{{waitTime}}</a>
        </div>

        <!-- 现金礼物发送 -->
        <div class="cashgift-warp" id="cashgift-warp" v-show="roomInfo.cashgift_is_show">

          <!--可选择数量 样式保留-->
          <span class="sp-num">
            <label class="pluss" @click="minusNum">-</label>
            <label>
              <input type="text" class="inputGift" name="txtGiftNum" :style="{color:$c('#6f6f6f##输入框字体的颜色', __FILE__)}" v-model="txtGiftNum" />
            </label>
            <label class="add" @click="addNum">+</label>
          </span>
          <!-- <span class="sp-num sp-num-text" :style="{color:$c('#6f6f6f##输入框字体的颜色', __FILE__)}"> 数量：1</span> -->
          <span class="sp-price" :style="{color:$c('#6f6f6f##输入框字体的颜色', __FILE__)}">合计
            <font>{{totalMoney}}</font>元</span>
          <a href="javascript:;" class="chat-send-btn" id="id-gift-btn" @click="sendGift" :style="{backgroundColor: $c('#fe9901##聊天发送按钮颜色', __FILE__)}">发送</a>
        </div>
      </div>
      <cash-gift v-show="roomInfo.cashgift_is_show"></cash-gift>

      <div class="bottom-wrap" id="bottom-wrap" v-show="giftShow">
        <div class="bottom-plane plane-pic"></div>
        <div class="bottom-plane plane-gift " >
          <!-- 礼物列表 -->
          <div class="MR-gift" id="js-gift-panel">
            <chat-gift></chat-gift>
          </div>
        </div>
      </div>

    </div>

  </div>
</template>


<style scoped>
  /*=============================礼物列表底部============================*/

  .chatbar-bottom {
    display: flex;
    flex-direction: column;

  }

  .bottom-wrap {
    background-color: #fff;
    /* top: 348px; */
    z-index: 999;
    /* width: 750px; */
    padding: 10px;
    font-size: 12px;
    background: #fff;
    overflow: hidden;
    /* position: absolute; */
    border: 1px solid #e8e8e8;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    min-height: 250px;
    /* bottom: 0px; */
  }

  .bottom-wrap.active {
    display: block;
    /*height: 264px;*/
  }

  .bottom-wrap.biaoqing-on {
    height: 264px;
  }

  .bottom-plane {
    display: block;
  }

  .bottom-plane.active {
    display: block;
  }


  .dms-send-container {
    display: flex;
    flex-direction: column;
    width: 100%;
    overflow: hidden;
    z-index: 99;

  }

  .chatSend,
  .cashgift-warp {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    flex: 1;
    align-items: center;
  }

  .sp-num {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    width: 160px !important;
    padding-left: 10px;
  }

  .sp-num-text {
    font-size: 30px;
    text-align: center;
    line-height: 65px;
    vertical-align: middle;
    -webkit-justify-content: center;
    justify-content: center;
    align-items: center;
  }

  .cashgift-warp span label {
    display: flex;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    width: 80px;
    border: 1px solid #fff;
    color: #fff;
    font-size: 30px;
    text-align: center;
    line-height: 65px;
    vertical-align: middle;
    justify-content: center;
    align-items: center;
  }

  .pluss,
  .add {
    cursor: pointer;
  }

  .sp-price {
    flex: 1;
    font-size: 30px;
    text-align: center;
    line-height: 65px;
    vertical-align: middle;
    justify-content: center;
    align-items: center;
  }

  .cashgift-warp span label:nth-child(2) {
    border-left: none;
    border-right: none;
  }

  .dms-textarea-container {
    padding: 0px 10px;
    background-color: #090909;
    /* width: 100%; */
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    flex-direction: row;
    align-items: center;
  }

  .dms-textarea-container span {
    width: 63px;
    height: 63px;
    background-size: 63px !important;
    vertical-align: middle;
    padding-right: 3px;
    margin-right: 8px;
  }

  .dms-textarea-box {
    padding-right: 10px;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .input-text {
    width: 99%;
    height: 62px;
    line-height: 62px;
    border-radius: 8px;
    padding-left: 4px;
    font-size: 25px;
  }

  .chat-send-btn {
    display: inline-block;
    color: #fff;
    width: 114px;
    height: 64px;
    line-height: 64px;
    vertical-align: middle;
    text-align: center;
    font-size: 27.8px;
    border-radius: 8px;
    font-weight: bold;
    float: right;
    margin-right: 0px 5px;
  }

  .chattopattern {
    display: flex;
    flex-direction: column;
    left: 10px;
    z-index: 99;
    width: 70%;
  }

  .inputGift {
    text-align: center;
  }

  a {
    text-decoration: none;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import ChatGift from "@/mobile_views/_/pop/ChatGift";

  import ChatTo from "@/mobile_views/_/chatbar/ChatTo";
  import MoreAction from "@/mobile_views/_/chatbar/MoreAction";
  import MoreMenu from "@/mobile_views/_/menu/MoreMenu";

  import CurPattern from "@/mobile_views/_/chatbar/CurPattern";
  import CashGift from "@/mobile_views/_/moreoptions/CASHGIFT";

  export default {
    data() {
      return {
        textMsg: "",
        show: false,
        giftShow: false,
        innerMenuShow: false,
        waitTime: 0,
        txtGiftNum: 1,
        moreOptionsArr: []
      };
    },
    created() {
      this.getMoreOption();
      var self = this;

      $("#dms-emotion-button").wait(function () {
        $.fn.sinaEmotion.options = {
          rows: 21, // 每页显示的表情数
          language: "cnname", // 简体（cnname）、繁体（twname）
          appKey: "1362404091" // 新浪微博开放平台的应用ID
        };

        $("#dms-emotion-button").on("click", function (e) {
          if (self.giftShow) {
            self.giftShow = false;
          }
          if (self.roomInfo.active_more_isshow) {
            self.$store.commit(types.UPDATE_ROOM_INFO, {
              active_more_isshow: false,
            });
          }
          $.fn.sinaEmotion.options.inputCallBack = function (msg) {
            self.textMsg = msg;
          };
          $("#aodianyun-dms-text").sinaEmotion("#aodianyun-dms-text");
          e.stopPropagation();
        });
      });
    },
    mounted() {
      this.$on("chatGiftClose", function (e) {
        this.giftShow = false;
      });

      this.$on("moreActionClose", function (val) {
        this.show = false;
      });
      var self = this;
      var callback = function (e) {
        if (!self.roomInfo.cashgift_is_show) {
          return;
        }
        var e = e || window.event; //浏览器兼容性
        var elem = e.target || e.srcElement;
        while (elem) {
          //循环判断至跟节点，防止点击的是div子元素
          if (elem.id && elem.id == "cashgift-warp" || elem.id == 'cashgift' || elem.id == 'more-action') {
            return;
          }
          elem = elem.parentNode;
        }
        self.$store.commit(types.UPDATE_ROOM_INFO, {
          cashgift_is_show: false,
        }) //点击的不是div或其子元素

      };
      dms.registerFuncGroup('main-content', 'cashgift', callback);
    },
    computed: {
      totalMoney() {
        return this.roomInfo.cashGiftInfo.price * this.txtGiftNum || 0;
      }
    },
    methods: {
      isGiftShow(e) {
        this.giftShow = !this.giftShow;
        e.stopPropagation();
        e.preventDefault();
      },
      isShowMoreAction(e) {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_more_isshow: this.roomInfo.active_more_isshow ? false : true,
        });
        e.stopPropagation();
        e.preventDefault();
      },
      minusNum() {
        if (this.txtGiftNum == 0) {
          return
        }
        this.txtGiftNum = this.txtGiftNum - 1;
      },
      addNum() {
        this.txtGiftNum = this.txtGiftNum + 1;
      },
      sendMsg() {
        var message = this.textMsg;
        message = $.trim(message);
        this.textMsg = "";
        if (message.length == 0) {
          return;
        }
        if (this.baseConfig.chatcfg.guest_chat_cue && !this.userInfo.logined) {
          this.dialogMsgAlign('游客不能发言，请先登录', "提示");
          return;
        }

        if (this.roomInfo.danmu_is_open) {
          //弹幕情况
          var danmuParams = {
            danmu_msg: message,
            font_color: "red" //??
          };
          dms.LiveApi.sendDanmu(danmuParams, res => {
            console.log("danMu===", res.msg);
          });
        } else {
          //机器人及其他普通消息情况
          if (this.waitTime > 0) {
            return;
          }
          var countTime = this.userInfo.role.chat_ts || 0;
          this.waitTime = countTime;
          var intervarTimer = setInterval(() => {
            if (countTime == 0) {
              intervarTimer && clearInterval(intervarTimer);
            } else {
              countTime--;
              this.waitTime = countTime;
            }
          }, 1000);
          this.$store.dispatch(types.DO_MSG_SEND_PC, {
            message: message,
            type: 1,
          });
        }
      },
      //Post方式提交表单
      PostSubmit(url, gift_id, num, home_url) {
        var postUrl = url; //提交地址
        var _giftid = gift_id; //第一个数据
        var _num = num; //第二个数据
        var ExportForm = document.createElement("FORM");
        document.body.appendChild(ExportForm);
        ExportForm.method = "POST";
        var newElement = document.createElement("input");
        var newElement2 = document.createElement("input");
        var newElement3 = document.createElement("input");
        newElement.setAttribute("name", "gift_id");
        newElement.setAttribute("type", "hidden");

        newElement2.setAttribute("name", "num");
        newElement2.setAttribute("type", "hidden");

        newElement3.setAttribute("name", "home_url");
        newElement3.setAttribute("type", "hidden");

        ExportForm.appendChild(newElement);
        ExportForm.appendChild(newElement2);
        ExportForm.appendChild(newElement3);
        newElement.value = _giftid;
        newElement2.value = _num;
        newElement3.value = home_url;
        ExportForm.action = postUrl;
        ExportForm.submit();
      },
      sendGift() {
        if (!this.roomInfo.cashGiftInfo.id) {
          this.$layer.msg("请先选择礼物！", { time: 2 });
          return;
        }
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          cashgift_is_show: false,
        });

        //表单提交
        var url = '/gift/PhoneOrderPay/' + this.roomInfo.room_id;
        var home_url = window.D.cdn || window.location.href;
        this.PostSubmit(url, this.roomInfo.cashGiftInfo.id, this.txtGiftNum, home_url);
      },
      getMoreOption() {
        var moreOptions = [];
        if (this.userInfo.role.f_luck_max_money) {
          moreOptions.push({
            tag: 'HONGBAO',
            text: $t('发红包##发红包文本', __FILE__),
            imgUrl: $m('/assets/v3/images/phone/hongbao.png##发红包图标', __FILE__)
          })
        }
        if (this.userInfo.role.f_caitiao) {
          moreOptions.push({
            tag: 'CAITIAO',
            text: $t('发彩条##发彩条文本', __FILE__),
            imgUrl: $m('/assets/v3/images/phone/caitiao.png##发彩条图标', __FILE__),
          })
        }
        if (this.userInfo.role.f_danmu) {
          moreOptions.push({
            tag: 'DANMU',
            text: $t('弹幕##弹幕文本', __FILE__),
            imgUrl: $m('/assets/v3/images/phone/shoton.png##打开弹幕图标', __FILE__), //<item id="DANMUOFF" type="image" value="/assets/v3/images/phone/shotoff.png" title="关闭弹幕图标"/>
          })
        }
        if (this.userInfo.role.f_robot_send) {
          moreOptions.push({
            tag: 'ROBOT',
            text: $t('机器人##机器人文本', __FILE__),
            imgUrl: $m('/assets/v3/images/phone/robot.png##机器人图标', __FILE__),
          })
        }
        this.moreOptionsArr = moreOptions;
      }
    },
    components: {
      ChatGift,
      ChatTo,
      MoreAction,
      MoreMenu,
      CurPattern,
      CashGift
    }
  };
</script>