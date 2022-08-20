import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../pages/Home/Home.vue';
import Events from "../pages/Events/Events.vue";
import Event from "../pages/Events/Event.vue";
import CreateEvent from "../pages/Events/Create.vue";
import EditEvent from "../pages/Events/Edit.vue";
import Login from "../pages/Auth/Login.vue";
import Register from "../pages/Auth/Register.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes:[
        {
            path: '/home',
            component: Home,
            name:'home',
            alias: '/'
        },
        {
            path: '/events',
            component: Events,
            name:'list-events'
        },
        {
            path: '/events/:id',
            component: Event,
            name:'single-event'
        },
        {
            path: '/events/create/new',
            component: CreateEvent,
            name:'create-event'
        },
        {
            path: '/events/:id/edit',
            component: EditEvent,
            name:'edit-event'
        },
        {
            path: '/login',
            component: Login,
            name:'login'
        },
        {
            path: '/register',
            component: Register,
            name:'register'
        },
    ],
});

export default router;