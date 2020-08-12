<template>
  <div v-if="tab.tag == roomInfo.active_menu" class="pane sider-hot-rank vote" :style="{backgroundColor:$c('#2f2e2e##该块背景颜色', __FILE__)}">
    <scroller>
      <ul id="idHotRank">

        <li v-for="(item,index) in roomInfo.hotRank.teacherList" :key="item.tid" :style="{borderBottom:'1px solid'+$c('#595858##border-bottom颜色', __FILE__)}">
          <span class="sp-ind">
            <label :style="lbIndStyle(index) ">{{index+1}}</label>
          </span>
          <span class="sp-tname" :style="{color:$c('#ffffff##昵称文本颜色', __FILE__)}">
            <font>
              <label :style="{color: item.name_color !='#ffffff'|| item.name_color !='#FFFFFF'? item.name_color :'#fff','font-weight':item.name_bold?'':''}">
                {{item.name}}
              </label>
              <label class="lb-vot-num">({{ item.hide_vote_num ? '*' : item.hot_base +item.hot_got }})</label>
            </font>
            <font :style="{color:item.add_info_color}">{{item.add_info}}</font>

            <template v-if="item.fired">
              <img src="/assets/img/fire.png" class="fired-img">
            </template>
            <template v-else>
              <img v-if="item.rank == 1" src="/assets/img/third-rk.png" class="fired-img">
              <img v-if="item.rank == 2" src="/assets/img/second-rk.png" class="fired-img">
              <img v-if="item.rank == 3" src="/assets/img/champion-rk.png" class="fired-img">
            </template>
          </span>

          <span v-if="!item.fired && !item.rank" class="sp-zan" @click="zanClick(item.tid,$event)">
            <i :data-test="roomInfo.hotRank.userTidMap[item.tid]" :style="{backgroundImage: !roomInfo.hotRank.userTidMap[item.tid]?'url('+$m('/assets/v3/images/phone/vote.png##点赞图片', __FILE__)+')':'url('+$m('/assets/v3/images/phone/vote_no.png##无法点赞图片', __FILE__)+')'}">
              {{voteTitle}}</i>
          </span>
          <span v-else class="sp-zan">
            <i></i>
          </span>
        </li>
      </ul>
    </scroller>

  </div>
</template>


<style scoped>
  .pane {
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .fired-img {
    position: absolute;
    margin-top: -80px;
    left: 35%;
  }

  .sp-tname font {
    display: block;
  }

  .sp-tname font:nth-child(1) {
    display: block;
    width: 100%;
    height: 85px;
    line-height: 115px;
  }

  .sp-tname font:nth-child(2) {
    display: block;
    width: 100%;
    height: 22px;
    line-height: 22px;
    padding-top: 1px;
  }

  .vote {
    color: #fff;
    position: fixed;
    width: 100%;
    overflow: auto;
    position: relative;
  }

  .vote ul li {
    display: -webkit-box;
    /* Chrome 4+, Safari 3.1, iOS Safari 3.2+ */
    display: -moz-box;
    /* Firefox 17- */
    display: -webkit-flex;
    /* Chrome 21+, Safari 6.1+, iOS Safari 7+, Opera 15/16 */
    display: -moz-flex;
    /* Firefox 18+ */
    display: -ms-flexbox;
    /* IE 10 */
    display: flex;
    /* Chrome 29+, Firefox 22+, IE 11+, Opera 12.1/17/18, Android 4.4+ */
    height: 122px;
    line-height: 122px;
    /* border-bottom: 1px solid #595858; */
    margin: 0px 12px;
  }

  .vote ul li span {
    text-align: center;
  }

  .vote ul li span.sp-ind {
    flex: 1;
  }

  .vote ul li span.sp-ind label {
    display: inline-block;
    width: 60px;
    height: 60px;
    line-height: 60px;
    font-size: 32px;
    border-radius: 32px;
    text-align: center;
  }

  .vote ul li span.sp-tname {
    flex: 3;
    font-size: 30px;
    height: 122px;
    line-height: 122px;
    text-align: left;
    position: relative;
  }

  .vote ul li span.sp-zan {
    /* flex: 2; */
    margin-right: 10px;
  }

  .sp-zan i {
    display: inline-block;
    background-position: left;
    background-repeat: no-repeat;
    background-size: 100%;
    width: 148px;
    height: 82px;
    line-height: 86px;
    font-weight: bold;
    font-size: 28px;
    text-indent: 34px;
  }

  .sp-zan i.izan {
    background-size: 100%;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import AnswerQues from "./AnswerQues";
  import hotrankMixin from "@/mixins/hotrankMixin"
  export default {
    props: {
      tab: Object
    },
    data() {
      return {
        voteTitle: '',
        components: {
          AnswerQues
        }
      };
    },
    mixins: [hotrankMixin],
    created() {
      this.voteTitle = this.baseConfig.hotcfg.vote_title
      this.lazyWatch(
        'hotRank',
        'roomInfo.active_menu',
        (n, o) => n == 'RANKING_HOT'
      )
    },
    methods: {
      load() {
        this.$store.dispatch(types.LOAD_RANKING_HOT)
      },
      lbIndStyle(index) {
        return {
          backgroundColor: index + 1 > 3 ? this.$c('#00a0fc##后面排名背景颜色', __FILE__) : this.$c('#fa2c1f##前三名背景颜色', __FILE__)
        };
      },

      pageHandle() { //弹出框
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_inner_menu: 'AnswerQues', //当前活动的菜单
          inner_menu_pop_curBoxId: '',
        });

        //以组件的 弹出
        let _id = this.$layer.iframe({
          content: {
            content: this.components.AnswerQues,
            parent: this,
            data: {
              obj: {}
            },
            tipsMore: false,
            shade: true,
          },
          area: ["95%"],
          btn: "确定"
        });

        $("#" + _id).addClass('bgborder');
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          inner_menu_pop_curBoxId: _id, //存储当前弹出框的id
          inner_menu_isshow: false, //关闭菜单按钮
        });
      },
    },
    components: {
      AnswerQues
    }
  };
</script>