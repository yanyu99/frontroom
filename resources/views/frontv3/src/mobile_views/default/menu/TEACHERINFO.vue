<template>
  <div class="menu-box" id="TEACHERINFO">
    <div class="menu-main">
      <span>
        <p class="p-tit">详情</p>
      </span>
      <div class="menu-contain">
        <div v-html="args"></div>
      </div>
    </div>
  </div>
</template>
<style>
  /* =====================公共部分 start==================*/

  .menu-box {
    padding: 15px 10px;
    width: 700px;
    border-radius: 6px;
    background: #fff;
    height: 600px;
  }

  .menu-main {}

  .menu-main .p-tit {
    display: inline-block;
    color: #fe9901;
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    height: 100px;
    line-height: 100px;
    vertical-align: middle;
    border-bottom: 1px solid #e6e6e6;
    width: 100%;
  }

  .p-tisi {
    font-size: 26px;
    line-height: 50px;
    border-top: 1px solid #e6e6e6;
    color: #333333;
  }

  .menu-contain {
    line-height: 80px;
    vertical-align: middle;
    font-size: 30px;
    word-wrap:break-word;
    height: 500px;
    width:100%;
    overflow: auto;
    margin: 0 auto;
  }
</style>
<script>
  export default {
    props: ["args"],
  }
</script>