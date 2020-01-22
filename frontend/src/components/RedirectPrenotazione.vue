<template>
    <h1>Redirecting...</h1>
</template>

<script>
export default {
    name:'RedirectPrenotazione',
    mounted(){
        var searchString = this.$route.params.prenotazione;
        console.log(searchString)
        this.$router.push(`/prenotazione/${searchString}`);
    }
}
</script>