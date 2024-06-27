<template>
    <AuthenticatedLayout>
        <div class="grid gap-6 mb-8 grid-cols-1 lg:grid-cols-4">
            <Card
                class="fill-main-primary"
                label="Total Bookings"
                :value="totalBooking"
            >
                <template v-slot:icon>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-book stroke-main-primary"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path
                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"
                        ></path>
                    </svg>
                </template>
            </Card>
            <Card
                class="fill-main-primary"
                label="Pending Bookings"
                :value="pendingBooking"
            >
                <template v-slot:icon>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-book stroke-main-primary"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path
                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"
                        ></path>
                    </svg>
                </template>
            </Card>
            <Card
                class="fill-main-primary"
                label="Accepted Bookings"
                :value="acceptedBooking"
            >
                <template v-slot:icon>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-book stroke-main-primary"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path
                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"
                        ></path>
                    </svg>
                </template>
            </Card>
            <Card
                class="fill-main-primary"
                label="Rejected Bookings"
                :value="rejectedBooking"
            >
                <template v-slot:icon>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-book stroke-main-primary"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path
                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"
                        ></path>
                    </svg>
                </template>
            </Card>
        </div>
        <BookingList :bookings="bookings" />
    </AuthenticatedLayout>
</template>

<script setup>
import { computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from "@/Components/Cards/Card.vue";
import BookingList from "./BookingList.vue";

const props = defineProps({
    bookings: Array,
});

const totalBooking = computed(() => {
    return props.bookings.length;
});

const pendingBooking = computed(() => {
    return props.bookings.filter((booking) => booking.status == 'Pending').length;
});

const acceptedBooking = computed(() => {
    return props.bookings.filter((booking) => booking.status == 'Accepted').length;
});

const rejectedBooking = computed(() => {
    return props.bookings.filter((booking) => booking.status == 'Rejected').length;
});

</script>
