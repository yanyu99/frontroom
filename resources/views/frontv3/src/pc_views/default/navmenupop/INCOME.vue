<template>
  <div class="menu-box" id="INCOME">
    <div class="jg_kcb " :style="{backgroundImage: bg_img ? 'url('+bg_img+')' :'url(/assets/img/income_list.jpg)'}">
      <div class="jg_kcb_list">
        <table border="1" cellspacing="0">
          <thead>
            <tr>
              <template v-for="(th,ind) in th_heads ">
                <th :key="ind">{{th ? th : ''}}</th>
              </template>
            </tr>
          </thead>
          <tbody>
            <template v-for="(item,index) in td_list">
              <tr :key="index" class="assessDetail">
                <template v-for="(val,ind) in item">
                  <td :key="ind">{{val ? val : ''}}</td>
                </template>
              </tr>
            </template>
          </tbody>
        </table>

      </div>
    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>
<style scoped>
  .jg_kcb {
    background-size: 100% 100%;
    padding: 30px 0;
  }

  .jg_kcb_list {
    width: 800px;
    padding: 20px 0;
    height: 400px;
    overflow: hidden;
    margin: 60px 10px 0px 10px;
    overflow-y: scroll
  }

  .jg_kcb_list::-webkit-scrollbar {
    display: none
  }

  table {
    border-collapse: collapse;
    border: 1px #e3e3e3 solid;
    width: 100%;
    margin: 0 auto;
    padding-top: 30px;
    padding-bottom: 50px;
  }

  table thead {
    background-color: #bc8510;
  }

  table tbody {
    background-color: #bc8510;
  }

  table tbody tr {
    border-radius: 4px;
    background-color: #fff;
    line-height: 43px;
  }

  th,
  td {
    border: 1px solid #e3e3e3;
    text-align: center;
    font-size: 35px;
    line-height: 43px;
    background: #C6C7C6;
  }

  td {
    font-size: 20px;
    line-height: 43px;
    background: #fff
  }

  th {
    background: #bc8510;
    color: white;
    font-size: 22px;
    line-height: 43px;
    font-weight: bold
  }

  .assessDetail td {
    background-color: #FFF;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data() {
      return {
        bg_img: '',
        col_num: 0,
        th_heads: [],
        td_list: [],
      }
    },
    props: ['obj'],
    created() {
      this.getData();
    },
    mounted() {
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).css({
        height: '526px'
      });
      $("#" + id).find('.vl-notify-content').addClass('padding-style')
      $("#" + id + " .notify .notify-main").css('top', '50%')
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
      getData() {
        this.bg_img = this.obj.fourimgs;
        this.col_num = this.obj.args.col_num;
        var td_list = this.obj.args.td_list || [];
        var th_heads = this.obj.args.th_head || [];

        let tmp_th_heads = [];
        for (var i = 0; i < this.col_num; i++) {
          let tmp_th = th_heads[i] || '';
          tmp_th_heads.push(tmp_th);
        }
        this.th_heads = tmp_th_heads;

        let tmp_td_list = td_list.map(item => {
          let tmp_td_item = [];
          for (var i = 0; i < this.col_num; i++) {
            let tmp_th = item[i] || '';
            tmp_td_item.push(tmp_th);
          }
          return tmp_td_item;
        })
        this.td_list = tmp_td_list;
      }
    }
  };
</script>