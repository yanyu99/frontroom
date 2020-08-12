<template>
  <div class="menu-box" id="VIDEO">
    <div class="vod-con" style=" padding:10px 15px; margin:auto">
      <ul v-if="!isLoadingData">
        <li v-for="item in vodList" :key="item.id" @click="playVod(item)">
          <img :src=" item.vod_pic || '/assets/img/defvod.jpg' ">
          <p>{{item.vod_title}}</p>
        </li>
      </ul>
      <div class="loading-layer" v-if="isLoadingData">
        <span></span>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    border-radius: 6px;
  }

  .vod-con {
    margin: 0 auto;
    width: 630px;
    height: 400px;
  }

  .vod-con ul {
    margin: 0 auto;
    width: 100%;
    height: 400px;
  }

  .vod-con ul li {
    display: inline-block;
    width: 150px;
    padding: 10px 5px;
    text-align: center;
    float: left;
    cursor: pointer;
  }

  .vod-con ul li img {
    width: 140px;
    height: 100px;
    background-size: 100%;
  }

  .vod-con ul li p {
    height: 25px;
    line-height: 25px;
    text-align: center;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        vodList: [],
        isLoadingData: true
      }
    },
    mounted() {
      types.vodListSelect({
        page: 1,
        num: 10
      }).then(resp => {
        this.vodList = resp.data.room.vodList.rows || [];
      }).catch(e => {
        console.warn(e);
      }).finally(() => {
        this.isLoadingData = false;
      });
    },
    methods: {
      playVod(item) {
        $("#js-video-player-pwd").hide();
        setTimeout(() => {
          playVod(item.vod_url);
          this.$layer.close(this.roomInfo.curlayer_pop_id);
        }, 1000)
      },
    }
  };
</script>