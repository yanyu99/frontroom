export default {
  mounted() {
    var self = this
    var tipsTimer = null;
    $(".st-item").wait(function () {
      $('.st-item').mouseover(function () {
        var dom = $(this);
        $('.ts-info').each(function () {
          var obj = $(this);
          if (!contains(dom, obj) && obj.is(':visible')) {
            obj.hide();
            if (tipsTimer) {
              clearTimeout(tipsTimer);
              tipsTimer = null;
            }
          }
        });
        dom.find('.ts-info').css('display', 'block');
        $('.data-today').text(dom.data('today'));
        $('.data-total').text(dom.data('total'));
      });
      $('.st-item').mouseout(function () {
        var dom = $(this);
        var obj = dom.find('.ts-info');
        if (obj.is(':visible')) {
          tipsTimer = setTimeout(function () {
            obj.css('display', 'none');
          }, 500);
        }
      });
      $('.ts-info').mouseout(function () {
        var obj = $(this);
        obj.parent().find('.ts-info').css('display', 'none');
      });
      $('.ts-info').mouseover(function () {
        if (tipsTimer) {
          clearTimeout(tipsTimer);
          tipsTimer = null;
        }
      });
      //换一换
      var _click = true;
      $('.st-title-btn').click(function () {
        var linum = $('.overflow >ul').find('li').length;
        var ul_len = linum * 59;
        var m1 = parseInt($('.overflow ul').css('marginLeft'));
        var offset = parseInt(self.baseConfig.pgsizecfg.sider_w);

        if (!_click || linum <= 4) {
          return;
        }
        _click = false; //阻止连续点击
        if (m1 + ul_len <= offset) {
          $('.overflow ul').animate({ marginLeft: 0 + 'px' }, 5, function () {
            _click = true;
          });
        } else {
          var tmp = m1 + ul_len - offset;
          offset = tmp < offset ? tmp : offset;
          $('.overflow ul').animate({ marginLeft: m1 - offset + 'px' }, 400, function () {
            _click = true;
          });
        }
      });
    })
  },
}