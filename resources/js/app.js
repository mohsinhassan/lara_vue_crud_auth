require('./bootstrap');
//window.Vue = require('vue');
import Vue from 'vue/dist/vue';


window.Vue = Vue;


import App from './App.vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.prototype.axios = axios;

const router = new VueRouter({
  mode: 'history',
  routes: routes
})

const app = new Vue({
  router: router,
  el: '#app',  
  render: h => h(App),
});