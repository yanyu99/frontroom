<template>
  <div id="TeacherJude" class="TeacherJude-warp pane" v-if="tab.tag == roomInfo.active_menu" :style="{backgroundColor:$c('#2f2e2e##该块背景颜色', __FILE__)}">
    <scroller>
      <ul>
        <li v-for="item in roomInfo.judgeTeacher.judgeList" :key="item.id" :style="{borderBottom:'1px solid'+$c('#595858##border-bottom颜色', __FILE__)}">
          <span class="sp-tname" :style="{color:$c('#fff##昵称文本颜色', __FILE__)}">
            <font>
              <label :style="{color: item.name_color !='#ffffff'|| item.name_color !='#FFFFFF'? item.name_color :'#fff','font-weight':item.name_bold?'':''}">
                {{item.name}}
              </label>
            </font>
          </span>

          <div class="right-info" v-if="!item.fired">
            <span class="sp-btninf">
              <font class="lb-judge-btn" :style="{'background':roomInfo.judgeTeacher.userTidMap[item.id]? 'grey':$c('#00a6e4##支持按钮的背景颜色', __FILE__)}" @click="Judge(1,item.id)">{{$t('支持##支持按钮的文本', __FILE__)}}</font>
              <font class="ft-num">{{item.agree_base +item.agree_num}}</font>
            </span>
            <span class="sp-btninf">
              <font class="lb-judge-btn" :style="{'background':roomInfo.judgeTeacher.userTidMap[item.id]? 'grey':$c('#ee7600##淘汰按钮的背景颜色', __FILE__)}" @click="Judge(2,item.id)">{{$t('淘汰##淘汰按钮的文本', __FILE__)}}</font>
              <font class="ft-num">{{item.oppose_base +item.oppose_num}}</font>
            </span>
          </div>
          <div class="right-info" v-else>
            <img v-if="item.fired" src="/assets/img/fire.png" class="fired-img">
          </div>
        </li>
      </ul>
    </scroller>
  </div>
</template>
<style scoped>
  .TeacherJude-warp ul {
    padding: 0px 20px;
  }

  .TeacherJude-warp li {
    height: 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    padding-bottom: 10px;
  }

  .sp-tname {
    font-size: 32px;
    height: 76px;
    vertical-align: top;
    line-height: 76px;
  }

  .right-info {
    width: 356px;
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
    width: 108px;
    border-radius: 3px;
    height: 60px;
    line-height: 60px;
    vertical-align: middle;
    text-align: center;
    cursor: pointer;
    color: #fff;
    font-size: 26px;
  }

  .ft-num {
    width: 108px;
    font-size: 24px;
    display: block;
    float: right;
    text-align: center;
    color: #b3b3b3;
  }
</style>

<script>
  import Vuex from "vuex"
  import * as types from '@/store/types'
  export default {
    props: {
      tab: Object
    },
    created() {
      !(this.roomInfo.judgeTeacher.judgeList && this.roomInfo.judgeTeacher.judgeList.length) && this.load();
    },
    methods: {
      load() {
        this.$store.dispatch(types.LOAD_TEACHER_JUDGE)
      },
      Judge(_type, _tid) {
        dms.teacherJudge({
          type: _type,
          tid: _tid
        }, resp => {
          var _mapTip = JSON.parse(JSON.stringify(this.roomInfo.judgeTeacher.userTidMap));
          _mapTip[_tid] = 1;
          this.$store.state.roomInfo.judgeTeacher.userTidMap = _mapTip;
          this.dialogMsgAlign(resp.msg)
        }, resp => {
          this.dialogMsgAlign(resp.msg)
          return
        })
      },
    }
  }
</script>