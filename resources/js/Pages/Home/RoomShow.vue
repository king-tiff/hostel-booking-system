<template>
    <Head title="Room Detail" />

    <AuthenticatedLayout>
        <div class="mx-auto bg-white rounded p-10">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold mb-4">
                    {{ room.type }} Room
                </h1>
                <p class="text-gray-700">
                    {{ room.hostel.name }} - {{ room.hostel.location }}
                </p>
                <p class="text-gray-700">
                    {{ room.price }} / Per {{ room.duration }}
                </p>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8"
            >
                <div v-for="image in room.images" :key="image.id">
                    <img
                        :src="`/storage/${image.image_path}`"
                        class="w-full h-48 object-cover rounded"
                        alt="Room image"
                    />
                </div>
            </div>
            <p class="text-gray-700"><span class="font-bold">Description: </span>{{ room.description }}</p>
            <p class="text-gray-700">
                    <span class="font-bold">Available Spaces:</span>
                    {{ available_spaces }}
                </p>
            <div v-if="available_spaces > 0">
                <Link
                    :href="route('bookings.request', room.id)"
                    target="_blank"
                    class="my-5 w-full inline-flex items-center px-4 justify-center py-2 border rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm disabled:opacity-25 transition ease-in-out duration-150 bg-main-primary text-white border-transparent hover:bg-main-primary-darker dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >Request Booking</Link
                >
            </div>
            <div v-else>
                <p class="text-red-600">
                    Rooms are fully booked. Next available date:
                    {{ formattedNextAvailableDate }}
                </p>
            </div>

            <div class="mt-4 flex items-center">
                <Link :href="route('bookings.view')" class="text-blue-500 mr-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-arrow-left"
                    >
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </Link>
                <span>Back to Rooms</span>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { format, addDays } from "date-fns";

const props = defineProps({
    room: {
        type: Object,
        required: true,
    },
    available_spaces: {
        type: Number,
        required: true,
    },
    next_available_date: {
        type: String,
        required: false,
    },
});

const formattedNextAvailableDate = props.next_available_date
    ? format(addDays(new Date(props.next_available_date), 1), "MMMM d, yyyy")
    : "N/A";
</script>
