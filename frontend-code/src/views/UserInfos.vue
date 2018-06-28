<template>
  <div class="user-infos-page">
    <StaticBackground />
    <div class="header-container">
      <div v-on:click="redirectToDashboard" class="header-container__back-arrow">
        <svg class="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 31.494 31.494" style="enable-background:new 0 0 31.494 31.494;" xml:space="preserve">
          <path d="M10.273,5.009c0.444-0.444,1.143-0.444,1.587,0c0.429,0.429,0.429,1.143,0,1.571l-8.047,8.047h26.554  c0.619,0,1.127,0.492,1.127,1.111c0,0.619-0.508,1.127-1.127,1.127H3.813l8.047,8.032c0.429,0.444,0.429,1.159,0,1.587  c-0.444,0.444-1.143,0.444-1.587,0l-9.952-9.952c-0.429-0.429-0.429-1.143,0-1.571L10.273,5.009z" fill="#FFFFFF"/>
        </svg>
      </div>
      <h3 class="header-container__title">Mes informations</h3>
    </div>
    <ul class="list-container">
      <li class="list-container__item">
        <p class="name-field">Nom d'utilisateur :</p>
        <p class="user-data"> {{userDatas.username}}</p>
      </li>
      <li class="list-container__item">
        <p class="name-field">Nom :</p>
        <p class="user-data"> {{userDatas.lastName}}</p>
      </li>
      <li class="list-container__item">
        <p class="name-field">Prénom :</p>
        <p class="user-data"> {{userDatas.firstName}}</p>
      </li>
      <li class="list-container__item">
        <p class="name-field">Adresse email :</p>
        <p class="user-data"> {{userDatas.email}}</p>
      </li>
      <li class="list-container__item">
        <p class="name-field">Téléphone :</p>
        <p class="user-data"> {{userDatas.phoneNumber}}</p>
      </li>
      <li class="list-container__item">
        <p class="name-field">Planète :</p>
        <p class="user-data"> {{userDatas.planet}}</p>
      </li>
      <li class="list-container__item">
        <p class="name-field">Mes vaisseaux :</p>
        <p class="user-data" v-if="userDatas.spaceShips.length === 0"> Aucun vaisseau</p>
        <span v-else><p class="user-data" v-for="(spaceShip, index) in userDatas.spaceShips" :key="index"> {{spaceShip.matricule}} </p></span>
      </li>
      <li class="list-container__item">
        <p class="name-field">Mes crédits :</p>
        <p class="user-data"> {{userDatas.credits}}</p>
      </li>
    </ul>
    <button class="button">Éditer mes infos</button>
  </div>
</template>
<script>
import router from "../router/index.js";

import "@ViewStyle/UserInfos.scss";
import StaticBackground from "@Component/Helper/StaticBackground.vue";
import Footer from "@Component/Helper/Footer.vue";

export default {
  name: "UserInfos",
  components: {
    StaticBackground,
    Footer
  },
  methods: {
    redirectToDashboard() {
      router.push("/dashboard");
    }
  },
  computed: {
    userDatas() {
      return this.$store.getters.userDetails;
    }
  },
  beforeMount() {
    if (true !== this.$store.getters.isLoggedIn) {
      router.push("/login");
    }
  }
};
</script>