<template>
  <div class="menu-box p_scroll" id="NEWS" style=" height:500px;">
    <template v-if="userInfo.role.f_cjrl">
      <iframe class="p_scroll nicescroll" src="https://m.wallstreetcn.com/markets"></iframe>
    </template>
    <template v-else>
     <comm-qq :qqData="baseConfig.roomqqs" qqts="当前无权限，请联系相关人员"></comm-qq>
    </template>

  </div>
</template>
<style scoped>
  .p_scroll::-webkit-scrollbar {
    display: none
  }
  .menu-box {
    width: 600px;
    border-radius: 6px;
  }

  .menu-contain {
    -webkit-overflow-scrolling: touch;
    overflow-y: scroll;
  }
  .menu-contain iframe {
    height: 100%;
    width: 100%;
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