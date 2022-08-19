import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../pages/Home/Home.vue';
import Events from "../pages/Events/Events.vue";
import Event from "../pages/Events/Event.vue";
import CreateEvent from "../pages/Events/Create.vue";
import EditEvent from "../pages/Events/Edit.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path: '/',
            component: Home,
            name:'home'
        },
        {
            path: '/home',
            component: Home,
            name:'home'
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
            path: '/events/create',
            component: CreateEvent,
            name:'create-event'
        },
        {
            path: '/events/:id/edit',
            component: EditEvent,
            name:'edit-event'
        },
    ],
});

export default router;