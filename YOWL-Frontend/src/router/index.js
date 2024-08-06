import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/new-post/:id',
      name: 'new-post',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue')
    },
    {
      path: '/profile/:id',
      name: 'profile',
      component: () => import('../views/Profile/ProfileVIew.vue')
    },
    {
      path: '/test',
      name: 'test',
      component: () => import('../views/Testing/TestingView.vue')
    }
  ]
})

export default router
