<template>
  <div class="register-page">
    <register-background />
    <register-form @stepData="processStepData" :input-placeholder="actualStep.placeholder" :label-info="actualStep.title" :field-name="actualStep.fname"/>
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import RegisterBackground from "@Component/Register/Background.vue";
import RegisterForm from "@Component/Register/Form.vue";
import RegisterSteps from "@Component/Register/Steps.vue";
import DataStore from "../datastore/index.js";

import "@ViewStyle/Register.scss";

export default {
  name: "Register",
  components: {
    RegisterBackground,
    RegisterForm,
    RegisterSteps
  },
  data() {
    return {
      userDetails: {},
      actualStep: {},
      stepsData: {
        username: {
          placeholder: "Votre nom d'utilisateur",
          title: "Choissisez un nom d'utilisateur :",
          fname: "username",
          nextStep: "email"
        },
        email: {
          placeholder: "Entrez votre e-mail",
          title: "Veuillez entrer une adresse e-mail :",
          fname: "email",
          nextStep: "password"
        },
        password: {
          placeholder: "Votre mot de passe",
          title: "Veuillez choisir un mot de passe :",
          fname: "password",
          nextStep: "lastname"
        },
        lastname: {
          placeholder: "Entrez votre nom",
          title: "Veuillez renseigner votre nom :",
          fname: "lastname",
          nextStep: "firstname"
        },
        firstname: {
          placeholder: "Entrez votre prénom",
          title: "Veuillez renseigner votre prénom :",
          fname: "firstname",
          nextStep: "phoneNumber"
        },
        phoneNumber: {
          placeholder: "Entrez votre numéro",
          title: "Veuillez renseigner un numéro de téléphone :",
          fname: "phoneNumber",
          nextStep: "planet"
        },
          planet: {
          placeholder: "Entrez le nom de votre planète",
          title: "De quelle planète êtes-vous originaire ?",
          fname: "planet",
          nextStep: "credits"
        },
        credits: {
          placeholder: "Entrez le montant de vos crédits",
          title: "De combien souhaitez-vous créditer votre compte ?",
          fname: "credits",
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
    redirectToRegister() {
      router.push("/register");
    },
    processStepData(object) {
      this.actualStep = this.stepsData[this.actualStep.nextStep];
      DataStore.userDetails[object.type] = object.input;
      window.localStorage.setItem("userData", JSON.stringify(DataStore));
    }
  }
};
</script>