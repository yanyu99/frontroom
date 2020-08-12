<template>
  <div class="sider-userlist">
    <div class="title" :style="{'background-color': $c('rgba(0,0,0,0.8)##用户列表头部颜色值透明度',__FILE__)}">
      <img src="/assets/img/uselistico.png">
      <span style="margin-left: 5px;">{{baseConfig.textcfg.ul_title}}</span>
      <span v-if="baseConfig.blockcfg.show_user_num" id="idUserTotal1">({{totalUser}})</span>
    </div>
    <div class=" user-list nice-scroll" tabindex="0" :style="{'overflow': 'hidden','outline': 'none','background-color': $c('rgba(0,0,0,0.5)##用户列表背景颜色值透明度',__FILE__)}">

      <template v-if="userInfo.role.f_search">
        <form class="user-list-search" onsubmit="return false;">
          <input type="text" class="search-input" v-model="searchName" placeholder="搜索">
        </form>
      </template>
      <template v-if="userInfo.role.f_ul_select">
        <select id="js-ul-type-list" class="user-list-typelist" v-model="selectTypeId">
          <option v-for="item in roomInfo.optSearchArr" :key="item.id" :selected="item.role_id == 0" :value="item.role_id" :name="item.des" :data-value="item.name">
            {{item.des}}
            <template v-if="item.name != 'all'">({{item.num}})</template>
          </option>
        </select>
      </template>

      <template>
        <div v-if="userInfo.role.f_userlist" class="user-list-wrap">
          <ul id="idUserList" style="margin-bottom: 0px;">

            <template v-for="item in sortUserList">
              <li :key="item.uid" :class="liClass(item)" :id="'user_'+item.uid+'_'+item.plat" :data-type="item.role_id" :data-id="item.uid" :data-name="item.name">
                <a class="dropdown-toggle user-a-bef" data-hover="dropdown11">
                  <img :src="item.pic? item.pic :'/assets/img/avatar/t3/32/09.png'" alt="user" />
                  <span class="text" :i-type="item.role_id" :i-isrobot="item.isRobot" :style="{color:userInfo.role.f_sign_robots && item.isRobot ==1? 'red':''}">{{item.name}}</span>
                  <template v-if="item.referrerId">
                    （
                    <span class='number'>{{item.referrerId}}</span>）
                  </template>
                </a>
                <span class="ri-func">
                  <template v-if="!item.isRobot">
                    <template v-if="userInfo.role.f_privatechat">
                      <template v-if="item.uid != userInfo.uid">
                        <span class="rolebtn rolebtn-prichat" :style="btnBg" @click="priChatTo(item)"> 私 </span>
                      </template>
                    </template>
                    <template v-else>
                      <template v-if="item.role && item.role.f_privatechat ">
                        <span class="rolebtn rolebtn-prichat" :style="btnBg" @click="priChatTo(item)"> 私 </span>
                      </template>
                    </template>
                  </template>
                  <span v-if="userInfo.role.f_tochat && !baseConfig.msgcfg.hide_to_user" class="rolebtn rolebtn-tochat js-chat-select-name" :style="btnBg" @click="chatTo(item)"> 说</span>
                  <span v-if="userInfo.role.f_look" class="rolebtn rolebtn-look " @click="lookUser(item,$event)" :style="btnBg"> 看 </span>
                  <span class="icon" :class="'userlist-icon-'+item.role_id"></span>
                </span>
              </li>
            </template>
            <div id="js-more-user" class="user-bottom-more" @click="loadMore">获取更多</div>
          </ul>
        </div>
        <div v-else-if="($m('##用户没有查看用户列表时的图片',__FILE__)).length" class="user-list-wrap" :style="{height: '100%','background-image': 'url('+$m('##用户没有查看用户列表时的图片',__FILE__)+')'}">
        </div>
      </template>
    </div>
  </div>

</template>
<style scoped>
  .sider-userlist {
    position: relative;
    display: flex;
    flex: 1;
    margin-top: 3px;
    flex-direction: column;
  }

  .user-list {
    display: flex;
    flex: 1;
    flex-direction: column;
  }

  .user-list-wrap {
    display: flex;
    flex: 1;
    flex-direction: column;
  }

  #idUserList {
    /* display: flex; */
    flex-direction: column;
  }

  #js-more-user {
    display: flex;
    justify-content: center;
  }

  .user-list .user-item .icon {

    height: 20px;
    background-size: 100% 100%;
    vertical-align: middle;
    margin-left: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .user-list .user-item {
    position: relative;
    cursor: pointer;
    height: 40px;
    line-height: 40px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  }

  .user-list .user-item .rolebtn {
    font-size: 14px;
    color: #FFF;
    background: #359A03;
    text-align: center;
    border-radius: 3px;
    line-height: 20px;
    display: flex;
    height: 20px;
    line-height: 20px;
    width: 20px;
    align-items: center;
    justify-content: center;
    margin-left: 3px;
  }

  .user-list .user-item a {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    display: flex;
    padding-right: 25px;
    align-items: center;
  }

  .user-list .user-item .text {
    color: #fff;
  }

  .user-list .user-item .number {
    color: #aaa;
  }

  .user-list .user-item img {
    height: 26px;
    width: 26px;
    border-radius: 26px;
    vertical-align: middle;
    margin-right: 3px;
  }

  .user-a-bef {
    display: flex;
    flex: 1;
  }

  .ri-func {
    display: flex;
    position: absolute;
    right: 0px;
    top: 0px;
    flex-direction: row;
    height: 100%;
    align-items: center;
  }

  .user-list-search,
  .user-list-typelist {
    display: flex;
  }

  .user-bottom-more {
    padding: 5px;
    text-align: center;
    cursor: pointer;
  }
</style>
<script>
  import Vuex from "vuex"
  import * as types from '@/store/types'
  import layercommMixinPc from "@/mixins/layercommMixinPc"
  import userlistCom from "@/mixins/userlistCom"

  var userRoom_Timmer = null;

  export default {
    data() {
      return {
        msgInfo: "加载中...",
        isRoll: true,
        btnBg: ''
      }
    },
    props: ['styleuser'],
    mixins: [layercommMixinPc, userlistCom],
    created() {
      this.btnBg = { 'background-color': $c('#359A03##用户列表按钮背景颜色', __FILE__) }
    },
    computed: {
      ...Vuex.mapGetters([types.sortUserList]),

      searchName: {
        get: function () {
          return this.roomInfo.userData.filterStrParam;
        },
        set: function (newVal, oldVal) {
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            userData: {
              filterStrParam: newVal
            }
          })
        }
      },

      selectTypeId: {
        get: function () {
          return this.roomInfo.userData.filterSelParam;
        },
        set: function (newVal) {
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            userData: {
              filterSelParam: newVal
            }
          })
        }
      },
    },

    methods: {
      liClass(item) {
        var _tempArr = ["user-item online"];
        _tempArr.push("select-role-" + item.role_id);
        if (item.role_id >= 500) {
          _tempArr.push("select-role-mgr")
        } else if (item.role_id == 400) {
          _tempArr.push("select-role-teacher")
        } else if (item.role_id == 100) {
          _tempArr.push(" select-role-guest")
        } else {
          if (item.isRobot) {
            _tempArr.push("select-role-robot"); //机器人的情况
          } else {
            _tempArr.push("select-role-reg")
          }
        }
        if (item.role && item.role.f_privatechat) {
          _tempArr.push("has-prichat")
        }
        return _tempArr;
      },
      getRobotList() {
        var self = this
        if (this.robotGetting) {
          return;
        }
        this.robotGetting = true;
        this.robotPage++;

        dms.LiveApi.userList2({ page: this.robotPage }, resp => {
          this.robotGetting = false;
          $(".user-list").scrollTop(0)
          // 多次加载数据
          if (resp.list.length) {
            var _tempArr = self.roomInfo.userData.userList.slice();
            this._comRobotData(resp, _tempArr);
          }
        }, resp => {
          this.msgInfo = "加载完毕";
          this.isRoll = false;
        })
      },

      loadMore() {
        !this.userGettingEnd ? this.getUserList(this.userPage + 1) : this.getRobotList();
      },

      //对谁私聊
      priChatTo(item) {
        //更改当前的tag
        //更改当前的选择私聊的用户
        if (item.uid == this.userInfo.uid) {
          return;
        }
        var _tempItem = {
          ...item,
          islook: false,
        }
        var _tempArr = (this.roomInfo.priChatToList || []).slice();
        _tempArr.findIndex(i => i.uid == item.uid) == -1 && _tempArr.push(_tempItem);

        this.$store.state.roomInfo.priChatToList = _tempArr;
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          selPriChatMsgItem: {
            toUid: item.uid,
            toName: item.name,
            toPic: item.pic,
            from: 'userlist'
          },
          is_show_pri_box: true, //私聊框是否显示
        })
      },
      lookUser(obj, event) {
        var intY = event.pageY + 111 > $(window).height() ? ($(window).height() - 111 - 100) : event.pageY - 100
        this.$store.dispatch(types.DO_USERINFO_LOOK, {
          uid: obj.uid,
          x: event.pageX, //e.pageX-$(this).offset().left
          y: intY,
          from: 'userlist',
        });
      },
      chatTo(item) { //对谁说
        if (!this.userInfo.role.f_tochat || this.userInfo.uid == item.uid) {
          return
        }
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          selChatMsgItem: {
            toUid: item.uid,
            toName: item.name,
            from: 'userlist',
            toType: item.role_id
          },
        })
      }
    },
  }
</script>