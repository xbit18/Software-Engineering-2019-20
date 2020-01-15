import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import store from './store'
// import axios from 'axios'
import Inizio from "./components/Inizio.vue"
import listaPersone from './components/listPersone.vue'
import searchAula from './components/searchAula.vue'
import RedirectListaPersone from './components/RedirectListaPersone.vue'
import RedirectAula from './components/RedirectAula.vue'
import RedirectEdificio from './components/RedirectEdificio.vue'
import RedirectDeleteEdificio from './components/RedirectDeleteEdificio.vue'
import RedirectDeleteAula from './components/RedirectDeleteAula.vue'
import Aula from './components/Aula.vue'
import gestisceAule from './components/gestisceAule.vue'
import editAula from './components/editAula.vue'
import createAula from './components/createAula.vue'
import createEdificio from './components/createEdificio.vue'
import editEdificio from './components/editEdificio.vue'
import gestisceEdifici from './components/gestisceEdifici.vue'
import Edificio from './components/Edificio.vue'
import CheckIn from './components/CheckIn.vue'
require('./store/modules/subscriber.js')

// axios.defaults.baseURL = "http://127.0.0.1:8000";

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(require('vue-moment'));

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() =>{

  new Vue({
    router,
    store,
    render: h => h(App),
  }).$mount('#app')

});

export const bus = new Vue();






/* Router */
const routes = [
  {
    path:'/', 
    name: 'inizio',
    component: Inizio,
   

    
  },
  {
    path:'/listaPersone/:aula', 
    name:'listaPersone',
    component: listaPersone,
    beforeEnter: (to, from, next) => {
      if(!store.getters['auth/Authenticated']){
        return next({
          name: 'inizio'
        })
      }
      next()
    }
  },
  {
    path:'/searchAula', 
    component: searchAula,
    beforeEnter: (to, from, next) => {
      if(!store.getters['auth/Authenticated']){
        return next({
          name: 'inizio'
        })
      }
      next()
    }
  },
  {path:'/redirectPersone/:aula',
  component: RedirectListaPersone,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/redirectAula/:aula',
  component: RedirectAula,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/redirectEdificio/:edificio', 
  component: RedirectEdificio,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/aula/:aula', 
  name:'aula', 
  component: Aula,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/gestisceAule', 
  component: gestisceAule,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/gestisceEdifici', 
  component: gestisceEdifici,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/editAula/:aula',
  component: editAula,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/createAula', 
  component: createAula,
  name: 'createAula',
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/createEdificio',
  component: createEdificio,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/editEdificio/:edificio', 
  component: editEdificio,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/edificio/:edificio',
  name:'edificio', 
  component: Edificio,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/check/:aula?',
  name:'check', 
  component: CheckIn,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/redirectDeleteEdificio', 
  component: RedirectDeleteEdificio,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  },
  {path:'/redirectDeleteAule',
  component: RedirectDeleteAula,
  beforeEnter: (to, from, next) => {
    if(!store.getters['auth/Authenticated']){
      return next({
        name: 'inizio'
      })
    }
    next()
  }
  }
]

const router = new VueRouter({
  routes,
  mode: 'history'
});


/* ----------------- Router ----------------------*/

