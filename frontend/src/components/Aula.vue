<template>
  <div>
    <section class="lista">
      <div class="title">
        <h1>Aula</h1>
      </div>
      <table class="tg" v-if="aula">
        <thead>
          <tr>
            <th class="tg th">Aula</th>
            <th class="tg th">Edificio</th>
            <th class="tg th">Capienza</th>
            <th class="tg th">Tipo</th>
            <th class="tg th">Disponibilità</th>
            <th class="tg th">Mappa</th>
            <th class="tg th">Modifica</th>
            <th class="tg th">Elimina</th>
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
              <button class="button">Mappa</button>
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
    </section>
    <aside class="sidebar search waitingSearch">
      <div id="search" class="sidebar-item">
        <h3>Cerca</h3>
        <p>Trova una aula</p>
        <form @submit.prevent="goSearch">
          <input class="input" type="text" name="search" v-model="searchString" />
          <input type="submit" name="submit" value="Cerca" class="button button-search" />
        </form>
      </div>
    </aside>
    <div class="clearfix"></div>
  </div>
</template>

<script>
import swal from "sweetalert";
import axios from "axios";
export default {
  name: "Aula",
  data() {
    return {
      aula: null,
      searchString: null
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
    },
    goSearch: function() {
      this.$router.push("/redirectAula/" + this.searchString);
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
          axios.delete("https://reqres.in/api/users/" + id).then(res => {
            console.log(res);

            swal("L'aula è stata eliminata!", {
              icon: "success"
            });
            this.$router.push("/gestisceAule");
          });
        } else {
          swal("Quasi!!");
        }
      });
    }
  }
};
</script>