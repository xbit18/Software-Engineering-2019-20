<template src="../views/createAula.html"></template>

<script>
import axios from "axios";
import Aula from "../models/aula.js";
import swal from "sweetalert";
export default {
  name: "editAula",
  data() {
    return {
      isEdit: true,
      aula: new Aula(),
      building: { id: null },
      edifici: null
    };
  },
  mounted() {
    var id = this.$route.params.aula;
    this.getEdifici();
    this.getAula(id);
  },
  methods: {
    save() {
      this.aula.id_edificio = this.building.id;
      this.aula.nome = this.building.nome;
      let aulaId = this.$route.params.aula;
      axios
        .put(`http://127.0.0.1:8000/aule/${aulaId}`, this.aula)
        .then(res => {
          console.log(this.aula);
          if (res.status == 200) {
            swal({
        text: "L'aula è stata modificata",
        icon: "success"
      });
      this.$router.push("/gestisceAule");
          }
        })
        .catch(e => {
          console.log(e);
        });
      
    },
    getEdifici() {
      axios.get("http://127.0.0.1:8000/buildings").then(res => {
        this.edifici = res.data;
      });
    },
    getAula(id) {
      axios.get(`http://127.0.0.1:8000/classrooms/${id}`).then(res => {
        this.aula = res.data;
      });
    }
  }
};
</script>