// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import axios from "axios"
import Vuex from 'vuex'

Vue.config.productionTip = false
Vue.prototype.$http = axios
Vue.prototype.$urlAPI = 'http://localhost:8000/api/'
Vue.use(Vuex)

//loja do vuex
var store = {
  state: {
    usuario: sessionStorage.getItem('usuario') ? JSON.parse(sessionStorage.getItem('usuario')) : null,
    conteudosLinhaTempo: []
  },
  getters:{
    //testando o getter
    getUsuario: state =>{
      return state.usuario;
    },
    getToken: state =>{
      return state.usuario.token
    },
    getConteudosLinhaTempo: state =>{
      return state.conteudosLinhaTempo;
    }
  },
  mutations:{
    setUsuario(state, n){
      state.usuario = n;
    },
    setConteudosLinhaTempo(state,n){
      state.conteudosLinhaTempo = n;
    }
  }
}

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  //configurando minha loja do vuex
  store: new Vuex.Store(store),
  components: { App },
  template: '<App/>'
})
