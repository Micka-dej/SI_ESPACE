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
  data() {
    return {
      errors: []
    };
  },
  methods: {
    redirectToConfirmation() {
      router.push("/confirmation");
    }
  },
  created() {
    this.errors = this.$store.getters.validationErrors;
  }
};
</script>

<style></style>