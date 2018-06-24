import Vue from "vue";
import router from "./router";
import App from "./components/App/App.vue";

Vue.config.productionTip = false;

router.beforeEach((to, from, next) => {
  document.title = to.meta.title + " - Alpha";
  next();
});

new Vue({
  render: h => h(App),
  router
}).$mount("#app");
