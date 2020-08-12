export default {
  methods: {
    getStockData(str_StockCode) {
      var self = this;
      var foreign_exchange = 'btc,eos,eth,ht,bch,xrp,etc,iost,ltc,elf';
      var hq_arr = str_StockCode.split(",");

      var p1 = new Promise(function (resolve, reject) {
        $.ajax({
          cache: true,
          url: "http://hq.sinajs.cn/list=" + str_StockCode,
          type: "GET",
          dataType: "script",
          success: function () {
            var _tmpData = []
            for (var i in hq_arr) {
              var _name = hq_arr[i];
              if (_name.trim().length > 0) {
                if (foreign_exchange.indexOf(_name) >= 0) {
                  continue;
                }
                var info = self.fixStockInfo(_name.trim()) || [];
                if ('长信美国标普100等权指数(QDII)' == info.name) {
                  info.name = '美国标普';
                }
                info && _tmpData.push(info);
              }
            }
            resolve(_tmpData);
          },
          error: function () {
            reject
          }
        });
      });

      var p2 = new Promise(function (resolve, reject) {
        $.ajax({
          url: "/api/ApiHub/fetchJinse",
          type: "GET",
          success: function (resp) {
            var _tmpData = [];
            var stockData = resp.data || [];
            if (!stockData || stockData.length == 0) {
              return;
            }
            for (var i in hq_arr) {
              var name = hq_arr[i];
              if (foreign_exchange.indexOf(name) >= 0) {
                var infoArr = stockData.filter((n) => {
                  return n.currency_code == name
                });
                if (infoArr.length > 0) {
                  var tmp = infoArr[0];
                  var info = {
                    name: tmp.currency_code.toUpperCase(),
                    price: parseFloat(tmp.last).toFixed(2),
                    change: parseFloat(tmp.last * tmp.degree).toFixed(6),
                    per: parseFloat(tmp.degree).toFixed(2)
                  };
                  info && _tmpData.push(info)
                }
              }
            }
            resolve(_tmpData)
          },
          error: function () {
            reject
          }
        });
      });
      // 同时执行p1和p2，并在它们都完成后执行then:
      Promise.all([p1, p2]).then(function (results) {
        var _tmpData = results || []
        self.dataList = _tmpData[0].concat(_tmpData[1]);
      }).catch(resp => {
        console.warn("异常")
      })
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
    },
  },
}