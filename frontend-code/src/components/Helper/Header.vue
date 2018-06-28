<template>
  <div class="Header-container">
    <router-link :to="{name: 'Home'}" class="logo">
      <img class="logo__image" :src="logoImage" alt="">
    </router-link>
    
    <router-link :to="{name:'Register'}" class="register">
      <h4 class="register__title">S'inscrire</h4>
    </router-link>
    <router-link :to="{name:'Login'}" class="login">
      <h4 class="login__title">Se connecter</h4>
    </router-link>
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