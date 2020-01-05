import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import Inizio from "./components/Inizio.vue"
Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(require('vue-moment'));


const routes = [
 {path:'/', component: Inizio}
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
