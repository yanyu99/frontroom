<template>
  <div id="UserMain">
    <div class="" id="list">
      <div class="sider" style=" height:556px;">
        <a v-for="(item,index) in userCenter" v-if="item.palte != 'phone'" :key="item.icon" :class="{'on':curShow == index}" @click="changeInfo(item,index)">
          {{item.tag}}
        </a>
      </div>
      <div class="warp">
        <template v-for="(item,index) in userCenter" v-if="item.palte != 'phone'">
          <component :key="index" :is="item.compon" v-show="index == curShow">
          </component>
        </template>
      </div>
    </div>

  </div>
</template>

<script>
  import Vuex from 'vuex'
  import * as types from '@/store/types'

  import JfRecord from './JfRecord'
  import PacketList from './PacketList'
  import Recommend from './Recommend'
  import EditPwd from './EditPwd'
  export default {
    data() {
      return {
        curShow: 0,
      }
    },
    computed: {
      ...Vuex.mapGetters([types.userCenter])
    },
     mounted(){
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notify-content').css({
        width:'1038px'
      })
    },
    methods: {
      changeInfo(item, index) {
        this.curShow = index
      }
    },
    components: {
      JfRecord,
      PacketList,
      Recommend,
      EditPwd
    }

  }
</script>
<style scoped>
  #UserMain {
    width: 980px;
    height: 100%;
    margin: 0px auto;
  }

  .sider a {
    color: #333;
  }

  .sider {
    width: 165px;
    height: 100%;
    border: 1px solid #EEE;
    background-color: #f2f2f2;
    float: left;
  }

  .sider a {
    display: block;
    width: 100%;
    text-align: center;
    line-height: 38px;
    height: 38px;
    font-size: 16px;
    color: #0293ca;
  }

  .sider .on {
    background-color: #0293ca;
    color: #eee;
  }

  .warp {
    padding-left: 10px;
    width: 814px;
    height: 100%;
    float: right;
  }

  .warp .title {
    height: 40px;
    border-bottom: 1px solid #EEE;
    line-height: 40px;
  }

  .warp .title span {
    line-height: 26px;
    padding-left: 10px;
    display: inline-block;
    border-left: 2px solid #189ccf;
  }

  .warp .content {
    clear: both;
    height: 10px;
  }
</style>
<style>
  table {
    border-collapse: collapse;
    margin-top: 10px;
  }

  tr {
    border: 1px solid #ddd;
    border-bottom: 0px;
  }

  tr:last-child {
    border-bottom: 1px solid #ddd;
  }

  th {
    padding: 8px 0px;
    border-right: 1px solid #ddd;
    text-align: center;
  }

  th:last-child {
    border-right: 0px;
  }

  td {
    text-align: center;
    padding: 8px 0px;
    border-right: 1px solid #ddd;
  }

  th:last-child {
    border-right: 0px;
  }

  .jfuse {
    margin-top: 10px;
    margin-left: 10px;
  }

  .jfuse>span {
    color: #F78303;
  }

  .header-view {
    height: 50px;
    line-height: 50px;
    text-align: center;
    background-color: #2E6DD6;
    color: #fff;
    margin-bottom: 4px;
  }
</style>