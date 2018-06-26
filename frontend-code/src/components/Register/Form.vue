<template>
  <div class="register-form">
    <h3 class="register-form__title">{{ labelInfo }}</h3>
    <form class="register-form__form" v-on:submit.prevent="onSubmit">
      <input class="register-form__input" v-model="inputValue" :type="inputType" :placeholder="inputPlaceholder" />
      <button class="register-form__button" type="submit">Suivant</button>
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
    },
    inputType: {
      required: true,
      type: String
    },
    defaultValue: {
      required: true,
      type: String
    }
  },
  methods: {
    onSubmit() {
      this.$emit("stepData", { type: this.fieldName, input: this.defaultValue });
    }
  }
};
</script>