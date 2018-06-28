<template>
  <div class="booking-page">
    <helperBackground :imgSrc="img" />
    <h1 class="booking-form__title">Votre réservation a bien été prise en compte</h1>
    <button class="booking-form__button" type="submit">Réserver un service</button>
    <button class="booking-form__button" type="submit">Réserver une table</button>
    <button class="booking-form__button" type="submit">Réserver une activité</button>
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import HelperBackground from "@Component/Helper/Background.vue";

import api from "../APIHelper.js";

import imageBg from "../img/alpha.png";

export default {
  name: "Bookingconfirmation",
  components: {
    HelperBackground
  },
  data() {
    return {
      img: imageBg
    };
  }
};
</script>
