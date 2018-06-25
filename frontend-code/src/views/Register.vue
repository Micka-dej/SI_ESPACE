<template>
  <div class="register-page">
    <register-form @stepData="processStepData" :input-placeholder="actualStep.placeholder" :label-info="actualStep.title" :field-name="actualStep.fname"/>
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import RegisterForm from "@Component/Register/Form.vue";
import RegisterSteps from "@Component/Register/Steps.vue";
import DataStore from "../datastore/index.js";

import "@ViewStyle/Register.scss";

export default {
  name: "Register",
  components: {
    RegisterForm,
    RegisterSteps
  },
  data() {
    return {
      userDetails: {},
      actualStep: {},
      stepsData: {
        email: {
          placeholder: "Entrez votre e-mail",
          title: "Adresse e-mail",
          fname: "email",
          nextStep: "firstname"
        },
        firstname: {
          placeholder: "Entrez votre prénom",
          title: "Prénom",
          fname: "firstname",
          nextStep: "lastname"
        },
        lastname: {
          placeholder: "Entez votre nom de famille",
          title: "Nom",
          fname: "lastname",
          nextStep: ""
        }
      }
    };
  },
  created() {
    this.actualStep = this.stepsData.email;
    console.log(DataStore.userDetails);
  },
  methods: {
    redirectToRegister: function() {
      router.push("/register");
    },
    processStepData: function(object) {
      this.userDetails[object.type] = object.input;
      console.log(this.userDetails);
      this.actualStep = this.stepsData[this.actualStep.nextStep];
      DataStore.userDetails = this.userDetails;
    }
  }
};
</script>