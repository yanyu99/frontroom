<template>
  <div class="sider-top" :style="{'background-color': $c('rgba(0,0,0,0.5)##股票整体颜色值透明度',__FILE__)}">
    <div class="title stock-tit" :style="{'background-color': $c('rgba(0,0,0,0.8)##股票头部颜色值透明度',__FILE__) }">
      <img :src="$m('/assets/img/stockIco.png##侧边栏股票title图标', __FILE__)">
      <span style="margin-left: 5px;">行情动态</span>
    </div>

    <div class="body stock-body nice-scroll-h">
      <template v-if="!dataList.length ">
        <div class="guzhi-item" v-for="item in dataList.length" :key="item">
          <span class="name">加载中</span>
          <div style="float: right;">
            <span class="num"></span>
            <span class="per-num"></span>
          </div>
        </div>
      </template>
      <template v-else>
        <template v-for="(item,index) in getData">
          <div :key="index" class="guzhi-item" :style="{'background-color': $c('rgba(0,0,0,0.8)##股票内容颜色值透明度',__FILE__)}">
            <span class="name"> {{item.name ? item.name : '加载中'}}</span>
            <div style="float: right;">
              <span class="num" :class="{'green':item.change<0,'red':item.change >0,'gray':item.change == 0}">{{ !isNaN(item.price) ? item.price :' 00.0' }}</span>
                <span class="per-num" :class="{'green_Bg':item.change<0,'red_Bg':item.change >0,'gray_Bg':item.change == 0}">{{ !isNaN(item.per)?item.per + '%' : '0%'}}</span>
            </div>
          </div>
        </template>
      </template>

    </div>
    <div class="bottom " v-if="dataList.length>3" :style="{'background-color': $c('rgba(0,0,0,0.5)##股票尾部颜色值透明度',__FILE__)}" :class="{'bottom_down':bottomdownCla} " @click="changeBottom">
      <img src="assets/img/page_ic/arrow_down.png" alt="" :style="{'transform':!this.is_showmore_stock?'rotate(360deg)':'rotate(180deg)'}">
    </div>
  </div>


</template>
<style scoped>
  .sider-top {
    display: flex;
    flex-direction: column;
  }

  .stock-tit {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .stock-body {
    display: flex;
    /* flex: 1; */
    flex-direction: column;
  }

  .guzhi-item {
    justify-content: space-between;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from '@/store/types'

  var sinaStockTimer = null;

  export default {
    data() {
      return {
        dataList: [],
        bottomdownCla: true,
        is_showmore_stock: 0
      }
    },
    created() {
      if (this.baseConfig.extcfg.stock_code != "") {
        this.getStock();
        if (!sinaStockTimer) {
          sinaStockTimer = setInterval(this.getStock, 5000);
        }
      }
      this.is_showmore_stock = parseInt(this.$t('##侧边栏股票首次展开', __FILE__)) || 0;
    },
    computed: {
      getData() {
        console.log("getStockData", this.dataList.length);
        if (!this.is_showmore_stock) { //没有显示更多
          return this.dataList.slice(0, 3);
        }
        return this.dataList;
      },
    },
    methods: {
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

      getStock() {
        var self = this;
        var str_StockCode = this.baseConfig.extcfg.stock_code.trim();
        $.ajax({
          cache: true,
          url: "http://hq.sinajs.cn/list=" + str_StockCode,
          type: "GET",
          dataType: "script",
          success: function () {
            self.dataList = [];
            // 上证指数
            var hq_arr = str_StockCode;
            if (str_StockCode && str_StockCode.indexOf(',') != -1) {
              hq_arr = str_StockCode.split(',');
              for (var i in hq_arr) {
                if (hq_arr[i].trim().length > 0) {
                  var info = self.fixStockInfo(hq_arr[i].trim()) || [];
                  info && self.dataList.push(info);
                }
              }
            } else {
              var info = self.fixStockInfo(str_StockCode);
              info && self.dataList.push(info)
            }
          }
        });
      },


      fixStockInfo(stock_code) {
        if (!window['hq_str_' + stock_code]) {
          return;
        }
        var szzs = window['hq_str_' + stock_code].split(",");
        var zhishu = 'DINIW';
        var foreign_exchange = 'USDCNY,EURUSD,GBPUSD,AUDUSD,NZDUSD,USDJPY,USDCAD,USDCHF,USDHKD,EURGBP,EURAUD,EURCAD,EURJPY,EURCHF,EURNZD,EURCNY,GBPAUD,GBPCAD,GBPCHF,GBPCNY,GBPJPY,GBPNZD,AUDCNY,AUDCAD,AUDJPY,AUDNZD,AUDCHF,CADCHF,CADJPY,USDSGD,HKDCNY,HKDJPY';
        if (foreign_exchange.indexOf(stock_code) >= 0) {
          var change = parseFloat(szzs[1]) - parseFloat(szzs[5]);
          var price = parseFloat(szzs[1]);
          return {
            name: szzs[szzs.length - 2],
            price: price.toFixed(4),
            change: change.toFixed(4),
            per: (100 * change / parseFloat(szzs[5])).toFixed(4)
          };
        } else if (zhishu.indexOf(stock_code) >= 0) {
          var change = parseFloat(szzs[1]) - parseFloat(szzs[3]);
          var price = parseFloat(szzs[1]);
          return {
            name: szzs[szzs.length - 2],
            price: price.toFixed(4),
            change: change.toFixed(4),
            per: (100 * change / parseFloat(szzs[3])).toFixed(4)
          };
        } else if (stock_code.slice(0, 3) === 'hf_') {
          var per = parseFloat(szzs[1]);
          var price = parseFloat(szzs[0]);
          var change = price * per;
          return {
            name: szzs[szzs.length - 1],
            price: price.toFixed(2),
            change: change.toFixed(4),
            per: per.toFixed(2)
          };
        } else if (stock_code.slice(0, 3) === 'rt_') {
          var per = parseFloat(szzs[8]);
          var price = parseFloat(szzs[6]);
          var change = price * per;
          return {
            name: szzs[1],
            price: price.toFixed(2),
            change: change.toFixed(4),
            per: per.toFixed(2)
          };
        } else if (stock_code.slice(0, 3) === 'gb_') {
          var per = parseFloat(szzs[2]);
          var price = parseFloat(szzs[1]);
          var change = price * per;
          return {
            name: szzs[0],
            price: price.toFixed(2),

            change: change.toFixed(4),
            per: per.toFixed(2)
          };
        } else if (/^[A-Z]{2}[0-9]{1,4}$/.test(stock_code)) {
          // var hq_str_FU1901="燃油1901,145955,3183.00,3227.00,3131.00,3172.00,3140.00,3141.00,3141.00,3184.00,3177.00,5,110,163772,569584,沪,燃油,2018-08-10,1,3303.000,3116.000,3303.000,3034.000,3303.000,2849.000,3748.000,2849.000,56.238";
          // var hq_str_SC1809="〇原油1809, ①145955, ②521.00, ③526.50, ④510.70, ⑤519.10, ⑥512.90, ⑦513.10, ⑧512.90, ⑨520.50, ⑩519.80,2,2,11538,204814,沪,原油,2018-08-10,0,550.000,506.000,550.000,497.400,550.000,478.500,550.000,453.700,11.657";
          var price = parseFloat(szzs[6]);
          var per = (price - parseFloat(szzs[10])) / parseFloat(szzs[10]) * 100;
          var change = price * per;

          return {
            name: szzs[0],
            price: price.toFixed(2),
            change: change.toFixed(4),
            per: per.toFixed(2)
          };
        } else {
          var name = szzs[0]; // 股票 名称   http://hq.sinajs.cn/list=DINIW,hf_XAU,hf_CHA50CFD,s_sh000001
          var price = parseFloat(szzs[1]).toFixed(2);
          var change = parseFloat(szzs[2]).toFixed(2);
          var per = parseFloat(szzs[3]).toFixed(2);
          return {
            name: name,
            price: price,
            change: change,
            per: per
          };
        }
      }
    },
  }
</script>