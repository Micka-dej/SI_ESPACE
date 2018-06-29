<template>
  <div class="booking-page">
    <helperBackground :imgSrc="img" />
    <booking-form @stepData="processStepData" :default-value="actualStep.defaultValue" :input-type="actualStep.ftype" :input-placeholder="actualStep.placeholder" :label-info="actualStep.title" :field-name="actualStep.fname" :select="actualStep.select" :options="actualStep.options" :selected="actualStep.selected" />
  </div>
</template>

<script>
import axios from "axios";

import router from "../router/index.js";
import BookingForm from "@Component/Booking/Form.vue";
import BookingSteps from "@Component/Booking/Steps.vue";
import HelperBackground from "@Component/Helper/Background.vue";

import api from "../APIHelper.js";

import imageBg from "../img/alpha.png";

export default {
  name: "Bookingadd",
  components: {
    HelperBackground,
    BookingForm,
    BookingSteps
  },
  data() {
    return {
      spaceshipDetails: {},
      actualStep: {},
      img: imageBg,
      stepsData: {
        new: {
          select: false,
          title: "ID du nouveau vaisseau ?",
          fname: "matricule",
          ftype: "text",
          defaultValue: "",
          nextStep: "fuelType",
          placeholder: "AA-123-BB",
          options: []
        },
        fuelType: {
          select: true,
          options: [
            { text: "Iridium", value: "Iridium" },
            { text: "Solaire", value: "Solaire" },
            { text: "Plutonium", value: "Plutonium" }
          ],
          title: "Avec quelle énergie fonctionne votre vaisseau ? ",
          fname: "fuelType",
          ftype: "hidden",
          defaultValue: "",
          placeholder: "",
          nextStep: "",
          selected: "Iridium"
        }
      }
    };
  },
  created() {
    this.actualStep = this.stepsData.new;
  },
  methods: {
    updateLocalStorage() {
      window.localStorage.setItem(
        "userIsLoggedIn",
        JSON.stringify(this.$store.getters.isLoggedIn)
      );
      window.localStorage.setItem(
        "userData",
        JSON.stringify(this.$store.getters.userDetails)
      );
    },
    handleRegistrationSubmit() {
      api
        .post("/spaceship", this.spaceshipDetails)
        .then(response => {
          router.push("/booking");
        })
        .catch(error => {
          // @TODO: handle errors instead of doing crap
          console.error(error.response.data);
          console.log(this.spaceshipDetails);
        });
    },
    processStepData(object) {
      this.spaceshipDetails[object.type] = object.input;
      if ("" === this.actualStep.nextStep) {
        this.handleRegistrationSubmit();
      } else {
        this.actualStep = this.stepsData[this.actualStep.nextStep];
      }
    }
  },
  beforeMount() {
    if (true !== this.$store.getters.isLoggedIn) {
      router.push("/login");
    }
  }
};
</script>
