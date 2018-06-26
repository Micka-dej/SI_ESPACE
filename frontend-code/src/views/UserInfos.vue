<template>
  <div class="userInfos-page">
    Hello
  </div>
</template>

<script>
import router from "../router/index.js";

//import "@ViewStyle/UserInfos.scss";

export default {
  name: "UserInfos",
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
        username: "Stell04"
      }
    };
  }
};
</script>

<style></style>