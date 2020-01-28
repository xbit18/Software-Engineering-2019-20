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

  
    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
import Persone from "./Persone.vue";
export default {
  name: "listPersone",
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
      axios.get(`http://127.0.0.1:8000/api/classrooms/${searchString}/attendances`).then(res => {
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