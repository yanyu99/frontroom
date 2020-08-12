<template>
  <div class="got-luck-money-wrap" @click.stop="getPacket('popicon')">
    <div class="got-luck-money-con">
      <img id="gotPacket" src="/assets/img/hbicon.gif">
      <br>
      <span :style="{color:$c('#fff##右侧浮动字体颜色', __FILE__)}">
        当前红包：
        <font class="ft-sty">{{roomInfo.packArr.length}}</font>个
      </span>
    </div>
  </div>
</template>
<style scoped>
  .got-luck-money-wrap {
    position: absolute;
    right: 120px;
    bottom: 120px;
    cursor: pointer;
    text-align: center;
    /* z-index: 456; */
  }

  .got-luck-money-con img {
    width: 92px;
  }

  .ft-sty {
    color: yellow;
  }
</style>

<script>
  import * as types from "@/store/types";
  import gotpackMixinMobile from "@/mixins/gotpackMixinMobile";
  export default {
    mixins: [gotpackMixinMobile]
  };
</script>