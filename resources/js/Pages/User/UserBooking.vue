<template>
    <AuthenticatedLayout>
        <Head title="My Bookings" />
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">My Bookings</h2>
            </header>
            <div v-if="bookings.length">
                <div v-for="booking in bookings" :key="booking.id" class="mb-6">
                    <div class="p-4 border border-gray-200 rounded-lg bg-white">
                        <h4 class="text-xl font-semibold mb-2">{{ booking.room.type }} Room</h4>
                        <p class="text-gray-700 mb-2">
                            <span class="font-bold">Hostel Name:</span> {{ booking.room.hostel.name }}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <span class="font-bold">Location:</span> {{ booking.room.hostel.location }}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <span class="font-bold">Check In Date:</span> {{ booking.check_in_date }}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <span class="font-bold">Check Out Date:</span> {{ booking.check_out_date }}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <span class="font-bold">Status:</span> {{ booking.status }}
                        </p>
                        <Link :href="route('bookings.edit', booking.id)" class="btn border border-gray-300 rounded-full px-3 py-2 text-blue-600 flex items-center hover:bg-gray-100">
                            <i class="fa fa-edit mr-2 text-blue-600"></i> Edit Booking
                        </Link>
                    </div>
                </div>
            </div>
            <div v-else>
                <p class="text-gray-700">You have no bookings.</p>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    bookings: Array,
});
</script>
