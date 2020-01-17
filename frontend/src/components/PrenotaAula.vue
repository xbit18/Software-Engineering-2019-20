<template >
    <div class="center">
    <section class="edit">
      <div class="title">
        <h1>Prenota Aula</h1>
      </div>
      <form class="mid-form" @submit.prevent=save()>

        <label for="data_inizio">Data inizio</label>
        <FunctionalCalendar
        v-model="calendarData"
        ></FunctionalCalendar>
        <label for="data_fine">Data fine</label>
        <input type="text" name="data_fine" v-model="prenotazione.data_fine" required/>
     
        <label for="motivazione">Motivazione</label>
        <input type="text" name="motivazione" v-model="prenotazione.motivazione" required/>

        <label for="aula">Aula</label>
       <select v-model="room" name="aula" required >
          <option v-bind:value="{id: aula.id}" v-for="aula in listAule" :key="aula.id"> {{aula.codice}}</option>
        </select>
        
        <input type="submit" value ="Salva" class="button button-success" />
      </form>
    </section>

    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
import Prenotazione from "../models/prenotazione.js"
import Aula from "../models/aula.js";
import swal from "sweetalert";
import { FunctionalCalendar } from 'vue-functional-calendar';
import { mapGetters } from 'vuex';
export default {
  name: "PrenotaAula",
  components: {
       FunctionalCalendar
  },
  data() {
    return {
     prenotazione : new Prenotazione(),
     aula: new Aula(),
     listAule: null,
     room: {id:null},
     calendarData: {},
     calendarConfigs:{
         placerholder: new Date(),
         dateFormat: 'yyyy/mm/dd',
         isDatePicker: true
     }
    };
  },
  mounted() {
    this.getAule();
  },
  computed:{
      ...mapGetters({
          'user' : 'auth/user'
      })
  },
  methods: {
    save() {
        this.prenotazione.id_utente = 1;
        this.prenotazione.id_aula = this.room.id;
        console.log(this.prenotazione);
        // this.prenotazione.id_utente = store.user.id;
      axios.post(`http://127.0.0.1:8000/prenotazioni`, this.prenotazione).then(res => {
        console.log(res);
        swal({
          text: "L'prenotazione è stata effettuata",
          icon: "success"
        });
        setTimeout(() => {
          this.$router.push("/gestisceAule");
        }, 1000);
      });
    },
    getAule() {
      axios.get("http://127.0.0.1:8000/aule").then(res => {
        console.log(res);
        this.listAule = res.data;
      });
    }
  }
};
</script>