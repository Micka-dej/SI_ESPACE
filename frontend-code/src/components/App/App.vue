<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>

<script>
import DataStore from "../../datastore/index.js";
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
        JSON.stringify(DataStore.isLoggedIn)
      );
      window.localStorage.setItem(
        "userData",
        JSON.stringify(DataStore.userDetails)
      );
    }
  },
  created() {
    DataStore.userDetails =
      JSON.parse(window.localStorage.getItem("userData")) ||
      DataStore.userDetails;
    DataStore.isLoggedIn =
      JSON.parse(window.localStorage.getItem("userIsLoggedIn")) ||
      DataStore.isLoggedIn;

    if (DataStore.isLoggedIn) {
      api
        .get("/checklogin")
        .then(response => {
          if (200 === response.status) {
            DataStore.isLoggedIn = true;
          } else {
            DataStore.isLoggedIn = false;
            DataStore.userDetails = {};
          }
          this.updateLocalStorage();
        })
        .catch(error => {
          DataStore.isLoggedIn = false;
          DataStore.userDetails = {};
          this.updateLocalStorage();
        });
    }
  }
};
</script>