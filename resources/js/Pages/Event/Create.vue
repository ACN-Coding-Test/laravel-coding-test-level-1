<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

    const form = useForm({
        name: '',
        slug: ''
    });

    const submit = () => {
        form.post(route('events.store'));
    };

    </script>

    <template>
        <Head title="Dashboard" />

        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create Event
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

                            <form name="createForm" @submit.prevent="submit">
                                    <div className="flex flex-col">
                                        <div className="mb-4">

                                            <InputLabel for="name" value="Name" />

                                            <TextInput
                                                id="name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.name"
                                                autofocus />

                                            <span className="text-red-600" v-if="form.errors.name">
                                                {{ form.errors.name }}
                                            </span>
                                        </div>

                                        <div className="mb-4">

                                            <InputLabel for="slug" value="slug" />

                                            <TextInput
                                                id="slug"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.slug"
                                                autofocus />

                                            <span className="text-red-600" v-if="form.errors.slug">
                                                {{ form.errors.slug }}
                                            </span>
                                        </div>

                                    </div>

                                    <div className="mt-4">
                                        <button
                                            type="submit"
                                            className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                                        >
                                            Save
                                        </button>
                                    </div>
                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </template>
