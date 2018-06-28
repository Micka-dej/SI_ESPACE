<template>
  <div class="dashboard-page">
    <staticBackground />
    <p class="username"> {{ userDatas.username }} </p>
    <ul class="list-container">
      <li class="list-container__item" v-on:click="redirectToUserInfos" >
        <div class="icon"></div>
        <p class="icon-title">Mes informations</p>
      </li>
      <li class="list-container__item">
        <div class="icon"></div>
        <p class="icon-title">Mes réservations</p>
      </li>
      <li class="list-container__item">
        <div class="icon"></div>
        <p class="icon-title">Mes factures</p>
      </li>
    </ul>
    <button v-on:click="logout" class="button">Déconnexion</button>
  </div>
</template>

<script>
import router from "../router/index.js";

import "@ViewStyle/Dashboard.scss";

import StaticBackground from "@Component/Helper/StaticBackground.vue";
import api from "../APIHelper.js";

export default {
  name: "Dashboard",
  components: {
    StaticBackground
  },
  computed: {
    userDatas() {
      return this.$store.getters.userDetails;
    }
  },
  methods: {
    redirectToUserInfos() {
      router.push("/userInfos");
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
    logout() {
      this.$store.commit("setIsLoggedIn", false);
      this.$store.commit("setUserDetails", {});
      this.updateLocalStorage();
      this.$cookie.delete("PHPSESSID");
      router.push("/");
    }
  },
  beforeMount() {
    if (true !== this.$store.getters.isLoggedIn) {
      router.push("/login");
    }
  }
};
</script>