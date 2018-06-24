<template>
  <div class="register-form">
    <h3>{{ labelInfo }}</h3>
    <input v-model="inputValue" type="text" :placeholder="inputPlaceholder" />
    <button v-on:click="nextStep">Suivant</button>
  </div>
</template>

<script>
import "@ComponentStyle/RegisterForm.scss";

export default {
  name: "RegisterForm",
  data() {
    return {
      inputValue: ""
    };
  },
  props: {
    labelInfo: {
      required: true,
      type: String
    },
    inputPlaceholder: {
      required: true,
      type: String
    },
    fieldName: {
      required: true,
      type: String
    }
  },
  methods: {
    nextStep: function() {
      this.$emit("stepData", { type: this.fieldName, input: this.inputValue });
      this.inputValue = "";
    }
  }
};
</script>