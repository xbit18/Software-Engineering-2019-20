<template src="../views/createAula.html"></template>

<script>
import axios from "axios";
import Aula from "../models/aula.js";
import Mappa from "../models/mappa.js"
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
  },
  methods: {
    save() {
      this.aula.id_edificio = this.building.id;
      this.aula.nome = this.building.nome;
      axios.post(`http://127.0.0.1:8000/aule`, this.aula).then(res => {
        if (res.status == 201) {
          if (this.file != null && this.file != "" && this.file != undefined) {
            formData.append("file0", this.file, this.file.name);
              const formData = new FormData();
             let mappa = new Mappa(null,formData,this.aula.piano,this.aula.id_edificio);
             console.log(mappa);
             axios.post(`http://127.0.0.1:8000/mappe`,mappa)
              .then(res => {
                if (res.data) {
                  this.aula = res.data;
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
          }else {
              this.aula = res.data;
               this.$router.push('/gestisceAule');
            }
        }
      })
        .catch(e =>{
          console.log(e);
        }); 
        swal({
          text: "L'aula è stato creata",
          icon: "success"
        });
        setTimeout(() => {
          this.$router.push("/gestisceAule");
        }, 1000);
    
    },
    getEdifici() {
      axios.get("http://127.0.0.1:8000/edifici").then(res => {
        console.log(res);
        this.edifici = res.data;
      });
    },
    fileChange() {
      this.file = this.$refs.file.files[0];
      console.log(this.file);
  }
  }
};
</script>