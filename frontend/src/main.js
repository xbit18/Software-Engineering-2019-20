import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import Inizio from "./components/Inizio.vue"
import listaPersone from './components/listPersone.vue'
import searchAula from './components/searchAula.vue'
import RedirectListaPersone from './components/RedirectListaPersone.vue'
import RedirectAula from './components/RedirectAula.vue'
import Aula from './components/Aula.vue'
import gestisceAule from './components/gestisceAule.vue'
import editAula from './components/editAula.vue'
import createAula from './components/createAula.vue'
Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(require('vue-moment'));


const routes = [
 {path:'/', component: Inizio},
 {path:'/listaPersone/:aula', name:'listaPersone',component: listaPersone},
 {path:'/waitingAula', component: searchAula},
 {path:'/redirectPersone/:aula', component: RedirectListaPersone},
 {path:'/redirectAula/:aula', component: RedirectAula},
 {path:'/aula/:aula', name:'aula', component: Aula},
 {path:'/gestisceAule', component: gestisceAule},
 {path:'/editAula/:aula?', component: editAula},
 {path:'/createAula', component: createAula}

]

const router = new VueRouter({
  routes,
  mode: 'history'
});

export const bus = new Vue();

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
