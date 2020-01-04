<template>
  <header>
    <div id="top">
      <div id="logo-div">
        <img id="logo-univaq" src="../assets/img/logo.png" />
      </div>
      <div id="form-div">
        <form>
          <input class="input" type="text" name="email" id="email" placeholder="email" required />
          <input
            class="input"
            type="password"
            name="passwd"
            id="passwd"
            placeholder="password"
            required
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

      <router-link to="/">
        <span>Gestisci aule</span>
      </router-link>

      <router-link to="/">
        <span>Gestisci edifici</span>
      </router-link>

      <router-link to="/">
        <span>Apri/chiudi aule</span>
      </router-link>

      <router-link to="/">
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
export default {
  name: "Header",
  components: {
    Slide
  }
};
</script>