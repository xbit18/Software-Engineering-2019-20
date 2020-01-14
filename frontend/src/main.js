import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import Inizio from "./components/Inizio.vue"
import listaPersone from './components/listPersone.vue'
import searchAula from './components/searchAula.vue'
import RedirectListaPersone from './components/RedirectListaPersone.vue'
import RedirectAula from './components/RedirectAula.vue'
import RedirectEdificio from './components/RedirectEdificio.vue'
import Aula from './components/Aula.vue'
import gestisceAule from './components/gestisceAule.vue'
import editAula from './components/editAula.vue'
import createAula from './components/createAula.vue'
import createEdificio from './components/createEdificio.vue'
import editEdificio from './components/editEdificio.vue'
import gestisceEdifici from './components/gestisceEdifici.vue'
import Edificio from './components/Edificio.vue'
import CheckIn from './components/CheckIn.vue'

Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(require('vue-moment'));


const routes = [
 {path:'/', component: Inizio},
 {path:'/listaPersone/:aula', name:'listaPersone',component: listaPersone},
 {path:'/searchAula', component: searchAula},
 {path:'/redirectPersone/:aula', component: RedirectListaPersone},
 {path:'/redirectAula/:aula', component: RedirectAula},
 {path:'/redirectEdificio/:edificio', component: RedirectEdificio},
 {path:'/aula/:aula', name:'aula', component: Aula},
 {path:'/gestisceAule', component: gestisceAule},
 {path:'/gestisceEdifici', component: gestisceEdifici},
 {path:'/editAula/:aula', component: editAula},
 {path:'/createAula', component: createAula},
 {path:'/createEdificio', component: createEdificio},
 {path:'/editEdificio/:edificio', component: editEdificio},
 {path:'/edificio/:edificio', name:'edificio', component: Edificio},
 {path:'/check/:aula?', name:'check', component: CheckIn}
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