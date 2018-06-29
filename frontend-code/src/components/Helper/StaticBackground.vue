<template>
  <div class="helper-static-background">
    <div ref="imageBg" class="background-image"></div>
    <div class="profile-picture">
      <img class="profile-picture__img" :src="profilePicture" alt="">
    </div>
    <div class="waves"></div>
  </div>
</template>

<script>
import router from "../../router/index.js";

import defaultImage from "../../img/futurist_city.png";
import profilePicture from "../../img/logo-bleu.png";

import "@ComponentStyle/HelperStaticBackground.scss";

export default {
  name: "StaticBackground",
  data() {
    return {
      profilePicture,
      imageBg: null
    }
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