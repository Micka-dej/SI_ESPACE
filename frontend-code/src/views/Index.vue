<template>
  <div class="home-page">
    <div class="home-page__background">
      <p class="home-page__background__presentation-text"></p>
    </div>
    <button class="home-page__button" v-on:click="redirectToLogin">Réserver</button>
    <router-link to="/">Accéder au site</router-link>
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";

import "@ViewStyle/Index.scss";

export default {
  name: "Index",
  components: {},
  data() {
    return {
      title: "Index page !"
    };
  },
  methods: {
    redirectToLogin: function() {
      router.push("login");
    }
  }
};
</script>