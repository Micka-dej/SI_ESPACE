<template>
  <div class="login-page">
    <helperBackground/>
    <div class="login-page-loader" v-if="isLoading"></div>
    <form class="form" v-on:submit.prevent="onSubmit">
      <input class="form__username-input" type="text" v-model="form.username" placeholder="Entrez votre nom d'utilisateur">
      <input class="form__password-input" type="password" v-model="form.password" placeholder="Entrez votre mot de passe">
      <button class="form__button" type="submit">Connexion</button>
    </form>
    <a class="link" v-on:click="redirectToRegister">Créer un compte utilisateur</a>
  </div>
</template>

<script>
import api from "../APIHelper.js";

import router from "../router/index.js";
import DataStore from "../datastore/index.js";
import HelperBackground from "@Component/Helper/Background.vue";


import "@ViewStyle/Login.scss";

export default {
  name: "Login",
  components: {
    HelperBackground
  },
  data() {
    return {
      form: {
        username: "",
        password: ""
      },
      isLoading: false
    };
  },
  methods: {
    redirectToRegister: function() {
      router.push("register");
    },
    onSubmit() {
      this.isLoading = true;
      api
        .post("/login", this.form)
        .then(response => {
          if (response.status === 401) {
            DataStore.isLoggedIn = false;
            alert("Bad credentials");
          } else if (response.status === 200) {
            DataStore.isLoggedIn = true;
          } else {
            console.error("error");
          }
          this.isLoading = false;
        })
        .catch(error => {
          console.error(error);
          this.isLoading = false;
        });
    }
  }
};
</script>