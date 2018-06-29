<template>
  <div class="header">
    <div class="header__container">
      <router-link :to="{name: 'Home'}" class="logo">
        <img class="logo__image" :src="logoImage" alt="">
      </router-link>
      <router-link :to="{name:'Dashboard'}" class="personal-space">
        <p class="personal-space__link">Mon espace</p>
      </router-link>
    </div>
  </div>
</template>

<script>
import router from "../../router/index.js";
import "@ComponentStyle/Header.scss";

import image from "../../img/logo.png";

export default {
    name: "Header",
    data() {
      return {
        logoImage: image
      }
    },
    created() {
        console.log(this.item);
    }
};
</script>