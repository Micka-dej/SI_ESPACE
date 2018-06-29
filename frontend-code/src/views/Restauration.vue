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
          <h2 class="hotelPage-title">Restaurez-vous</h2> 
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

import Dish1 from "../img/restauration/plat1.jpg";
import Dish2 from "../img/restauration/plat2.jpg";
import Dish3 from "../img/restauration/plat3.jpg";
import Dish4 from "../img/restauration/plat4.jpg";
import imageBg from "../img/restauration/plat1.jpg";
import CarImg from "../img/Car/vehicule.jpg";
import HomeImg from "../img/Hotel/HomePicture.jpg";
import RestoreImg from "../img/Restoration/forumFull.jpg";
import ActiviteImg from "../img/Activities/maxresdefault.jpg";


import "@ComponentStyle/Category.scss";
import "@ViewStyle/Article.scss";

export default {
  name: "Restauration",
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
          img: Dish1,
          numberUser: "",
          title: "Après",
          description:
            "Un restaurant français aux saveurs d'antan à partager, un bar mixologie avec DJ, une terrasse verdoyante de 200m2, un bar à glace et des ateliers. Tout pour reprendre des forces, se reposer, s'échapper ou se trémousser sur des rythmes furieux. "
        },
        hotel2: {
          img: Dish2,
          numberUser: "",
          title: "Ice Kube Bar",
          description:
            "La vie a gelé dans 20 tonnes de glace. Par -20 ° C, enfilez des doudounes et des gants, et venez vivre une expérience unique. Le Ice Kube Bar vous fera déguster de délicieux cocktails préparés par nos mixologues dans une atmosphère complètement gelée."
        },
        hotel3: {
          img: Dish3,
          numberUser: "",
          title: "Inka",
          description:
            "Inka à l'hôtel 1K Paris est un petit restaurant d'inspiration péruvienne situé à l’Est d’Alpha, qui présente le meilleur des saveurs, des couleurs et des textures latino-américaines."
        },
        hotel4: {
          img: Dish4,
          numberUser: "",
          title: "Augustine",
          description:
            "Une brasserie de fruits de mer: un galion chic illuminé de lampes à suspension en nacre sous le voile de la galaxie, ambiance régate et cuisine méditerranéenne tout droit venue des océans sous-terrains de Venus."
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