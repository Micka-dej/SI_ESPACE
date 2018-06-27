<template>
  <div class="dashboard-page">
    <div class="background-image"></div>
    <div class="profile-picture">
      <img class="profile-picture__img" src="" alt="">
    </div>
    <div class="waves"></div>
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
    <button class="button">Déconnexion</button>
  </div>
</template>

<script>
import router from "../router/index.js";

import "@ViewStyle/Dashboard.scss";

export default {
  name: "Dashboard",
  components: {},
  computed: {
    userDatas() {
      return this.$store.getters.userDetails;
    }
  },
  methods: {
    redirectToUserInfos: function() {
      router.push("/userInfos");
    }
  },
  beforeMount() {
    if (true !== this.$store.getters.isLoggedIn) {
      router.push("/login");
    }
  }
};
</script>

<style></style>