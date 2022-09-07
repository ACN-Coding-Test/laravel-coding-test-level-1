require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import router from './router/router';
import App from './app.vue';

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});