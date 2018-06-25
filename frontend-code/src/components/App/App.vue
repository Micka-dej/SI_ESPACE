<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>

<script>
import DataStore from "../../datastore/index.js";

export default {
  name: "App",
  data() {
    return {};
  },
  created() {
    DataStore.userDetails =
      JSON.parse(window.localStorage.getItem("userData")) ||
      DataStore.userDetails;

    console.log(DataStore);
  }
};
</script>