<template>
  <div>
    <section class="lista" v-if="listAule.length > 0">
      <div class="title">
        <h1>Visualizza Aule Disponibili</h1>
      </div>
      <Aule inizio="true" :listAule="listAule"></Aule>
    </section>

    <section class="vuoto" v-else>
      <div class="title">
        <h1>Non ci sono Aule disponibili</h1>
      </div>
    </section>
    <!-- Sidebar -->

    <aside id="sidebar mappa" v-if="srcImg != null && srcImg != '' && show">
      <div class="title">
        <h2>Mappa</h2>
      </div>
      <div id="img-wrap">
        <img
          title="mappa"
          alter="mappa"
          v-bind:src="'http://localhost/progetto%20ingegneria%20software/storage/app/'+srcImg"
        />
      </div>
    </aside>

    <aside v-else></aside>
    <div class="clearfix"></div>

    <!-- End Sidebar -->
  </div>
</template>

<script>
import Aule from "./Aule.vue";
import axios from "axios";
import { bus } from "../main.js";
export default {
  name: "Inizio",
  components: {
    Aule
  },
  data() {
    return {
      listAule: "",
      srcImg: "null",
      show: false
    };
  },
  methods: {
    getListAule() {
      axios.get("http://127.0.0.1:8000/api/classrooms").then(res => {
        console.log(res);
        this.listAule = res.data.data;
      });
    }
  },
  mounted() {
    this.getListAule();
  },
  created() {
    bus.$on("imgSend", data => {
      this.srcImg = data.img;
      console.log(this.srcImg);
      this.show = data.show;
    });
    bus.$on("toggle", data => {
      this.show = data;
    });
  }
};
</script>