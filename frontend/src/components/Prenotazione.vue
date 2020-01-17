<template>
  <div>
  <section class="lista">
       <div class="title">
        <h1>Prenotazione</h1>
      </div>
      <table class="tg">
    <thead>
      <tr>
        <th class="tg th">ID</th>
        <th class="tg th">Data inizio</th>
        <th class="tg th">Data fine</th>
        <th class="tg th">Motivazione</th>
        <th class="tg th">Stato</th>
        <th class="tg th">Aula</th>
        <th class="tg th">Utente</th>
        <th class="tg th">Accetta</th>
        <th class="tg th">Rifiuta</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="tg td">{{prenotazione.id}}</td>
        <td class="tg td">{{prenotazione.data_inizio}}</td>
        <td class="tg td">{{prenotazione.data_fine}}</td>
        <td class="tg td">{{prenotazione.motivazione}}</td>
        <td class="tg td">{{prenotazione.stato}}</td>
        <td class="tg td">{{prenotazione.codice}}</td>
        <td class="tg td">{{prenotazione.nome}} {{prenotazione.cognome}}</td>
        <td class="tg td">
          <button class="button button-accetta" @click="accetta(prenotazione.id,prenotazione.stato,'accettata')">Accetta</button>
        </td>
        <td class="tg td">
          <button class="button button-elimina" @click="rifiuta(prenotazione.id,prenotazione.stato,'rifiutata')">Rifiuta</button>
        </td>
      </tr>
    </tbody>
  </table>
  </section>
  <aside class="sidebar search waitingSearch">
      <div id="search" class="sidebar-item">
        <h3>Cerca</h3>
        <p>Trova una prenotazione</p>
        <form @submit.prevent="goSearch">
          <input class="input" type="text" name="search" v-model="searchString" />
          <input type="submit" name="submit" value="Cerca" class="button button-search" />
        </form>
      </div>
  </aside>
  <div class="clearfix"></div>
</div>
</template>

<script>
import axios from 'axios'
import Prenotazione from '../models/prenotazione.js'
import swal from 'sweetalert'
export default {
    name: 'Prenotazione',
    data(){
        return{
            prenotazione: new Prenotazione(),
            searchString: null
        }
    },
    mounted(){
        let id = this.$route.params.prenotazione;
        this.getPrenotazione(id);
    },
    methods:{
        goSearch: function() {
      this.$router.push(`/redirectPrenotazione/${this.searchString}`);
    },
        getPrenotazione(id){
            axios.get(`http://127.0.0.1:8000/prenotazioni/${id}`)
            .then(res =>{
                this.prenotazione = res.data;
            })
        },
        accetta_rifiuta(id,stato,newStato){ 
      console.log(id);
                axios.patch(`http://127.0.0.1:8000/prenotazioni/${id}`,{stato : newStato})
                .then(() =>{
                  this.$router.push('/redirectPrenotazione');
                    swal({
                    text: `Prenotazione ${newStato}`,
                    icon: "success"
                    });
                })
    }
    }
}
</script>

