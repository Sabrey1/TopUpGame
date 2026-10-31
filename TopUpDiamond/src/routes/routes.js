import { createRouter, createWebHistory } from "vue-router"

// pages
import Home from "@/Home/Home.vue"
import CardDetail from '@/Home/components/CardDetail.vue'

import CourselList from '@/Admin/CourselList/CourselList.vue'
import sidebar from '@/Admin/Layouts/sidebar.vue'
import GameList from '@/Admin/Game/GameList.vue'
import OrderList from '@/Admin/Order/OrderList.vue'
import PaymentList from '@/Admin/Payment/PaymentList.vue'
import PaymentTypeList from '@/Admin/PaymentType/PaymentTypeList.vue'
import TopUpPackageList from '@/Admin/TopUpPackage/TopUpPackageList.vue'
import UserList from '@/Admin/User/UserList.vue'
import Login from '@/Auth/Login.vue'
import Register from '@/Auth/Register.vue'
import CurrencyList from '@/Admin/Currency/CurrencyList.vue'
import Dashboard from '@/Admin/Dashboard/Dashboard.vue'
import UnitList from '@/Admin/Unit/UnitList.vue'
import Setting from '@/Admin/Setting/Setting.vue'

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
  },
  {
    path: "/game/:id",
    name: "CardDetail",
    component: CardDetail,
  },
  {
    path:"/admin",
    component:sidebar,
    meta:{requiresAuth:true},
    children: [
      //admin
      {
        path: "",
        redirect: "/admin/dashboard",
      }
      ,{
        path: "settings",
        name: "Setting",
        component: Setting,
      }
      ,{
        path: "coursellist",
        name: "CourselList",
        component: CourselList,
        meta: { title: 'Coursel List' }
      }
      ,{
        path: "game-list",
        name: "GameList",
        component: GameList,
        meta: { title: 'Game List' }
      }
      ,{
        path: "payment-list",
        name: "PaymentList",
        component: PaymentList,
        meta: { title: 'Payment List' }
      }
      ,{
        path: "order-list",
        name: "OrderList",
        component: OrderList,
        meta: { title: 'Order List' }
      }
      ,{
        path: "payment-type-list",
        name: "PaymentTypeList",
        component: PaymentTypeList,
        meta: { title: 'Payment Type List' }
      }
      ,{
        path: "top-up-package-list",
        name: "TopUpPackageList",
        component: TopUpPackageList,
        meta: { title: 'Top Up Package List' }
      }
      ,{
        path: "user-list",
        name: "UserList",
        component: UserList,
        meta: { title: 'User List' }
      }
      ,{
        path: "currency-list",
        name: "CurrencyList",
        component: CurrencyList,
        meta: { title: 'Currency List' }
      }
      ,{
        path: "dashboard",
        name: "Dashboard",
        component: Dashboard,
        meta: { title: 'Dashboard' }
      }
      ,{
        path: "unit-list",
        name: "UnitList",
        component: UnitList,
        meta: { title: 'UnitList' }
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to) => {
  const token = localStorage.getItem("token");

  const requiresAuth = to.matched.some(
    (record) => record.meta.requiresAuth
  );

  if (requiresAuth && !token) {
    return "/login";
  }

  if ((to.path === "/login" || to.path === "/register") && token) {
    return "/admin/dashboard";
  }

  return true;
});

export default router
