<template>
  <div class="userInfos-page">
    <h3>Mes informations</h3>
    <ul class="list-container">
      <li class="list-container__item">
        <p class="name-field"></p>
        <p class="user-data"></p>
      </li>
    </ul>
    <Footer />
  </div>
</template>

<script>
import router from "../router/index.js";

//import "@ViewStyle/UserInfos.scss";
import Footer from "@Component/Helper/Footer.vue";

export default {
  name: "UserInfos",
  components: {
    Footer
  },
  data() {
    return {
      userDatas: {
        credits: "0",
        email: "test@test.com",
        firstName: "TestFirstName",
        lastName: "TestName",
        phoneNumber: "+33660181095",
        planet: "TestPlanet",
        username: "Stell04"
      }
    };
  },
  beforeMount() {
    if (true !== this.$store.getters.isLoggedIn) {
      router.push("/login");
    }
  }
};
</script>

<style></style>