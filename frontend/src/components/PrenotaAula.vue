<template >
  <div class="center">
    <section class="edit">
      <div class="title">
        <h1>Prenota Aula</h1>
      </div>
      <form class="mid-form" @submit.prevent="save()">
        <label for="data_inizio">Data inizio</label>
        <div class="clearfix"></div>
        <date-picker
          v-model="prenotazione.data_inizio"
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

          <label for="data_fine">Data fine</label>
        <div class="clearfix"></div>
        <date-picker
          v-model="prenotazione.data_fine"
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
        <select v-model="prenotazione.id_aula" name="aula" required>
          <option v-bind:value="aula.id" v-for="aula in listAule" :key="aula.id">{{aula.codice}}</option>
        </select>

        <label for="motivazione">Motivazione</label>
        <textarea v-model="prenotazione.motivazione" required></textarea>

        <input type="submit" value="Salva" class="button button-success" />
      </form>
    </section>
    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
import Prenotazione from "../models/prenotazione.js";
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
      prenotazione: new Prenotazione(),
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
      this.prenotazione.id_utente = this.user.id;
      console.log(this.prenotazione);
      // this.prenotazione.id_utente = store.user.id;
      axios
        .post(`http://127.0.0.1:8000/api/bookings`, this.prenotazione)
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
      axios.get("http://127.0.0.1:8000/api/aule").then(res => {
        console.log(res);
        this.listAule = res.data.data;
      });
    },
    verifica(){
      if(this.prenotazione.data_inizio > this.prenotazione.data_fine){
        swal({
          text: "La data fine non può essere maggiore alla data inizio",
          icon: "warning"
        })
      }
    }
  }
};
</script>