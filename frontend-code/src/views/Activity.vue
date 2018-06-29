<template>
    <div class="hotelPage">
      <Header/>
      <helperBackground :imgSrc="img"/>
      <grid>
        <row start="xs">
          <column :xs="12">
          <h2 class="hotelPage-title">Explorer Alpha</h2> 
          </column>
          <Category v-for="service in services" :item="service" v-bind:key="service.title" />
          <column :xs="12">
          <h2 class="hotelPage-title">Amusez-vous</h2> 
          </column>
        </row>
      </grid>
    <div class="hotelPage-container">
        <HotelArticle v-for="(hotel, index) in hotels" v-bind:hotel="hotel" :key="index"/>
    </div>
    <div class="hotelPage-contain">
    <button class="hotelPage-contain__button">Voir plus</button>
    </div>
  </div>
</template>


<script>
import api from "../APIHelper.js";
import router from "../router/index.js";

import HelperBackground from "@Component/Helper/Background.vue";
import HotelArticle from "@Component/Hotel/Articles.vue";
import Category from "@Component/Helper/Category.vue";
import Header from "@Component/Helper/Header.vue";

import nightClub from "../img/Activite/nightclub.jpg";
import surf from "../img/Activite/Surf.jpg";
import ski from "../img/Activite/Ski.jpg";
import MaxDefault from "../img/Activite/Maxdefault.jpg";
import imageBg from "../img/Activite/Surf.jpg";
import CarImg from "../img/Car/vehicule.jpg";
import HomeImg from "../img/Hotel/HomePicture.jpg";
import RestoreImg from "../img/Restoration/forumFull.jpg";
import ActiviteImg from "../img/Activities/maxresdefault.jpg";

import "@ComponentStyle/Category.scss";
import "@ViewStyle/Article.scss";

export default {
  name: "Activity",
  components: {
    HelperBackground,
    HotelArticle,
    Category,
    Header
  },
  data() {
    return {
      img: imageBg,
      hotels: {
        hotel1: {
          img: nightClub,
          numberUser: "Activité pour 1 à 4 personnes",
          title: "Legacy",
          description:
            "Envie de passer du bon temps ? La boîte de nuit Legacy ouvre ses portes à partir de 23h. Avec pour DJ les légendaires Daft Punk qui vous feront vibrer toute la nuit"
        },
        hotel2: {
          img: surf,
          numberUser: "Activité de 1 à 2 personnes",
          title: "Sky Surf",
          description:
            "Nous nous sommes associés à la World Surf League, la ligue mondiale de surf, pour des expériences destinées aux amoureux de l'océan. Profitez de la nouvelle expérience et surfez avec nous sur la voie lactée. "
        },
        hotel3: {
          img: ski,
          numberUser: "Activité de 1 à 15 personnes",
          title: "Snow Park",
          description:
            "Notre station dispose également d’un Snow Park d’un espace de 2000m². Une station de ski unique qui vous offrira toutes les sensations dignes du Mont Blanc. "
        },
        hotel4: {
          img: MaxDefault,
          numberUser: "Activité de 1 à 4 personnes",
          title: "JetSky",
          description:
            "vous fera rêver. Décollez dans les nuages et profitez d’une vue imprenable sur toute la station et l’espace."
        }
      },

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