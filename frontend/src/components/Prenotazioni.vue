<template>
  <table class="tg" v-if="listPrenotazioni.length > 0">
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
      <tr v-for="prenotazione in listPrenotazioni" :key="prenotazione.id">
        <td class="tg td">{{prenotazione.id}}</td>
        <td class="tg td">{{prenotazione.data_inizio}}</td>
        <td class="tg td">{{prenotazione.data_fine}}</td>
        <td class="tg td">{{prenotazione.motivazione}}</td>
        <td class="tg td">{{prenotazione.stato}}</td>
        <td class="tg td">{{prenotazione.codice}}</td>
        <td class="tg td">{{prenotazione.nome}} {{prenotazione.cognome}}</td>
        <td class="tg td">
          <button class="button button-accetta" @click="accetta_rifiuta(prenotazione.id,prenotazione.stato,'accettata')">Accetta</button>
        </td>
        <td class="tg td">
          <button class="button button-elimina" @click="accetta_rifiuta(prenotazione.id,prenotazione.stato,'rifiutata')">Rifiuta</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert'
export default {
  name: "Prenotazioni",
  props: ["listPrenotazioni"],
  methods: {
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
};
</script>

<style>
</style>