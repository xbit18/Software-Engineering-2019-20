<template>
  <div>
    <section class="lista"  v-if="listAule.length > 0">
      <div class="title">
        <h1>Lista Aule</h1>
      </div>
      <Aule gestisce="true" :listAule="listAule"></Aule>  
    </section>
    <section class="lista"  v-else>
      <div class="title">
        <h1>Non ci sono aule da mostrare...</h1>
      </div>
    </section>
    <aside class="sidebar search waitingAula">
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
import Aule from "./Aule.vue";
import axios from "axios";
export default {
  name: "gestisceAule",
  data() {
    return {
      searchString: '',
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
      this.$router.push(`/redirectAula/${this.searchString}`);
    },
    getListAule() {
      axios.get("http://127.0.0.1:8000/aule").then(res => {
        this.listAule = res.data;
      });
    }
  }
};
</script>