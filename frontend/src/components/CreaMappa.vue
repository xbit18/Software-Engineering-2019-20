<template src="../views/createMappa.html">

</template>

<script>
import axios from 'axios'
import swal from 'sweetalert'
import Mappa from '../models/mappa.js'
export default {
    name: 'CreaMappa',
    data(){
        return{
            file:'',
            edifici: '',
            mappa: new Mappa(),
            isEdit: false,
        }
    },
    mounted(){
        this.getEdifici();
        this.see();
    },
    methods:{
        save(){
            if (
              this.file != null &&
              this.file != "" &&
              this.file != undefined
            ) {
              const map = new FormData();
              map.append("map", this.file);
              map.append("floor", this.mappa.floor);
              map.append("building_id", this.mappa.building_id);
              axios
                .post(
                  `http://127.0.0.1:8000/api/maps`,
                  map,
                  {
                    headers: {
                      "Content-Type": "multipart/form-data"
                    }
                  }
                )
                .then(res => {
                  if (res.data.data) {
                    this.file = '';
                    swal({
                      text: "La mappa è stata creata",
                      icon: "success"
                    });
                    this.$router.push("/gestisceAule");
                  }
                })
                .catch(() => {
                  swal({
                      text: 'Questa mappa esiste già!',
                      icon: 'warning'
                  })
                });
            } else {
              swal({
                      text: "Inserisci un file",
                      icon: "warning"
                    });
            }
        },
        getEdifici(){
            axios.get(`http://127.0.0.1:8000/api/buildings`)
            .then( res =>{
                this.edifici = res.data.data
            })
        },
        fileChange() {
      this.file = this.$refs.file.files[0];
      console.log(this.file);
    }
    }
}
</script>

<style>

</style>