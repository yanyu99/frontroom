<template>
  <div id="COURSE" class="course-box">
    <div class="jg_kcb" :style="{
            background: 'url(/assets/img/kcgg.png)' ,
            width: '100% ',
          height: '100%',
          backgroundRepeat: 'repeat-y',
          backgroundSize: '100% 100%',
          }">

      <h2 id="div_title">{{dateShow}} {{baseConfig.textcfg.lesson_pre}}</h2>
      <div class="jg_kcb_list">
        <ul id="courseMt">
          <li v-for="(item,index) in roomInfo.lessonInfo.lessonList" :key="index">
            <div class="clearfix jg_kcb_list_nr">
              <div class="fl jg_kcb_list_fl clearfix">
                <div :class="{'jg_kcb_color':item.type>0}" class="jg_tecer fl">
                  {{ (item[roomInfo.lessonInfo.teacher]&& item[roomInfo.lessonInfo.teacher].name) ? item[roomInfo.lessonInfo.teacher].name :"无"}}
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
  </div>

</template>
<style scoped>
  .course-box {
    height: 400px;
    overflow: scroll;
    background: #1171e1;
    -webkit-overflow-scrolling: touch;
  }

  .fl {
    float: left;
  }

  .f-time {
    margin-left: 20px;
  }

  .fr {
    float: right
  }

  .jg_kcb {
    scroll-behavior: contain;
    -webkit-overflow-scrolling: touch;
    padding: 20px 0;
  }

  .jg_kcb h2 {
    text-align: center;
    font-size: 32px;
    text-align: center;
    color: #fff;
    font-weight: normal;
  }

  .jg_kcb_list {
    padding: 20px 0;
    background: url(/assets/img/zbkcb.png) no-repeat 322px top;
    margin-top: 20px;
    min-height: 70%;
    height: auto;
  }

  .jg_kcb_list_nr {
    margin: 0 auto;
  }

  .jg_kcb_list_fl {
    text-align: right;
    width: 40%;
    margin-left: 30px;
  }

  .jg_kcb_list li {
    line-height: 45px;
    text-align: center;
    color: #fff;
    font-size: 26px;
  }

  .jg_kcb_span {
    padding: 0 15px;
  }

  .jg_kcb_color {
    display: -webkit-inline-box;
    display: -moz-inline-box;
    display: -ms-inline-flexbox;
    display: -webkit-inline-flex;
    display: inline-flex;
    width: 182px;
    color: #ff0;
  }

  .jg_tecer {
    width: 130px;
    display: inline-block;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  export default {
    data() {
      return {
        dateShow: dms.date('m') + "月" + dms.date('d') + "日",
        dataNow: dms.date('H:i'),
      }
    },
    mounted() {
      var id = this.roomInfo.inner_menu_pop_curBoxId //当前弹出层的id
      $("#" + id).css('top', '72%')

      document.addEventListener('touchmove', function (e) {
        var e = e || window.event; //浏览器兼容性
        var elem = e.target || e.srcElement;
        if (elem.id == "COURSE") {
          e.preventDefault();
        }
      }, false);
    },
    methods: {
      bgStyle() {
        return {
          background: "url('/assets/img/kcgg.png')",
          width: '100% ',
          height: '100%',
          backgroundRepeat: 'repeat-y',
          backgroundSize: '100% 100%',
        }
      },
    }

  }
</script>