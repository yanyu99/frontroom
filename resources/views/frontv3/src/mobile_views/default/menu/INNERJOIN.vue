<template>
  <div class="menu-box" id="INNERJOIN">
    <div class="menu-main">
      <span>
        <p class="p-tit">内参</p>
      </span>

      <div class="menu-contain">
        <div class="demo-wrapper dinfo" v-if="userInfo.logined && dataList.length">
          <div class="demo-inner list" v-if="!isLoadingData">
            <div style=" ">
              <ul class="contain-ul">
                <template v-for="item in dataList">
                  <li v-if="item.teacher" :key="item.index">
                    <span class="sp-tit">{{item.teacher.name}}</span>
                    <span class="sp-status">{{item.title}}</span>
                    <span class="sp-category" @click="checkInfo(item.id)">
                      <label class="t-look">查看</label>
                    </span>
                  </li>
                </template>

                <div v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="30" style="text-align:center">
                  <p class="pagemsg" v-show="busy" v-html="msgInfo"></p>
                </div>
              </ul>

            </div>
          </div>
          <div class="loading-layer" v-if="isLoadingData">
            <span></span>
          </div>
        </div>
        <comm-qq v-if="!userInfo.logined &&dataList.length == 0 && qqMap.LEADIN.length >0" :qqData="qqMap.LEADIN" qqts='会员查看请登录，非会员请联系下方老师助理领取登录密码'></comm-qq>
      </div>

    </div>
  </div>
</template>
<style scoped>
  .menu-box {
    padding: 15px 10px;
    background: #fff;
    border-radius: 6px;
    max-height: 500px;
    overflow-y: auto;
    position: relative;
    z-index: 999999;
  }

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

  .menu-contain ul {
    position: relative;
    overflow: hidden;
  }

  .menu-contain ul {}

  .menu-contain ul li {
    position: relative;
    float: left;
    box-sizing: border-box;
    margin: 0 auto;
    position: relative;
    margin: 5px auto;
  }

  .menu-contain ul li span {
    display: inline-block;
    font-size: 30px;
  }

  /* =====================公共部分 end==================*/

  .contain-ul li {
    width: 100%;
  }

  .sp-tit {
    width: 16%;
    text-align: right;
  }

  .sp-category {
    width: 26%;
    text-align: center;
  }

  .sp-status {
    width: 50%;
    text-align: center;
  }

  .t-look {
    font-size: 28px;
    background-color: #0e9adc;
    padding: 0px 10px;
    border-radius: 4px;
  }

  .demo-inner {
    max-height: 500px;
    overflow: auto;
    margin-bottom: 30px;
  }

  .pagemsg {
    font-size: 28px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import TEACHERINFO from "@/mobile_views/_/menu/TEACHERINFO"
  import CommQq from "@/mobile_views/_/menu/CommQq";
  export default {
    data() {
      return {
        busy: false,
        page: 1,
        dataList: [],
        msgInfo: "加载中...",

        refresh: 30 * 1000,
        isRoll: true,
        num: 5,
        isLoadingData: false
      }
    },
    computed: {
      ...Vuex.mapGetters([types.qqMap]),
    },
    mounted() {
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      var obj = $("#" + id + " .notify .notify-main")
      document.addEventListener('touchmove', function (e) {
        var e = e || window.event; //浏览器兼容性
        var elem = e.target || e.srcElement;
        if (elem.id == "INNERJOIN") {
          e.preventDefault();
        }
      }, false);

      this.userInfo.logined && this.getDataList();
    },

    methods: {
      getDataList(flag) {
        this.isLoadingData = true;
        types.internalInfoListSelect({
          page: this.page,
          num: this.num
        }).then(resp => {
          var _tmpData = resp.data.room.internalInfoList || {};
          if (flag) {
            if (!_tmpData.pageInfo.hasNextPage) {
              this.busy = true; //没有更多数据
              this.msgInfo = "加载完毕";
              this.isRoll = false;
            } else {
              this.busy = false;
            }
          }
          this.dataList = this.dataList.concat(_tmpData.rows);
        }).catch(e => {
          this.busy = true; //没有更多数据
          this.msgInfo = "加载完毕";
          this.isRoll = false;
        }).finally(() => {
          this.isLoadingData = false;
        });
      },
      loadMore() {
        this.busy = true;
        // 多次加载数据
        this.isRoll && setTimeout(() => {
          this.page++; //从第二页开始
          this.getDataList(true);
        }, 1000);
      },
      checkInfo(tid) {
        types.queryNavInternalById({ id: tid }).then(resp => {
          var _tmpInfo = resp.data.navInternalInfo || {};
          var dataInfo = _tmpInfo.content || ''
          let _id = this.$layer.iframe({
            content: {
              content: TEACHERINFO,
              parent: this,
              data: {
                args: dataInfo
              }
            },
          });
          //存储当前弹出框的id
          this.$store.state.roomInfo.inner_menu_pop_curBoxId = _id;
        }).catch(e => {
          console.warn(e);
        })
      },
    },
    components: {
      CommQq
    }
  };
</script>