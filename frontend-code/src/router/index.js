import Vue from "vue";
import Router from "vue-router";

import Index from "@View/Index.vue";
import Login from "@View/Login.vue";
import Register from "@View/Register.vue";
import Confirmation from "@View/Confirmation.vue";
import Dashboard from "@View/Dashboard.vue";
import UserInfos from "@View/UserInfos.vue";

Vue.use(Router);

const router = new Router({
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
    },
    {
      path: "/confirmation",
      name: "Confirmation",
      component: Confirmation,
      meta: {
        title: "Confirmation de compte"
      }
    },
    {
      path: "/dashboard",
      name: "Dashboard",
      component: Dashboard,
      meta: {
        title: "Profil"
      }
    },
    {
      path: "/userInfos",
      name: "UserInfos",
      component: UserInfos,
      meta: {
        title: "Informations du compte"
      }
    }
  ]
});

router.beforeEach((to, from, next) => {
  document.title = to.meta.title + " - Alpha";
  next();
});

export default router;
