<template>
  <div :style="getLeft()" class="" id="UserInfo">
    <div class="profile-block clearfix profile-block-base">
      <img class="img-circle img- profile-avatar pull-left" :src="userInfo.pic ? userInfo.pic : ''">
      <div>
        <div class="profile-name">{{userInfo.name}}</div>
        <ul class="op list-inline ">
          <li>
            <a class="js-user-setting-dialog" @click.stop="popShow('SetInfo',{text:'设置'})">设置</a>
          </li>
          <li>|</li>
          <li>
            <a @click.stop="userLogout">退出</a>
          </li>
        </ul>
      </div>

      <template>
        <div id="idBetInfo" style="padding-left: 90px;line-height: 18px;">
          <div class="bet-cur">当前{{baseConfig.textcfg.jf_txt_tit}}：0</div>
          <div class="bet-giftsend">送礼{{baseConfig.textcfg.jf_txt_tit}}：0</div>
        </div>
      </template>
    </div>
    <div class="profile-block clearfix">
      <div class="title" style="margin-bottom: 5px;line-height: 35px;">
        我的推广
        <button id="copy-button2" type="button" class="btn btn-success" style="margin-left: 10px;" :data-clipboard-text="baseConfig.tgURL" @click.stop="copyTo">
          点击复制推广链接
        </button>
      </div>
      <div class="content">
        <p>
          已经推荐 {{userInfo.recommend_num}} 人，其中注册会员 {{userInfo.recommend_reg}}人
        </p>
      </div>
    </div>

    <ul class="list-inline profile-footer-menu">
      <li class="profile-footer-menu-5" style="margin-left: 20px" @click="popShow('UserMain',{text:'个人中心'})">
        <a display="float:left">
          <i class="icon"></i>
          <span class="text">个人中心</span>
        </a>
      </li>
    </ul>
  </div>

</template>
<style scoped>
  #UserInfo {
    width: 360px;
    background-color: #fff;
    color: #333;
    position: absolute;
    z-index: 4;
    right: 0px;
  }

  .profile-dropdown-menu {
    left: -170px;
    width: 355px;
    color: #333;
    cursor: default;
  }

  .profile-avatar {
    border-radius: 50%;
    margin-right: 10px;
    width: 80px;
    height: 80px;
  }

  .op {
    position: absolute;
    top: 10px;
    right: 10px;
  }

  .op a {
    font-size: 12px;
    color: #666;
  }

  .btn {
    background-color: #107bcf;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import layercommMixinPc from "@/mixins/layercommMixinPc";
  export default {
    mixins: [layercommMixinPc],
    props: ['propPos'],
    methods: {
      getLeft() {
        if (this.propPos != 'headtheme') {
          if (this.baseConfig.blockcfg.show_siderlogin && this.baseConfig.theme.layoutsider != 'layout-sider-right') { //登录模块开启 ，并侧边栏居左
            return {
              left: '0px ',
            }
          }
        } else {
          if (this.baseConfig.extcfg.style_opend) {
            return { left: '-230px', }
          }
          return {
            left: '',
          }
        }
      },

      userLogout() {
        dms.LiveApi.userLogout({}, resp => {
          //领券登录模式2
          window.location.reload(true);
        });
      },
      //复制
      copyTo() {
        var clipboard = new Clipboard(".btn");
        clipboard.on("success", e => {
          alert("复制成功");
          // 释放内存
          clipboard.destroy();
        });
        clipboard.on("error", e => {
          // 不支持复制
          alert("浏览器不支持自动复制，请手动复制微信号");
          // 释放内存
          clipboard.destroy();
        });
      },
    }
  };
</script>