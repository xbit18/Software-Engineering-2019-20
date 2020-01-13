<template>
    <h1>Redirecting...</h1>
</template>

<script>
export default {
    name:'RedirectEdificio',
    mounted(){
        var searchString = this.$route.params.edificio;
        this.$router.push('/edificio/'+searchString);
    }
}
</script>