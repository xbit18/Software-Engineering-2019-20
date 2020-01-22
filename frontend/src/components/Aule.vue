<template>
  <div>
    <!-- INIZIO -->
    <table class="tg" v-if="!waiting && !gestisce">
      <thead>
        <tr>
          <th class="tg th">Aula</th>
          <th class="tg th">Edificio</th>
          <th class="tg th">Piano</th>
          <th class="tg th">Capienza</th>
          <th class="tg th">Tipo</th>
          <th class="tg th">Disponibilità</th>
          <th class="tg th">Mappa</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">{{aula.codice}}</td>
          <td class="tg td">{{aula.nome_edificio}}</td>
          <td class="tg td">{{aula.piano}}</td>
          <td class="tg td">{{aula.capienza}}</td>
          <td class="tg td">{{aula.tipo}}</td>
          <td class="tg td">{{aula.disponibilita}}</td>
          <td class="tg td">
            <button class="button" @click="showMap(aula.id_edificio,aula.piano)">Mappa</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- FINE INIZIO -->

    <!-- GESTISCE AULA-->

    <table class="tg" v-else-if="gestisce">
      <thead>
        <tr>
          <th class="tg th">ID</th>
          <th class="tg th">Aula</th>
          <th class="tg th">Edificio</th>
          <th class="tg th">Piano</th>
          <th class="tg th">Capienza</th>
          <th class="tg th">Tipo</th>
          <th class="tg th">Disponibilità</th>
          <th class="tg th">Apri/chiudi</th>
          <th class="tg th">Modifica</th>
          <th class="tg th">Elimina</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">{{aula.id}}</td>
          <td class="tg td">{{aula.codice}}</td>
          <td class="tg td">{{aula.nome_edificio}}</td>
          <td class="tg td">{{aula.piano}}</td>
          <td class="tg td">{{aula.capienza}}</td>
          <td class="tg td">{{aula.tipo}}</td>
          <td class="tg td">{{aula.disponibilita}}</td>
          <td class="tg td" v-if="aula.stato == 'chiusa'">
            <button class="button button-apri/chiudi" @click="apri_chiudi(aula.id, aula.stato)">Apri</button>
          </td>
          <td class="tg td" v-else>
            <button
              class="button button-apri/chiudi"
              @click="apri_chiudi(aula.id, aula.stato)"
            >Chiudi</button>
          </td>
          <td class="tg td">
            <router-link :to="'/editAula/'+aula.id" class="button button-modifica">Modifica</router-link>
          </td>
          <td class="tg td">
            <button class="button button-elimina" @click="elimina(aula.id)">Elimina</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!--FINE GESTISCE -->

    <!-- WAITING AULA -->

    <table class="tg" v-else>
      <thead>
        <tr>
          <th class="tg th">ID</th>
          <th class="tg th">Aula</th>
          <th class="tg th">Edificio</th>
          <th class="tg th">Piano</th>
          <th class="tg th">Capienza</th>
          <th class="tg th">Tipo</th>
          <th class="tg th">Disponibilità</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">{{aula.id}}</td>
          <td class="tg td">
            <router-link :to="{name: 'listaPersone', params:{aula: aula.codice}}">{{aula.codice}}</router-link>
          </td>
          <td class="tg td">{{aula.nome_edificio}}</td>
          <td class="tg td">{{aula.piano}}</td>
          <td class="tg td">{{aula.capienza}}</td>
          <td class="tg td">{{aula.tipo}}</td>
          <td class="tg td">{{aula.disponibilita}}</td>
        </tr>
      </tbody>
    </table>
    <!-- FINE WAITING -->
  </div>
</template>

<script>
import { bus } from "../main.js";
import swal from "sweetalert";
import axios from "axios";
export default {
  name: "Aule",
  data() {
    return {
      image: null,
      show: false
    };
  },
  props: ["listAule", "waiting", "gestisce"],
  methods: {
    showMap(edificio, piano) {
      if (!this.show) {
        axios
          .get(`http://127.0.0.1:8000/api/maps/${edificio}/${piano}`)
          .then(res => {
            this.image = res.data.piantina;
            this.show = true;
            bus.$emit("imgSend", { img: this.image, show: this.show });
          })

          .catch(() => {
            swal({
              text: "Quest'aula non ha la mappa",
              icon: "warning"
            });
          });
      } else if (this.show) {
        this.show = false;
        bus.$emit("toggle", this.show);
      }
    },
    elimina(id) {
      swal({
        title: "Sei sicuro ?",
        text: "Una volta eliminata non sarà possibile recuperare l'aula!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios.get(`http://127.0.0.1:8000/api/classrooms/${id}/delete`).then(() => {
            this.$router.push("/redirectDeleteAule");
            swal("L'aula è stata eliminata!", {
              icon: "success"
            });
          });
        } else {
          swal("Quasi!!");
        }
      });
    },
    apri_chiudi(id, stato) {
      if (stato == "chiusa") {
        axios
          .patch(`http://127.0.0.1:8000/api/classrooms/${id}`, { stato: "aperta" })
          .then(() => {
            this.$router.push("/redirectDeleteAule");
            swal({
              text: "Aula aperta",
              icon: "success"
            });
          });
      } else {
        axios
          .patch(`http://127.0.0.1:8000/api/classrooms/${id}`, { stato: "chiusa" })
          .then(() => {
            this.$router.push("/redirectDeleteAule");
            swal({
              text: "Aula chiusa",
              icon: "success"
            });
          });
      }
    }
  }
};
</script>
