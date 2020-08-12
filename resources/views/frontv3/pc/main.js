// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Vuex from "vuex"
import App from './App'
import router from './router'
import store from "@/store/store"
import * as types from "@/store/types"
import 'babel-polyfill'

// import 'transform-es3-property-literals'
// import 'transform-es3-member-expression-literals'

// import es6Promise from "babel-polyfill";
// es6Promise.polyfill();
Vue.config.devtools = true
Vue.config.productionTip = false;

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
