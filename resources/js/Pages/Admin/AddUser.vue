<template>
    <AuthenticatedLayout>
        <Head title="Add New User" />
        <section class="mx-auto bg-white rounded p-4 lg:p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Add User</h2>
            </header>

            <form @submit.prevent="form.post(route('admin.user.store'))" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="name"
                        v-model="form.name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        autocomplete="email"
                        v-model="form.email"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                        v-model="form.password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel for="confirm_password" value="Confirm Password" />
                    <TextInput
                        id="confirm_password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
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

                <div class="mt-6 mb-4">
                    <Button type="submit">Save</Button>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
    import { Head, useForm } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import Button from '@/Components/Button.vue';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: 'user',
    });
</script>
