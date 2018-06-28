<template>
  <div class="login-page">
    <helperBackground/>
    <div class="login-page-loader" v-if="isLoading">
      <div class="logo-container">
        <img class="logo-container__img-logo" src="../img/logo.png" alt="alpha logo">
      </div>
    </div>
    <form class="form" v-on:submit.prevent="onSubmit">
      <input class="form__username-input" type="text" v-model="form.username" placeholder="Entrez votre nom d'utilisateur">
      <input class="form__password-input" type="password" v-model="form.password" placeholder="Entrez votre mot de passe">
      <button class="form__button" type="submit">Connexion</button>
    </form>
    <a class="link" v-on:click="redirectToRegister">Créer un compte utilisateur</a>
    <Footer/>
  </div>
</template>

<script>
import api from "../APIHelper.js";

import router from "../router/index.js";
import HelperBackground from "@Component/Helper/Background.vue";
import Footer from "@Component/Helper/Footer.vue";

import image from "../img/logo.png";

import "@ViewStyle/Login.scss";

export default {
  name: "Login",
  components: {
    HelperBackground,
    Footer
  },
  data() {
    return {
      form: {
        username: "",
        password: ""
      },
      logoImage: image,
      isLoading: false
    };
  },
  methods: {
    redirectToRegister: function() {
      router.push("register");
    },
    updateLocalStorage() {
      window.localStorage.setItem(
        "userIsLoggedIn",
        JSON.stringify(this.$store.getters.isLoggedIn)
      );
      window.localStorage.setItem(
        "userData",
        JSON.stringify(this.$store.getters.userDetails)
      );
    },
    onSubmit() {
      this.isLoading = true;

      api
        .post("/login", this.form)
        .then(response => {
          if (response.status === 200) {
            this.$store.commit("setIsLoggedIn", true);
            this.$store.commit("setUserDetails", response.data.results.user);
          } else {
            this.$store.commit("setUserDetails", {});
            this.$store.commit("setIsLoggedIn", false);
          }
          this.isLoading = false;
          this.updateLocalStorage();
        })
        .catch(error => {
          console.error(error);
          this.isLoading = false;
          this.$store.commit("setIsLoggedIn", false);
          this.$store.commit("setUserDetails", {});
          this.updateLocalStorage();
        });
    }
  }
};
</script>