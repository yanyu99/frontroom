<template>
  <div class="sider-leave-rank" :style="{'height':$t('179##留言板的高度',__FILE__)+'px'}">
    <div class="hot-rank-head" :style="{'background-color':  $c('rgba(0,0,0,0.7)##留言标题栏颜色值透明度',__FILE__)}">
      <img :src="$m('/assets/img/leavemsg_head.png##留言榜头部图片(高度:38px)', __FILE__)?$m('/assets/img/leavemsg_head.png##留言榜头部图片(高度:38px)', __FILE__) :'/assets/img/leavemsg_head.png'" style="width: 212px; height:38px;" />
    </div>
    <div class="hot-rank-body" :style="{'position': 'relative','background-color':  $c('rgba(0,0,0,0.5)##留言内容颜色值透明度',__FILE__) }">
      <ul id="idHotRank" class="nice-scroll-h">

        <li v-for="(item,index) in roomInfo.leaveRank.teacherList" :key="item.index" class="ter-hot-li" :class="{'ter-fired':item.fired}">
          <div class="ph-num" :style="lbIndStyle(index) ">
            {{index+1}}
          </div>
          <span class="teacher-name" :style="{'position': 'relative','color':$c('#E0E8FF##昵称的颜色', __FILE__)}">
            <span>
              <template v-if="item.name_bold">
                <b>{{item.name}}</b>
              </template>
              <template v-else>{{item.name}}</template>
            </span>
          </span>

          <span class="zan_teacher" @click="leaveClick(item.id,$event)" :style="{'background-color':$c('transparent##留言按钮的背景颜色',__FILE__)}">
            {{$t('留言##按钮显示的文字', __FILE__)}}</span>
        </li>
      </ul>
    </div>
  </div>

</template>
<style scoped>
  .sider-leave-rank {
    background-color: rgba(255, 255, 255, 0.1);
    position: relative;
    display: flex;
    flex-direction: column;
    margin-top: 3px;
  }

  .hot-rank-body {
    display: flex;
    flex: 1;
  }

  .sider-leave-rank .hot-rank-head {
    padding: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .sider-leave-rank ul {
    margin: 0px;
    padding: 0px;
    height: 169px;
    overflow: hidden;
  }

  .sider-leave-rank li {
    padding-bottom: 10px;
    border-bottom: 0.5px solid #5782A6;
    margin-top: 10px;
    text-align: left;
  }

  .sider-leave-rank li .ph-num {
    width: 23px;
    height: 23px;
    text-align: center;
    line-height: 22px;
    border: 1.5px solid #fff;
    background-color: #fa9000;
    display: inline-block;
    margin-right: 5px;
  }

  .sider-leave-rank li .num {
    color: #9DCBEF;
  }

  .sider-leave-rank li .teacher-name {
    color: #E0E8FF;
    font-size: 16px;
  }

  .sider-leave-rank .zan_teacher {
    display: inline-block;
    width: 40px;
    height: 23px;
    text-align: center;
    line-height: 20px;
    color: #fff;
    border: 1px solid #fff;
    border-radius: 3px;
    float: right;
  }

  .sider-leave-rank .zan_teacher.zan {
    background-color: #627584;
    border: 1px solid #627584;
    color: #ccc;
  }

  .hot-rank-body {
    padding: 5px;
    overflow: hidden;
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
  export default {
    mixins: [layercommMixinPc],
    created() {
      this.load();
    },
    methods: {
      load() {
        this.$store.dispatch(types.LOAD_RANKING_LEAVE)
      },
      lbIndStyle(index) {

        var _first = $c('#ff0000##投票排序第一行的背景颜色', __FILE__);
        var _second = $c('#fa9000##投票排序第二行的背景颜色', __FILE__);
        var _third = $c('#fa9000##投票排序第三行的背景颜色', __FILE__);
        var _four = $c('#3285ED##投票排序第四行的背景颜色', __FILE__);
        var _all = $c('#3285ED##投票排序数字默认的背景颜色', __FILE__);
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
      leaveClick(obj) {
        this.popShow('LeaveMsg', obj);
      }
    },
  }
</script>