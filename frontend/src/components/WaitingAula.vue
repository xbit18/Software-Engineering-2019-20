<template>
  <div>
    <section class="lista">
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
import Aule from './Aule.vue'
import axios from 'axios'
export default {
  name: "WaitingAula",
   data() {
    return {
      searchString: null,
      listAule: null
    };
  },
  components:{
    Aule
  },
  mounted(){
    this.getListAule();
  },
  methods:{
      goSearch: function() {
      this.$router.push("/infoAula/" + this.searchString);
    },
     getListAule() {
      axios.get("https://reqres.in/api/users?page=2").then(res => {
        this.listAule = res.data.data;
      })
     }
  }
};
</script>