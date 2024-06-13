<template>
    <AuthenticatedLayout>
        <Head title="Admin Dashboard" />
        <div class="max-w-7xl mx-auto lg:px-8">
            <div class="grid gap-6 mb-20 grid-cols-2 xl:grid-cols-2">
                <Link :href="route('admin.hostels.index')">
                    <Card label="Total Hostels" :value="totalHostels">
                        <template v-slot:icon>
                            <svg
                                class="w-5 h-5 fill-main-primary"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"
                                ></path>
                                <path
                                    d="M10 5c-2.757 0-5 2.243-5 5s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5zM10 13c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3z"
                                ></path>
                            </svg>
                        </template>
                    </Card>
                </Link>
                <Link :href="route('admin.rooms.index')">
                    <Card label="Total Rooms" :value="totalRooms">
                        <template v-slot:icon>
                            <svg
                                class="w-5 h-5 fill-main-primary"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"
                                ></path>
                                <path
                                    d="M10 5c-2.757 0-5 2.243-5 5s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5zM10 13c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3z"
                                ></path>
                            </svg>
                        </template>
                    </Card>
                </Link>
                <Link :href="route('admin.bookings.index')">
                    <Card label="Total Bookings" :value="totalBookings">
                        <template v-slot:icon>
                            <svg
                                class="w-5 h-5 fill-main-primary"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"
                                ></path>
                                <path
                                    d="M10 5c-2.757 0-5 2.243-5 5s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5zM10 13c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3z"
                                ></path>
                            </svg>
                        </template>
                    </Card>
                </Link>
                <Link :href="route('admin.users.index')">
                    <Card label="Total Users" :value="totalUsers">
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
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from "@/Components/Cards/Card.vue";

const props = defineProps({
    totalHostels: Number,
    totalRooms: Number,
    totalBookings: Number,
    totalUsers: Number,
});
</script>
