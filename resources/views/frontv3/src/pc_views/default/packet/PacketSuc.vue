<template>
  <div class="congratulate-box">
    <div class="congratulate-bg congratulate-con">
      <div class="box-con">
        <p class="p-des">获得{{args.name}}的红包</P>
        <p class="p-money">{{args.money}}元</P>
      </div>
      <p class="p-remark">{{$t("请将此页面截图保存并发给客服人员领取奖励##备注文本描述",__FILE__)}}</p>
    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>

<style scoped>
  .congratulate-box {
    height: 422px;
  }

  .congratulate-bg {
    width: 526px;
    height: 422px;
    background-image: url(/assets/v3/images/phone/congratulate.png);
    background-repeat: no-repeat;
    background-size: 100%;
    margin: 0 auto;
  }

  .box-con {
    margin: 0 auto;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    padding-top: 115px;
    height: 256px;
    width: 100%;
  }

  .p-des {
    line-height: 60px;
  }

  .p-money {
    line-height: 40px;
    color: red;
    text-align: center;
  }

  .p-remark {
    color: #980f02;
    font-size: 20px;
    text-align: center;
  }
</style>
<style>
  .bgborder {
    border: 0 none !important;
    box-shadow: transparent !important;
  }

  .notify .notify-main,
  .notify-content {
    background-color: rgba(0, 0, 0, 0) !important;
  }
</style>
<script>
  export default {
    props: ["args"],
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style');
      $("#" + id + " .vl-notify.vl-notify-main").addClass("bgborder");
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>