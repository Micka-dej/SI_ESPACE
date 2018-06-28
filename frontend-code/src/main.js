import Vue from "vue";
import Vuex from "vuex";
import VueCookie from "vue-cookie";

import router from "./router";
import App from "./components/App/App.vue";
import VuexStoreConfig from "./store";

Vue.config.productionTip = false;

Vue.use(Vuex);
Vue.use(VueCookie);

const store = new Vuex.Store(VuexStoreConfig);

new Vue({
  render: h => h(App),
  router,
  store
}).$mount("#app");
