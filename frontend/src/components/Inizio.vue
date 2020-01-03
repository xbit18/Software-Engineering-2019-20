<template>
<div>
<section>
    <div class="title">
        <h1>Visualizza Aule Disponibili</h1>
    </div>
    <Aule :listAule="listAule"></Aule>
</section>
<Sidebar></Sidebar>
</div>
</template>

<script>
import Aule from './Aule.vue';
import axios from 'axios';
import Sidebar from './Sidebar.vue';
export default {
    name: 'Inizio',
    components:{
        Aule,
        Sidebar
    },
    data(){
        return {
            listAule: ''
        }
    },
    methods: {
        getListAule(){
            axios.get("https://reqres.in/api/users?page=2")
            .then(res => {
                    this.listAule = res.data.data;
                }
            )
        }
    },
    mounted(){
        this.getListAule();        
    }
}
</script>