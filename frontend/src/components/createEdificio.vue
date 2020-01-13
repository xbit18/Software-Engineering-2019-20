<template src="../views/createEdificio.html"></template>

<script>
import axios from "axios";
import Edificio from "../models/edificio.js";
import swal from 'sweetalert';
export default {
  name: "createEdificio",
  data() {
    return {
      isEdit: false,
      edificio: new Edificio(),
    };
  },
   methods: {
    save() {
      console.log(this.edificio);
    
    axios
        .post("https://reqres.in/api/users/", this.edificio)
        .then(res => {
          if(res.status == 201){
             console.log(res);
          }
        })
        .catch(e =>{
          console.log(e);
        }); 
      swal({
        text: "L'edificio è stato creato",
        icon: "success"
      });
      this.$router.push("/gestisceEdifici");
    }
  }
};
</script>