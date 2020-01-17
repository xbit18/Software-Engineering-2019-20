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
    <a id="logout" class="button" v-if="authenticated" @click.prevent="logOut()">LOGOUT</a>

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

      <router-link to="/prenotaAula" v-if="authenticated && (isAdmin || isDocente)">
        <span>Prenota Aula</span>
      </router-link>

       <router-link to="/listPrenotazioni" v-if="authenticated && isAdmin">
        <span>Prenotazioni</span>
      </router-link>

      <router-link to="/gestisceAule" v-if="authenticated && isAdmin">
        <span>Gestisci aule</span>
      </router-link>

      <router-link to="/gestisceEdifici" v-if="authenticated && isAdmin">
        <span>Gestisci edifici</span>
      </router-link>
      

      <router-link to="/createAula" v-if="authenticated && isAdmin">
        <span>Crea Aula</span>
      </router-link>

      <router-link to="/createEdificio" v-if="authenticated && isAdmin">
        <span>Crea Edificio</span>
      </router-link>

      <router-link to="/searchAula" v-if="authenticated && isAdmin">
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
      user: 'auth/user',
      isAdmin: 'auth/isAdmin',
      isDocente: 'auth/isDocente'
    })
  },
  methods: {
    ...mapActions({
      logInAction: 'auth/login',
      logOutAction: 'auth/logout'
    }),
    submit() {
     //
     this.logInAction(this.utente)
    },
    logOut(){
      this.logOutAction().then(() =>{
        this.$router.replace({
          name: 'inizio'
        })
      })
      .catch(e =>{
        console.log(e)
      })
    }
  }
};
</script>
