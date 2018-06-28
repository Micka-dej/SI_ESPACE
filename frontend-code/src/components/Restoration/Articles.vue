<template>
<div class="hotel-article">
<column :xs="12" :lg="12">
    <div class="hotel-article-container">
      <column :sm="4"  :md="4" :lg="4">
      <img class="hotel-article-container__image" :src="hotel.img" alt="PictureOfHotel">
      </column>
        <column :lg="6" class="hotel-article-container__items">
            <h3 class="hotel-article-container__items-title-hotel">{{ hotel.title }}</h3><br>
            <h2 class="hotel-article-container__items-number-user">{{ hotel.numberUser }}</h2><br>
            <p class="hotel-article-container__items-description">{{ hotel.description }}</p>
          </column>
            <column :lg="3" class="hotel-article-reservation">
            <div class="hotel-article-reservation__container">
            <h3 class="hotel-article-reservation__container-button" v-on:click="redirectToReservation"><span class="hotelArticle-reservation__container-text">Réserver</span></h3>
              </div>
            </column>
        </div>
      </column>
    </div>
</template>

<script>
import router from "../../router/index.js";

import "@ComponentStyle/HotelArticle.scss";

export default {
  name: "HotelArticle",
  props: {
      hotel: {
        type: Object,
        required: true
      }
  },
  methods: {
    redirectToReservation() {
      router.push("/register");
    }
  }
};
</script>
