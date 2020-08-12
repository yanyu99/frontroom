

import Vuex from "vuex"
import * as types from "@/store/types"
export default {
  computed: {
    ...Vuex.mapState([types.userInfo, types.roomInfo, types.baseConfig]),
  },
}