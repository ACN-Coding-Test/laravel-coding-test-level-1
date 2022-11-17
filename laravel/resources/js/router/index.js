import { createRouter, createWebHistory } from "vue-router";

import EventIndex from '../components/events/EventIndex'
import EventCreate from '../components/events/EventCreate'
import EventEdit from '../components/events/EventEdit'

const routes = [
    {
        path: '/dashboard',
        name: 'event.index',
        component: EventIndex
    },
    {
        path: '/events/create',
        name: 'event.create',
        component: EventCreate
    },
    {
        path: '/events/:id/edit',
        name: 'event.edit',
        component: EventEdit,
        props: true
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
