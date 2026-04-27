import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import Login from '@/views/Login.vue'
import Singup from '@/views/Singup.vue'
import Search from '@/views/Search.vue'
import CreateExerRoutine from '@/views/CreateExerRoutine.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
    },
    {
      path: '/signup',
      name: 'signup',
      component: Singup,
    },
    {
      path: '/search',
      name: 'search',
      component: Search,
    },
    {
      path: '/create',
      name: 'create',
      component: CreateExerRoutine,
    }
  ],
})

export default router
