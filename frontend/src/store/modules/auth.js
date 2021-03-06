import Utente from '@/models/utente.js'
import axios from 'axios'
export default ({
namespaced:true,

state:{
    // Qui si trovano i dati 
    token: null,
    utente: new Utente(),
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
    axios.post("http://127.0.0.1:8000/api/login", user)
    .then(res => {
        console.log(res.data.data);
        dispatch('attempt',res.data.token);    
    })
    .catch(e => {
      console.log(e);
    });
       
    },

    attempt({commit,state},token){
        if(token){
            commit('SET_TOKEN', token);
            setInterval(() => {
                axios.post("http://127.0.0.1:8000/api/logout")
            .then(() => {
            commit('SET_UTENTE',null);
            commit('SET_TOKEN',null);
            commit('SET_ISADMIN',null);
            commit('SET_DOCENTE',null);

        })
            }, 5988000);
        }
      
        if(state.token){
            try{
                        axios.get("http://127.0.0.1:8000/api/me")
                        .then(res => {
                            console.log(res.data);
                            commit('SET_UTENTE',res.data);
                            if(res.data.type == 'admin'){
                                commit('SET_ISADMIN',true);
                            } else if (res.data.type == 'teacher'){
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
        return axios.post("http://127.0.0.1:8000/api/logout")
        .then(() => {
            commit('SET_UTENTE',null);
            commit('SET_TOKEN',null);
            commit('SET_ISADMIN',null);
            commit('SET_DOCENTE',null);

        })
    }
}

})
