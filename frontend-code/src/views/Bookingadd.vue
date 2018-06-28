<template>
  <div class="booking-page">
    <helperBackground :imgSrc="img" />
    <booking-form @stepData="processStepData" :default-value="actualStep.defaultValue" :input-type="actualStep.ftype" :input-placeholder="actualStep.placeholder" :label-info="actualStep.title" :field-name="actualStep.fname" :select="actualStep.select" :options="actualStep.options" />
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
      selected: "A",
      actualStep: {},
      img: imageBg,
      stepsData: {
        new: {
          select: false,
          title: "ID du nouveau vaisseau ?",
          fname: "new",
          ftype: "text",
          defaultValue: "",
          nextStep: "energy",
          placeholder: "Entrez l'ID de votre vaisseau",
          options: []
        },
        energy: {
          select: true,
          options: [
            { text: "Iridium", value: "A" },
            { text: "Solaire", value: "B" },
            { text: "Plutonium", value: "C" }
          ],
          title: "Avec quelle énergie fonctionne votre vaisseau ? ",
          fname: "energy",
          ftype: "hidden",
          defaultValue: "",
          placeholder: "",
          nextStep: ""
        }
      }
    };
  },
  created() {
    this.actualStep = this.stepsData.new;
  },
  methods: {
    processStepData(object) {
      if ("" === this.actualStep.nextStep) {
        router.push("/booking");
      } else {
        this.actualStep = this.stepsData[this.actualStep.nextStep];
      }
    }
  }
};
</script>
