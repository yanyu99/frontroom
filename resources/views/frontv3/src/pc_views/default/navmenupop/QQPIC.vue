<template>
  <div class="menu-box" id="QQPIC">
    <div class="menu-main" :style="{'background':'url('+args.imgurl+') no-repeat center','width':'100%','background-size':'cover'}">
      <div class="menu-contain nice-scroll-h">
        <ul class="contain-ul nice-scroll-h">
          <template v-for="item in dataList">
            <li :key="item.id">
              <a :href="'http://wpa.qq.com/msgrd?v=3&uin='+ item.qq+'&site=qq&menu=yes'" target="_blank">
                <img src="/assets/img/qq_ico1.png" :title="item.qq" />
              </a>
            </li>
          </template>
        </ul>
      </div>
    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    border-radius: 6px;
    position: relative;
    width: 600px;
    background: #fff;
  }

  .menu-main {
    overflow: hidden;
    height: 400px;
    width: 100%;
    background-size: 100%;
  }

  .menu-contain {
    width: 100%;
    height: 100%;
  }

  .menu-contain::-webkit-scrollbar {
    display: none
  }

  .menu-contain ul {
    position: relative;
    padding: 20px;
  }


  .menu-contain ul li {
    position: relative;
    float: left;
    box-sizing: border-box;
    text-align: center;
    margin: 0 auto;
    text-align: center;
  }

  /* =====================公共部分 end==================*/

  .contain-ul li {
    padding: 10px;
    width: 25%;
  }

  .contain-ul li p {
    font-size: 16px;
    text-align: center;
    display: inline-block;
    width: 70px;
    height: 26px;
    line-height: 13px;
    vertical-align: middle;
    color: #000;
    word-wrap: break-word;
  }
</style>
<style>
  .notify .notify-main {
    min-width: 250px;
    min-height: 150px;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    position: absolute;
    box-shadow: 0px rgba(0, 0, 0, 0);
    background-color: rgba(0, 0, 0, 0) !important;
  }

  .notify .notify-iframe .notify-content {
    padding: 20px !important;
    background-color: rgba(0, 0, 0, 0);
  }

  .padding-style {
    overflow: visible !important;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        dataList: [],
      }
    },

    created() {
      var _tempArr = this.baseConfig.roomqqs;
      var _qqType = this.args.qqtype;
      var _typeArr = _tempArr.filter(i => {
        return i.type == _qqType
      });
      this.dataList = _typeArr.length > 12 ? _tempArr.slice(0, 12) : _typeArr;
    },
    props: ["args"],
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id; //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style');
      $('#' + id).find('.vl-notify-content').css({
        overflow: " '' !important"
      })

    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>