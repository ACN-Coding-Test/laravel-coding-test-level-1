require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import router from './router/router';
import store from './store/store';
import App from './app.vue';

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    store,
    created(){
        const userInfo = localStorage.getItem('user')
       
        if (userInfo) {
          const userData = JSON.parse(userInfo);
          this.$store.commit('setUserData', userData);

          // this.$store.dispatch('fetchUserGames', userData.user.id);
        }
    },
    render: h => h(App)
});