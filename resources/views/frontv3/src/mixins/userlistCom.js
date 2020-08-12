import Vuex from "vuex";
import * as types from "@/store/types";

export default {
  data() {
    return {
      userPage: 0, //用户当前页
      robotPage: 0, //机器人当前页
      userGettingEnd: false, //用户数据是否拉完
      robotGetting: false,
      countTime: 5 * 60 * 1000, //5分钟刷新
    }
  },
  created() {
    this.userGettingEnd = this.roomInfo.userData.userFull;
    if (this.roomInfo.userData.isFirstGet) {
      this.getUserList(this.roomInfo.userData.stopAt)
      this.getRobotList();
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        userData: {
          isFirstGet: false,
        }
      })
    }

    //隔5分钟移除机器人的数据 获取第一页机器人的数据
    setInterval(() => {
      dms.LiveApi.userList2({ page: 1 }, resp => {
        var _tempArr = this.roomInfo.userData.userList.slice()
        _tempArr = _tempArr.filter(i => (i.isRobot || 0) != 1); //排除机器人的
        this._comRobotData(resp, _tempArr);
      })
    }, this.countTime);
  },
  computed: {
    totalUser() {
      var userNum = parseInt(this.roomInfo.robot_num) +
        parseInt(this.roomInfo.real_robot_num) +
        parseInt(this.roomInfo.realUserTotal || 0) +
        parseInt(this.baseConfig.logincfg.base_user) || 0;
      return userNum
    },
  },
  methods: {
    getUserList(stopAt) {
      var stopAt = parseInt(stopAt) > 0 ? parseInt(stopAt) : 0;
      if (stopAt > 0 && this.userPage > stopAt) { // 自动加载的情况下  只会加载前 stopAt 页
        return;
      }

      this.userPage++;
      this.msgInfo = "加载更多";
      dms.LiveApi.userList({ room_id: this.roomInfo.room_id, page: this.userPage }, res => {
        if (this.userPage == 1) {
          this.$store.state.roomInfo.realUserTotal = parseInt(this.roomInfo.realUserTotal + res.total);
          this.$store.commit(types.UPDATE_ROOM_INFO, {
            userData: {
              userReg: res.reg || 0,
              userGuest: res.guest || 0,
            }
          });
          //window.LIVE_PLAT == 'pc' && this.totalNumCal();
        }
        if (res.full) { //后面还有数据
          //延迟10s 重新发送请求
          setTimeout(() => {
            this.getUserList(stopAt)
          }, 10000);
        } else {
          this.userGettingEnd = true; //用户数据已经拉取完了
        }
        res.list = res.list || [];
        for (var user of res.list) {
          user.fromList = 1;
          this.$store.commit(types.ON_USER_ENTER, user);
        }
      }, res => {
        setTimeout(() => this.getUserList(stopAt), 3000)
      })
    },
    totalNumCal() {
      //计算数量
      if (this.userInfo.role.f_ul_select) {
        var _dataArr = this.roomInfo.optSearchArr.slice();
        for (var i = 0; i < _dataArr.length; i++) {
          var _selType = _dataArr[i].role_id;

          if (_selType == 100) { //游客
            _dataArr[i].num = this.roomInfo.userData.userGuest;
          } else if ((_selType == 1 || i.type == 499) && (i.isRobot || 0) != 1) { //会员
            var _tmpArr = this.roomInfo.userData.userList;
            var teacherArr = _tmpArr.filter(i => i.role_id && i.role_id == 400).length; //讲师的人数
            var mgrArr = _tmpArr.filter(i => i.role_id && i.role_id == 500).length; //管理员的人数
            var regNum = this.roomInfo.userData.userReg - teacherArr - mgrArr;
            _dataArr[i].num = regNum >= 0 ? regNum : 0;
          } else {
            var _num = this.roomInfo.userData.userList.filter(i => i.role_id == _selType).length;
            _dataArr[i].num = _num;
          }
        }
        state.roomInfo.optSearchArr = _dataArr;
      }
    },
    _retSetArr(arr) {
      for (var i = arr.length - 1; i >= 0; i--) {
        var _tempArr = arr.filter(m => m.uid == arr[i].uid)
        if (_tempArr.length > 1) {
          arr.splice(i, 1);
        }
      }
      return arr
    },
    _addRobotInfo(arr) {
      for (var i = 0; i < arr.length; i++) {
        arr[i].isRobot = 1;
      }
      return arr
    },
    _comRobotData(resp, _tempArr) {
      var _tempRobot = resp.list || []
      _tempRobot = this._addRobotInfo(_tempRobot); //添加机器人属性
      _tempArr = _tempArr.concat(_tempRobot)
      _tempArr = this._retSetArr(_tempArr); //去除重复

      this.$store.state.roomInfo.userData.userList = _tempArr;
      this.$store.state.roomInfo.real_robot_num = resp.real_num;
    }
  }

}