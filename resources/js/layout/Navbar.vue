<template>
    <nav class="mynav">
        <div class="logo">
            <h4>
                <router-link :to="{ name: 'home' }">Event-Manager</router-link>
            </h4>
        </div>
        <ul class="nav-links">
          <li><router-link :to="{ name: 'home' }"> Home </router-link></li>
          <li><router-link :to="{ name: 'list-events' }"> Events </router-link></li>

        </ul>
    </nav>
</template>

<script>
export default {
    name: 'navbar',
}
</script>

<style>

</style>