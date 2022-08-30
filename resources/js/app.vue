<template>
    <div class="app">
        <Navbar />
        <main class="py-4">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import Navbar from './layout/Navbar.vue';

export default {
    name: "app",
    components: { Navbar },
}
</script>

<style>

</style>