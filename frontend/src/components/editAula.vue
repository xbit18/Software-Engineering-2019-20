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
      file: null,
      building: { id: null, nome: null },
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
      console.log(this.aula);
      /*  var aulaId = this.$route.params.aula;
    axios
        .put("https://reqres.in/api/users/" + aulaId, this.aula)
        .then(res => {
          if(res.status == 201){
            if(
              this.file != null &&
              this.file != '' &&
              this.file != undefined
            ){
              const formData = new FormData();
              formData.append("file0",this.file, this.file.name);
              axios.patch("URLAPI" + ID DELL'AULA , formData)
              .then(res => {
                if(res.data.aula){
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
        }); */
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
        console.log(res);
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