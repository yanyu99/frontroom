<template>
  <div class="menu-box" id="TEACHERINFO">
    <div class="menu-main">
      <div class="menu-contain p_scroll">
        <div v-html="args"></div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    border-radius: 6px;
    min-height: 300px;
    width: 600px;
  }

  .menu-main {
    width: 100%;
  }

  .menu-contain {
    line-height: 24px;
    vertical-align: middle;
    font-size: 15px;
    text-indent: 1em;
    word-wrap: break-word;
    height: 500px;
    width: 580px;
    overflow: auto;
    margin: 0 auto;
  }
</style>
<script>
  export default {
    props: ["args"],
  }
</script>