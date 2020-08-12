<template>
  <div class=" theme-dropdown-menu" id="ThemeMenu" :style="getLeft()">

    <h4>
      <span class="text">个性化</span>
    </h4>
    <div class="block theme">
      <div>布局</div>
      <div class="layout-wrap clearfix">
        <div class="theme-layout-sider clearfix">
          <div class="text-muted">固定菜单位置</div>
          <div class="theme-layout theme-layout-sider-left " a="" :class="{'active':!baseConfig.theme.layoutsider || baseConfig.theme.layoutsider == 'layout-sider-left'}" @click.stop="ChangePos(1)"></div>
          <div class="theme-layout theme-layout-sider-right" :class="{'active':baseConfig.theme.layoutsider == 'layout-sider-right'}" @click.stop="ChangePos(2)"></div>
        </div>
        <div class="theme-layout-video clearfix">
          <div class="text-muted">视频位置</div>
          <div class="theme-layout theme-layout-video-left " :class="{'active': !baseConfig.theme.layout || baseConfig.theme.layout == 'layout-video-left'}" @click.stop="ChangePos(3)"></div>
          <div class="theme-layout theme-layout-video-right" :class="{'active':baseConfig.theme.layout == 'layout-video-right'}" @click.stop="ChangePos(4)"></div>
        </div>
      </div>
      <div>背景图</div>
      <div class="background-wrap clearfix">
        <template v-for="(item,index) in baseConfig.roombgs">
          <a class="theme-bg theme-background " :key="index" :style="{backgroundImage:'url('+item.imgurl+')'}" :class="{'active': item.imgurl == baseConfig.theme.backgroundImg}" @click.stop="ChangeBg(item,index)"></a>
        </template>
      </div>
    </div>
  </div>
</template>
<style scoped>
  #ThemeMenu {
    width: 300px;
    height: 450px;
    position: absolute;
    right: 2px;
    background-color: #fff;
    top: 53px;
    border-radius: 3px;
    z-index: 999;
  }

  #ThemeMenu h4 {
    font-size: 18px;
    border-bottom: 2px solid #ddd;
    line-height: 24px;
    margin: 15px;
    color: #2973ca;
  }

  #ThemeMenu .block {
    margin: 0 15px 15px;
    text-align: left;
  }

  #ThemeMenu h4 span {
    border-bottom: 2px solid #2973ca;
    font-weight: bold;
  }

  #ThemeMenu .block {
    margin: 0 15px 15px;
  }

  #ThemeMenu .text {
    padding: 1px 5px;
  }
</style>
<script>
  import * as types from "@/store/types";
  export default {
    props: ['propPos'],
    methods: {
      getLeft() {
        if (this.propPos != 'headtheme') {
          if (this.baseConfig.blockcfg.show_siderlogin && this.baseConfig.theme.layoutsider != 'layout-sider-right') { //登录模块开启 ，并侧边栏居左
            return {
              left: '0px ',
            }
          } else {
            return {
              left: '',
            }
          }
        }
      },
      ChangeBg(item, index) {
        dms.LiveApi.setTheme({
          backgroundImg: item.imgurl
        }, resp => {
          this.$store.state.baseConfig.theme.backgroundImg = item.imgurl;
          console.log("成功返回", resp);
        }, resp => {
          console.log("成功失败", resp);
        })

      },
      ChangePos(pos, url) {
        var options = {}
        switch (pos) {
        case 1:
          options.layoutsider = "layout-sider-left"
          break;
        case 2:
          options.layoutsider = "layout-sider-right"
          break;
        case 3:
          options.layout = "layout-video-left";
          break;
        case 4:
          options.layout = "layout-video-right";
          break;
        default:
          break;
        }
        dms.LiveApi.setTheme(options, resp => {
          this.$store.commit(types.UPDATE_BASECONFIG_INFO, {
            theme: {
              ...options
            },
          })
          console.log("成功返回", resp);
        }, resp => {

        })

      }


    }
  }
</script>