<template>
  <div id="DOWNLOAD" class="download-box nice-scroll" tabindex="0">
    <template v-if="!isLoadingData">
      <template v-if="!userInfo.role.f_download ">
        <div style="color: #999; line-height:24px;">
          <comm-qq :qqData="qqMap.CHAT" qqts="暂无权限查看此内容，如有疑问，请联系客服。"></comm-qq>
        </div>
      </template>
      <template v-else>
        <ul class="download-ul">
          <li v-for="(item,index) in dataList" :key="index">
            <a :href="'/live/downloadfile/'+ item.room_id + '?id='+item.id" target="_blank">
              <span class="sp-icon"></span>
              <span>
                <p class="p-name">{{item.filename}}
                  <small class="download-small" v-if="baseConfig.noShowNum">
                    <i class="icon-download"></i>
                    {{item.download_num}}次下载
                  </small>
                </p>
                <p>
                  <span class="sp-jf">{{item.jf_num}}{{baseConfig.textcfg.jf_txt_tit}} </span>
                  <label>
                    <font v-if="item.ts">{{item.ts}}</font>
                    <font v-else>{{item.created_at}}</font>
                  </label>
                </p>
              </span>
            </a>
          </li>
        </ul>
      </template>
    </template>
    <div class="loading-layer" v-if="isLoadingData">
      <span></span>
    </div>

  </div>
</template>
<style scoped>
  .sp-icon {
    background: url("/assets/img/filelist.png") no-repeat left;
    width: 58px;
    height: 58px;
    display: block;
    margin: 0 auto;
  }

  .download-box {
    width: 600px;
    height: 400px;
    overflow-y: scroll;
  }

  .download-box::-webkit-scrollbar {
    display: none;
  }

  .p-name {
    line-height: 20px;
    margin-top: 10px;
  }

  .sp-jf {
    margin-right: 5px;
  }

  .download-ul li {
    display: block;
    float: left;
    width: 90%;
    margin: 10px;
    border: 1px solid #eee;
  }

  .download-ul li span {
    display: inline-block;
    float: left;
  }

  .download-ul li a {
    color: #333 !important;
    display: block;
    margin-left: 4px;
  }

  .download-small {
    font-size: 14px;
    color: blue;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import CommQq from "@/pc_views/_/util/CommQq";

  export default {
    data() {
      return {
        dataList: [],
        pageIndex: 1,
        pageNum: 10,
        isLoadingData: true
      };
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap])
    },
    mounted() {
      types.downloadFileListSelect({
        page: this.pageIndex,
        num: this.pageNum
      }).then(resp => {
        this.dataList = resp.data.room.downloadFileList.rows || [];
      }).catch(e => {
        console.warn(e);
      }).finally(() => {
        this.isLoadingData = false;
      });
    },
    components: {
      CommQq
    }
  };
</script>