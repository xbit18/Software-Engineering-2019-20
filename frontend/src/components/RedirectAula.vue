<template>
    <h1>Redirecting...</h1>
</template>

<script>
export default {
    name:'RedirectAula',
    mounted(){
        var searchString = this.$route.params.aula;
        this.$router.push('/aula/'+searchString);
    }
}
</script>