<template>
    <h1>Redirecting...</h1>
</template>

<script>
export default {
    name:'RedirectListaPersone',
    mounted(){
        var searchString = this.$route.params.aula;
        this.$router.push('/listaPersone/'+searchString);
    }
}
</script>