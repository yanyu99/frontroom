import Vuex from 'vuex'
import * as types from '@/store/types'

//菜单栏弹出
import QQHELPER from "@/pc_views/_/navmenupop/QQHELPER";
import SHARE from "@/pc_views/_/navmenupop/SHARE";
import ECO_CALENDER from "@/pc_views/_/navmenupop/ECO_CALENDER";
import TEACHER from "@/pc_views/_/navmenupop/TEACHER";
import NEWS from "@/pc_views/_/navmenupop/NEWS";
import INNERJOIN from "@/pc_views/_/navmenupop/INNERJOIN";
import PICROLL from "@/pc_views/_/navmenupop/PICROLL";
import OPTIONS from "@/pc_views/_/navmenupop/OPTIONS";

import FORTUNE from "@/pc_views/_/navmenupop/FORTUNE";
import STOCKPOOL from "@/pc_views/_/navmenupop/STOCKPOOL";
import COURSE from "@/pc_views/_/navmenupop/COURSE";
import VIDEO from "@/pc_views/_/navmenupop/VIDEO"
import DOWNLOAD from "@/pc_views/_/navmenupop/DOWNLOAD"
//聊天区
import HONGBAO from "@/pc_views/_/chatpop/HONGBAO"
import TREASURE from "@/pc_views/_/chatpop/TREASURE"
//用户中心
//import UserInfo from "@/pc_views/_/header/UserInfo"
import ThemeMenu from '@/pc_views/_/header/ThemeMenu'
import Login from '@/pc_views/_/header/Login'
import CouponLogin from '@/pc_views/_/header/CouponLogin'
import Register from '@/pc_views/_/header/Register'

import UserMain from '@/pc_views/_/usercenter/UserMain'
import UserCard from "@/pc_views/_/side/UserCard"

//排行榜
import RANK_GIFTGOT from "@/pc_views/_/rank/RANK_GIFTGOT"
import RANK_GIFTSEND from "@/pc_views/_/rank/RANK_GIFTSEND"
import RANK_HOTTING from "@/pc_views/_/rank/RANK_HOTTING"
import RANK_JF from "@/pc_views/_/rank/RANK_JF"

//客服联系弹出 组件
import GetCoupon from "@/pc_views/_/coupon/GetCoupon"
import SetInfo from "@/pc_views/_/usercenter/SetInfo"

import POPAD from "@/pc_views/_/navmenupop/POPAD"
import CONTASTCOURSE from "@/pc_views/_/navmenupop/CONTASTCOURSE"
import INCOME from "@/pc_views/_/navmenupop/INCOME"
import QQPIC from "@/pc_views/_/navmenupop/QQPIC" //图片类型
import AnswerQues from "@/pc_views/_/side/AnswerQues"
import PacketNone from "@/pc_views/_/packet/PacketNone"

import YjContent from "@/pc_views/_/yjlottery/YjContent";
import RobotAutoModal from "@/pc_views/_/navmenupop/RobotAutoModal"; // 机器人自动发言
import DFCF from "@/pc_views/_/navmenupop/DFCF";
import signinMixinPc from "@/mixins/signinMixinPc";
import LeaveMsg from "@/pc_views/_/navmenupop/LeaveMsg";
import StartVote from "@/pc_views/_/votecon/StartVote";
import UserVote from "@/pc_views/_/votecon/UserVote";
import TeacherReward from "@/pc_views/_/navmenupop/TeacherReward";
export default {
  data() {
    return {
      components: {
        QQHELPER,
        SHARE,
        ECO_CALENDER,
        TEACHER,
        NEWS,
        INNERJOIN,
        PICROLL,
        OPTIONS,
        FORTUNE,
        STOCKPOOL,
        COURSE,
        VIDEO,
        DOWNLOAD,

        HONGBAO,
        TREASURE,
        ThemeMenu,
        Login,
        CouponLogin,
        Register,
        //UserCard,
        UserMain,

        RANK_GIFTGOT,
        RANK_GIFTSEND,
        RANK_HOTTING,
        RANK_JF,
        GetCoupon,
        SetInfo,
        POPAD,
        CONTASTCOURSE,
        INCOME,
        QQPIC,
        AnswerQues,
        PacketNone,
        YjContent,
        RobotAutoModal,
        DFCF,
        // LeaveMsg,
        // StartVote,
        // UserVote,
        // TeacherReward
      }
    }
  },
  mixins: [signinMixinPc],
  computed: {
    ...Vuex.mapGetters([types.innerMenus]),
  },
  methods: {
    popShow(tag, itemObj) {
      if (tag == "EmptyType") {
        return;
      }
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        active_inner_menu: tag, //当前活动的菜单
        curlayer_pop_id: ''
      });
      if (itemObj && itemObj.type == '4200') {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          is_show_left_userlist: this.roomInfo.is_show_left_userlistrue ? false : true,
        });
        return;
      }
      if (itemObj && itemObj.type == 4003) { //链接
        window.open(itemObj.args.url);
        return;
      }
      if (itemObj && itemObj.type == 4800) { //签到
        this.userPast();
        return;
      }
      this._popShow(tag, itemObj);
    },

    _popShow(tag, itemObj) {
      console.log("=======" + tag, itemObj);
      //以组件的 弹出
      let _id = this.$layer.iframe({
        content: {
          content: this.components[tag],
          parent: this,
          data: {
            obj: itemObj,
            args: itemObj && itemObj.args ? itemObj.args : {},
          }
        },
        title: itemObj && itemObj.text ? itemObj.text : '',
        tipsMore: false,
        shadeClose: itemObj && itemObj.noClose ? false : true, //点击遮罩是否关闭
      });

      if (tag == "POPAD" || tag == "FORTUNE" || tag == "LeaveMsg" || tag == "StartVote" || tag == "UserVote") { //不需要弹窗title 边框的
        $("#" + _id).find('.vl-notice-title').hide();
        $("#" + _id).addClass("bgborder");
        $("#" + _id).find('.vl-notify-content').addClass('padding-style');
      }
      if (itemObj && itemObj.noClose) {
        $("#" + _id).addClass("setlayer");
        $("#" + _id + "_mask").addClass("setlayer-mask");
      }
      this.$store.commit(types.UPDATE_ROOM_INFO, {
        curlayer_pop_id: _id
      });
    },
  }
}