<template>
  <div class="sider-hot-rank bor-top" :style="{'height':$t('227##人气榜内容高度', __FILE__)+'px'}">
    <div class="hot-rank-head" :style="{'background-color':  $c('rgba(0,0,0,0.7)##人气榜标题栏颜色值透明度',__FILE__) }">
      <img :src=" '/assets/img/renqi.png' " style="width: 212px;" />
    </div>
    <div class="hot-rank-body" :style="{'position': 'relative','background-color': $c('rgba(0,0,0,0.5)##人气榜内容颜色值透明度',__FILE__)}">
      <ul id="idHotRank" class="nice-scroll-h">

        <li v-for="(item,index) in roomInfo.hotRank.teacherList" :key="item.index" :class="['ter-hot-li',{'ter-fired':item.fired}]">
          <div class="ph-num" :style="lbIndStyle(index) ">
            {{index+1}}
          </div>
          <span class="teacher-name" style="position: relative;">
            <span :i-color="item.name_color" :style="{color: item.name_color !='#ffffff'|| item.name_color !='#FFFFFF' ?item.name_color :'#fff' }">
              <template v-if="item.name_bold">
                <b>{{item.name}}</b>
              </template>
              <template v-else>{{item.name}}</template>
            </span>
            <span class="num">(
              <span class="hot-rank-num">{{item.hide_vote_num ? '*' : (item.hot_base +item.hot_got) }}</span>)</span>
            <template v-if="!item.fired ">
              <img v-if="item.rank == 1" src="/assets/img/third-rk.png" class="rank-img">
              <img v-if="item.rank == 2" src="/assets/img/second-rk.png" class="rank-img">
              <img v-if="item.rank == 3" src="/assets/img/champion-rk.png" class="rank-img">
            </template>
          </span>

          <span v-if="!item.fired && !item.rank" class="zan_teacher" :class="{'zan':roomInfo.hotRank.userTidMap[item.tid]}" @click="zanClick(item.tid,$event)" :style="{'background-color':$c('transparent##点赞按钮的背景颜色',__FILE__)}">
            {{vote_title}}
          </span>
          <div class="hot-income" v-if="item.add_info" :style="{color:item.add_info_color}">{{item.add_info}} </div>
        </li>
      </ul>
    </div>
  </div>

</template>
<style scoped>
  .sider-hot-rank {
    display: flex;
    flex-direction: column;

  }

  .hot-rank-head {
    display: flex;
    height: 48px;
  }

  .hot-rank-body {
    display: flex;
    flex: 1;
  }

  .zan_teacher {
    cursor: pointer;
  }

  .fired-img {
    background: url("/assets/img/fire.png") no-repeat center;
    width: 47px;
    height: 30px;
    position: absolute;
    top: 0px;
    left: 55px;
  }

  .rank-img {
    position: absolute;
    right: -44px;
  }

  .ter-fired {
    background: url(/assets/img/firebtn.png);
    background-repeat: no-repeat;
    background-position: right 0px;
  }

  .sider-hot-rank li {
    border-bottom: 0.5px solid;
    border-bottom-color: rgba(255, 255, 255, 0.4);
  }

  .hot-rank-body {
    overflow: hidden;
  }
</style>
<script>
  import * as types from '@/store/types'
  import layercommMixinPc from "@/mixins/layercommMixinPc"
  import hotrankMixin from "@/mixins/hotrankMixin"
  export default {
    mixins: [layercommMixinPc, hotrankMixin],
    created() {
      this.load();
    },
    methods: {
      load() {
        this.$store.dispatch(types.LOAD_RANKING_HOT)
      },
      lbIndStyle(index) {
        var _first = $c('#ff0000##投票排序第一行的背景颜色', __FILE__);
        var _second = $c('#fa9000##投票排序第二行的背景颜色', __FILE__);
        var _third = $c('#fa9000##投票排序第三行的背景颜色', __FILE__);
        var _four = $c('#3285ED##投票排序第四行的背景颜色', __FILE__);
        var _all = $c('#3285ED##投票排序默认的背景颜色', __FILE__);
        var _valColor = '';
        if (index == 0) {
          _valColor = _first;
        } else if (index == 1) {
          _valColor = _second;
        } else if (index == 2) {
          _valColor = _third;
        } else if (index == 3) {
          _valColor = _four;
        } else {
          _valColor = _all;
        }
        return {
          backgroundColor: _valColor,
        };
      },
    },
  }
</script>