<template>
  <div class="another-content">
    <div>
      <AnotherContentSpan >{{ $t('你的账号在其他的页面打开') }}</AnotherContentSpan>
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
    margin-top: 100px;
    text-align: center;
  }
</style>

<script>
  import Vuex from "vuex";
  import * as types from "@/store/types";
  import styled from "vue-styled-components";

  const AnotherContentSpan = styled("span")
  `
  color: ${props => $c('#ff0000')};
  font-weight: bold;
  font-size: ${props => px2rem($t('21')) + "rem"};
`;

  export default {
    components: {
      AnotherContentSpan
    }
  };
</script>
