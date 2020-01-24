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
        <th class="tg th">motivation</th>
        <th class="tg th">state</th>
        <th class="tg th">Aula</th>
        <th class="tg th">Utente</th>
        <th class="tg th">Accetta</th>
        <th class="tg th">Rifiuta</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="tg td">{{prenotazione.id}}</td>
        <td class="tg td">{{prenotazione.start_date}}</td>
        <td class="tg td">{{prenotazione.end_date}}</td>
        <td class="tg td">{{prenotazione.motivation}}</td>
        <td class="tg td">{{prenotazione.state}}</td>
        <td class="tg td">{{prenotazione.code}}</td>
        <td class="tg td">{{prenotazione.name}} {{prenotazione.surname}}</td>
        <td class="tg td">
          <button class="button button-accetta" @click="accetta(prenotazione.id,prenotazione.state,'accettata')">Accetta</button>
        </td>
        <td class="tg td">
          <button class="button button-elimina" @click="rifiuta(prenotazione.id,prenotazione.state,'rifiutata')">Rifiuta</button>
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
          <input class="input" type="text" name="search" v-model.trim="searchString" />
          <input type="submit" name="submit" value="Cerca" class="button button-search" />
        </form>
      </div>
  </aside>
  <div class="clearfix"></div>
</div>
</template>

<script>
import axios from 'axios'
import PrenotazioneAula from '../models/prenotazioneAula.js'
import swal from 'sweetalert'
export default {
    name: 'Prenotazione',
    data(){
        return{
            prenotazione: new PrenotazioneAula(),
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
            axios.get(`http://127.0.0.1:8000/api/bookings/${id}`)
            .then(res =>{
                this.prenotazione = res.data.data;
            })
        },
        accetta_rifiuta(id,state,newstate){ 
      console.log(id);
                axios.patch(`http://127.0.0.1:8000/api/bookings/${id}`,{state : newstate})
                .then(() =>{
                  this.$router.push('/redirectPrenotazione');
                    swal({
                    text: `Prenotazione ${newstate}`,
                    icon: "success"
                    });
                })
    }
    }
}
</script>

