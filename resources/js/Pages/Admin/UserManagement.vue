<template>
    <AuthenticatedLayout>
        <Head title="User Management" />
        <div class="max-w-7xl mx-auto lg:px-8">
            <div class="grid gap-6 mb-20 grid-cols-2 xl:grid-cols-4">
                <Card label="All users" :value="users.length">
                    <template v-slot:icon>
                        <svg
                            class="w-5 h-5 fill-main-primary"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                            ></path>
                        </svg>
                    </template>
                </Card>
                <Card label="Admins" :value="user_count.admin">
                    <template v-slot:icon>
                        <svg
                            class="w-5 h-5 fill-main-primary"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                            ></path>
                        </svg>
                    </template>
                </Card>
                <Card label="Landlord" :value="user_count.landlord">
                    <template v-slot:icon>
                        <svg
                            class="w-5 h-5 fill-main-primary"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                            ></path>
                        </svg>
                    </template>
                </Card>
                <Card label="Users" :value="user_count.user">
                    <template v-slot:icon>
                        <svg
                            class="w-5 h-5 fill-main-primary"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                            ></path>
                        </svg>
                    </template>
                </Card>
            </div>
            <div class="flex justify-between items-center my-5">
                <h2 class="text-lg font-semibold text-gray-600">
                    User Management
                </h2>
                <LinkButton
                    :href="route('admin.user.create')"
                    title="Add User"
                />
            </div>
            <UserList :users="users" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import Card from "@/Components/Cards/Card.vue";
import UserList from "./UserList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import LinkButton from "@/Components/LinkButton.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
    user_count: {
            type: Object,
            required: true,
        },
});
</script>
