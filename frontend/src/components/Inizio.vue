<template>
  <div>
    <section class="lista" v-if="listAule.length > 0">
      <div class="aule">
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
      <div class="mappa">
        <h2>Mappa</h2>
      </div>
      <div id="img-wrap">
        <img
          title="mappa"
          alter="mappa"
          v-bind:src="'http://127.0.0.1:8000'+srcImg"
        />      
        </div>
        <p>{{address}}</p>

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
      address: null,
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
      this.show = data.show;
      this.address = data.address;
    });
    bus.$on("toggle", data => {
      this.show = data;
    });
  }
};
</script>
