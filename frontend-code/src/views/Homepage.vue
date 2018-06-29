<template>
    <div class="home">
        <Header />
        <HelperBackground :imgSrc="bgImg"/>
        <h1 class="home__description">Venez vivre l'expérience Alpha, la station spaciale qui révolutionne les voyages intergalactiques.</h1>
        <button class="home__button" v-on:click="redirectToLogin">Réserver</button>
        <grid>
          <row start="xs">
            <column :xs="12">
            <div class="home__title-container">
              <h2 class="title">Explorer Alpha</h2> 
              <div class="line-decoration"></div>
            </div>
            </column>
            <Category v-for="service in services" :item="service" v-bind:key="service.title" />
          </row>
        </grid>
    </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import HelperBackground from "@Component/Helper/Background.vue";
import Category from "@Component/Helper/Category.vue";
import Header from "@Component/Helper/Header.vue";
import "@ComponentStyle/Category.scss";
import CarImg from "../img/Car/vehicule.jpg";
import HomeImg from "../img/Hotel/HomePicture.jpg";
import RestoreImg from "../img/Restoration/forumFull.jpg";
import ActiviteImg from "../img/Activities/maxresdefault.jpg";
import "@ViewStyle/Homepage.scss";



export default {
  name: "Homepage",
  components: {
    HelperBackground,
    Category,
    Header
  },
  data() {
    return {
      title: "Home page !",
      bgImg: HomeImg,
      services: [
        {
          url: "/vehicle",
          title: "Se véhiculer",
          img: CarImg
        },
        {
          url: "/hotel",
          title: "Se reposer",
          img: HomeImg
        },
        {
          url: "/restauration",
          title: "Se restaurer",
          img: RestoreImg
        },
        {
          url: "/activity",
          title: "Se divertir",
          img: ActiviteImg
        }
      ]
    };
  },
  methods: {
    redirectToLogin() {
      router.push("/login");
    }
  }
};
</script>
