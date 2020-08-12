export default Vue => {
  var defaultFunction = function (a) {
      a = a || '';
      return a.split('##')[0];
  };

  Vue.prototype.$t = window.gettext || defaultFunction;
  Vue.prototype.$c = window.gettext || defaultFunction;
  Vue.prototype.$m = window.gettext || defaultFunction;
};
