<template>
  <div class="footer">
    <div class="top-line"></div>
    <div class="content-container">
      <div class="links-container">
        <div class="img-container">
          <img class="img-container__logo" :src="logoBleu" alt="alpha logo">
        </div>
        <div class="links">
          <a class="links__item">Plan du site</a><span class="links__span">|</span><a class="links__item">Mentions légales</a>
        </div>
      </div>
      <p class="rights">Aplha © Tous droits réservés.</p>
      <div class="icon-container">
        <img class="icon-container__myspace" :src="mySpace" alt="">
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

import router from "../../router/index.js";

import logo from "../../img/logo-bleu.png";
import mySpace from "../../img/myspace.png";

import "@ComponentStyle/Footer.scss";

export default {
  name: "Footer",
  data() {
    return {
      logoBleu: logo,
      mySpace: mySpace
    };
  },
};
</script>