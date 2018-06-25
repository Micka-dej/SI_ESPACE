<template>
  <div class="login-page">
    <input type="text" placeholder="Entrez votre nom d'utilisateur">
    <input type="text" placeholder="Entrez votre mot de passe">
    <button disabled="disabled">Se connecter</button>
    <a v-on:click="redirectToRegister">Créer un compte utilisateur</a>
  </div>
</template>

<script>
import router from "../router/index.js";
import DataStore from "../datastore/index.js";

import "@ViewStyle/Login.scss";

export default {
  name: "Login",
  components: {},
  data() {
    return {
      title: "Index page !",
      articles: null
    };
  },
  methods: {
    redirectToRegister: function() {
      router.push("register");
    }
  },
  created() {
    console.log(DataStore.userDetails);
  }
};
</script>

<style></style>