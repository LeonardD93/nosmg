import Vue from 'vue'
import App from './App.vue'
import router from './router'
import './theme.scss'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import store from './store'
window.$store = Vue.prototype.$store = store

import axios from 'axios'
const http = Vue.prototype.$http = axios.create({
  baseURL: 'http://nosmg.x/api/',
})

http.interceptors.request.use(function (config) {
  if (store.token) {
    config.headers.Authorization = store.token
  }
  return config
}, function (error) {
  return Promise.reject(error)
})

http.interceptors.response.use(function (response) {
    return response
  }, function (error) {
    console.log('error', error.response)
    const res = error.response
    if (!res) {
      alert('Errore di connessione')
    } else {
      if (res.status == 401) {
        //alert('Non autorizzato')
        store.setToken(null)
        store.app.$router.push({name:'login'})
      } else {
        //alert('Errore '+res.status+': '+res.statusText)
      }
    }
    return Promise.reject(error);
  });

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,
}).$mount('#app')
