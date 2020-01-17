<template src="../views/createEdificio.html"></template>

<script>
import axios from "axios";
import Edificio from "../models/edificio.js";
import swal from "sweetalert";
export default {
  name: "editEdificio",
  data() {
    return {
      isEdit: true,
      edificio: new Edificio()
    };
  },
  mounted() {
    var id = this.$route.params.edificio;
    this.getEdificio(id);
  },
  methods: {
    save() {
      let idEdificio = this.$route.params.edificio;
      console.log(this.edificio);
      axios
        .put(`http://127.0.0.1:8000/edifici/${idEdificio}`, this.edificio)
        .then(res => {
          console.log(res);
          if (res.status == 201) {
            console.log(res);
            swal({
              text: "L'edificio è stato modificato",
              icon: "success"
            });
            this.$router.push("/gestisceEdifici");
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    getEdificio(id) {
      axios.get(`http://127.0.0.1:8000/edifici/${id}`).then(res => {
        this.edificio = res.data;
      });
    }
  }
};
</script>