<template>
  <ul class="steps">
    <li v-for="step in steps" v-bind:key="step.fname" v-bind:class="[stepItemClass, (step.isDone) ? doneClass : '']"></li>
  </ul>
</template>

<script>
import "@ComponentStyle/RegisterSteps.scss";

export default {
  name: "RegisterSteps",
  props: {
    steps: {
      require: true,
      type: Object
    }
  },
  data() {
    return {
      stepItemClass: "steps__item",
      doneClass: "steps__is-done"
    }
  }
};
</script>
