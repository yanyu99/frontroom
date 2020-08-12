<template>
  <div v-if="tab.tag == roomInfo.active_menu" id="js-vod-warp" class="pane" :style="{backgroundColor:$c('#2f2e2e##视频库背景颜色', __FILE__)}">
    <div class="vod-con" style=" padding:10px 15px; margin:auto">
      <scroller>
        <ul>
          <li v-for="item in vodList" :key="item.id" @click="playVodo(item)">
            <img :src=" item.vod_pic || $m('/assets/img/defvod.jpg##视频库图片', __FILE__) ">
            <p :style="{color:$c('#fff##视频库文本颜色', __FILE__)}">{{item.vod_title}}</p>
          </li>
        </ul>
      </scroller>
    </div>
  </div>
</template>

<style scoped>
  .pane {
    overflow-y: scroll;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .vod-con {}

  .vod-con ul {
    margin: 0 auto;
    width: 650px;
  }

  .vod-con ul li {
    display: inline-block;
    width: 300px;
    padding: 10px 5px;
    text-align: center;
  }

  /* 偶数 */

  .vod-con ul li:nth-child(even) {
    padding-right: 0px;
    float: right;
  }

  .list ul li:nth-child(odd) {}

  .vod-con ul li img {
    width: 280px;
    height: 200px;
    background-size: 100%;
  }

  .vod-con ul li p {
    height: 50px;
    line-height: 50px;
    text-align: center;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    props: {
      tab: Object
    },
    data() {
      return {
        vodList: []
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
      });
    },
    methods: {
      active() {
        return this.roomInfo.active_menu == 'VOD_LIST'
      },
      playVodo(item) {
        playVod(item.vod_url)
      }
    }
  };
</script>