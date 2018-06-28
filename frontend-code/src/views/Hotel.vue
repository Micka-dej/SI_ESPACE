<template>
    <div class="hotelPage">
      <helperBackground/>
      <h2 class="hotelPage-title">Reposez vous</h2>
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
import image1 from "../img/Hotel/azur.jpg";
import image2 from "../img/Hotel/JANERA.jpg";
import image3 from "../img/Hotel/Ahbahcsur.jpg";
import image4 from "../img/Hotel/starlord.jpg";

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
          img: image1,
          numberUser: "Logement pour 1 à 4 personnes",
          title: "Hotel Azur",
          description:
            "Luxe et bien-être, voilà ce que vous retrouverez en allant au Azur. Cet Hôtel vous transportera dans un climat hors norme, à la saveur oriental qui ne manquera pas de vous rappeler la Terre."
        },
        hotel2: {
          img: image2,
          numberUser: "Logement pour 1 à 4 personnes",
          title: "Hotel Janera",
          description:
            "Notre station est en partenariat avec Dubaï. Dans un cadre paisible, souvent bercés par une vue panoramique de lespace, nos invités sont incités à se reposer, se détendre et à sémerveiller."
        },
        hotel3: {
          img: image3,
          numberUser: "Logement pour 1 à 4 personnes",
          title: "Hotel Azur",
          description:
            "Endormez-vous au son des vagues de locéan terrien dans ce charmant hôtel avec reproduction de bord de mer. Les chambres lumineuses et aérées disposent toute dun salon décloisonné et dun mur de fenêtres pour…"
        },
        hotel4: {
          img: image4,
          numberUser: "Logement pour 1 à 4 personnes",
          title: "Hotel Starlord",
          description:
            "Cet hôtel le plus éloigné de la station vous procura le plus grand des calmes. Des chambres spacieuses, un service royal. Venez découvrir le Starlord."
        }
      }
    };
  }
};
</script>

