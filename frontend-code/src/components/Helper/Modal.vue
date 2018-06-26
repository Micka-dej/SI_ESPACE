<template>
  <div class="modal">
    <div class="modal__overlay"></div>
    <div class="list-container">
      <ul class="list">
        <li class="list__item" v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
      <div class="btn-container">
        <button class="btn-container__button" v-on:click="redirectToRegister">Retour à l'inscription</button>
      </div>
    </div>
  </div>
</template>

<script>
import router from "../../router/index.js";

import "@ComponentStyle/HelperModal.scss";

export default {
  name: "Modal",
  props: {
    errors: {
      required: true,
      type: Array
    }
  },
  methods: {
    redirectToRegister: function() {
      router.push("register");
    }
  }
};
</script>
