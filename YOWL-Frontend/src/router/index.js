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
      path: '/posts/create/:id',
      name: 'new-post',
      component: () => import('../views/Post/NewPost.vue')
    },
    {
      path: '/posts/create',
      name: 'new-post-web',
      component: () => import('../views/Post/NewPost.vue')
    },
    {
      path: '/test',
      name: 'test',
      component: () => import('../views/Testing/TestingView.vue')
    }
  ]
})

export default router
