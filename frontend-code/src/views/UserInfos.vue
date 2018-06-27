<template>
  <div class="user-infos-page">
    <StaticBackground />
    <div class="header-container">
      <div class="header-container__back-arrow"></div>
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
import StaticBackground from "@Component/Helper/StaticBackground.vue"
import Footer from "@Component/Helper/Footer.vue";

export default {
  name: "UserInfos",
  components: {
    StaticBackground,
    Footer
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

<style></style>