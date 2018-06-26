<template>
  <div class="helper-background">
    <div class="helper-background__image"></div>
    <div class="helper-background__wave-container">
      <div class="helper-background__wave-container--wave helper-background__wave-container--wave-one"></div>
      <div class="helper-background__wave-container--wave helper-background__wave-container--wave-two"></div>
      <div class="helper-background__wave-container--wave helper-background__wave-container--wave-three"></div>
    </div>
  </div>
</template>

<script>
import router from "../../router/index.js";

import "@ComponentStyle/HelperBackground.scss";

export default {
  name: "Background"
};
</script>