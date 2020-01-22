<template>
  <table class="tg">
    <thead>
      <tr>
        <th class="tg th">Edificio</th>
        <th class="tg th">Nome</th>
        <th class="tg th">Numero aule</th>
        <th class="tg th">Indirizzo</th>
        <th class="tg th" v-if="isAdmin">Modifica</th>
        <th class="tg th" v-if="isAdmin">Elimina</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="edificio in listEdifici" :key="edificio.id">
        <td class="tg td">
          <router-link :to="{name:'edificio',params:{edificio: edificio.id}}">{{edificio.id}}</router-link>
        </td>
        <td class="tg td">{{edificio.nome}}</td>
        <td class="tg td">{{edificio.numero_aule}}</td>
        <td class="tg td">{{edificio.indirizzo}}</td>
        <td class="tg td" v-if="isAdmin">
          <router-link :to="'/editEdificio/'+edificio.id" class="button button-modifica">Modifica</router-link>
        </td>
        <td class="tg td" v-if="isAdmin">
          <button class="button button-elimina" @click="elimina(edificio.id)">Elimina</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";
import { mapGetters } from 'vuex';
export default {
  name: "gestisceEdifici",
  props: ["listEdifici"],
  methods: {
    ...mapGetters({
      isAdmin : 'auth/isAdmin'
    }),

    elimina(id) {
      swal({
        title: "Sei sicuro ?",
        text: "Una volta eliminata non sarà possibile recuperare l'edificio!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios.get(`http://127.0.0.1:8000/buildings/${id}/delete`).then(res => {
            console.log(res);
            this.$router.push('/redirectDeleteEdificio');
            swal("L'edificio è stato eliminato!", {
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