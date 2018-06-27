<template>
  <div class="confirmation-page">
    <helper-modal :errors="errors"/>
  </div>
</template>

<script>
import router from "../router/index.js";

import HelperModal from "@Component/Helper/Modal.vue";

//import "@ViewStyle/Confirmation.scss";

export default {
  name: "Confirmation",
  components: {
    HelperModal
  },
  computed: {
    errors() {
      return this.$store.getters.validationErrors;
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