import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth.js'
Vue.use(Vuex);
Vue.config.devtools = true

export default new Vuex.Store({
state:{
    // Qui si trovano i dati 
},

mutations:{
    // Le mutations aggiornano gli stati
},

actions:{
    // Faranno le richieste all'api e le commit alle mutations
},

modules:{
    auth
}


})


