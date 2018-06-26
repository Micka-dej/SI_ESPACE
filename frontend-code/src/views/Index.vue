<template>
  <div class="home-page">
    <helperBackground/>
    <button class="home-page__button" v-on:click="redirectToLogin">Réserver</button>
    <router-link class="home-page__link" to="/">Accéder au site</router-link>
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import HelperBackground from "@Component/Helper/Background.vue";

import "@ViewStyle/Index.scss";

export default {
  name: "Index",
  components: {
  HelperBackground
  },
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