import { ref } from 'vue'
import axios from "axios";

export default function useEvents() {
    const events = ref([])

    const getEvents = async () => {
        let response = await axios.get('/api/v1/events')
        events.value = response.data.data;
    }

    return {
        events,
        getEvents
    }
}
