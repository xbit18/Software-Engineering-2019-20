<template>
  <div class="center">
    <section class="edit">
      <div class="title">
        <h1>Effettua Check-in</h1>
      </div>
      <form class="mid-form">
        <div id="token">
          <h3>Token</h3>
          <p>{{token}}</p>
        </div>

        <label for="token">Codice Token</label>
        <input type="text" name="token" v-model="actualToken" required />

        <label for="materia">Materia</label>
        <input type="text" name="materia" v-model="materia" />

        <input type="submit" value="Check" class="button button-success" />
      </form>
    </section>

    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";
export default {
  name: "CheckIn",
  data() {
    return {
      token: "",
      actualToken: "",
      materia: "",
      listToken: ""
    };
  },
  methods: {
    getTokens(id) {
      axios
        .get(`http://127.0.0.1:8000/api/tokens/classroom/${id}`)
        .then(res => {
          this.listToken = res.data.data;
          console.log(this.listToken);
        })
        .catch(e => {
          console.log(e);
        });
    },
    effettua() {
      axios
        .post(`http://127.0.0.1:8000/checkin`, {
          code: this.actualToken,
          subject: this.materia
        })
        .then(() => {
          swal({
            text: "Check in effettuato",
            icon: "succeess"
          });
        });
    }
  },
  mounted() {
    let aula_id = this.$route.params.aula;
    this.getTokens(aula_id);

    let i = 0;
    setInterval(() => {
      axios
        .post(
          `http://127.0.0.1:8000/api/tokens/${aula_id}/${this.listToken[i].id}/validate`
        )
        .then(() => {
          console.log(this.listToken[i].id);
          this.token = this.listToken[i].code;
          i++;
          if (i >= 5) {
            i = 0;
          }
        });
    }, 5000);
  }
};
</script>
