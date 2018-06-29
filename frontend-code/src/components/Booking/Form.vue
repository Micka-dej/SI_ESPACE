<template>
  <div class="booking-form">
    <h3 class="booking-form__title">{{ labelInfo }}</h3>
    <form class="booking-form__form" v-on:submit.prevent="onSubmit">
      <select class="booking-form__select" v-if="select" v-model="selectedData">
        <option v-for="(option, index) in options" :key="index" :value="option.value">
          {{ option.text }}
        </option>
      </select>
      <input class="booking-form__input" v-model="inputValue" :type="inputType" :placeholder="inputPlaceholder" min="1" max="15" v-else />
      <button class="booking-form__button" type="submit">Suivant</button>
    </form>
  </div>
</template>

<script>
import "@ComponentStyle/BookingForm.scss";

export default {
  name: "BookingForm",
  data() {
    return {
      selectedData: this.selected,
      inputValue: this.defaultValue
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
    },
    select: {
      required: true,
      type: Boolean
    },
    options: {
      required: false,
      type: Array
    },
    selected: {
      required: false,
      type: String,
      default: "A"
    }
  },
  methods: {
    onSubmit() {
      if (this.select) {
        this.$emit("stepData", {
          type: this.fieldName,
          input: this.selectedData
        });
      } else {
        this.$emit("stepData", {
          type: this.fieldName,
          input: this.inputValue
        });
      }
      this.inputValue = this.defaultValue;
    }
  },
  watch: {
    defaultValue() {
      this.inputValue = this.defaultValue;
    },
    selected() {
      this.selectedData = this.selected;
    }
  }
};
</script>
