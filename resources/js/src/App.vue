<template>
    <Navbar/>
    <main class="container">
        <router-view/>
    </main>
</template>
<script lang="js">
import { defineComponent } from 'vue';
import Navbar from "@/src/components/Navbar.vue";

export default defineComponent({
    components: {Navbar},
    setup() {
        return {
            username: 'Ervin'
        }
    }
})
</script>
