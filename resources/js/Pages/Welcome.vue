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
        "/events",

    );
    }else{
  Inertia.get(
        "/events",
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
              <Link
                className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                :href="route('events.index')"
              >
                Back
              </Link>
            </div>

            <form>
              <div className="flex flex-col">
                <div className="mb-4">
                  <InputLabel for="name" value="Name" />

                  <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    disabled
                  />
                </div>

                <div className="mb-4">
                  <InputLabel for="slug" value="slug" />

                  <TextInput
                    id="slug"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.slug"
                    disabled
                  />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
