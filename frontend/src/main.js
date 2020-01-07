import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import Inizio from "./components/Inizio.vue"
import InfoAula from './components/InfoAula.vue'
import WaitingAula from './components/WaitingAula.vue'
import Redirect from './components/Redirect.vue'
import Aula from './components/Aula.vue'
Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(require('vue-moment'));


const routes = [
 {path:'/', component: Inizio},
 {path:'/infoAula/:aula', component: InfoAula},
 {path:'/infoAula', component: WaitingAula},
 {path:'/Redirect/:aula', component: Redirect},
 {path:'/aula/:aula', name:'aula', component: Aula}

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
