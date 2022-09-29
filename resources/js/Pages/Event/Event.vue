<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
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
function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route("events.destroy", id));
  }
}
</script>

    <template>
  <Head title="Events" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Events
      </h2>
    </template>
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
              <Link
                className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                :href="route('events.create')"
              >
                Create Post
              </Link>
            </div>

            <table className="table-fixed w-full">
              <thead>
                <tr className="bg-gray-100">
                  <!-- <th className="px-4 py-2 w-20">No.</th> -->
                  <th className="px-4 py-2">Title</th>
                  <th className="px-4 py-2">Body</th>
                  <th className="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="event in events.data" :key="event">
                  <!-- <td className="border px-4 py-2">{{ event.id }}</td> -->
                  <td className="border px-4 py-2">
                    <Link tabIndex="1" :href="route('events.show', event.id)">
                      {{ event.name }}
                    </Link>
                  </td>
                  <td className="border px-4 py-2">{{ event.slug }}</td>
                  <td className="border px-4 py-2">
                    <Link
                      tabIndex="1"
                      className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                      :href="route('events.edit', event.id)"
                    >
                      Edit
                    </Link>

                    <button
                      @click="destroy(event.id)"
                      tabIndex="-1"
                      type="button"
                      className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <Pagination class="mt-6" :links="events.links" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
  <!-- <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Manage Posts - Laravel 9 Vue 3 CRUD App with Vite - NiceSnippets.com
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">

                            <div className="flex items-center justify-between mb-6">
                                <Link
                                    className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                    :href="route('posts.create')"
                                >
                                    Create Post
                                </Link>
                            </div>

                            <table className="table-fixed w-full">
                                <thead>
                                    <tr className="bg-gray-100">
                                        <th className="px-4 py-2 w-20">No.</th>
                                        <th className="px-4 py-2">Title</th>
                                        <th className="px-4 py-2">Body</th>
                                        <th className="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="event in events">
                                        <td className="border px-4 py-2">{{ event.id }}</td>
                                        <td className="border px-4 py-2">{{ event.name }}</td>
                                        <td className="border px-4 py-2">{{ event.slug }}</td>
                                        <td className="border px-4 py-2">
                                            <Link
                                                tabIndex="1"
                                                className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                                :href="route('posts.edit', event.id)"
                                            >
                                                Edit
                                            </Link>

                                            <button
                                                @click="destroy(event.id)"
                                                tabIndex="-1"
                                                type="button"
                                                className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout> -->
</template>
