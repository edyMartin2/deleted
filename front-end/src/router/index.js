import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import dasshboard from '../views/dasshboard.vue'
import naves from '../views/naves.vue'
import parques from '../views/Parques.vue'
import admin from "../views/admin";
import corporativos from "../views/corporativos";
import usuarios from "../views/usuarios";
import Inquilino from "../views/Inquilino";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path:'/dasshboard',
    name:'dasshboard',
    component:dasshboard
  },
  {
    path:'/naves',
    name:'naves',
    component:naves
  },
  {
    path: '/parques',
    name: 'parques',
    component: parques
  },
  {
    path:'/admin',
    name: 'admin',
    component: admin
  },
  {
    path: '/corporativos',
    name: 'corporativos',
    component: corporativos
  },
  {
    path: '/usuarios',
    name: 'usuarios',
    component: usuarios
  },
  {
    path: '/Inquilino',
    name: 'Inquilini',
    component:Inquilino
  }
  
]

const router = new VueRouter({
  base: process.env.BASE_URL,
  routes
})

export default router
