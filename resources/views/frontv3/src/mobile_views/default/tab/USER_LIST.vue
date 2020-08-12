<template>
  <div v-if="tab.tag == roomInfo.active_menu" class="pane" :style="{backgroundColor:$c('#2f2e2e##该块背景颜色', __FILE__)}">
    <template v-if="baseConfig.blockcfg.show_user_num">
      <div class="usernum-top" :style="{backgroundColor:$c('#1e1e1e##在线人数背景颜色', __FILE__)}">
        <span class="usernum" :style="{color:$c('#7f7f7f##在线人数标题字体颜色', __FILE__)}">在线用户数：
          <label :style="{color:$c('#fe9a01##在线人数字体颜色', __FILE__)}">
            {{totalUser}}
          </label>
        </span>
      </div>
    </template>

    <div class="demo-wrapper">
      <div class="demo-inner list">
        <ul>
          <li v-for="item in sortUserList" :key="item.uid" :style="{borderBottom:'1px solid'+$c('#595858##border-bottom颜色', __FILE__)}">
            <span class="sp-ind">
              <label>
                <img :src="item.pic? item.pic :'/assets/img/avatar/t3/32/09.png'" class="user-img-head">
              </label>
            </span>
            <span class="sp-tname" :style="{color:$c('#ffffff##昵称文本颜色', __FILE__)}">
              <font>{{item.name}}</font>
            </span>
            <span class="sp-role">
              <template v-if="userInfo.role.f_privatechat">
                <label v-if="item.uid != userInfo.uid" class="pri-chat" @click="priChatTo(item)" :style="{backgroundColor:$c('#db7093##私聊背景颜色', __FILE__)}">私</label>
              </template>
              <template v-else>
                <label v-if="item.role && item.role.f_privatechat" class="pri-chat" @click="priChatTo(item)" :style="{backgroundColor:$c('#db7093##私聊背景颜色', __FILE__)}">私</label>
              </template>
              <template v-if="userInfo.role.f_look">
                <label v-if="item.uid != userInfo.uid" class="lb-look" @click="lookUser(item, $event)" :style="{backgroundColor:$c('#25a707##“看”背景颜色', __FILE__)}">看</label>
              </template>

              <i :style="{
              backgroundImage: item.role_id?'url(' + baseConfig.roles[item.role_id].role_pic + ')':'',
              height: _px(22.3) + 'px',
              width: item.role_id?_px(baseConfig.roles[item.role_id].role_picw) + 'px': _px(22.3) + 'px',
              backgroundSize: '100% 100%',
            }"></i>
            </span>
          </li>
        </ul>

        <div v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="30" style="text-align:center">
          <p class="pagemsg" v-show="busy" v-html="msgInfo" @click="loadMore"></p>
        </div>
      </div>
    </div>
  </div>

</template>

<style scoped>
  .pane {
    color: #fff;
    position: relative;
    width: 100%;
    overflow: auto;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .pane ul {}

  .pane ul li {
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
    background-color: transparent;
    border-top: 0px none !important;
  }

  .pane ul li span {
    text-align: center;
    display: inline-block;
  }

  .pane ul li span.sp-ind {
    display: flex;
    align-items: center;
    margin-right: 10px;
  }

  .pane ul li span.sp-ind label {
    display: flex;
    width: 62px;
    font-size: 32px;
    border-radius: 32px;
    text-align: center;
  }

  .list ul li span.sp-role {
    display: flex;
    justify-items: flex-end;
    align-items: center;
  }

  .sp-role label {
    display: inline-block;
    height: 62px;
    line-height: 62px;
    border-radius: 10px;
    padding: 0px 14px;
    vertical-align: middle;
    margin-right: 20px;
  }

  .user-img-head {
    width: 62px;
    height: 62px;
    border-radius: 62px;
  }

  .pane ul li span.sp-tname {
    display: flex;
    -webkit-flex: 1;
    flex: 1;
    font-size: 30px;
    height: 122px;
    line-height: 122px;
    text-align: left;
  }

  .pane ul li span.sp-zan {
    flex: 2;
  }

  .sp-role i {
    width: 148px;
    height: 46px;
    line-height: 46px;
    background-size: 100%;
    background-repeat: no-repeat;
    vertical-align: middle;
  }

  .usernum-top {
    width: 100%;
    background: #1e1e1e;
    display: flex;
  }

  .usernum {
    padding: 0px 15px;
    height: 74px;
    line-height: 74px;
    display: inline-block;
    font-size: 30px;
    color: #7f7f7f;
  }

  .usernum label {
    color: #fe9a01;
    font-weight: bold
  }

  .demo-wrapper {
    display: flex;
    flex: 1;
  }

  .demo-inner {
    overflow: auto;
    margin-bottom: 30px;
    scroll-behavior: contain;
    width: 100%;
  }

  .list {
    height: 720px;
  }

  .pagemsg {
    font-size: 28px;
    color: #fff;
    display: block;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import userlistCom from "@/mixins/userlistCom";

  export default {
    props: {
      tab: Object
    },
    mixins: [userlistCom],
    data() {
      return {
        busy: false,
        msgInfo: "加载中...",
        isRoll: true,

        userPage: 0, //用户当前页
        robotPage: 0, //机器人当前页
        userGettingEnd: false, //用户数据是否拉完
        robotGetting: false,
        countTime: 5 * 60 * 1000, //5分钟刷新
      }
    },
    computed: {
      ...Vuex.mapGetters([types.sortUserList]),
    },
    methods: {
      getRobotList() {
        var self = this
        this.msgInfo = "加载更多";
        if (this.robotGetting) {
          return;
        }
        this.robotGetting = true;
        this.robotPage++;
        dms.LiveApi.userList2({ page: this.robotPage }, resp => {
          this.robotGetting = false;
          // 多次加载数据
          if (resp.list.length == 0) {
            this.busy = true; //没有更多数据
            //this.msgInfo = "加载更多"; // "加载完毕";
            this.isRoll = false;
          } else {
            this.busy = false;
            var _tempArr = self.roomInfo.userData.userList.slice()
            this._comRobotData(resp, _tempArr);
          }
        }, resp => {
          this.busy = true; //没有更多数据
          //this.msgInfo = "加载完毕";
          this.isRoll = false;
        })
      },

      loadMore() {
        if (this.roomInfo.active_menu != 'USER_LIST') {
          return
        }
        this.busy = true;
        if (!this.userGettingEnd) {
          setTimeout(() => {
            this.getUserList(this.userPage + 1);
          }, 1000)
        } else {
          setTimeout(() => {
            this.getRobotList();
          }, 1000)
        }
        this.rollTop(); //滚动头部
      },
      //对谁私聊
      priChatTo(item) {
        //更改当前的tag
        //更改当前的选择私聊的用户
        if (item.uid == this.userInfo.uid) {
          return;
        }
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          active_menu: 'CHAT_PRIVATE',
          menusMapIsNew: {
            CHAT_PRIVATE: false,
          },
          selPriChatMsgItem: {
            toUid: item.uid,
            toName: item.name,
            from: 'userlist'
          },
        })
      },
      lookUser(obj, event) {
        this.$store.dispatch(types.DO_USERINFO_LOOK, {
          uid: obj.uid,
          x: event.pageX,
          y: event.pageY - 240
        });
      },

      //滚动到第一条
      rollTop() {
        var box = ".list";
        setTimeout(() => {
          $(box).scrollTop(0);
        }, 500);
      }

    }
  };
</script>