import Utente from '@/models/utente.js'
import axios from 'axios'
export default ({
namespaced:true,

state:{
    // Qui si trovano i dati 
    token: null,
    utente: new Utente()
},

getters:{
    authenticated (state){
        return state.token && state.utente;
    },

    user (state){
        return state.utente;
    }
},

mutations:{
    // Le mutations aggiornano gli stati
    SET_TOKEN (state, token){
        state.token = token;
    },

    SET_UTENTE (state, utente){
        state.utente = utente;
    }
},

actions:{
    // Faranno le richieste all'api e le commit alle mutations
    login({dispatch},user){
    axios.post("http://127.0.0.1:9200/api/auth/signin", {email : user.email, password : user.password})
    .then(res => {
        console.log(res.data);
       return dispatch('attempt',res.data.token);    
    })
    .catch(e => {
      console.log(e);
    });
       
    },

    attempt({commit},token){
        commit('SET_TOKEN', token);

        try{
            axios.get("http://127.0.0.1:9200/api/auth/me", {
                headers: {
                    Authorization : "Bearer " + token
                }
            })
            .then(res => {
                console.log(res.data);
                commit('SET_UTENTE',res.data);
            })
        } catch(e){
            console.log("failed");
            commit('SET_UTENTE',null);
            commit('SET_TOKEN',null);

        }

    }
}

})