<template>
    <div class="hotelPage">
      <helperBackground :imgSrc="img"/>
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
import vehicle1 from "../img/vehicle/honda-3r-c-0_1440x655c.jpg";
import vehicle2 from "../img/vehicle/MotorBike.jpg";
import vehicle3 from "../img/vehicle/vehicle3.jpg";
import vehicle4 from "../img/vehicle/vehicle.jpg";

import "@ViewStyle/Article.scss";

import imageBg from "../img/vehicle/vehicle.jpg";

export default {
  name: "Vehicle",
  components: {
    HelperBackground,
    // HelperCategory,
    HotelArticle
  },
  data() {
    return {
      img: imageBg,
      hotels: {
        hotel1: {
          img: vehicle1,
          numberUser: "",
          title: "Honda 3-RC",
          description:
            "Ce petit bijoux discret saura se faufiler dans toutes les ruelles de la station. Avec cet engin, vous ne serez jamais en retard ! "
        },
        hotel2: {
          img: vehicle2,
          numberUser: "",
          title: "Honda S-22",
          description:
            "Si vous êtes plutôt du genre aventurier, cette moto surpuissante est faite pour vous. Elle ne manquera pas de vous faire faire le tour de la station aussi vite que l’éclair. "
        },
        hotel3: {
          img: vehicle3,
          numberUser: "",
          title: "Roewe Mobiliant",
          description:
            "Un véhicule monoplace mixant sportivité et luxe. "
        },
        hotel4: {
          img: vehicle4,
          numberUser: "",
          title: "Augustine",
          description:
            "Pour vous et votre famille. Pour parcourir la station avec classe et discrétion. Ce modèle électrique vous emmènera partout. "
        }
      }
    };
  }
};
</script>