<template>
<div>
    <div v-if="errors">
      <div v-for="(v, k) in errors" :key="k" class="bg-red-500 rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
        <p v-for="error in v" :key="error" class="text-sm">
          {{ error }}
        </p>
      </div>
    </div>
    <p class="mb-4 font-bold">Edit Event</p>
    <form class="space-y-6" v-on:submit.prevent="saveEvent">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="event.name">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Slug</label>
                <div class="mt-1">
                    <input type="text" name="slug" id="slug"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="event.slug">
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Save
        </button>
        <router-link :to="{ name: 'event.index' }" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Back</router-link>
    </form>
</div>
</template>

<script>
import useEvents from "../../composables/events";
import { onMounted } from "vue";
export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },
    setup(props) {
        const { errors, event, getEvent, updateEvent } = useEvents()

        onMounted(getEvent(props.id))
        
        const saveEvent = async () => {
            await updateEvent(props.id)
        }

        return {
            errors,
            event,
            saveEvent
        }
    }
}
</script>
