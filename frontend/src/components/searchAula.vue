<template>
  <div v-if="listAule.length > 0">
    <section class="lista">
      <div class="title">
        <h1>Lista Aule</h1>
      </div>
      <Aule waiting="true" :listAule="listAule"></Aule>
    </section>
    <aside class="sidebar search waitingSearch">
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
import Aule from "./Aule.vue";
import axios from "axios";
export default {
  name: "searchAula",
  data() {
    return {
      searchString: null,
      listAule: ''
    };
  },
  components: {
    Aule
  },
  mounted() {
    this.getListAule();
  },
  methods: {
    goSearch: function() {
      this.$router.push("/listaPersone/" + this.searchString);
    },
    getListAule() {
      axios.get("http://127.0.0.1:8000/aule").then(res => {
        this.listAule = res.data;
      });
    }
  }
};
</script>