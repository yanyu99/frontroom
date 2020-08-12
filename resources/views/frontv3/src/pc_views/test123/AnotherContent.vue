<template>
  <div class="another-content">
    <div>
      <h1>test123</h1>
      <AnotherContentH1>{{ $t('你的xxxx在其他的页面打开', __FILE__) }}</AnotherContentH1>
    </div>
  </div>
</template>
<style scoped>
  .another-content {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 99999;
    width: 100%;
    background: none repeat scroll 0% 0% rgba(3, 3, 3, 0.7);
    height: 100%;
  }

  .another-content div {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate3d(-50%, -50%, 0);
    text-align: center;
    font-size: 28px;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import styled from "vue-styled-components";

  const AnotherContentH1 = styled("h1")
  `
  color: ${props => $c("#ff1234", __FILE__)};
  font-weight: bold;
  font-size: ${props => $t("28", __FILE__) + "px"};
`;

  export default {
    data() {
      return {};
    },
    components: {
      AnotherContentH1
    }
  };
</script>