<template>
  <div>
    <section class="lista">
      <div class="title">
        <h1>Visualizza Aule Disponibili</h1>
      </div>
      <Aule :listAule="listAule"></Aule>
    </section>
    <!-- Sidebar -->
  
    <aside id="sidebar mappa" v-if="srcImg != null && srcImg != '' && show">
      <div class="title">
        <h2>Mappa</h2>
      </div>
      <div id="img-wrap">
        <img :src="srcImg" />
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
      srcImg: null,
      show: false
    };
  },
  methods: {
    getListAule() {
      axios.get("https://reqres.in/api/users").then(res => {
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
    });
    bus.$on("toggle", data => {
      this.show = data;
    });
  }
};
</script>