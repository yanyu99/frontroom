<template>
  <div class="menu-box" id="QQHELPER">
    <div class="menu-main">
      <comm-qq :qqData="dataList" qqts=""></comm-qq>
    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    background-color: #fff;
    border-radius: 6px;
    position: relative;
    width: 600px;
  }

  .menu-main {
    height: 500px;
    overflow: hidden;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/pc_views/_/util/CommQq"
  export default {
    data() {
      return {
        dataList: []
      }
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap]),
    },
    props: ["obj"],
    created() {
      this.getData();
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
      getData() {
        if (this.obj.type == 4004) { //导航助理
          this.dataList = this.qqMap.LEADIN
        } else(
          this.dataList = this.qqMap.CHAT //聊天助理
        )
      }
    },
    components: {
      CommQq
    }
  };
</script>