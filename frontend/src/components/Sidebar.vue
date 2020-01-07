<template>
    <aside v-if="srcImg != null && srcImg != '' && show">
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
            srcImg : null,
            show: false,
        }
    },
    created(){
        bus.$on('imgSend', (data) => {
            this.srcImg = data.img;
            this.show = data.show;
        })
        bus.$on('toggle',(data)=>{
            this.show = data;
        })
    }
}
</script>