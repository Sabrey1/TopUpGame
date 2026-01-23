import { createRouter, createWebHistory } from "vue-router"

// pages
import Home from "@/Home/Home.vue"
import CardDetail from '@/Home/components/CardDetail.vue'

import QuickPayment from '@/Payment/QuickPayment.vue'

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/ss",
    name: "QuickPayment",
    component: QuickPayment,
  },
  {
    path: "/game/:id",
    name: "CardDetail",
    component: CardDetail,
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
