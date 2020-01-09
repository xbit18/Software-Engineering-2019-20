import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import Inizio from "./components/Inizio.vue"
import InfoAula from './components/InfoAula.vue'
import WaitingAula from './components/WaitingAula.vue'
import RedirectListaPersone from './components/RedirectListaPersone.vue'
import RedirectAula from './components/RedirectAula.vue'
import Aula from './components/Aula.vue'
import gestisceAule from './components/gestisceAule.vue'
Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(require('vue-moment'));


const routes = [
 {path:'/', component: Inizio},
 {path:'/infoAula/:aula', name:'infoAula',component: InfoAula},
 {path:'/waitingAula', component: WaitingAula},
 {path:'/redirectPersone/:aula', component: RedirectListaPersone},
 {path:'/redirectAula/:aula', component: RedirectAula},
 {path:'/aula/:aula', name:'aula', component: Aula},
 {path:'/gestisceAule', component: gestisceAule}

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
