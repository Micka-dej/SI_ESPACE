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
import api from "../APIHelper.js";

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
        username: {
          placeholder: "Votre nom d'utilisateur",
          title: "Choissisez un nom d'utilisateur :",
          fname: "username",
          ftype: "text",
          nextStep: "email"
        },
        email: {
          placeholder: "Entrez votre e-mail",
          title: "Veuillez entrer une adresse e-mail :",
          fname: "email",
          ftype: "email",
          nextStep: "plainPassword"
        },
        plainPassword: {
          placeholder: "Votre mot de passe",
          title: "Veuillez choisir un mot de passe :",
          fname: "plainPassword",
          ftype: "password",
          nextStep: "lastName"
        },
        lastName: {
          placeholder: "Entrez votre nom",
          title: "Veuillez renseigner votre nom :",
          fname: "lastName",
          ftype: "text",
          nextStep: "firstName"
        },
        firstName: {
          placeholder: "Entrez votre prénom",
          title: "Veuillez renseigner votre prénom :",
          fname: "firstName",
          ftype: "text",
          nextStep: "phoneNumber"
        },
        phoneNumber: {
          placeholder: "Entrez votre numéro",
          title: "Veuillez renseigner un numéro de téléphone :",
          fname: "phoneNumber",
          ftype: "text",
          nextStep: "planet"
        },
        planet: {
          placeholder: "Entrez le nom de votre planète",
          title: "De quelle planète êtes-vous originaire ?",
          fname: "planet",
          ftype: "text",
          nextStep: "credits"
        },
        credits: {
          placeholder: "Entrez le montant de vos crédits",
          title: "De combien souhaitez-vous créditer votre compte ?",
          fname: "credits",
          ftype: "number",
          nextStep: ""
        }
      }
    };
  },
  created() {
    this.actualStep = this.stepsData.username;
  },
  methods: {
    handleRegistrationSubmit() {
      api
        .post("/user", DataStore.userDetails)
        .then(response => {
          if (201 !== response.status) {
            console.debug(response.data);
          } else {
            console.error(response.data);
          }
        })
        .catch(error => {
          console.error(error);
        });
      //router.push("/confirmation");
    },
    processStepData(object) {
      if ("" === this.actualStep.nextStep) {
        this.handleRegistrationSubmit();
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