<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Landlord Dashboard
                </h2>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <!-- <Card title="Total Hostels" :count="totalHostels" />
                <Card title="Total Rooms" :count="totalRooms" />
                <Card title="Total Bookings" :count="totalBookings" /> -->
            </div>

        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Card from '@/Components/Cards/Card.vue';

const props = defineProps({
    hostels: Array,
});

const totalHostels = computed(() => {
    return props.hostels.length;
});

const totalRooms = computed(() => {
    return props.hostels.reduce((acc, hostel) => acc + hostel.rooms.length, 0);
});

const totalBookings = computed(() => {
    return props.hostels.reduce((acc, hostel) => acc + hostel.rooms.reduce((roomAcc, room) => roomAcc + room.bookings.length, 0), 0);
});
</script>

