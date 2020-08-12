<template>
  <div id="COURSE" class="course-boxs p_scroll">

    <div class="jg_kcb" :style="{
            background: 'url(/assets/img/kcgg.png)' ,
            width: '100% ',
          height: '100%',
          backgroundRepeat: 'repeat-y',
          backgroundSize: '100% 100%',
          }">

      <h2 id="div_title">{{dateShow}} {{baseConfig.textcfg.lesson_pre}}</h2>
      <div class="jg_kcb_list">
        <ul id="courseMt ">
          <li v-for="(item,index) in roomInfo.lessonInfo.lessonList" :key="index">
            <div class="clearfix jg_kcb_list_nr">
              <div class="fl jg_kcb_list_fl clearfix">
                <div :class="{'jg_kcb_color':item.type>0}" class="jg_tecer fl">
                  {{ (item[roomInfo.lessonInfo.teacher] &&item[roomInfo.lessonInfo.teacher].name) ? item[roomInfo.lessonInfo.teacher].name : '无'}}
                </div>
                  <div :class="{'jg_kcb_color':item.type > 0}" class="fr" v-if="item[roomInfo.lessonInfo.title]">{{item[roomInfo.lessonInfo.title]}}</div>
                </div>

                <div class="fl f-time">
                  <span class="jg_kcb_span">●</span>
                  直播时间：
                  <span class="jg_kcb_color lesson-time">
                    <template v-if="item[roomInfo.lessonInfo.dsc]">
                      {{item[roomInfo.lessonInfo.dsc]}}
                    </template>
                    <template v-else>
                      <template v-if="item.s_at <= dataNow && item.e_at >= dataNow ">
                        正在直播中
                      </template>
                      <template v-else>
                        {{item.s_at}}-{{item.e_at}}
                      </template>
                    </template>
                  </span>
                </div>
              </div>
          </li>

        </ul>
      </div>
    </div>
    <div class="close-layer" @click="closeLayer" v-if="!noClose">
      ×
    </div>
  </div>

</template>
<style scoped>
  .close-layer {
    background: #E0110B;
    color: #fff !important;
    border-radius: 32px;
    line-height: 25px;
    text-align: center;
    height: 32px;
    width: 32px;
    font-size: 20px;
    padding: 1px;
    top: -15px;
    right: -11px;
    position: absolute;
    z-index: 99;
    border: 2px solid #fff;
    cursor: pointer;
  }

  .course-boxs {
    max-height: 600px;
    background: #1171e1;
    -webkit-overflow-scrolling: touch;
    width: 700px;
    font-size: 16px;
  }

  .fl {
    float: left;
  }

  .f-time {
    margin-left: 18px;
  }

  .fr {
    float: right;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    height: 30px;
    line-height: 30px;
    width: 112px;
  }

  .jg_kcb {
    scroll-behavior: contain;
    -webkit-overflow-scrolling: touch;
    padding: 20px 0;
  }

  .jg_kcb h2 {
    text-align: center;
    font-size: 18px;
    text-align: center;
    color: #fff;
    font-weight: normal;
  }

  .jg_kcb_list {
    padding: 20px 0;
    background: url(/assets/img/zbkcb.png) no-repeat center top;
    margin-top: 20px;
  }

  .jg_kcb_list_nr {
    margin: 0 auto;
  }

  .jg_kcb_list_fl {
    text-align: right;
    width: 36%;
    margin-left: 30px;
  }

  .jg_kcb_list li {
    line-height: 30px;
    text-align: center;
    color: #fff;
    font-size: 16px;
  }

  .jg_kcb_span {
    padding: 0 15px;
  }

  .jg_kcb_color {
    color: #ff0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    height: 30px;
    line-height: 30px;
    width: 140px;
    text-align: left;
  }

  .jg_tecer {
    display: inline-block;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    height: 30px;
    line-height: 30px;
    width: 140px;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  export default {
    data() {
      return {
        dateShow: dms.date('m') + "月" + dms.date('d') + "日",
        dataNow: dms.date('H:i')
      }
    },
    props: ["noClose"],
    created() {
      this.$store.dispatch(types.LOAD_LESSON);
    },
    mounted() {
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style')

      //$("#" + id + " .notify .notify-main").css('top', '72%')
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      }
    }
  }
</script>