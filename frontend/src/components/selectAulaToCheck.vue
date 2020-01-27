<template>
  <div>
    <section class="lista">
      <div class="title">
        <h1>Seleziona l'aula</h1>
      </div>
     <table class="tg">
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
            <router-link class="button button-success" :to="{name:'checkin', params:{aula: aula.id}}">Checkin</router-link>
          </td>
            <td class="tg td">
            <router-link class="button button-elimina" :to="{name:'checkout', params:{aula: aula.id}}">Checkout</router-link>
          </td>
        </tr>
      </tbody>
    </table>
    </section>

    <!-- <section class="vuoto" v-else>
      <div class="title">
        <h1>Non ci sono Aule disponibili</h1>
      </div>
    </section> -->
    <!-- Sidebar -->

    


    <div class="clearfix"></div>

    <!-- End Sidebar -->
  </div>
</template>

<script>
// import Aule from "./Aule.vue";
import axios from "axios";
export default {
  name: "selectAulaToCheck",
  components: {
    // Aule
  },
  data() {
    return {
      listAule: "",

    }
  },
  methods: {
    getListAule() {
      axios.get("http://127.0.0.1:8000/api/aule").then(res => {
        console.log(res);
        this.listAule = res.data.data;
        console.log(this.listAule)
      });
    }
  },
  mounted() {
    this.getListAule();
  }
};
</script>