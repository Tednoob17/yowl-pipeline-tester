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
<<<<<<< HEAD
      path: '/signin',
      name: 'signin',
      component: () => import('../views/SigninView.vue')
    },
    {
      path: '/signup',
      name: 'signup',
      component: () => import('../views/SignupView.vue')
    },
    {
      path: '/landing',
      name: 'pages',
      component: () => import('../views/LandingpageView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue')
    },
    {
=======
>>>>>>> 55461970fbaff9e40d54a52dc1698e4a03ff8572
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
<<<<<<< HEAD
  const publicPages = ['/login', '/register', '/signin', '/signup', '/landing', '/forgot-password', '/reset-password'];
=======
  const publicPages = ['/login', '/register',  '/signin', '/signup', '/forgot-password', '/reset-password'];
>>>>>>> 55461970fbaff9e40d54a52dc1698e4a03ff8572
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('token');

  if (authRequired && !loggedIn && to.name !== 'not-found') {
    return next('/login');
  }

  if (!authRequired && loggedIn) {
    return next('/');
  }

  next();
});


export default router
