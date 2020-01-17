<template src="../views/createAula.html"></template>

<script>
import axios from "axios";
import Aula from "../models/aula.js";
import Mappa from "../models/mappa.js";
import swal from "sweetalert";
export default {
  name: "editAula",
  data() {
    return {
      isEdit: true,
      aula: new Aula(),
      file: null,
      building: { id: null},
      edifici: null,
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
          if(res.status == 200){
            if(
              this.file != null &&
              this.file != '' &&
              this.file != undefined
            ){
              const formData = new FormData();
              formData.append("file0",this.file, this.file.name);
             let mappa = new Mappa(null,formData,this.aula.piano,this.aula.id_edificio);
             console.log(mappa)
              axios.put(`http://127.0.0.1:8000/mappe/${this.aula.piano}/${this.aula.id_edificio}`,mappa)
              .then(res => {
                if(res.data){
                  this.aula = res.data;
                          swal({
                             text: "L'aula è stata modificata",
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
        }); 
      swal({
        text: "L'aula è stata modificata",
        icon: "success"
      });
      this.$router.push("/gestisceAule");
    },
    getEdifici() {
      axios.get("http://127.0.0.1:8000/edifici").then(res => {
        this.edifici = res.data;
      });
    },
    getAula(id) {
      axios.get(`http://127.0.0.1:8000/aule/${id}`).then(res => {
        this.aula = res.data;
      });
    },
       fileChange() {
      this.file = this.$refs.file.files[0];
      console.log(this.file);
  }
  }
};
</script>