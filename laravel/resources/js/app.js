import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from "vue"; //new added
import router from './router';
import EventIndex from './components/events/EventIndex'

createApp({
    components: {
        EventIndex
    }
}).use(router).mount('#app') //new added

window.Alpine = Alpine;

Alpine.start();
