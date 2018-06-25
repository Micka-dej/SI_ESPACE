<template>
  <div class="register-form">
    <h3>{{ labelInfo }}</h3>
    <form v-on:submit.prevent="onSubmit">
      <input v-model="inputValue" type="text" :placeholder="inputPlaceholder" />
      <button type="submit">Suivant</button>
    </form>
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
    onSubmit() {
      this.$emit("stepData", { type: this.fieldName, input: this.inputValue });
      this.inputValue = "";
    }
  }
};
</script>