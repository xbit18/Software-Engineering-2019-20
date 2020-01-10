<template src="../views/createAula.html"></template>

<script>
/* import axios from "axios"; */
import Aula from "../models/aula.js";
import swal from 'sweetalert';
export default {
  name: "createAula",
  data() {
    return {
      isEdit: false,
      aula: new Aula(),
      file: null
    };
  },
  mounted() {
   /* var id = this.$route.params.aula; */
    /* this.getAula(id); */
  },
   methods: {
    save() {
      console.log(this.aula);
    /*
    axios
        .put("https://reqres.in/api/users/", this.aula)
        .then(res => {
          if(res.status == 201){
            if(
              this.file != null &&
              this.file != '' &&
              this.file != undefined
            ){
              const formData = new FormData();
              formData.append("file0",this.file, this.file.name);
              axios.patch("URLAPI", formData)
              .then(res => {
                if(res.data.aula){
                  this.aula = res.data;
                          swal({
                             text: "L'aula è stata creata",
                              icon: 'success'
                              });
                               this.$router.push('/gestisceAule');
                }
              })
              .catch(e =>{
                console.log(e);
              });
            } else {
              this.aula = res.data;
               this.$router.push('/gestisceAule');
            }
          }
        })
        .catch(e =>{
          console.log(e);
        }); */
      swal({
        text: "L'aula è stata creata",
        icon: "success"
      });
      this.$router.push("/gestisceAule");
    },
       fileChange() {
      this.file = this.$refs.file.files[0];
      console.log(this.file);
  }
  }
};
</script>