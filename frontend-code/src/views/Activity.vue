<template>
    <div class="hotelPage">
      <helperBackground/>
      <!-- <helperCategorie/> -->
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
// import HelperCategorie from "@Component/Helper/Category.vue";
import HotelArticle from "@Component/Hotel/Articles.vue";
import nightclub from "../img/Activite/nightclub.jpg";
import surf from "../img/Activite/Surf.jpg";
import ski from "../img/Activite/Ski.jpg";
import Maxdefault from "../img/Activite/Maxdefault.jpg";

import "@ViewStyle/Hotelpage.scss";

export default {
  name: "Hotel",
  components: {
    HelperBackground,
    // HelperCategory,
    HotelArticle
  },
  data() {
    return {
      hotels: {
        hotel1: {
          img: nightclub,
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
          img: Maxdefault,
          numberUser: "Activité de 1 à 4 personnes",
          title: "JetSky",
          description:
            "vous fera rêver. Décollez dans les nuages et profitez d’une vue imprenable sur toute la station et l’espace."
        }
      }
    };
  }
};
</script>