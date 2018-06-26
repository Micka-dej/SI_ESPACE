<template>
  <div class="register-page">
    <helperBackground/>
    <register-form @stepData="processStepData" :default-value="actualStep.defaultValue" :input-type="actualStep.ftype" :input-placeholder="actualStep.placeholder" :label-info="actualStep.title" :field-name="actualStep.fname"/>
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import RegisterForm from "@Component/Register/Form.vue";
import RegisterSteps from "@Component/Register/Steps.vue";
import HelperBackground from "@Component/Helper/Background.vue";
import DataStore from "../datastore/index.js";

import "@ViewStyle/Register.scss";
import api from "../APIHelper.js";

export default {
  name: "Register",
  components: {
    HelperBackground,
    RegisterForm,
    RegisterSteps
  },
  data() {
    return {
      actualStep: {},
      stepsData: {
        username: {
          placeholder: "Votre nom d'utilisateur",
          title: "Choisissez un nom d'utilisateur :",
          fname: "username",
          ftype: "text",
          defaultValue: "",
          nextStep: "email"
        },
        email: {
          placeholder: "Entrez votre e-mail",
          title: "Veuillez entrer une adresse e-mail :",
          fname: "email",
          ftype: "email",
          defaultValue: "",
          nextStep: "plainPassword"
        },
        plainPassword: {
          placeholder: "Votre mot de passe",
          title: "Veuillez choisir un mot de passe :",
          fname: "plainPassword",
          ftype: "password",
          defaultValue: "",
          nextStep: "lastName"
        },
        lastName: {
          placeholder: "Entrez votre nom",
          title: "Veuillez renseigner votre nom :",
          fname: "lastName",
          ftype: "text",
          defaultValue: "",
          nextStep: "firstName"
        },
        firstName: {
          placeholder: "Entrez votre prénom",
          title: "Veuillez renseigner votre prénom :",
          fname: "firstName",
          ftype: "text",
          defaultValue: "",
          nextStep: "phoneNumber"
        },
        phoneNumber: {
          placeholder: "Entrez votre numéro",
          title: "Veuillez renseigner un numéro de téléphone :",
          fname: "phoneNumber",
          ftype: "text",
          defaultValue: "",
          nextStep: "planet"
        },
        planet: {
          placeholder: "Entrez le nom de votre planète",
          title: "De quelle planète êtes-vous originaire ?",
          fname: "planet",
          ftype: "text",
          defaultValue: "",
          nextStep: "credits"
        },
        credits: {
          placeholder: "Entrez le montant de vos crédits",
          title: "De combien souhaitez-vous créditer votre compte ?",
          fname: "credits",
          ftype: "number",
          defaultValue: "0",
          nextStep: ""
        }
      }
    };
  },
  created() {
    this.stepsData.username.defaultValue =
      DataStore.registrationDetails.username ||
      this.stepsData.username.defaultValue;
    this.actualStep = this.stepsData.username;
    DataStore.validationErrors = [];
  },
  methods: {
    handleRegistrationSubmit() {
      console.log(DataStore.registrationDetails);
      api
        .post("/user", DataStore.registrationDetails)
        .then(response => {
          console.log("ok");
        })
        .catch(error => {
          DataStore.validationErrors = Object.values(
            error.response.data["additional-informations"][
              "fields-validation-violations"
            ]
          );
          this.redirectToConfirmation();
        });
    },
    redirectToConfirmation: function() {
      router.push("confirmation");
    },
    processStepData(object) {
      if ("" === this.actualStep.nextStep) {
        this.handleRegistrationSubmit();
      } else {
        this.stepsData[this.actualStep.nextStep].defaultValue =
          DataStore.registrationDetails[this.actualStep.nextStep] ||
          this.stepsData[this.actualStep.nextStep].defaultValue;
        this.actualStep = this.stepsData[this.actualStep.nextStep];
      }

      DataStore.registrationDetails[object.type] = object.input;
      console.log(DataStore.registrationDetails);
    }
  }
};
</script>