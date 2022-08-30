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
          <li v-if="isLogged" class="user-logged-in">Hello {{user.user.name}}!</li>
          <li v-if="!isLogged">
            <router-link v-if="!isLogged" :to="{ name: 'login' }"> <i class="mdi mdi-login"></i> Login </router-link>
          </li>
          <li v-else class="logout" @click="logout">
                <a href="#"><i class="mdi mdi-logout"></i> Logout</a>
          </li>

        </ul>
    </nav>
</template>

<script>
import { mapState, mapGetters,mapActions } from 'vuex';
export default {
    name: 'navbar',
    computed:{
        ...mapState([
        // map this.count to store.state.count
        'user',
        ]),
        ...mapGetters([
        'isLogged',
        ])
    },
    methods:{
        ...mapActions([
            'logout',
        ]),
    }
}
</script>

<style>
.user-logged-in{
    color: #e2e2e2;
    text-decoration: none;
    font-weight: bold;
    font-size: 15px;
}
.logout{
    color: #e2e2e2;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
}
</style>