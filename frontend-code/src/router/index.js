import Vue from "vue";
import Router from "vue-router";

import Index from "../views/Index.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: "/",
      name: "Home",
      component: Index,
      meta: {
        title: "Accueil"
      }
    },
    {
      path: "/login",
      name: "Login",
      component: Login,
      meta: {
        title: "Connexion"
      }
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
      meta: {
        title: "Création de compte"
      }
    }
  ]
});
