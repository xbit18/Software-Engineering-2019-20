<template>
  <div>
    <section class="lista" v-if="aula">
      <div class="title">
        <h1>Aula</h1>
      </div>
      <table class="tg">
        <thead>
          <tr>
            <th class="tg th">ID</th>
            <th class="tg th">Aula</th>
            <th class="tg th">Edificio</th>
            <th class="tg th">Capienza</th>
            <th class="tg th">Tipo</th>
            <th class="tg th">Disponibilità</th>
            <th class="tg th" v-if="isAdmin">Apri/chiudi</th>
            <th class="tg th" v-if="isAdmin">Modifica</th>
            <th class="tg th" v-if="isAdmin">Elimina</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="tg td">{{aula.id}}</td>
            <td class="tg td">{{aula.code}}</td>
            <td class="tg td">
              <router-link
                :to="{name:'edificio',params:{edificio: aula.building_id}}"
              >{{aula.building_id}}</router-link>
            </td>
            <td class="tg td">{{aula.capacity}}</td>
            <td class="tg td">{{aula.type}}</td>
            <td class="tg td">{{aula.availability}}</td>
            <td class="tg td" v-if="aula.state == 'chiusa' && isAdmin ">
              <button
                class="button button-apri/chiudi"
                @click="apri_chiudi(aula.id, aula.state)"
              >Apri</button>
            </td>
            <td class="tg td" v-else-if="aula.state == 'aperta' && isAdmin">
              <button
                class="button button-apri/chiudi"
                @click="apri_chiudi(aula.id, aula.state)"
              >Chiudi</button>
            </td>
            <td class="tg td" v-if="isAdmin">
              <router-link :to="'/editAula/'+aula.id" class="button button-modifica">Modifica</router-link>
            </td>
            <td class="tg td" v-if="isAdmin">
              <button class="button button-elimina" @click="elimina(aula.id)">Elimina</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
    <section class="lista" v-else>
      <div class="title">
        <h1>Aula non trovata</h1>
      </div>
    </section>
    <aside class="sidebar search waitingSearch">
      <div id="search" class="sidebar-item">
        <h3>Cerca</h3>
        <p>Trova una aula</p>
        <form @submit.prevent="goSearch">
          <input class="input" type="text" name="search" v-model.trim="searchString" />
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
import Aula from "../models/aula.js";
import { mapGetters } from "vuex";
export default {
  name: "Aula",
  data() {
    return {
      aula: new Aula(),
      searchString: null,
      prova: null
    };
  },
  mounted() {
    var id = this.$route.params.aula;
    this.getAula(id);
  },
  computed: {
    ...mapGetters({
      isAdmin: "auth/isAdmin"
    })
  },
  methods: {
    getAula(id) {
      console.log(typeof id);
      if (typeof id == "number") {
        axios
          .get(`http://127.0.0.1:8000/api/classrooms/${id}`)
          .then(res => {
            this.aula = res.data.data;
          })
          .catch(() => {
            if (this.isAdmin) {
              this.$router.push("/gestisceAule");
            } else {
              this.$router.push("/");
              swal({
                text: "Aula non trovata",
                icon: "error"
              });
            }
          });
      } else {
        axios
          .get(`http://127.0.0.1:8000/api/classrooms/${id}`)
          .then(res => {
            this.aula = res.data.data;
          })
          .catch(() => {
            if (this.isAdmin) {
              this.$router.push("/gestisceAule");
            } else {
              this.$router.push("/");

              swal({
                text: "Aula non trovata",
                icon: "error"
              });
            }
          });
      }
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
          axios.get(`http://127.0.0.1:8000/api/classrooms/${id}/delete`).then(res => {
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
      if (this.aula.state == "chiusa") {
        axios
          .patch(`http://127.0.0.1:8000/api/classrooms/${id}`, { state: "aperta" })
          .then(() => {
            this.$router.push(`/redirectAula/${id}`);
            swal({
              text: "Aula aperta",
              icon: "success"
            });
          });
      } else {
        axios
          .patch(`http://127.0.0.1:8000/api/classrooms/${id}`, { state: "chiusa" })
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
