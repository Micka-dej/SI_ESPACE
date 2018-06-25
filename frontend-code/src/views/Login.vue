<template>
  <div class="login-page">
    <div class="loginprogress" v-if="isLoading"></div>
    <form v-on:submit.prevent="onSubmit">
      <input type="text" v-model="form.username" placeholder="Entrez votre nom d'utilisateur">
      <input type="text" v-model="form.password" placeholder="Entrez votre mot de passe">

      <button type="submit">Se connecter</button>
    </form>
    <a v-on:click="redirectToRegister">Créer un compte utilisateur</a>
  </div>
</template>

<script>
import api from "../APIHelper.js";

import router from "../router/index.js";
import DataStore from "../datastore/index.js";

import "@ViewStyle/Login.scss";

export default {
  name: "Login",
  components: {},
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
            this.isLoading = false;
            alert("Bad credentials");
          } else if (response.status === 200) {
            DataStore.isLoggedIn = true;
          } else {
            console.error("error");
          }
        })
        .catch(error => {
          console.error(error);
          this.isLoading = false;
        });
    }
  },
  created() {
    console.log(DataStore.userDetails);
  }
};
</script>