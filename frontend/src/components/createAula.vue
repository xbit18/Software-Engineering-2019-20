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
      aule: null,
      file: null,
      edifici: null,
      building: { id: null, nome: null }
    };
  },
  mounted() {
    this.getEdifici();
    this.getAule();
  },
  methods: {
    save() {
      console.log(this.aula);
      this.aula.id_edificio = this.building.id;
      this.aula.nome = this.building.nome;
      axios.post(`http://127.0.0.1:8000/aule`, this.aula).then(res => {
        console.log(res);
        swal({
          text: "L'aula è stato creata",
          icon: "success"
        });
        setTimeout(() => {
          this.$router.push("/gestisceAule");
        }, 1000);
      });
    },
    getEdifici() {
      axios.get("http://127.0.0.1:8000/edifici").then(res => {
        console.log(res);
        this.edifici = res.data;
      });
    },
    getAule() {
      axios.get("http://127.0.0.1:8000/aule").then(res => {
        console.log(res);
        this.aule = res.data;
      });
    }
  }
};
</script>