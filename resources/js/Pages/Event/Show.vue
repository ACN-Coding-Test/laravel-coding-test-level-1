<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  event: Object,
});
const form = useForm({
  name: props.event.name,
  slug: props.event.slug,
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Show Event
      </h2>
    </template>

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
  </AuthenticatedLayout>
</template>
