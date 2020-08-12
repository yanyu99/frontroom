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
    top: 18%;
    left: 5%;
  }

  .ryPopGift {
    margin: 15px 0px;
    position: relative;
    opacity: 0;
    font-size: 14px;
    padding: 0 50px 0 45px;
    background-color: rgba(82, 82, 82, 0.6);
    border-radius: 20px;
    left: -500px;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    -webkit-transition-property: opacity, left;
    transition-property: opacity, left;
    z-index: 998;
    left: 30px;
    opacity: 1
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

  .ryPopGift:nth-child(4) {
    top: 80px
  }

  .ryPopGift .icon-avatar {
    display: block;
    position: absolute;
    left: 0px;
    top: 0px;
    width: 40px;
    height: 40px;
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
    height: 20px;
    line-height: 20px;
    color: #fff;
  }

  .ryPopGift .giftname {
    height: 25px;
    line-height: 25px;
    color: #1daeff;
  }

  .ryPopGift .icon-gift {
    display: block;
    position: absolute;
    right: 0;
    bottom: 0;
    right: -5px;
    width: 50px;
    height: 50px;
    background-repeat: no-repeat;
    background-position: 0 0;
    background-size: 100% auto;
    border-radius: 20px
  }

  .ryPopGift .giftNum {
    position: absolute;
    right: -45px;
    top: -10px;
    font-size: 20px;
    color: #1fbcf8;
    text-shadow: 0 0 1px white
  }

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
  export default {};
</script>