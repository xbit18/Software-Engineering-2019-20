<template>
  <div>
    <table class="tg">
      <thead>
        <tr>
          <th class="tg th">ID</th>
          <th class="tg th">floor</th>
          <th class="tg th">Edificio</th>
          <th class="tg th">floor_map</th>

        </tr>
      </thead>
      <tbody>
        <tr v-for="mappa in listMappe" :key="mappa.id">
          <td class="tg td">{{mappa.id}}</td>
          <td class="tg td">{{mappa.name_edificio}}</td>
          <td class="tg td"><img :src="'http://localhost/progetto%20ingegneria%20software/storage/app/'+mappa.floor_map"/></td>
        </tr>
      </tbody>
    </table>
     <aside class="sidebar search">
      <div id="search" class="sidebar-item">
        <h3>Cerca</h3>
        <p>Trova la lista delle persone dentro una certa aula</p>
        <form @submit.prevent="goSearch">
          <input class="input" type="text" name="search" v-model.trim="searchString" />
          <input type="submit" name="submit" value="Cerca" class="button button-search" />
        </form>
      </div>
    </aside>
    <div class="clearfix"></div>
  </div>
</template>

<script>
export default {
    name: 'Mappe',
    props: ['listMappe']
}
</script>

<style>

</style>