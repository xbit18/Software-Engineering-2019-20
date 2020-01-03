<template>
  <div id="app">
    <Header></Header>
    <FooterComponent></FooterComponent>
  </div>
</template>

<script>
import Header from './components/Header.vue';
import FooterComponent from './components/FooterComponent.vue';
export default {
  name: 'app',
  components: {
    Header,
    FooterComponent
  }
}
</script>

<style>
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}*/

@import url('./assets/css/styles.css');
</style>
