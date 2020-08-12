<template>
  <p class="chat-tips-history" :id="msg_id">
    <span class="text">以上为历史消息</span>
  </p>
</template>
<style scoped>
 p.chat-tips-history {
    margin: 0px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import msgItemMixinPc from "@/mixins/msgItemMixinPc";

  export default {
    props: ["msgItemData", "afterAppend"],
    mixins: [msgItemMixinPc],
  };
</script>
