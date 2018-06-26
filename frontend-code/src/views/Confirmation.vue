<template>
  <div class="confirmation-page">
  </div>
</template>

<script>
import router from "../router/index.js";
import DataStore from "../datastore/index.js";

//import "@ViewStyle/Confirmation.scss";

export default {
  name: "Confirmation",
  components: {},
  methods: {
    redirectToConfirmation() {
      router.push("/confirmation");
    }
  }
};
</script>

<style></style>