<template>
  <div class="login-page">
    <form v-on:submit.prevent="onSubmit">
      <input type="text" v-model="form.username" placeholder="Entrez votre nom d'utilisateur">
      <input type="text" v-model="form.password" placeholder="Entrez votre mot de passe">

      <button type="submit">Se connecter</button>
    </form>
    <a v-on:click="redirectToRegister">Créer un compte utilisateur</a>
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import DataStore from "../datastore/index.js";

import "@ViewStyle/Login.scss";
import Axios from "axios";

export default {
  name: "Login",
  components: {},
  data() {
    return {
      form: {
        username: "",
        password: ""
      }
    };
  },
  methods: {
    redirectToRegister: function() {
      router.push("register");
    },
    onSubmit() {
      axios
        .post("http://localhost:12000/api/login", this.form)
        .then(response => {
          console.log(response.data);
          console.log(response.status);
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
  created() {
    console.log(DataStore.userDetails);
  }
};
</script>