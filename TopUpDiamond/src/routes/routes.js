import { createRouter, createWebHistory } from "vue-router"

// pages
import Home from "@/Home/Home.vue"
const CardDetail = () => import('@/Home/components/CardDetail.vue')
const CourselList = () => import('@/Admin/CourselList/CourselList.vue')
const sidebar = () => import('@/Admin/Layouts/sidebar.vue')
const GameList = () => import('@/Admin/Game/GameList.vue')
const OrderList = () => import('@/Admin/Order/OrderList.vue')
const PaymentList = () => import('@/Admin/Payment/PaymentList.vue')
const PaymentTypeList = () => import('@/Admin/PaymentType/PaymentTypeList.vue')
const TopUpPackageList = () => import('@/Admin/TopUpPackage/TopUpPackageList.vue')
const UserList = () => import('@/Admin/User/UserList.vue')
const Login = () => import('@/Auth/Login.vue')
const Register = () => import('@/Auth/Register.vue')
const CurrencyList = () => import('@/Admin/Currency/CurrencyList.vue')
const Dashboard = () => import('@/Admin/Dashboard/Dashboard.vue')
const UnitList = () => import('@/Admin/Unit/UnitList.vue')
const Setting = () => import('@/Admin/Setting/Setting.vue')

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
