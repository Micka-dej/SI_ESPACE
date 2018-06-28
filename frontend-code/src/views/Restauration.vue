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
import plat1 from "../img/restauration/plat1.jpg";
import plat2 from "../img/restauration/plat2.jpg";
import plat3 from "../img/restauration/plat3.jpg";
import plat4 from "../img/restauration/plat4.jpg";

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
          img: plat1,
          numberUser: "",
          title: "Après",
          description:
            "Un restaurant français aux saveurs d'antan à partager, un bar mixologie avec DJ, une terrasse verdoyante de 200m2, un bar à glace et des ateliers. Tout pour reprendre des forces, se reposer, s'échapper ou se trémousser sur des rythmes furieux. "
        },
        hotel2: {
          img: plat2,
          numberUser: "",
          title: "Ice Kube Bar",
          description:
            "La vie a gelé dans 20 tonnes de glace. Par -20 ° C, enfilez des doudounes et des gants, et venez vivre une expérience unique. Le Ice Kube Bar vous fera déguster de délicieux cocktails préparés par nos mixologues dans une atmosphère complètement gelée."
        },
        hotel3: {
          img: plat3,
          numberUser: "",
          title: "Inka",
          description:
            "Inka à l'hôtel 1K Paris est un petit restaurant d'inspiration péruvienne situé à l’Est d’Alpha, qui présente le meilleur des saveurs, des couleurs et des textures latino-américaines."
        },
        hotel4: {
          img: plat4,
          numberUser: "",
          title: "Augustine",
          description:
            "Une brasserie de fruits de mer: un galion chic illuminé de lampes à suspension en nacre sous le voile de la galaxie, ambiance régate et cuisine méditerranéenne tout droit venue des océans sous-terrains de Venus."
        }
      }
    };
  }
};
</script>