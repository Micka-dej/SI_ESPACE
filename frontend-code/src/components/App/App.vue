<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>

<script>
import api from "../../APIHelper.js";

export default {
  name: "App",
  data() {
    return {};
  },
  methods: {
    updateLocalStorage() {
      window.localStorage.setItem(
        "userIsLoggedIn",
        JSON.stringify(this.$store.getters.isLoggedIn)
      );
      window.localStorage.setItem(
        "userData",
        JSON.stringify(this.$store.getters.userDetails)
      );
    }
  },
  created() {
    this.$store.commit(
      "setUserDetails",
      JSON.parse(window.localStorage.getItem("userData")) ||
        this.$store.getters.userDetails
    );
    this.$store.commit(
      "setIsLoggedIn",
      JSON.parse(window.localStorage.getItem("userIsLoggedIn")) ||
        this.$store.getters.isLoggedIn
    );

    if (this.$store.getters.isLoggedIn) {
      api
        .get("/checklogin")
        .then(response => {
          if (200 === response.status) {
            this.$store.commit("setIsLoggedIn", true);
          } else {
            this.$store.commit("setIsLoggedIn", false);
            this.$store.commit("setUserDetails", {});
          }
          this.updateLocalStorage();
        })
        .catch(error => {
          this.$store.commit("setIsLoggedIn", false);
          this.$store.commit("setUserDetails", {});
          this.updateLocalStorage();
        });
    } else {
      this.$store.commit("setIsLoggedIn", false);
      this.$store.commit("setUserDetails", {});
      this.updateLocalStorage();
    }
  }
};
</script>