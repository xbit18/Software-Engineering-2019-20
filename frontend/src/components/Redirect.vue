<template>
    <h1>Redirecting...</h1>
</template>

<script>
export default {
    name:'Redirect',
    mounted(){
        var searchString = this.$route.params.aula;
        this.$router.push('/infoAula/'+searchString);
    }
}
</script>