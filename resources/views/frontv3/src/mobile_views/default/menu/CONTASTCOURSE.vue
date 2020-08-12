<template>
  <div id="CONTASTCOURSE">
    <div class="jg_kcb " :style="{backgroundImage: imgurl ? 'url('+imgurl+')' :'url(/assets/img/coursebg.jpg)'}">
      <div class="jg_kcb_list" v-if="!isLoadingData">
        <table border="1" cellspacing="0">
          <thead>
            <tr>
              <th>{{$t("时间##时间文本",__FILE__)}}</th>
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
              <td>{{item.z2_teacher && item.z2_teacher.name ? item.z2_teacher.name :'无'}}</td>
              <td>{{item.z3_teacher && item.z3_teacher.name ? item.z3_teacher.name :'无'}}</td>
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
  </div>
</template>
<style scoped>
  .jg_kcb {
    height: 520px;
    background-size: 100% 100%;
    padding: 30px 0;
  }

  .jg_kcb_list {
    padding: 20px 0;
    /*左右不能滑*/
    height: 400px;
    overflow: scroll;
    margin: 60px 10px 0px 10px;
  }

  table {
    border-collapse: collapse;
    border: 1px #e3e3e3 solid;
    width: 1200px;
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
    font-size: 28px;
    line-height: 43px;
    background: #C6C7C6;
  }

  td {
    line-height: 60px;
  }

  th {
    background: #bc8510;
    color: white;
    line-height: 80px;
  }

  .assessDetail td {
    background-color: #FFF;
  }
</style>

<script>
  export default {
    data() {
      return {
        imgurl: '',
        lessons: [],
        isLoadingData: false
      }
    },
    props: ['check'],
    mounted() {
      this.imgurl = this.check.args.bgimgs;
    },
    created() {
      this.getData();
    },
    methods: {
      getData() {
        this.isLoadingData = true;
        dms.LiveApi.getCourse({}, res => {
          this.lessons = res.data.lessons || [];
          this.isLoadingData = false;
        }, res => {
          this.isLoadingData = false;
        })
      }
    }
  }
</script>