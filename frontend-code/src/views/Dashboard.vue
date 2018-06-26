<template>
  <div class="dashboard-page">
    Hello {{ userDatas.username }}
  </div>
</template>

<script>
import router from "../router/index.js";
import DataStore from "../datastore/index.js";

//import "@ViewStyle/Dashboard.scss";

export default {
  name: "Dashboard",
  components: {},
  data() {
    return {
      userDatas: {
        credits: "0",
        email: "test@test.com",
        firstName: "TestFirstName",
        lastName: "TestName",
        phoneNumber: "+33660181095",
        planet: "TestPlanet",
        username: "TestUserName"
      }
    };
  },
  methods: {},
  beforeMount() {
    if (true !== DataStore.isLoggedIn) {
      router.push('/login');
    }
  }
};
</script>

<style></style>