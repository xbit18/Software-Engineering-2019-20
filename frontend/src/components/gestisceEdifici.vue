<template>
  <div>
    <section class="lista">
      <div class="title">
        <h1>Lista Edifici</h1>
      </div>
      <Edifici :listEdifici="listEdifici"></Edifici>
    </section>
    <aside class="sidebar search waitingAula">
      <div id="search" class="sidebar-item">
        <h3>Cerca</h3>
        <p>Trova un edificio</p>
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
import Edifici from "./Edifici.vue";
import axios from "axios";
export default {
  name: "gestisceEdifici",
  data() {
    return {
      searchString: '',
      listEdifici: ""
    };
  },
  components: {
    Edifici
  },
  mounted() {
    this.getEdifici();
  },
  methods: {
    goSearch: function() {
      this.$router.push("/redirectEdificio/" + this.searchString);
    },
    getEdifici() {
      axios.get("http://127.0.0.1:8000/api/buildings").then(res => {
        this.listEdifici = res.data.data;
      });
    }
  }
};
</script>