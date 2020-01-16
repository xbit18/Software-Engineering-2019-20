<template>
  <div>
    <section class="lista">
      <div class="title">
        <h1>Aula</h1>
      </div>
      <table class="tg" v-if="aula">
        <thead>
          <tr>
            <th class="tg th">ID</th>
            <th class="tg th">Aula</th>
            <th class="tg th">Edificio</th>
            <th class="tg th">Capienza</th>
            <th class="tg th">Tipo</th>
            <th class="tg th">Disponibilità</th>
            <th class="tg th">Apri/chiudi</th>
            <th class="tg th">Modifica</th>
            <th class="tg th">Elimina</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="tg td">{{aula.id}}</td>
            <td class="tg td">{{aula.codice}}</td>
            <td class="tg td">{{aula.edificio}}</td>
            <td class="tg td">{{aula.capienza}}</td>
            <td class="tg td">{{aula.tipo}}</td>
            <td class="tg td">{{aula.disponibilita}}</td>
            <td class="tg td">
              <button class="button button-apri/chiudi" @click="apri_chiudi(aula.id)">Elimina</button>
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
      axios.get(`http://127.0.0.1:8000/aule/${id}`).then(res => {
        this.aula = res.data.aula;
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
    },
    apri_chiudi(id) {
      if (this.aula.stato == "chiusa") {
        axios
          .patch(`http://127.0.0.1:8000/aule/${id}`, { stato: "aperta" })
          .then(() => {
            swal({
              text: "Aula aperta",
              icon: "success"
            });
          });
      } else {
        axios
          .patch(`http://127.0.0.1:8000/aule/${id}`, { stato: "chiusa" })
          .then(() => {
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