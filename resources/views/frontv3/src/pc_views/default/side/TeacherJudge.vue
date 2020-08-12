<template>
  <div class="sider-teacher-judge" :style="{'height':$t('227##审判团的高度',__FILE__)+'px'}">
    <div class="hot-rank-head" :style="{'background-color': $c('rgba(0,0,0,0.7)##人气榜标题栏颜色值透明度',__FILE__)}">
      <img :src=" '/assets/img/judge-tit.png' " style="width: 212px;" />
    </div>
    <div class="teacher-judge-body" :style="{'position': 'relative','background-color': $c('rgba(0,0,0,0.5)##人气榜内容颜色值透明度',__FILE__)}">
      <ul id="idHotRank" class="nice-scroll-h">
        <li v-for="item in roomInfo.judgeTeacher.judgeList" :key="item.index" class="ter-hot-li" :class="{'ter-fired':item.fired}">
          <span class="teacher-name" style="position: relative;">
            <span :i-color="item.name_color" :style="{color: item.name_color !='#ffffff'|| item.name_color !='#FFFFFF' ?item.name_color :'#fff' }">
              <template v-if="item.name_bold">
                <b>{{item.name}}</b>
              </template>
              <template v-else>{{item.name}}</template>
            </span>
          </span>

          <div class="right-info" v-if="!item.fired">
            <span class="sp-btninf">
              <font class="lb-judge-btn" :style="{'background':roomInfo.judgeTeacher.userTidMap[item.id]? 'grey': $c('#00a6e4##支持按钮的背景颜色', __FILE__)}" @click="Judge(1,item.id)">{{$t('支持##支持按钮的文本', __FILE__)}}</font>
              <font class="ft-num">({{item.agree_base +item.agree_num}})</font>
            </span>
            <span class="sp-btninf">
              <font class="lb-judge-btn" :style="{'background':roomInfo.judgeTeacher.userTidMap[item.id]? 'grey': $c('#ee7600##淘汰按钮的背景颜色', __FILE__)}" @click="Judge(2,item.id)">{{$t('淘汰##淘汰按钮的文本', __FILE__)}}</font>
              <font class="ft-num">({{item.oppose_base +item.oppose_num}})</font>
            </span>
          </div>
          <div class="right-info" v-else>

          </div>

        </li>
      </ul>
    </div>
  </div>

</template>
<style scoped>
  .sider-teacher-judge {
    display: flex;
    flex-direction: column;
  }

  .hot-rank-head {
    display: flex;
  }

  .teacher-judge-body {
    display: flex;
    flex: 1;
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

  .teacher-name {
    height: 42px;
    margin-left: 5px;
  }

  .sider-teacher-judge li {
    padding-bottom: 5px;
    margin-top: 5px;
  }

  .hot-rank-body {
    overflow: hidden;
  }

  .ter-hot-li {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .lb-judge-btn {}

  .right-info {
    width: 128px;
    display: flex;
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    justify-content: flex-end;
    -webkit-box-pack: flex-end;
    -ms-flex-pack: flex-end;
    -webkit-justify-content: flex-end;
    justify-content: flex-end;
    -webkit-box-align: flex-end;
    -ms-flex-align: flex-end;
    -webkit-align-items: flex-end;
    align-items: flex-end;
  }

  .sp-btninf {
    flex: 1;
    text-align: right;
  }

  .lb-judge-btn {
    display: inline-block;
    width: 54px;
    border-radius: 3px;
    height: 26px;
    line-height: 26px;
    vertical-align: middle;
    text-align: center;
    cursor: pointer;
  }

  .ft-num {
    font-size: 12px;
    display: inline-block;
    text-align: center;
    width: 100%;
  }
</style>
<script>
  import * as types from '@/store/types'
  export default {
    created() {
      this.load();
    },
    methods: {
      load() {
        //this.$store.dispatch(types.LOAD_TEACHER_JUDGE)
      },
      Judge(_type, _tid) {
        dms.teacherJudge({
          type: _type,
          tid: _tid
        }, resp => {
          this.dialogMsgAlign(resp.msg);
          var _mapTip = JSON.parse(JSON.stringify(this.roomInfo.judgeTeacher.userTidMap));
          _mapTip[_tid] = 1;
          this.$store.state.roomInfo.judgeTeacher.userTidMap = _mapTip;
        }, resp => {
          this.dialogMsgAlign(resp.msg)
          return
        })
      },
    },
  }
</script>