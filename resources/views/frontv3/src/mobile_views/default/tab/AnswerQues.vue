<template>
  <!-- 回答问题投票 -->
  <div class="questionbox">
    <ul id="js-hot-dialog" style="font-family: 微软雅黑">
      <template v-for="(item,index) in roomInfo.hotRank.questionList">
        <li :key="item.id">
          <div class="li-tit">问题：{{item.ask}}</div>
          <div class="li-ques">
            <label for="rad_1 switch">
              <input type="radio" id="rad_1" class="rad-input" :name="'rad'+item.id" value="1" v-model="pickedArr[index]">{{item.answer1}}
            </label>
            <label for="rad_2">
              <input type="radio" id="rad_2" class="rad-input" :name="'rad'+item.id" value="2" v-model="pickedArr[index]">{{item.answer2}}
            </label>
            <label for="rad_3">
              <input type="radio" id="rad_3" class="rad-input" :name="'rad'+item.id" value="3" v-model="pickedArr[index]">{{item.answer3}}
            </label>
          </div>
        </li>
      </template>
    </ul>
    <div class="li-option">
      <span @click="questionOk">确定</span>
      <span @click="quesCancel">取消</span>
    </div>
  </div>

</template>
<style scoped>
  .questionbox {
    width: 700px;
    height: auto;
    max-height: 500px;
    background-color: #fff;
    overflow-y: scroll;
    overflow-x: hidden;
    scroll-behavior: contain;
  }

  .questionbox ul {}

  .questionbox ul li {
    vertical-align: middle;
    padding: 20px 15px;
    border-bottom: 2px solid #f3f3f3;
  }

  .li-tit {
    color: #fe9901;
    font-size: 26px;
    font-weight: 700;
    text-align: left;
    line-height: 44px;
    vertical-align: middle;
  }

  .li-ques {
    margin-top: 20px;
    padding: 10px 15px;
    color: black;
  }

  .questionbox ul li label {
    height: 60px;
    vertical-align: middle;
    font-size: 28px;
    word-break: break-all;
    margin-right: 10px;
  }

  .rad-input {
    -webkit-appearance: radio;
    vertical-align: middle;
    margin-right: 2px;
  }

  .li-option {
    height: 60px;
    padding: 10px 15px;
    text-align: center;
    color: #ffffff;
  }

  .li-option span {
    display: inline-block;
    width: 120px;
    height: 60px;
    line-height: 60px;
    vertical-align: middle;
    text-align: center;
    background-color: #0099cc;
    font-size: 28px;
    margin-right: 20px;
    border-radius: 8px;
  }

  .switch {
    display: flex;
    align-items: center;
    width: auto;
    float: left;
  }
</style>
<script>
  import * as types from "@/store/types";
  import hotanswerMixin from "@/mixins/hotanswerMixin"
  export default {
    mixins: [hotanswerMixin]
  };
</script>