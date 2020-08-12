<template>

    <span class="sp-func">
      <template v-if="!itemData.from_room_name">
        <template v-if="userInfo.role.f_look">
          <label v-if="itemData.uid != userInfo.uid" class="lb-look" @click.stop="lookUser(itemData, $event)">看</label>
        </template>
      </template>

      <template v-if="userInfo.role.f_deletechat">
        <label v-show="!itemData.selfShow" class="lb-del" @click.stop="delMsg(itemData.id)">删</label>
      </template>

      <template v-if="userInfo.role.f_audit">
        <template v-if="itemData.selfShow || !itemData.is_audited">
          <label v-show=" !(itemData.selfShow || itemData.hasFilter)" class="lb-check" @click.stop="checkMsg(itemData.id)" 
          :style="{backgroundColor:checkColor}">审</label>
        </template>
      </template>

    </span>
</template>

<style scoped>

  .sp-func {
    display: inline-block;
    float: right;
  }

  .dms-message-info p .sp-func>label {
    display: inline-block;
    padding: 0px 12px;
    height: 44px;
    line-height: 44px;
    vertical-align: middle;
    color: #fff;
    font-size: 27.8px;
    border-radius: 6px;
    margin-right: 4px;
  }

  .sp-func label.lb-del {
    background-color: #fc4d00;
  }

  .sp-func label.lb-check {
    background-color: #00a0fc;
  }

  .sp-func label.lb-look {
    background-color: #25a707;
  }
  /*==================覆盖原来样式==========================*/

  .notice-title {
    display: none;
    height: 0px;
  }

  .notify .notify-main {
    top: 62%;
  }

  .notify-content {
    height: auto !important;
  }

  .notify-msg {
    background-color: #fff !important;
    color: #000 !important;
    font-size: 30px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";

  export default {
    data () {
      return {
        checkColor:'',
      }
    },
    props: ["itemData"],
    methods: {
      showStyle(itemData) {
        this.checkColor = '#00a0fc';
        if (itemData.send_roomid != this.roomInfo.room_id) {
          if (itemData.room_id == 0) {
            this.checkColor = "#FF02E0"
          } else {
            this.checkColor = "red"
          }
        }

      },
      lookUser(obj, event) {
        this.$store.dispatch(types.DO_USERINFO_LOOK, {
          uid: obj.uid,
          x: event.pageX,
          y: event.pageY - 240
        });
      },
      delMsg(id) {
        this.$store.dispatch(types.DO_MSG_DEL, {
          id: id
        });
        //滚动条设置
      },
      checkMsg(id) {
        this.$store.dispatch(types.DO_MSG_CHECK, {
          id: id
        });
      }
    }
  };
</script>