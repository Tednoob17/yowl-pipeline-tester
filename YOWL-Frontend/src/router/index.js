import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/LoginView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/RegisterView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/LoginView.vue')
    }
  ]
})

export default router
