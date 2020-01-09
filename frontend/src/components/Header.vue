<template>
  <header>
    <div id="top">
      <div id="logo-div">
        <img id="logo-univaq" src="../assets/img/logo.png" />
      </div>
      <div id="form-div" v-if="!logged">
        <form @submit="login()">
          <input class="input" type="text" name="email" id="email" placeholder="email" required v-model="utente.email" />
          <input
            class="input"
            type="password"
            name="passwd"
            id="passwd"
            placeholder="password"
            required
            v-model="utente.password"
          />
          <button class="button" type="submit">LOGIN</button>
        </form>
      </div>
    </div>
    <Slide :right="true">
      <router-link to="/">
        <span>Home</span>
      </router-link>

      <router-link to="/">
        <span>Check-in</span>
      </router-link>

      <router-link to="/">
        <span>Prenota un posto</span>
      </router-link>

      <router-link to="/gestisceAule">
        <span>Gestisci aule</span>
      </router-link>

      <router-link to="/">
        <span>Gestisci edifici</span>
      </router-link>

      <router-link to="/">
        <span>Apri/chiudi aule</span>
      </router-link>

      <router-link to="/waitingAula">
        <span>Visualizza info aule</span>
      </router-link>

      <router-link to="/">
        <span>Contattaci</span>
      </router-link>

      <router-link to="/">
        <span>Aiuto</span>
      </router-link>
    </Slide>
  </header>
</template>

<script>
import { Slide } from "vue-burger-menu";
import axios from "axios";
import Utente from '../models/utente.js';
export default {
  name: "Header",
  components: {
    Slide
  },
  data() {
    return {
      utente: new Utente(),
      logged: false
    };
  },
  methods: {
    login() {
      axios
        .post("https://reqres.in/api/login",this.utente)
        .then(res => {
          if(res.status==200){
          console.log(res.data);
          this.logged = true;
          }
        })
        .catch(e=>{
          console.log(e);
        });
    }
  }
};
</script>