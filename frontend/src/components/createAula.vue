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
      buildings: null
    };
  },
  mounted() {
    this.getEdifici();
  },
  methods: {
    save() {
      axios
        .post(`http://127.0.0.1:8000/api/classrooms`, this.aula)
        .then(res => {
          if (res.status == 201) {
            swal({
        text: "L'aula è state creata",
        icon: "success"
      });
      setTimeout(() => {
        this.$router.push("/gestisceAule");
      }, 1000);
          }
        })
        .catch(() => {
          
          swal({
            text: "L'aula non è stata creata",
            icon: "warning"
          })
        });
      
    },
    getEdifici() {
      axios.get("http://127.0.0.1:8000/api/buildings").then(res => {
        console.log(res);
        this.buildings = res.data.data;
      });
    }
    
  }
};
</script>