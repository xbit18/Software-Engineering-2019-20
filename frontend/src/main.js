import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import store from './store'
import swal from 'sweetalert'
import FunctionalCalendar from 'vue-functional-calendar';
// import axios from 'axios'
import Inizio from "./components/Inizio.vue"
import listPersone from './components/listPersone.vue'
import searchAula from './components/searchAula.vue'
import RedirectListaPersone from './components/RedirectListaPersone.vue'
import RedirectAula from './components/RedirectAula.vue'
import RedirectAccept from './components/RedirectAccept.vue'
import RedirectEdificio from './components/RedirectEdificio.vue'
import RedirectDeleteEdificio from './components/RedirectDeleteEdificio.vue'
import RedirectDeleteAula from './components/RedirectDeleteAula.vue'
import RedirectPrenotazione from './components/RedirectPrenotazione.vue'
import Aula from './components/Aula.vue'
import gestisceAule from './components/gestisceAule.vue'
import editAula from './components/editAula.vue'
import createAula from './components/createAula.vue'
import createEdificio from './components/createEdificio.vue'
import editEdificio from './components/editEdificio.vue'
import gestisceEdifici from './components/gestisceEdifici.vue'
import Edificio from './components/Edificio.vue'
import CheckIn from './components/CheckIn.vue'
import CheckOut from './components/CheckOut.vue'
import Prenotazione from './components/Prenotazione.vue'
import listPrenotazioni from './components/listPrenotazioni.vue'
import PrenotaAula from './components/PrenotaAula.vue'
import CreaMappa from './components/CreaMappa.vue'
import editMappa from './components/editMappa.vue'
import selectAulaToCheck from './components/selectAulaToCheck.vue'
require('./store/modules/subscriber.js')

// axios.defaults.baseURL = "http://127.0.0.1:8000";

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(require('vue-moment'));
Vue.use(FunctionalCalendar, {
    dayNames: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
});

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
        component: Inizio
    },
    {
        path:'/listaPersone/:aula',
        name:'listaPersone',
        component: listPersone,
        beforeEnter:(to,from,next) =>{
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/searchAula',
        component: searchAula,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/redirectPersone/:aula',
        component: RedirectListaPersone,
        beforeEnter:(to,from,next) =>{
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/redirectAula/:aula',
        component: RedirectAula
    },
    {path:'/redirectEdificio/:edificio',
        component: RedirectEdificio
    },
    {path:'/aula/:aula',
        name:'aula',
        component: Aula
    },
    {path:'/gestisceAule',
        component: gestisceAule,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/gestisceEdifici',
        component: gestisceEdifici,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/editAula/:aula',
        component: editAula,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/createAula',
        component: createAula,
        name: 'createAula',
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/createEdificio',
        component: createEdificio,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/editEdificio/:edificio',
        component: editEdificio,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/edificio/:edificio',
        name:'edificio',
        component: Edificio
    },
    {path:'/checkout/:aula',
        name:'checkout',
        component: CheckOut,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/authenticated']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/check/:aula',
        name:'checkin',
        component: CheckIn,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/authenticated']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/selectAulaToCheck',
        component: selectAulaToCheck,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/authenticated']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/redirectDeleteEdificio',
        component: RedirectDeleteEdificio,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {path:'/redirectDeleteAule',
        component: RedirectDeleteAula,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/listPrenotazioni',
        component: listPrenotazioni,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/prenotazione/:prenotazione',
        component: Prenotazione,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path: '/redirectPrenotazione/:prenotazione',
        component: RedirectPrenotazione,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/redirectPrenotazione',
        component: RedirectAccept,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/prenotaAula',
        component: PrenotaAula,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/creaMappa',
        component: CreaMappa,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    },
    {
        path:'/editMappa/:mappa?',
        component: editMappa,
        beforeEnter:(to,from,next) =>{
            console.log(store.getters)
            if(!store.getters['auth/isAdmin']){
                swal({
                    text : 'Non sei autorizzato',
                    icon : 'error'
                });
                next({
                    name: 'inizio'
                });
            }
            next();
        }
    }
]

const router = new VueRouter({
    routes,
    mode: 'history'
});


/* ----------------- Router ----------------------*/

