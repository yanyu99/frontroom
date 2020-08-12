<template>
  <div class="lm-gotsuc" id="PacketNone">
    <h1 class="h-tit">抱歉红包已经被抢完啦！</h1>
    <p class="p-sty">请坐等下次机会哦。</p>

     <div class="close-layer" @click="closeLayer" style="top:5px">
        ×
    </div>
  </div>

</template>
<style>
  .h-tit {
    line-height: 64px;
    font-size: 21px;
    font-weight: bold;
    text-align: center;
    color: #fff;
  }

  .p-sty {
    color: #fff;
    width: 267px;
    margin: auto;
    padding-top: 25px;
  }
</style>
<script>
  export default {
    mounted() {
      //根据id 修改当前块的样式
      var id = this.roomInfo.curlayer_pop_id //当前弹出层的id
      $("#" + id).find('.vl-notice-title').hide();
      $("#" + id).addClass("bgborder");
      $("#" + id).find('.vl-notify-content').addClass('padding-style');
      $("#" + id + " .vl-notify.vl-notify-main").addClass("bgborder");
    },
    methods: {
      closeLayer() {
        this.$layer.close(this.roomInfo.curlayer_pop_id);
      },
    }
  };
</script>