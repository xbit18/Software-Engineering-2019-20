<template>
  <div>
    <!-- INIZIO -->
    <table class="tg" v-if="!waiting && !gestisce">
      <thead>
        <tr>
          <th class="tg th">Aula</th>
          <th class="tg th">Edificio</th>
          <th class="tg th">Capienza</th>
          <th class="tg th">Tipo</th>
          <th class="tg th">Disponibilità</th>
          <th class="tg th">Mappa</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">{{aula.codice}}</td>
          <td class="tg td">{{aula.edificio}}</td>
          <td class="tg td">{{aula.capienza}}</td>
          <td class="tg td">{{aula.tipo}}</td>
          <td class="tg td">{{aula.disponibilita}}</td>
          <td class="tg td">
            <button class="button" @click="showMap(aula.avatar)">Mappa</button>
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
          <th class="tg th">Capienza</th>
          <th class="tg th">Tipo</th>
          <th class="tg th">Disponibilità</th>
          <th class="tg th">Modifica</th>
          <th class="tg th">Elimina</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">{{aula.id}}</td>
          <td class="tg td">{{aula.codice}}</td>
          <td class="tg td">{{aula.edificio}}</td>
          <td class="tg td">{{aula.capienza}}</td>
          <td class="tg td">{{aula.tipo}}</td>
          <td class="tg td">{{aula.disponibilita}}</td>
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
          <th class="tg th">Capienza</th>
          <th class="tg th">Tipo</th>
          <th class="tg th">Disponibilità</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">
            <router-link :to="{name:'listaPersone',params:{aula: aula.id}}">{{aula.id}}</router-link>
          </td>
          <td class="tg td">{{aula.codice}}</td>
          <td class="tg td">{{aula.edificio}}</td>
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
    showMap(mappa) {
      if (!this.show) {
        this.image = mappa;
        this.show = true;
        bus.$emit("imgSend", { img: this.image, show: this.show });
      } else if (this.image == mappa) {
        this.show = false;
        bus.$emit("toggle", this.show);
      } else {
        this.image = mappa;
        bus.$emit("imgSend", { img: this.image, show: this.show });
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
          axios.get(`http://127.0.0.1:8000/aule/${id}/delete`).then(res => {
            console.log(res);
            this.$router.push("/redirectDeleteAule");
            swal("L'aula è stata eliminata!", {
              icon: "success"
            });
          });
        } else {
          swal("Quasi!!");
        }
      });
    }
  }
};
</script>