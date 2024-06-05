<template>
    <Head title="Add Hostel" />
    <AuthenticatedLayout>
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Add Hostel</h2>
            </header>

            <form @submit.prevent="form.post(route('landlord.hostel.store'))" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="location" value="Location" />
                    <TextInput
                        id="location"
                        type="text"
                        class="mt-1 block w-full rounded-none rounded-r-md"
                        v-model="form.location"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.location" />
                </div>
                <div>
                    <InputLabel for="description" value="Description" />
                    <TextareaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        placeholder="Enter Room Descriptions"
                        autocomplete="job-requirements"
                    />
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <div class="flex items-center gap-4">
                    <div>
                        <Button :disabled="form.processing">Add Hostel</Button>
                    </div>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >
                            Hostel Added successfully.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import Button from '@/Components/Button.vue';
    import TextInput from '@/Components/TextInput.vue';
    import TextareaInput from '@/Components/TextareaInput.vue';
    
    const form = useForm({
        name: '',
        location: '',
        description: '',
    });
</script>
