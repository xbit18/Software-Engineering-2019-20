<template >
  <div class="center">
    <section class="edit">
      <div class="title">
        <h1>Prenota Aula</h1>
      </div>
      <form class="mid-form" @submit.prevent="save()">
        <label for="start_date">Data inizio</label>
        <div class="clearfix"></div>
        <date-picker
          v-model="prenotazione.start_date"
          lang="en"
          type="datetime"
          format="YYYY-MM-DD HH:mm:ss"
          minute-step="30"
          second-step="60"
          placeholder="Select date"
          value-type="format"
          confirm
        ></date-picker>
        <div class="clearfix"></div>

          <label for="end_date">Data fine</label>
        <div class="clearfix"></div>
        <date-picker
          v-model="prenotazione.end_date"
          lang="en"
          type="datetime"
          format="YYYY-MM-DD HH:mm:ss"
          :minute-step= "30"
          :second-step= "60"
          placeholder="Select date"
          value-type="format"
          @change="verifica()"
          confirm
        ></date-picker>
        <div class="clearfix"></div>

        <label for="aula">Aula</label>
        <select v-model="prenotazione.classroom_id" name="aula" required>
          <option v-bind:value="aula.id" v-for="aula in listAule" :key="aula.id">{{aula.code}}</option>
        </select>

        <label for="motivation">motivation</label>
        <textarea v-model="prenotazione.motivation" required></textarea>

        <input type="submit" value="Salva" class="button button-success" />
      </form>
    </section>
    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
import PrenotazioneAula from "../models/prenotazioneAula.js";
import Aula from "../models/aula.js";
import swal from "sweetalert";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import { mapGetters } from "vuex";

export default {
  name: "PrenotaAula",
  components: {
    DatePicker
  },
  data() {
    return {
      // Prenotazioni
      prenotazione: new PrenotazioneAula(),
      aula: new Aula(),
      listAule: null,
    };
  },
  mounted() {
    this.getAule();
  },
  computed: {
    ...mapGetters({
      user: "auth/user"
    })
  },
  methods: {
    save() {
      this.prenotazione.user_id = this.user.id;
      console.log(this.prenotazione);
      // this.prenotazione.user_id = store.user.id;
      axios
        .post(`http://127.0.0.1:8000/api/classroomreservations`, this.prenotazione)
        .then(res => {
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
      axios.get("http://127.0.0.1:8000/api/classrooms").then(res => {
        console.log(res);
        this.listAule = res.data.data;
      });
    },
    verifica(){
      if(this.prenotazione.start_date > this.prenotazione.end_date){
        swal({
          text: "La data fine non può essere maggiore alla data inizio",
          icon: "warning"
        })
      }
    }
  }
};
</script>