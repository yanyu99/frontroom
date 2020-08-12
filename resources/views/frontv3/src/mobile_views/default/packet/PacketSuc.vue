<template>
  <div class="congratulate-box">
    <div class="congratulate-bg">
      <div class="congratulate-con">
        <div class="box-con">
          <p class="p-des">获得{{args.name}}的红包</P>
          <p class="p-money">{{args.money}}元</P>
        </div>
        <p class="p-remark">{{$t("请将此页面截图保存并发给客服人员领取奖励##红包领取成功文本描述",__FILE__)}}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .congratulate-box {
    height: 524px;
  }

  .congratulate-bg {
    width: 651px;
    height: 523px;
    background-image: url(/assets/v3/images/phone/congratulate.png);
    background-repeat: no-repeat;
    background-size: 100%;
    margin: 0 auto;
  }

  .congratulate-con {
    margin-top: 60px;
  }

  .box-con {
    margin: 0 auto;
    text-align: center;
    font-size: 34px;
    font-weight: bold;
    padding-top: 150px;
    height: 256px;
    width: 100%;
  }

  .p-des {
    line-height: 60px;
  }

  .p-money {
    line-height: 50px;
    color: red;
    text-align: center;
  }

  .p-remark {
    color: #fff;
    font-size: 24px;
    text-align: center;
  }
</style>
<style>
  .bgborder {
    background-color: transparent !important;
    border: 0 none !important;
  }
</style>
<script>
  export default {
    props: ["args"],
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id).addClass('bgborder');

    },
  };
</script>