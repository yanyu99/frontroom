<template>
  <div class="left-user-popup dropdown-menu" id="dropdownUserList" @mouseenter="changeUserList(true)" @mouseleave="changeUserList(false)">
    <user-list></user-list>
  </div>
</template>
<style scoped>
  .left-user-popup {
    display: block;
    padding-top: 0px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    flex: 1;
    width: 236px;
    padding-bottom: 0px;
  }

  #dropdownUserList .sider-userlist {
    margin-top: 0px !important;
  }

  #dropdownUserList .sider-userlist .title {
    text-align: center;
  }
</style>

<script>
  import Vuex from "vuex"
  import * as types from '@/store/types'
  import UserList from "@/pc_views/_/side/UserList"
  export default {
    methods: {
      changeUserList(bVal) {
        this.$store.commit(types.UPDATE_ROOM_INFO, {
          is_show_left_userlist: bVal,
        });
      },
    },
    components: {
      UserList
    }
  }
</script>