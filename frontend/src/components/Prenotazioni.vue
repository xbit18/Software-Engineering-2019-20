<template>
  <table class="tg" v-if="listPrenotazioni.length > 0">
    <thead>
      <tr>
        <th class="tg th" v-if="isAdmin">ID</th>
        <th class="tg th">Data inizio</th>
        <th class="tg th">Data fine</th>
        <th class="tg th">Motivazione</th>
        <th class="tg th">Stato</th>
        <th class="tg th">Aula</th>
        <th class="tg th">Utente</th>
        <th class="tg th" v-if="isAdmin">Accetta</th>
        <th class="tg th" v-if="isAdmin">Rifiuta</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="prenotazione in listPrenotazioni" :key="prenotazione.id">
        <td class="tg td" v-if="isAdmin">{{prenotazione.id}}</td>
        <td class="tg td">{{prenotazione.start_date}}</td>
        <td class="tg td">{{prenotazione.end_date}}</td>
        <td class="tg td">{{prenotazione.motivation}}</td>
        <td class="tg td">{{prenotazione.state}}</td>
        <td class="tg td">{{prenotazione.code}}</td>
        <td class="tg td">{{prenotazione.name}} {{prenotazione.surname}}</td>
        <td class="tg td">
          <button class="button button-accetta" @click="accetta_rifiuta(prenotazione.id,'accepted')" v-if="isAdmin">Accetta</button>
        </td>
        <td class="tg td">
          <button class="button button-elimina" @click="accetta_rifiuta(prenotazione.id,'refused')" v-if="isAdmin">Rifiuta</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert'
import { mapGetters } from 'vuex'

export default {
  name: "Prenotazioni",
  props: ["listPrenotazioni"],
  computed:{
    ...mapGetters({
      isAdmin: 'auth/isAdmin',
    })
  },
  methods: {
    accetta_rifiuta(id,newstate){ 
      console.log(newstate);
                axios.patch(`http://127.0.0.1:8000/api/classroomreservations/${id}`,{state : newstate})
                .then(() =>{
                  this.$router.push('/redirectPrenotazione');
                    swal({
                    text: `Prenotazione ${newstate}`,
                    icon: "success"
                    });
                })
    }
  }
};
</script>

<style>
</style>