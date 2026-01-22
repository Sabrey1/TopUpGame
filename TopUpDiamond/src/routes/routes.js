import { createRouter, createWebHistory } from "vue-router"

// pages
import Home from "@/Home/Home.vue"
import CardDetail from '@/Home/components/CardDetail.vue'

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
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
