<template>
  <div>
    <section class="lista">
      <div class="title">
        <h1>Lista Persone</h1>
      </div>
      <div v-if="listPersone">
        <Persone :listPersone="listPersone"></Persone>
      </div>
      <div id="mid" v-else>
        <h2>Aula non trovata</h2>
      </div>
    </section>

    <aside class="sidebar search">
      <div id="search" class="sidebar-item">
        <h3>Cerca</h3>
        <p>Trova la lista delle persone dentro una certa aula</p>
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
import axios from "axios";
import Persone from "./Persone.vue";
export default {
  name: "InfoAula",
  components: {
    Persone
  },
  data() {
    return {
      listPersone: null,
      searchString: null
    };
  },

  methods: {
    getListPersone(searchString) {
      axios.get("https://reqres.in/api/users?page=" + searchString).then(res => {
        this.listPersone = res.data.data;
        console.log(this.listPersone);
      });
    },
    goSearch: function() {
      this.$router.push("/redirectPersone/" + this.searchString);
    }
  },
  mounted() {
    this.searchString = this.$route.params.aula;
    this.getListPersone(this.searchString);
  }
};
</script>