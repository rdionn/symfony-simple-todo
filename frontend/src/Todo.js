import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

import VuexStore from './vuex.js'

Vue.use(VueRouter)
Vue.use(Vuex)

const routes = require('./routes.js')
const store = new Vuex.Store(VuexStore)
const router = new VueRouter({
  routes
})

let app = new Vue({
  components: {
    app: () => import('./App.vue')
  },
  el: '#vue-app',
  router,
  store
})
