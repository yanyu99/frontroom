export default {
  data() {
    return {
        isDataLoading:false
    }
  },
  mounted() {
    this.$layer.loading(2, { time: 1 });
  }
}