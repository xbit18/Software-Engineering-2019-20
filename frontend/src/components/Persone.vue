<template>
  <table class="tg" v-if="listPersone.length > 0">
    <thead>
      <tr>
        <th class="tg th">ID</th>
        <th class="tg th">Email</th>
        <th class="tg th">Nome</th>
        <th class="tg th">Cognome</th>
        <th class="tg th">Data di Nascita</th>
        <th class="tg th">Tipo</th>
        <th class="tg th">Corso</th>
        <th class="tg th">Matricola</th>
        <th class="tg th">Numero Documento</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="persona in listPersone" :key="persona.id">
        <td class="tg td">{{persona.id}}</td>
        <td class="tg td">{{persona.email}}</td>
        <td class="tg td">{{persona.first_name}}</td>
        <td class="tg td">{{persona.last_name}}</td>
        <td class="tg td"></td>
        <td class="tg td"></td>
        <td class="tg td"></td>
        <td class="tg td"></td>
        <td class="tg td"></td>
      </tr>
    </tbody>
  </table>
  <div class="title" v-else>
    <h2>Aula non esistente...</h2>
  </div>
</template>

<script>
export default {
  name: "Persone",
  props: ["listPersone"]
};
</script>