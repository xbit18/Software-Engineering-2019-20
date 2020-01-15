<template>
  <header>
    <div id="top">
      <div id="logo-div">
        <img id="logo-univaq" src="../assets/img/logo.png" />
      </div>
      <div id="form-div" v-if="!authenticated">
        <form @submit.prevent="submit()">
          <input
            class="input"
            type="text"
            id="email"
            name="email"
            placeholder="email"
            required
            v-model="utente.email"
          />
          <input
            class="input"
            type="password"
            id="passwd"
            name="passwd"
            placeholder="password"
            required
            v-model="utente.password"
          />
          <button class="button" type="submit">LOGIN</button>
        </form>
      </div>
    </div>
    <a id="logout" class="button" v-if="authenticated">LOGOUT</a>

    <Slide :right="true">
      <router-link to="/">
        <span>Home</span>
      </router-link>

      <router-link to="/check" v-if="authenticated">
        <span>Check-in</span>
      </router-link>

      <router-link to="/" v-if="authenticated">
        <span>Prenota un posto</span >
      </router-link>

      <router-link to="/" v-if="authenticated && (user.tipo == 'admin' || user.tipo =='docente')">
        <span>Prenota Aula</span>
      </router-link>

       <router-link to="/" v-if="authenticated && user.tipo == 'admin'">
        <span>Prenotazioni</span>
      </router-link>

      <router-link to="/gestisceAule" v-if="authenticated && user.tipo == 'admin'">
        <span>Gestisci aule</span>
      </router-link>

      <router-link to="/gestisceEdifici" v-if="authenticated && user.tipo == 'admin'">
        <span>Gestisci edifici</span>
      </router-link>
      

      <router-link to="/createAula" v-if="authenticated && user.tipo == 'admin'">
        <span>Crea Aula</span>
      </router-link>

      <router-link to="/createEdificio" v-if="authenticated && user.tipo == 'admin'">
        <span>Crea Edificio</span>
      </router-link>

      <router-link to="/" v-if="authenticated && user.tipo == 'admin'">
        <span>Apri/chiudi aule</span>
      </router-link>

      <router-link to="/searchAula" v-if="authenticated && user.tipo == 'admin'">
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
import { mapActions } from 'vuex';
import { mapGetters } from 'vuex';
// import axios from "axios";
import Utente from "../models/utente.js";
export default {
  name: "Header",
  components: {
    Slide
  },
  data() {
    return {
      utente: new Utente(),
    };
  },
  computed:{
    ...mapGetters({
      authenticated: 'auth/authenticated',
      user: 'auth/user'
    })
  },
  methods: {
    ...mapActions({
      login: 'auth/login'
    }),
    submit() {
     //
     this.login(this.utente).then(() => {
       this.$router.push('/');
     }).catch((e) => {
       console.log(e);
     })
    }
  }
};
</script>
