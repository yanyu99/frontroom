<template>
  <div class="ryPopGift-wrap">
    <transition-group name="slide-fade">
      <template v-for="item in roomInfo.recGift.displayList ">
        <div class="ryPopGift" :key=" item._key">
          <i class="icon-avatar" :style="{
          'background-image':'url(' + item.avatar + ') !important'
        }"></i>

          <div class="nickname">{{item.name}}</div>
          <div class="giftname">{{item.giftName}}</div>
          <i class="icon-gift" :style="{
          'background-image':'url(' + item.giftPath + ') !important'
        }"></i>
          <div class="giftNum active">x{{item.gift_num}}</div>
        </div>
      </template>
    </transition-group>
  </div>
</template>

<style scoped>
  .ryPopGift-wrap {
    position: absolute;
    top: 42%;
    left: 5%;
  }

  .slide-fade-enter-active {
    transition: all .3s ease;
  }

  .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }

  .slide-fade-enter,
  .slide-fade-leave-to
    {
    transform: translateX(10px);
    opacity: 0;
  }

  .ryPopGift {
    margin-top: 15px;
  }

  .ryPopGift {
    position: relative;
  }

  .ryPopGift {
    opacity: 0;
    font-size: 24px;
    padding: 2px 50px 2px 45px;
    background-color: rgba(82, 82, 82, 0.6);
    border-radius: 40px;
    left: -500px;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    -webkit-transition-property: opacity, left;
    transition-property: opacity, left;
    z-index: 998;
    padding: 0px 70px;
  }

  .ryPopGift:nth-child(1) {
    top: 0px
  }

  .ryPopGift:nth-child(2) {
    top: 20px
  }

  .ryPopGift:nth-child(3) {
    top: 40px
  }

  .ryPopGift:nth-child(4) {
    top: 60px
  }

  .ryPopGift:nth-child(5) {
    top: 80px
  }

  .ryPopGift {
    left: 30px;
    opacity: 1
  }

  .ryPopGift .icon-avatar {
    display: block;
    position: absolute;
    left: 0px;
    top: 0px;
    width: 60px;
    height: 60px;
    background-repeat: no-repeat;
    background-position: 0 0;
    background-size: 100% auto;
    border-radius: 50%;
    border: 1px solid #fff;
    box-sizing: border-box
  }

  /**/
  .ryPopGift .vip {
    position: absolute;
    top: 18px;
    left: 10px;
    transform: scale(0.7, 0.8);
    -ms-transform: scale(0.7, 0.8);
    /* IE 9 */
    -moz-transform: scale(0.7, 0.8);
    /* Firefox */
    -webkit-transform: scale(0.7, 0.8);
    /* Safari 鍜� Chrome */
    -o-transform: scale(0.7, 0.8);
    /* Opera */
  }

  .ryPopGift .nickname {
    height: 32px;
    font-size: 24px;
    line-height: 32px;
    vertical-align: middle;
    color: #f8b62c
  }

  .ryPopGift .giftname {
    height: 32px;
    font-size: 24px;
    line-height: 32px;
    vertical-align: middle;
    color: #f6f6f6
  }

  .ryPopGift .icon-gift {
    display: block;
    position: absolute;
    right: 0;
    bottom: 20px;
    right: -20px;
    width: 80px;
    height: 80px;
    background-repeat: no-repeat;
    background-position: 0 0;
    background-size: 100% auto;
    border-radius: 40px
  }

  .ryPopGift .giftNum {
    position: absolute;
    right: -30px;
    top: -10px;
    font-size: 20px;
    font-weight: bold;
    color: #f8b62c;
    /*text-shadow: 0 0 1px white*/
  }

  /* .ryPopGift .giftNum.active { */
  .ryPopGift .giftNum.active {
    -webkit-animation: giftNum 100ms ease-in-out 0s;
    animation: giftNum 100ms ease-in-out 0s
  }

  @-webkit-keyframes giftNum {
    0% {
      -webkit-transform: scale(4);
      transform: scale(4)
    }

    50% {
      -webkit-transform: scale(1);
      transform: scale(1)
    }

    100% {
      -webkit-transform: scale(1);
      transform: scale(1)
    }
  }

  @keyframes giftNum {
    0% {
      -webkit-transform: scale(4);
      transform: scale(4)
    }

    50% {
      -webkit-transform: scale(1);
      transform: scale(1)
    }

    100% {
      -webkit-transform: scale(1);
      transform: scale(1)
    }
  }
</style>


<script>
  export default {
  };
</script>