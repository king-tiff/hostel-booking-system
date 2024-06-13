<template>
    <Head title="Edit User" />
    <AuthenticatedLayout>
        <section class="mx-auto bg-white rounded p-4 lg:p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Edit User</h2>
            </header>

            <form
                @submit.prevent="form.put(route('admin.users.update', props.user.id))"
                class="mt-6 space-y-6"
            >
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
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="mt-4">
                    <InputLabel for="role" value="Role" />
                    <select
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                        v-model="form.role"
                    >
                        <option value="admin">Admin</option>
                        <option value="landlord">Landlord</option>
                        <option value="user">User</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>

                <Button :disabled="form.processing">Update User</Button>

                <!-- Display success message -->
                <p
                    v-if="form.recentlySuccessful"
                    class="text-sm text-green-600 dark:text-green-400"
                >
                    User updated successfully.
                </p>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
    import { Head, useForm } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import Button from '@/Components/Button.vue';
    import TextInput from '@/Components/TextInput.vue';
    // import 'vue-select/dist/vue-select.css';

    // Props
    const props = defineProps({
        user: {
            type: Object,
            required: true,
        },
        
    });

    const form = useForm({
        name: props.user.name,
        email: props.user.email,
        role: !props.user.roles ? props.user.roles[0].name : 'user',
        password: props.user.password,
    });
</script>
