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
      path: '/utenti',
      name: 'users',
      component: () => import('./views/users'),
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('./views/login'),
    },
  ]
})

export default router
