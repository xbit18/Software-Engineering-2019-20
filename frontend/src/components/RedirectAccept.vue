<template>
    <h1>Redirecting...</h1>
</template>

<script>
export default {
    name:'RedirectAccept',
    mounted(){
        this.$router.push(`/listPrenotazioni`);
    }
}
</script>