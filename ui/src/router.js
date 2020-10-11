import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)

const router = new VueRouter({
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('./views/home'),
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('./views/users'),
      meta: {
        auth: true,
      },
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('./views/login'),
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('./views/register'),
    },
    {
      path: '/invitations',
      name: 'invitations',
      component: () => import('./views/invitations'),
      meta: {
        auth: true,
      },
    },
    {
      path: '/activities',
      name: 'activities',
      component: () => import('./views/activities'),
      meta: {
        auth: true,
      },
    },
    {
      path: '/players',
      name: 'players',
      component: () => import('./views/players'),
      meta: {
        auth: true,
      },
    },
  ]
})

export default router
