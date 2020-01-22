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
              const formData = new FormData();
              formData.append("mappa", this.file);
              formData.append("piano", this.mappa.piano);
              formData.append("id_edificio", this.mappa.id_edificio);
              axios
                .post(
                  `http://127.0.0.1:8000/maps`,
                  formData,
                  {
                    headers: {
                      "Content-Type": "multipart/form-data"
                    }
                  }
                )
                .then(res => {
                  if (res.data) {
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
            axios.get(`http://127.0.0.1:8000/buildings`)
            .then( res =>{
                this.edifici = res.data
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