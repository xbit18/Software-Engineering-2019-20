<template>
  <div>
    <section class="lista">
      <table class="tg" v-if="aula">
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
          <tr>
            <td class="tg td">{{aula.id}}</td>
            <td class="tg td">{{aula.email}}</td>
            <td class="tg td">{{aula.first_name}}</td>
            <td class="tg td">{{aula.last_name}}</td>
            <td class="tg td">
              <img :src="aula.avatar" />
            </td>
            <td class="tg td">
              <button class="button" @click="showMap(aula.avatar)">Mappa</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Aula",
  data() {
    return {
      aula: null
    };
  },
  mounted() {
    var id = this.$route.params.aula;
    this.getAula(id);
  },
  methods: {
    getAula(id) {
      axios.get("https://reqres.in/api/users/" + id).then(res => {
        this.aula = res.data.data;
      });
    }
  }
};
</script>