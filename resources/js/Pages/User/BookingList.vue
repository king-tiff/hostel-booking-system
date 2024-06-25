<template>
    <Head title="Bookings" />
    <section class="mx-auto bg-white rounded p-10">
        <header>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                User Bookings
            </h2>
        </header>
        <table class="min-w-full divide-y divide-gray-200 mt-6">
            <thead class="bg-gray-50">
                <tr>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Room
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Hostel
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Start Date
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        End Date
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Status
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="booking in bookings" :key="booking.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ booking.room.type }} Room
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ booking.room.hostel.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ booking.check_in_date }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ booking.check_out_date }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ booking.status }}
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                    >
                        <div class="flex items-center space-x-4 text-sm">
                            <Link
                                :href="route('bookings.show', booking.id)"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-main-primary rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Show"
                            >
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
                                    class="feather feather-eye"
                                >
                                    <path
                                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                    ></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </Link>
                            <Link
                                :href="route('bookings.edit', booking.id)"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-main-primary rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit"
                            >
                                <svg
                                    class="w-5 h-5"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                    ></path>
                                </svg>
                            </Link>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-end mb-4">
          <LinkButton
            :href="route('bookings.view')"
            title="Add Booking"
        />  
        </div>
        
    </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import LinkButton from "@/Components/LinkButton.vue";

const props = defineProps({
    bookings: Array,
});
</script>
