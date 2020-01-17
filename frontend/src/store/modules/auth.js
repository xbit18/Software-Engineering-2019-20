// import Utente from '@/models/utente.js'
import axios from 'axios'
export default ({
namespaced:true,

state:{
    // Qui si trovano i dati 
    token: null,
    utente: null,
    admin: null,
    docente: null
},

getters:{
    authenticated (state){
        return state.token && state.utente;
    },

    user (state){
        return state.utente;
    },

    isAdmin(state){
       return state.admin;
    },
    isDocente(state){
        return state.docente;

    }
},

mutations:{
    // Le mutations aggiornano gli stati
    SET_TOKEN (state, token){
        state.token = token;
    },

    SET_UTENTE (state, utente){
        state.utente = utente;
    },
    SET_ISADMIN (state, isAdmin){
        state.admin = isAdmin;
    },
    SET_DOCENTE (state, isDocente){
        state.docente = isDocente;
    }
},

actions:{
    // Faranno le richieste all'api e le commit alle mutations
    login({dispatch},user){
    axios.post("http://127.0.0.1:9200/api/auth/signin", {email : user.email, password : user.password})
    .then(res => {
        console.log(res.data);
        dispatch('attempt',res.data.token);    
    })
    .catch(e => {
      console.log(e);
    });
       
    },

    attempt({commit,state},token){
        if(token){
            commit('SET_TOKEN', token);
        }
      
        if(state.token){
            try{
                        axios.get("http://127.0.0.1:9200/api/auth/me")
                        .then(res => {
                            console.log(res.data);
                            commit('SET_UTENTE',res.data);
                            if(res.data.tipo == 'admin'){
                                commit('SET_ISADMIN',true);
                            } else if (res.data.tipo == 'docente'){
                                commit('SET_DOCENTE',true);
                            }
                         
                        })
                    } catch(e){
                        console.log("failed");
                        commit('SET_UTENTE',null);
                        commit('SET_TOKEN',null);
                        commit('SET_ISADMIN',null);
                        commit('SET_DOCENTE',null);

                    }
        }
    },

    logout({commit}){
        return axios.post("http://127.0.0.1:9200/api/auth/signout")
        .then(() => {
            commit('SET_UTENTE',null);
            commit('SET_TOKEN',null);
            commit('SET_ISADMIN',null);
            commit('SET_DOCENTE',null);

        })
    }
}

})