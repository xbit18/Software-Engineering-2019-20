<template>
<div>
  <section class="lista" >
       <div class="title">
        <h1  v-if="listPrenotazioni.length > 0">Lista Prenotazioni</h1>
        <h1 v-else>Non ci sono prenotazioni...</h1>
      </div>
      <Prenotazioni :listPrenotazioni="listPrenotazioni"/>
  </section>
  <aside class="sidebar search waitingSearch">
      <div id="search" class="sidebar-item">
        <h3>Cerca</h3>
        <p>Trova una prenotazione</p>
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
import Prenotazioni from './Prenotazioni.vue'
import axios from 'axios'
export default {
    name: 'listPrenotazioni',
    components:{
        Prenotazioni
    },
    data(){
        return{
            listPrenotazioni: '',
            searchString: null
        }
    },
    mounted(){
        this.getPrenotazioni();
    },
    methods:{
        goSearch: function() {
      this.$router.push(`/prenotazione/${this.searchString}`);
    },
        getPrenotazioni(){
            axios.get(`http://127.0.0.1:8000/prenotazioni`)
            .then(res =>{
                this.listPrenotazioni = res.data;
            })
        }
    }
}
</script>

<style>

</style>