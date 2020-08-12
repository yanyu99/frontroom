import stockData from "@/mixins/side/stockData"
var sinaStockTimer = null;

export default {
  data() {
    return {
      dataList: [],
      is_showmore_stock: 0
    }
  },
  mixins: [stockData],
  mounted() {
    this.$watch("baseConfig.extcfg.stock_code", function (newVal, oldVal) {
      this.$store.state.baseConfig.extcfg.stock_code = newVal
      sinaStockTimer = null;
      this.initStockData();
      this.changeBottom();
    });
  },
  created() {
    this.initStockData();
    this.is_showmore_stock = parseInt(this.$t('0##侧边栏股票首次是否展开', __FILE__)) || 0;
  },
  computed: {
    getData() {
      if (!this.is_showmore_stock) { //没有显示更多
        return this.dataList.slice(0, 3);
      }
      return this.dataList;
    },
  },
  methods: {
    initStockData() {
      var self = this
      var str_StockCode = $.trim(self.baseConfig.extcfg.stock_code);
      if (str_StockCode.length > 0) {
        if (!sinaStockTimer) {
          sinaStockTimer = setInterval(self.getStockData(str_StockCode), 5000);
        }
      }
    },
    changeBottom() {
      var stock_h = 34;
      var stock_len = this.dataList.length;
      var length = stock_h * stock_len + 'px';
      this.is_showmore_stock = !this.is_showmore_stock;

      if (stock_len <= 3) {
        return;
      }
      var _h = this.is_showmore_stock ? length : '102px';
      $(".stock-body").height(_h);
    },
  },
}