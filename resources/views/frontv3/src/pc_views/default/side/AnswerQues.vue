<template>
  <div class="questionbox">
    <ul id="js-hot-dialog" style="font-family: 微软雅黑">
      <template v-for="(item,index) in roomInfo.hotRank.questionList">
        <li :key="item.id">
          <div class="li-tit">
            <p>问题：{{item.ask}}</p>
          </div>
          <div class="li-ques">
            <label for="rad_1 switch">
              <input type="radio" class="rad-input" :name="'rad-input'+item.id" :value="1" v-model="pickedArr[index]">{{item.answer1}}</label>
            <label for="rad_2">
              <input type="radio" class="rad-input" :name="'rad-input'+item.id" :value="2" v-model="pickedArr[index]">{{item.answer2}}</label>
            <label for="rad_3">
              <input type="radio" class="rad-input" :name="'rad-input'+item.id" :value="3" v-model="pickedArr[index]">{{item.answer3}}</label>
          </div>
        </li>
      </template>
    </ul>
    <div class="li-option">
      <span @click="questionOk()">确定</span>
      <span @click="quesCancel">取消</span>
    </div>
  </div>

</template>
<style scoped>
  .questionbox {
    width: 500px;
    height: auto;
    max-height: 580px;
    background-color: #fff;
    overflow-x: hidden;
  }

  .questionbox ul li {
    vertical-align: middle;
    border-bottom: 1px solid #bbb;
  }

  .li-tit {
    margin-top: 20px;
  }

  .li-tit p {
    color: #333;
    font-size: 15px;
    font-weight: 700;
    text-align: left;
    line-height: 26px;
    vertical-align: middle;
  }

  .li-ques {
    padding: 0px 15px 10px;
    color: black;
  }

  .questionbox ul li label {
    line-height: 30px;
    vertical-align: middle;
    font-size: 14px;
    word-break: break-all;
    margin-right: 10px;
    font-weight: normal;
  }

  .rad-input {
    -webkit-appearance: radio;
    vertical-align: middle;
    margin-right: 2px;
    margin-top: 0px;
  }

  .li-option {
    height: 60px;
    padding: 10px 15px;
    text-align: center;
    color: #ffffff;
  }

  .li-option span {
    display: inline-block;
    width: 80px;
    height: 40px;
    line-height: 40px;
    vertical-align: middle;
    text-align: center;
    background-color: #0099cc;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    margin-right: 30px;
  }

  .switch {
    display: flex;
    align-items: center;
    width: auto;
    float: left;
  }
</style>
<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import hotanswerMixin from "@/mixins/hotanswerMixin"
  export default {
    mixins: [hotanswerMixin],
  };
</script>