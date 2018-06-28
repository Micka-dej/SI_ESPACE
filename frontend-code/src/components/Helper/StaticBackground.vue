<template>
  <div class="helper-static-background">
    <div class="background-image"></div>
    <div class="profile-picture">
      <img class="profile-picture__img" :src="profilePicture" alt="">
    </div>
    <div class="waves"></div>
  </div>
</template>

<script>
import router from "../../router/index.js";

import profilePicture from "../../img/logo-bleu.png";

import "@ComponentStyle/HelperStaticBackground.scss";

export default {
  name: "StaticBackground",
  data() {
    return {
      profilePicture
    };
  }
};
</script>