<template>
  <table class="tg">
    <thead>
      <tr>
        <th class="tg th">Aula</th>
        <th class="tg th">Edificio</th>
        <th class="tg th">Capienza</th>
        <th class="tg th">Tipo</th>
        <th class="tg th">Disponibilità</th>
        <th class="tg th">Mappa</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="aula in listAule" :key="aula.id">
        <td class="tg td">{{aula.id}}</td>
        <td class="tg td">{{aula.email}}</td>
        <td class="tg td">{{aula.first_name}}</td>
        <td class="tg td">{{aula.last_name}}</td>
        <td class="tg td">
          <img :src="aula.avatar" />
        </td>
        <td class="tg td">
          <button class="button" @click="showMap(aula.avatar)">Mappa</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { bus } from "../main.js";
export default {
  name: "Aule",
  data() {
    return {
      image: null,
      show: false
    };
  },
  props: ["listAule"],
  methods: {
    showMap(mappa) {
      if (!this.show) {
        this.image = mappa;
        this.show = true;
        bus.$emit("imgSend", { img: this.image, show: this.show });
        
      } else if(this.image == mappa){
        this.show = false;
        bus.$emit("toogle", this.show );
      }else{
       this.image = mappa;
        bus.$emit("imgSend", { img: this.image, show: this.show });
      }
    }
  }
};
</script>