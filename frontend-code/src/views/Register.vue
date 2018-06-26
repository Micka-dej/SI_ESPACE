<template>
  <div class="register-page">
    <register-form @stepData="processStepData" :input-type="actualStep.ftype" :input-placeholder="actualStep.placeholder" :label-info="actualStep.title" :field-name="actualStep.fname"/>
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
      actualStep: {},
      stepsData: {
        email: {
          placeholder: "Entrez votre e-mail",
          title: "Adresse e-mail",
          fname: "email",
          ftype: "email",
          nextStep: "firstname"
        },
        firstname: {
          placeholder: "Entrez votre prénom",
          title: "Prénom",
          fname: "firstname",
          ftype: "text",
          nextStep: "lastname"
        },
        lastname: {
          placeholder: "Entez votre nom de famille",
          title: "Nom",
          fname: "lastname",
          ftype: "text",
          nextStep: ""
        }
      }
    };
  },
  created() {
    this.actualStep = this.stepsData.email;
  },
  methods: {
    redirectToRegister() {
      router.push("/register");
    },
    processStepData(object) {
      if ("" === this.actualStep.nextStep) {
        router.push("/");
      } else {
        this.actualStep = this.stepsData[this.actualStep.nextStep];
      }
      DataStore.userDetails[object.type] = object.input;
      window.localStorage.setItem(
        "userData",
        JSON.stringify(DataStore.userDetails)
      );
    }
  }
};
</script>