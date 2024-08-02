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
      component: () => import('../views/Testing/TestingView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/test',
      name: 'test',
      component: () => import('../views/Testing/TestingView.vue')
    }
  ]
})

export default router
