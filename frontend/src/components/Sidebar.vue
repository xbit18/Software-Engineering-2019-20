<template>
    <aside v-if="srcImg != null && srcImg != ''">
    <div class="title">
        <h2>Mappa</h2>
    </div>
    <div id="img-wrap">
        <img :src="srcImg" />
    </div>
</aside>
<aside v-else></aside>
</template>

<script>
import { bus } from '../main.js'
export default {
    name: 'Sidebar',
    data(){
        return{
            srcImg : null
        }
    },
    props:['mappa'],
    created(){
        bus.$on('imgSend', (data) => {
            this.srcImg = data;
            console.log(this.srcImg);
        })
    }
}
</script>