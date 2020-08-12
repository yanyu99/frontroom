<template>
  <div class="sider-teacher" :style="{'height':$t('100##讲师团队的高度',__FILE__)+'px'}">
    <div class="st-title" :style="{'background-color':  $c('rgba(0,0,0,0.7)##讲师团队头部颜色值透明度',__FILE__)}">
      <span class="st-title-main">{{baseConfig.textcfg.ter_title}}</span>
      <span class="st-title-btn" :class="{'active':roomInfo.teachersList.length<=4}">换一换</span>
    </div>
    <div class="st-list" :style="{'background-color': $c('rgba(0,0,0,0.5)##讲师团队内容颜色值透明度',__FILE__) }">
      <div class="overflow">
        <ul>
          <li v-for="item in roomInfo.teachersList" :key="item.tid" class="st-item">
            <a href="#">
              <img :src="item.imgurl ?item.imgurl : '/assets/icon/ter_default.png'" />
              <p style="color:#fff;">{{item.name}}</p>
            </a>
            <div class="ts-info ">
              <h1>{{item.name}}</h1>
              <span class="nice-scroll-h" style="white-space: pre-wrap" v-html="item.introduction"></span>
              <div class="ts-zan">

                <p>今日点赞数：
                  <span class="data-today">{{item.today+item.today_base}}</span>
                  &nbsp;&nbsp;累计：
                  <span class="data-total">{{item.total+item.total_base}}</span>
                </p>
              </div>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .sider-teacher {
    position: relative;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    margin-top: 3px;
    display: flex;
    flex-direction: column;
  }

  .st-title-btn.active {
    color: #878282;
  }

  .st-title {
    height: 30px;
    line-height: 30px;
    font-size: 14px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    display: flex;
    justify-content: space-between;
  }

  .st-title-main {
    font-size: 15px;
    float: left;
    margin-left: 10px;
  }

  .st-title-btn {
    font-size: 12px;
    float: right;
    margin-right: 12px;
    cursor: pointer;
  }

  .st-list {
    padding: 5px 0;
    display: flex;
    flex: 1;
  }

  .st-list .overflow ul {
    margin-left: 0;
    height: 100%;
    white-space: nowrap;
  }

  .st-list .overflow ul>li {
    display: inline-block;
    width: 42px;
    height: 100%;
    margin-left: 8px;
    margin-right: 8px;
  }

  .st-item img {
    width: 42px;
    height: 42px;
    border-radius: 20px;
    border: 2px solid #fff;
  }

  .st-item p {
    margin-top: 3px;
    font-size: 12px;
  }

  .ts-info {
    width: 233px;
    height: 200px;
    position: absolute;
    z-index: 100;
    left: 0;
    bottom: 103px;
    background: url(/assets/img/page_ic/intrbg.jpg) center -25px no-repeat;
    background-size: cover;
    display: none;
    overflow: hidden;
  }

  .ts-info h1 {
    width: 100%;
    height: 22px;
    text-align: center;
    font-size: 20px;
    margin-top: 15px;
  }

  .ts-info>span {
    display: block;
    width: 90%;
    margin: 0 auto;
    height: 100px;
    font-size: 14px;
    overflow-y: hidden;
    outline: none;
    text-align: left;
  }

  .ts-info .ts-zan p {
    width: 100%;
    height: 35px;
    line-height: 30px;
    color: yellow;
    position: absolute;
    bottom: -10px;
    font-size: 14px;
  }

  .ts-info .ts-zan p span {
    font-size: 18px;
  }

  .overflow {
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
</style>
<script>
  import * as types from '@/store/types'
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
</script>