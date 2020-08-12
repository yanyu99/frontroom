<template>
  <div class="another-content">
    <div>
      <AnotherContentSpan >{{ $t('你的账号在其他的页面打开##帐号挤占提示', __FILE__) }}</AnotherContentSpan>
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

const AnotherContentSpan = styled("span")`
  color: ${props => $c("#ff1234##帐号挤占文字颜色", __FILE__)};
  font-weight: bold;
  font-size: ${props => $t("28##帐号挤占字体大小", __FILE__) + "px"};
`;

export default {
  components: {
    AnotherContentSpan
  }
};
</script>
