import { createRouter, createWebHistory } from "vue-router"

// pages
import Home from "@/Home/Home.vue"
import CardDetail from '@/Home/components/CardDetail.vue'

import CourselList from '@/Admin/CourselList/CourselList.vue'
import sidebar from '@/Admin/Layouts/sidebar.vue'
import TimeRun from '@/Admin/Layouts/TimeRun.vue'


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


  //admin
  ,{
    path: "/admin",
    name: "sidebar",
    component: sidebar,
  }
  ,{
    path: "/admin/coursellist",
    name: "CourselList",
    component: CourselList,
    meta: { title: 'Coursel List' }
  }
  
  
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
