<template>
  <div>
  <section class="lista" >
       <div class="title">
        <h1  v-if="listPrenotazioni.length > 0">Lista Prenotazioni</h1>
        <h1 v-else>Non ci sono prenotazioni...</h1>
      </div>
      <Prenotazioni :listPrenotazioni="listPrenotazioni"/>
  </section>
  <div class="clearfix"></div>
</div>
</template>

<script>
import Prenotazioni from './Prenotazioni.vue'
import axios from 'axios'
export default {
    name: 'myPrenotazioni',
    components:{
        Prenotazioni
    },
    data(){
        return{
            listPrenotazioni: '',
        }
    },
    mounted(){
        this.getPrenotazioni()
    },
    methods:{
        getPrenotazioni(){
            axios.get('http://127.0.0.1:8000/api/classroomreservations/me')
            .then(res =>{
                console.log(res)
                this.listPrenotazioni = res.data.data
            })
        }
    }
}
</script>

<style>

</style>