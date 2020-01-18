<template src="../views/createMappa.html">
  
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert'
export default {
     name: 'editMappa',
     data(){
         return{
             file: '',
             isEdit: true
         }
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
              formData.append("piano", this.aula.piano);
              formData.append("id_edificio", this.aula.id_edificio);
              axios
                .post(
                  `http://127.0.0.1:8000/mappe/${this.aula.id_edificio}/${this.aula.piano}`,
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
                .catch(e => {
                  console.log(e);
                });
            } else {
              swal({
                      text: "Inserisci un file",
                      icon: "warning"
                    });
            }
        }
     }
}
</script>

