// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Vuex from "vuex"
import App from './App'
import router from './router'
import store from "@/store/store"
import * as types from "@/store/types"

import 'babel-polyfill'

// Vue.config.debug = true;
Vue.config.devtools = true
Vue.config.productionTip = false;

import infiniteScroll from 'vue-infinite-scroll' //用户列表
Vue.use(infiniteScroll)
import VueScroller from 'vue-scroller' //tab
Vue.use(VueScroller)

/* eslint-disable no-new */
window.app = new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})

window.addEventListener("message", (event) => {
  var origin = event.origin || event.originalEvent.origin;
  if (!origin) {
    return
  }
  var data = event.data;
  if(data.type == 'component_cfg'){
    var cfg = D.componentCfg[data.tag] || {};
    Vue.set(D.componentCfg, data.tag, cfg);
    Vue.set(D.componentCfg[data.tag], data.key, data.val);
  }
}, false);
