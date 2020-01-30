<template>
  <div class="center">
    <section class="edit">
      <div class="title">
        <h1>Effettua Check-in</h1>
      </div>
      <form class="mid-form" @submit.prevent="effettua">
        <div id="token">
          <h3>Token</h3>
          <p>{{token}}</p>
        </div>

        <label for="token">Codice Token</label>
        <input type="text" name="token" v-model="actualToken" required />

        <input type="submit" value="Check out" class="button checkout" />
      </form>
    </section>

    <div class="clearfix"></div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";
export default {
  name: "CheckOut",
  data() {
    return {
      token: "",
      actualToken: "",
      listToken: ""
    };
  },
  methods: {
   
    changeToken(id) {
    setInterval(() => {
      axios
        .get(
          `http://127.0.0.1:8000/api/tokens/classroom/${id}`
        )
        .then(res => {
          this.token = res.data.data.code;
        })
        .catch(e => {
          console.log(e);
        })
    }, 5000);
    },
    effettua() {
      axios
        .patch(`http://127.0.0.1:8000/api/checkout`, {
          token: this.actualToken,
        })
        .then(() => {
          this.$router.push('/selectAulaToCheck');
          swal({
            text: "Checkout effettuato",
            icon: "success"
          });
        })
        .catch(()=>{
         swal({
           text: 'Checkout non effettuato',
           icon : 'warning'
         })
        })
    }
  },
  mounted() {
    let aula_id = this.$route.params.aula;
    this.changeToken(aula_id);

    
  }
};
</script>
