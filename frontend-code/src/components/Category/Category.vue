<template>
  <column :xs="12" :sm="3" :md="3" lg="3" class="category-container">
    <router-link class="category-container__link" :to="item.url">
      <img class="category-container__image" :src="item.img" alt="">
      <h4 class="category-container__title">{{ item.title }}</h4>
    </router-link>
  </column>
</template>

<script>
import "@ComponentStyle/Category.scss";
export default {
    name: "Category",
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    created() {
        console.log(this.item);
    }
};
</script>
