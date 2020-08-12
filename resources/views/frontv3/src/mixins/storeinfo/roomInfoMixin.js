import Vuex from "vuex"
import * as types from "./types"
export default {
  computed: {
    ...Vuex.mapState([types.roomInfo]),
  },
}