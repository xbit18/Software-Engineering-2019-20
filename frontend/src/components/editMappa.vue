<template src="../views/createMappa.html">
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert'
import Mappa from '../models/mappa.js'
export default {
     name: 'editMappa',
     data(){
         return{
             file: '',
             isEdit: true,
             mappa: new Mappa(),
             edifici: '',
             building:{id:null}
         }
     },
     mounted(){
       let id = this.$route.params.mappa;
       this.getMappa(id);
       this.getEdifici();
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
                  `http://127.0.0.1:8000/api/maps/${this.mappa.id_edificio}/${this.mappa.piano}`,
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
                      text: "La mappa è stata modificata",
                      icon: "success"
                    });
                    this.$router.push("/gestisceAule");
                  }
                })
                .catch(() => {
                  swal({
                    text: 'La mappa non si è modificata',
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
         fileChange() {
      this.file = this.$refs.file.files[0];
      console.log(this.file);
    },
    getEdifici(){
            axios.get(`http://127.0.0.1:8000/api/buildings`)
            .then( res =>{
                this.edifici = res.data
            })
        },
    getMappa(id){
      axios.get(`http://127.0.0.1:8000/api/maps/${id}`)
      .then(res =>{
        this.mappa = res.data
      })
    }
     }
}
</script>

