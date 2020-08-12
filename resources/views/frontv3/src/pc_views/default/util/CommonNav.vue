<template>
  <ul :class="classname" :style="{'background-color':classname =='room-nav-left'? $c('rgba(0, 0, 0, 0.5)##左侧栏的颜色值透明度',__FILE__) :''}">
    <template v-for="item in navMenuArr">
      <!-- 聊天区 -->
      <template v-if="item.pos == 2">
        <div v-if="item.type == 4500" :key="item.key" class="chat-float-model-item js-ui-dialog" style="order:10" :data-type="item.type">
          <a :href="'http://wpa.qq.com/msgrd?v=3&uin='+ item.args.qq+'&site=qq&menu=yes'" target="_blank">
            <img style="height: 54px;" :src=" item.icon ?item.icon: cdn+'/assets/img/ui_icon/'+item.type+'.png' ">
            <p style="color:#fff" v-if="item.text">{{item.text}}</p>
          </a>
        </div>

        <template v-else>
          <!-- PHONELIVE -->
          <div v-if="item.key == 'PHONELIVE'" :key="item.key" :data-type="item.type" :style="{'order':$t('2##手机二维码的上下位置',__FILE__)}" class="chat-float-model-item" @click="isShowCode = !isShowCode" @mouseenter="isShowCode = true" @mouseleave="isShowCode = false">
            <a class="dropdown-toggle" data-hover="dropdown" data-logtype="30">
              <i class="icon icon_phone_ewm" :style="{'background-image':'url(' +item.icon + ')' }"></i>
            </a>
            <div>{{item.text}}</div>
            <div class="dropdown-menu code-box" v-show="isShowCode">
              <template v-if="baseConfig.popcfg.wechat_img && baseConfig.blockcfg.replace_qrcode">
                <img :src="baseConfig.popcfg.wechat_img" class="qr-code-img">
              </template>
              <template v-else>
                <p class="qr-code-img" style="margin-top: 4px;" id="qrcode"></p>
              </template>
            </div>
          </div>

          <TREASURE v-else-if="item.key == 'TREASURE'" :key="item.key" :style="{'order':$t('3##宝箱的上下位置',__FILE__)}" class="chat-float-model-item"></TREASURE>

          <!-- SENDPACKET -->
          <div v-else-if="item.key == 'SENDPACKET'" :key="item.key" :style="{'order':$t('4##发送红包的上下位置',__FILE__)}" @click="popShow('HONGBAO')" class="chat-float-model-item" :data-type="item.type">
            <i class="icon icon_luck_money" :style="{'background-image':'url(' +item.icon + ')' }"></i>
            <div>{{item.text}}</div>
          </div>

          <div v-else :key="item.key" class="chat-float-model-item js-ui-dialog" :attr-type="item.type" @click="popShow(item.tag,item)" :style="{order:item.type =='4800' ? 1:10}">
            <i class="icon icon_chat_common" :style="{'background-image':item.icon ? 'url('+item.icon+')' : cdn+'/assets/img/ui_icon/'+item.type+'.png?v=1'}"></i>
            <div>{{item.text}}</div>
          </div>
        </template>
      </template>
      <template v-else>
        <li v-if="item.type == 4500" :key="item.key" :data-type="item.type">
          <a :href="'http://wpa.qq.com/msgrd?v=3&uin='+ item.args.qq+'&site=qq&menu=yes'" target="_blank">
            <img class="img-qq-icon" v-if="item.icon" :src=" item.icon">
            <span v-if="item.text">{{item.text}}</span>
          </a>
        </li>
        <li v-else-if="item.type == 4200 && item.pos == 4" class="leftuser_4200" :key="item.key" :data-type="item.type">
          <a href="javascript:;" :class="'js-ui-dialog-'+item.type">
            <img v-if="item.icon" class="img-icon" :src="item.icon || ( item.pos !=1 ?  cdn+'/assets/img/ui_icon/'+item.type+'.png' :'')" />
            <span v-if="item.text">{{item.text}} </span>
          </a>
        </li>

        <li v-else :key="item.key" @click.stop.prevent="popShow(item.tag,item)" :data-type="item.type">
          <a href="javascript:;" :class="'js-ui-dialog-'+item.type">
            <img v-if="item.icon" class="img-icon" :src="item.icon || ( item.pos !=1 ?  cdn+'/assets/img/ui_icon/'+item.type+'.png' :'')" />
            <span v-if="item.text">{{item.text}} </span>
          </a>
        </li>
      </template>
    </template>
  </ul>
</template>

<style scoped>
  ul {
    width: 100%;
  }

  .dropdown-menu {
    display: block;
  }

  .room-nav-side,
  .room-nav-head,
  .room-nav-left,
  .room-nav-chat {
    display: flex;
  }

  .room-nav-side,
  .room-nav-left,
  .room-nav-chat {
    flex-direction: column;
  }

  /*head*/
  .room-nav-head {
    flex-direction: row;
  }

  .room-nav-head li {
    display: flex;
    flex-direction: row;
    text-align: center;
    align-content: center;
  }

  .room-nav-head li a {
    display: flex;
    flex-direction: row;
    text-align: center;
    align-content: center;
    align-self: center;
  }

  .room-nav-head li a span {
    align-content: center;
    align-items: center;
    align-self: center;
    margin-left: 3px;
  }

  .room-nav-head li:first-child {
    border-left: solid #999 1px;
  }

  .room-nav-head>li {
    color: #999;
    font-size: 14px;
    /* margin-top: 7px; */
    padding: 0 10px;
    position: relative;
    border-right: solid #999 1px;
  }

  .room-nav-head .img-qq-icon {
    max-height: 30px;
  }

  .room-nav-head .img-icon {
    height: 30px;
  }

  .room-nav-head li a {
    color: #ddd7b7;
    text-decoration: none;
  }

  .room-nav-head li a:visited,
  .room-nav-head li a:hover {
    color: #ffff15;
  }

  /* left*/

  .room-nav-left li {
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
  }

  .room-nav-left li a {
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
  }

  .room-nav-left li a:visited,.room-nav-left li a:hover {
    color: #CCC !important;
    text-decoration: none;
  }

  .room-nav-left li {
    border-bottom: 1px solid #999;
    padding: 10px 6px;
    cursor: pointer;
  }

  .room-nav-left .img-icon {
    width: 48px;
  }

  .room-nav-left .img-qq-icon {
    max-height: 45px;
  }

  /* side*/
  .room-nav-side {
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }

  .room-nav-side li {
    padding: 10px 0px;
    width: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .room-nav-side li a {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .room-nav-side .img-icon,
  .room-nav-side .img-qq-icon {
    width: 32px;
    height: 32px;
  }

  /* chat*/
  .chat-float-model-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
  }

  .room-nav-chat .img-icon {}

  .code-box {
    left: -214px;
    top: 0px;
    width: 200px;
    height: 200px;
  }
</style>
<script>
  import Vuex from 'vuex'
  import * as types from '@/store/types'
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  import TREASURE from "@/pc_views/_/chatpop/TREASURE"

  export default {
    data() {
      return {
        isShowCode: false
      }
    },
    props: ["navMenuArr", "classname", "leftwidth"],
    mixins: [layercommMixinPc],

    mounted() {
      (this.baseConfig.blockcfg.show_phonewem && this.baseConfig.phoneUrl && this.baseConfig.phoneUrl.length) && this.initQrCode();

      var self = this
      var tipsTimer = null;
      $(".leftuser_4200").wait(function () {
        $('.leftuser_4200').mouseenter(function () {
          self.$store.commit(types.UPDATE_ROOM_INFO, {
            is_show_left_userlist: true,
          });
          self.calcUserListPos();
        }).mouseleave(function () {
          tipsTimer = setTimeout(function () {
            self.$store.commit(types.UPDATE_ROOM_INFO, {
              is_show_left_userlist: false,
            });
          }, 300);
        });
      })
      $('#dropdownUserList').wait(function () {
        $('#dropdownUserList').mouseenter(function () {
          if (tipsTimer) {
            clearTimeout(tipsTimer);
            tipsTimer = null;
          }
        }).mouseleave(function () {
          self.$store.commit(types.UPDATE_ROOM_INFO, {
            is_show_left_userlist: false,
          });
        });
      })
    },
    methods: {
      initQrCode() {
        var self = this;
        var _render = 'canvas';
        try {
          if (!document.createElement('canvas').getContext) {
            _render = "table";
          }
        } catch (err) {
          _render = "table";
        }
        $("#qrcode").wait(function () {
          $('#qrcode').empty();
          $('#qrcode').qrcode({
            render: _render,
            width: 180,
            height: 180,
            text: self.baseConfig.phoneUrl,
          });
        })
      },
      calcUserListPos() {
        var _right = this.baseConfig.theme.leftblock == "right" ? true : false;
        var _top = $(".page-container").position().top || $(".page-part-body").position().top;
        var _height = $(".page-body-main").height();
        var _leftWidth = (this.leftwidth || 63) + 2 + 'px';
        $("#dropdownUserList").css({ 'top': _top + 'px', 'height': _height + 'px', 'position': 'fixed' })
        if (_right) {
          $("#dropdownUserList").css({ 'left': 'auto', 'right': '65px' })
        } else {
          $("#dropdownUserList").css({ 'left': _leftWidth, 'right': 'auto' })
        }
      }
    },
    components: {
      TREASURE
    }
  }
</script>