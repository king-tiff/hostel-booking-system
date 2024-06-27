<template>
    <AuthenticatedLayout>
        <Head title="Booking Details" />
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">
                    Booking Details
                </h2>
            </header>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Applicant Name:</span>
                    {{ booking.user.name }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Room Type:</span>
                    {{ booking.room.type }} Room
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Number of Beds in a Room:</span>
                    {{ booking.room.num_of_beds_per_room }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Room Price:</span>
                    {{ booking.room.price }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Duration:</span>
                    {{ booking.room.duration }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Hostel Name:</span>
                    {{ booking.room.hostel.name }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Hostel Location:</span>
                    {{ booking.room.hostel.location }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Check In Date:</span>
                    {{ booking.check_in_date }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Check Out Date:</span>
                    {{ booking.check_out_date }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Status:</span> {{ booking.status }}
                </p>
            </div>

            <div v-if="booking.status == 'Approved'" class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Mobile Number:</span>
                    {{ booking.room.hostel.number }}
                </p>
            </div>

            <div v-if="booking.status == 'Approved'" class="mt-4">
                <a
                    :href="route('bookings.download', booking.id)"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg"
                >
                    Download Report
                </a>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    booking: Object,
});
</script>
