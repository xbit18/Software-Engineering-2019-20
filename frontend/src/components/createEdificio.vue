<template src="../views/createEdificio.html"></template>

<script>
import axios from "axios";
import Edificio from "../models/edificio.js";
import swal from "sweetalert";
export default {
  name: "createEdificio",
  data() {
    return {
      isEdit: false,
      edificio: new Edificio()
    };
  },
  methods: {
    save() {
      console.log(this.edificio);

      axios
        .post("http://127.0.0.1:8000/api/buildings", this.edificio)
        .then(res => {
          if (res.status == 201) {
            swal({
              text: "L'edificio è stato creato",
              icon: "success"
            });
            setTimeout(() => {
              this.$router.push("/gestisceEdifici");
            }, 1000);
          }
        })
        .catch(() => {
          swal({
              text: "L'edificio già esiste",
              icon: "warning"
            })
        });
    }
  }
};
</script>