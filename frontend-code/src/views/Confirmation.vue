<template>
  <div class="confirmation-page">
    <helper-modal :errors="errors"/>
  </div>
</template>

<script>
import router from "../router/index.js";
import DataStore from "../datastore/index.js";

import HelperModal from "@Component/Helper/Modal.vue";

//import "@ViewStyle/Confirmation.scss";

export default {
  name: "Confirmation",
  components: {
    HelperModal
  },
  data() {
    return {
      errors: ["Vous devez renseigner un nom de famille", "Vous devez renseigner un email"]
    }
  },
  methods: {
    redirectToConfirmation() {
      router.push("/confirmation");
    }
  }
};
</script>

<style></style>