<template>
  <div class="dashboard-page">
    <div class="background-image"></div>
    <div class="profile-picture">
      <img class="profile-picture__img" src="" alt="">
    </div>
    <div class="waves"></div>
    <p class="username"> {{userDatas.username}} </p>
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
import DataStore from "../datastore/index.js";

import "@ViewStyle/Dashboard.scss";

export default {
  name: "Dashboard",
  components: {},
  data() {
    return {
      userDatas: {
        credits: "0",
        email: "test@test.com",
        firstName: "TestFirstName",
        lastName: "TestName",
        phoneNumber: "+33660181095",
        planet: "TestPlanet",
        username: "Stell04"
      }
    };
  },
  methods: {
    redirectToUserInfos: function () {
    router.push('/userInfos');
    }
  },
  beforeMount() {
    if (true !== DataStore.isLoggedIn) {
      router.push('/login');
    }
  }
};
</script>

<style></style>