<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from "vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";


const props = defineProps({
    events: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});
// pass filters in search
let search = ref(props.filters.search);
watch(search, (value) => {
    if(value==""){
        Inertia.get(
        "/",

    );
    }else{
  Inertia.get(
        "/",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
    }

});
</script>

<template>
    <Head title="Welcome" />
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div className="flex items-center justify-between mb-6">
              <input
                type="text"
                v-model="search"
                placeholder="Search..."
                class="
                  bg-gray-50
                  border border-gray-300
                  text-gray-900 text-sm
                  rounded-lg
                  focus:ring-blue-500 focus:border-blue-500
                  block
                  w-60
                  p-2.5
                "
              />

            </div>

            <table className="table-fixed w-full">
              <thead>
                <tr className="bg-gray-100">
                  <!-- <th className="px-4 py-2 w-20">No.</th> -->
                  <th className="px-4 py-2">Title</th>
                  <th className="px-4 py-2">Body</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="event in events.data" :key="event">
                  <!-- <td className="border px-4 py-2">{{ event.id }}</td> -->
                  <td className="border px-4 py-2">
                    <Link tabIndex="1" :href="route('show', event.id)">
                      {{ event.name }}
                    </Link>
                  </td>
                  <td className="border px-4 py-2">{{ event.slug }}</td>

                </tr>
              </tbody>
            </table>
            <Pagination class="mt-6" :links="events.links" />
          </div>
        </div>
      </div>
    </div>
</template>
