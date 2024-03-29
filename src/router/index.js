import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import Login from '@/pages/login/Login'
import Cadastro from '@/pages/login/cadastro/Cadastro'
import Perfil from '@/pages/perfil/Perfil'


Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [    
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/login/cadastro',
      name: 'Cadastro',
      component: Cadastro
    },
    {
      path:'/perfil',
      name: 'Perfil',
      component: Perfil
    }
  ]
})
