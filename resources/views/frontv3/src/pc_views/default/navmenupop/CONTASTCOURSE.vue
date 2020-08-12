<template>
  <div id="CONTASTCOURSE">
    <div class="jg_kcb p_scroll" :style="{backgroundImage:imgurl ? 'url('+imgurl+')' :'url(/assets/img/coursebg.jpg)'}">
      <div class="jg_kcb_list " v-if="!isLoadingData">
        <table border="1" cellspacing="0">
          <thead>
            <tr>
              <th style="width:60px;">
                <div class="out" style="font-size:18px">
                  <b>{{$t("日期##日期文本",__FILE__)}}</b>
                  <em>{{$t("时间##时间文本",__FILE__)}}</em>
                </div>
              </th>
              <th>{{$t("星期一##星期一文本",__FILE__)}}</th>
              <th>{{$t("星期二##星期二文本",__FILE__)}}</th>
              <th>{{$t("星期三##星期三文本",__FILE__)}}</th>
              <th>{{$t("星期四##星期四文本",__FILE__)}}</th>
              <th>{{$t("星期五##星期五文本",__FILE__)}}</th>
              <th>{{$t("星期六##星期六文本",__FILE__)}}</th>
              <th>{{$t("星期日##星期日文本",__FILE__)}}</th>
            </tr>
          </thead>
          <tbody>
            <tr class="assessDetail" v-for=" item in lessons" :key="item.id">
              <td>{{item.s_at}}-{{item.e_at}}</td>
              <td>{{item.z1_teacher && item.z1_teacher.name ? item.z1_teacher.name :'无'}}</td>
              <td>{{item.z2_teacher &&item.z2_teacher.name ? item.z2_teacher.name : '无'}}</td>
              <td>{{item.z3_teacher &&item.z3_teacher.name ? item.z3_teacher.name : '无'}}</td>
              <td>{{item.z4_teacher && item.z4_teacher.name ? item.z4_teacher.name :'无'}}</td>
              <td>{{item.z5_teacher && item.z5_teacher.name ? item.z5_teacher.name :'无'}}</td>
              <td>{{item.z6_teacher && item.z6_teacher.name ? item.z6_teacher.name :'无'}}</td>
              <td>{{item.z7_teacher && item.z7_teacher.name ? item.z7_teacher.name :'无'}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="loading-layer" v-if="isLoadingData">
        <span></span>
      </div>
    </div>
    <div class="close-layer" @click="closeLayer">
      ×
    </div>
  </div>
</template>

<style scoped>
  .jg_kcb {
    overflow: auto;
  }

  /* 后面添加的样式 */
  .out {
    border-top: 4em #bc8510 solid;
    border-left: 120px #c79a38 solid;
    position: relative;
    color: white;
  }

  b {
    font-style: normal;
    display: block;
    position: absolute;
    top: -4em;
    left: -84px;
    width: 80px;
  }

  em {
    font-style: normal;
    display: block;
    position: absolute;
    top: -40px;
    left: -142px;
    width: 100px;
  }

  .jg_kcb {
    width: 800px;
    max-height: 680px;
    background-size: 100% 100%;
    padding: 30px 20px;
  }

  .jg_kcb_list {
    padding: 20px 0;
    /* height: 430px; */
    overflow: hidden;
    margin: 35px 10px 0px 10px;
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
  }

  th,
  td {
    border: 1px solid #e3e3e3;
    text-align: center;
    font-size: 16px;
    line-height: 43px;
    background: #c6c7c6;
  }

  td {
    line-height: 47px;
  }

  th {
    background: #bc8510;
    color: white;
    font-size: 18px;
    font-weight: bold
  }

  .assessDetail td {
    background-color: #fff;
  }
</style>
<script>
  export default {
    data() {
      return {
        imgurl: '',
        lessons: [],
        isLoadingData: true
      };
    },
    props: ["obj"],
    created() {
      this.getData();
    },
    mounted() {
      this.imgurl = this.obj.args.bgimgs;
      var id = this.roomInfo.curlayer_pop_id; //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).css({
        height: '526px'
      });
      $("#" + id).find('.vl-notify-content').addClass('padding-style')
      $("#" + id + " .notify .notify-main").css("top", "50%");
    },
    methods: {
      getData() {
        dms.LiveApi.getCourse({}, res => {
          this.lessons = res.data.lessons || [];
          this.isLoadingData = false
        }, res => {
          this.isLoadingData = false
        })
      },
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  };
</script>