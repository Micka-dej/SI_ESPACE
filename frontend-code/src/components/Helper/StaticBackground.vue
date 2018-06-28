<template>
  <div class="helper-static-background">
    <div class="background-image"></div>
    <div class="profile-picture">
      <img class="profile-picture__img" src="" alt="">
    </div>
    <div class="waves"></div>
  </div>
</template>

<script>
import router from "../../router/index.js";

import "@ComponentStyle/HelperStaticBackground.scss";

export default {
  name: "StaticBackground"
};
</script>