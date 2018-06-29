<template>
  <div class="helper-background">
    <div ref="imageBg" class="helper-background__image"></div>
    <div class="helper-background__wave-container">
      <div class="helper-background__wave-container--wave helper-background__wave-container--wave-one"></div>
      <div class="helper-background__wave-container--wave helper-background__wave-container--wave-two"></div>
      <div class="helper-background__wave-container--wave helper-background__wave-container--wave-three"></div>
    </div>
  </div>
</template>

<script>
import router from "../../router/index.js";

import defaultImage from "../../img/boutique.jpg";

import "@ComponentStyle/HelperBackground.scss";

export default {
  name: "Background",
  data() {
    return {
      imageBg: null
    };
  },
  props: {
    imgSrc: {
      type: String,
      default: defaultImage
    }
  },
  mounted() {
    this.$refs.imageBg.style.backgroundImage = "url(" + this.imgSrc + ")";
  }
};
</script>