<template>
  <div class="menu-box " id="DFCF">
    <template v-if="userInfo.role.f_cjrl">
      <iframe class="ifrbox" src="http://www.eastmoney.com/" frameborder="0"></iframe>
    </template>
    <template v-else>
      <comm-qq :qqData="baseConfig.roomqqs" qqts="当前无权限，请联系相关人员"></comm-qq>
    </template>

  </div>
</template>

<style scoped>
  .menu-box {
    width: 600px;
    border-radius: 6px;
    height: 500px;
  }

  .ifrbox {
    width: 600px;
    height: 500px;
  }
</style>

<script>
  import CommQq from "@/pc_views/_/util/CommQq"

  export default {
    components: {
      CommQq
    }
  };
</script>