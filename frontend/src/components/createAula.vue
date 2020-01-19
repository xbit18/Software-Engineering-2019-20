<template src="../views/createAula.html"></template>

<script>
import axios from "axios";
import Aula from "../models/aula.js";
import swal from "sweetalert";
export default {
  name: "createAula",
  data() {
    return {
      isEdit: false,
      aula: new Aula(),
      edifici: null
    };
  },
  mounted() {
    this.getEdifici();
  },
  methods: {
    save() {
      axios
        .post(`http://127.0.0.1:8000/aule`, this.aula)
        .then(res => {
          if (res.status == 201) {
            swal({
        text: "L'aula è stato creata",
        icon: "success"
      });
      setTimeout(() => {
        this.$router.push("/gestisceAule");
      }, 1000);
          }
        })
        .catch(e => {
          console.log(e);
        });
      
    },
    getEdifici() {
      axios.get("http://127.0.0.1:8000/edifici").then(res => {
        console.log(res);
        this.edifici = res.data;
      });
    }
    
  }
};
</script>