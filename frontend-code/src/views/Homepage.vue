<template>
    <div class="home">
        <Header />
        <HelperBackground :imgSrc="bgImg"/>
        <div class="container">
          <h1 class="container__title">Bienvenue, sur Alpha. La station spaciale la plus unique de la galaxie. </h1>
        </div>
        <grid>
          <row start="xs">
            <column :xs="12">
            <h2 class="home__title">Explorer Alpha</h2> 
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
  }
};
</script>
