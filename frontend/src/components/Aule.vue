<template>
  <div>
    <!-- INIZIO -->
    <table class="tg" v-if="inizio">
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
          <td class="tg td">{{aula.code}}</td>
          <td class="tg td">{{aula.building_name}}</td>
          <td class="tg td">{{aula.floor}}</td>
          <td class="tg td">{{aula.capacity}}</td>
          <td class="tg td">{{aula.type}}</td>
          <td class="tg td">{{aula.availability}}</td>
          <td class="tg td">
            <button class="button" @click="showMap(aula.building_id,aula.floor,aula.building_name)">Mappa</button>
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
          <td class="tg td">{{aula.code}}</td>
          <td class="tg td">{{aula.building_name}}</td>
          <td class="tg td">{{aula.floor}}</td>
          <td class="tg td">{{aula.capacity}}</td>
          <td class="tg td">{{aula.type}}</td>
          <td class="tg td">{{aula.availability}}</td>
          <td class="tg td" v-if="aula.state == 'closed'">
            <button class="button button-apri/chiudi" @click="apri_chiudi(aula.id, aula.state)">Apri</button>
          </td>
          <td class="tg td" v-else>
            <button
              class="button button-apri/chiudi"
              @click="apri_chiudi(aula.id, aula.state)"
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

    <table class="tg" v-else-if="waiting">
      <thead>
        <tr>
          <th class="tg th">ID</th>
          <th class="tg th">Aula</th>
          <th class="tg th">Edificio</th>
          <th class="tg th">floor</th>
          <th class="tg th">capacity</th>
          <th class="tg th">type</th>
          <th class="tg th">Disponibilità</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">{{aula.id}}</td>
          <td class="tg td">
            <router-link :to="{name: 'listaPersone', params:{aula: aula.id}}">{{aula.code}}</router-link>
          </td>
          <td class="tg td">{{aula.building_name}}</td>
          <td class="tg td">{{aula.floor}}</td>
          <td class="tg td">{{aula.capacity}}</td>
          <td class="tg td">{{aula.type}}</td>
          <td class="tg td">{{aula.availability}}</td>
        </tr>
      </tbody>
    </table>
    <!-- FINE WAITING -->
    <!-- <table class="tg" v-else>
      <thead>
        <tr>
          <th class="tg th">Aula</th>
          <th class="tg th">Edificio</th>
          <th class="tg th">Piano</th>
          <th class="tg th">Capienza</th>
          <th class="tg th">Tipo</th>
          <th class="tg th">Disponibilità</th>
          <th class="tg th">Check-in</th>
          <th class="tg th">Check-out</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aula in listAule" :key="aula.id">
          <td class="tg td">{{aula.code}}</td>
          <td class="tg td">{{aula.building_name}}</td>
          <td class="tg td">{{aula.floor}}</td>
          <td class="tg td">{{aula.capacity}}</td>
          <td class="tg td">{{aula.type}}</td>
          <td class="tg td">{{aula.availability}}</td>
          <td class="tg td">
            <router-link to="/check/" + aula.id></router-link>
          </td>
            <td class="tg td">
            <router-link></router-link>
          </td>
        </tr>
      </tbody>
    </table> -->
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
      show: false,
      address: null,
    };
  },
  props: ["listAule", "waiting", "gestisce","inizio"],
  methods: {
    showMap(building, floor,building_name) {
      if (!this.show) {
        axios
          .get(`http://127.0.0.1:8000/api/maps/${building}/${floor}`)
          .then(res => {
            console.log(res);
            this.image = res.data.data.floor_map;
            this.address = building_name + " piano " + floor + ", " + res.data.data.address;
            this.show = true;
            bus.$emit("imgSend", { img: this.image, address: this.address, show: this.show });
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
          axios
            .get(`http://127.0.0.1:8000/api/classrooms/${id}/delete`)
            .then(() => {
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
    apri_chiudi(id, state) {
      if (state == "closed") {
        axios
          .patch(`http://127.0.0.1:8000/api/classrooms/${id}`, {
            state: "open"
          })
          .then(() => {
            this.$router.push("/redirectDeleteAule");
            swal({
              text: "Aula aperta",
              icon: "success"
            });
          });
      } else {
        axios
          .patch(`http://127.0.0.1:8000/api/classrooms/${id}`, {
            state: "closed"
          })
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
