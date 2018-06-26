<template>
  <div class="register-page">
    <div class="register-background">
      <div class="register-background__image"></div>
      <div class="register-background__wave-container">
        <div class="register-background__wave-container--wave register-background__wave-container--wave-one"></div>
        <div class="register-background__wave-container--wave register-background__wave-container--wave-two"></div>
        <div class="register-background__wave-container--wave register-background__wave-container--wave-three"></div>
      </div>
    </div>
    <register-form @confirmAccount="redirectToConfirmation" @stepData="processStepData" :input-placeholder="actualStep.placeholder" :label-info="actualStep.title" :field-name="actualStep.fname" :next-step="actualStep.nextStep"/>
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
    redirectToConfirmation: function() {
      router.push("confirmation");
    },
    processStepData(object) {
      this.actualStep = this.stepsData[this.actualStep.nextStep];
      DataStore.userDetails[object.type] = object.input;
      window.localStorage.setItem("userData", JSON.stringify(DataStore));
    }
  }
};
</script>