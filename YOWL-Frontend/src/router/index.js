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
      component: () => import('../views/SigninView.vue')
    },
    {
      path: '/message',
      name: 'message',
      component: () => import('../views/MessageView.vue')
    },
    {
      path: '/login',
      name: 'signin',
      component: () => import('../views/SigninView.vue')
    },
    {
      path: '/landing',
      name: 'pages',
      component: () => import('../views/LandingpageView.vue')
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('../views/Profile/ProfileVIew.vue')
    },
    // not found
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: () => import('../views/NotFoundView.vue'),
    }
  ]
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register', '/signin', '/signup', '/landing', '/forgot-password', '/reset-password'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('token');

  if (authRequired && !loggedIn && to.name !== 'not-found' && to.name == 'pages') {
    return next('/login');
  }

  if (!authRequired && loggedIn) {
    return next('/');
  }

  next();
});


export default router
