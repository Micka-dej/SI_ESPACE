import Vue from "vue";
import Router from "vue-router";

import Index from "@View/Index.vue";
import Login from "@View/Login.vue";
import Register from "@View/Register.vue";
import Confirmation from "@View/Confirmation.vue";
import Dashboard from "@View/Dashboard.vue";
import UserInfos from "@View/UserInfos.vue";

import Homepage from "@View/Homepage.vue";
import Booking from "../views/Booking.vue";
import BookingConfirmation from "../views/Bookingconfirmation.vue";
import BookingAdd from "../views/Bookingadd.vue";
import Hotel from "../views/Hotel.vue";
import Activity from "../views/Activity.vue";
import Restauration from "../views/Restauration.vue";
import Vehicle from "../views/Vehicle.vue";

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
      path: "/hotel",
      name: "Hotel",
      component: Hotel,
      meta: {
        title: "Hotel"
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
    },
    {
      path: "/homepage",
      name: "Homepage",
      component: Homepage,
      meta: {
        title: "Page d'accueil"
      }
    },
    {
      path: "/activity",
      name: "Activity",
      component: Activity,
      meta: {
        title: "Activités"
      }
    },
    {
      path: "/restauration",
      name: "Restauration",
      component: Restauration,
      meta: {
        title: "Restauration"
      }
    },
    {
      path: "/booking",
      name: "Booking",
      component: Booking,
      meta: {
        title: "Réservation"
      }
    },
    {
      path: "/bookingconfirmation",
      name: "BookingConfirmation",
      component: BookingConfirmation,
      meta: {
        title: "Confirmation réservation"
      }
    },
    {
      path: "/vehicle",
      name: "Vehicle",
      component: Vehicle,
      meta: {
        title: "Vehicules"
      }
    },
    {
      path: "/bookingadd",
      name: "BookingAdd",
      component: BookingAdd,
      meta: {
        title: "Ajout d'un vaisseau"
      }
    }
  ]
});

router.beforeEach((to, from, next) => {
  document.title = to.meta.title + " - Alpha";
  next();
});

export default router;
