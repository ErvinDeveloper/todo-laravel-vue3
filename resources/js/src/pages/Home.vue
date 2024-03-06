<template>
    <p>Главная</p>
    <router-link class="btn btn-primary" :to="{name: 'tasks'}">Перейти к задачам</router-link>
</template>

<script>
export default {
    name: "Home"
}
</script>

<style scoped>

</style>
