<template>
    <AuthenticatedLayout>
        <div class="grid gap-6 mb-8 grid-cols-1 lg:grid-cols-3">
            <Card
                class="fill-main-primary"
                label="Total Rooms"
                :value="totalRooms"
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
                label="Pending Rooms"
                :value="fullRooms"
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
                label="Available Rooms"
                :value="availableRooms"
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
        <div class="p-6 bg-white">
            <h2 class="text-2xl font-bold mb-4">Room Management</h2>
            <div class="flex justify-end mb-4">
                <LinkButton
                    :href="route('landlord.room.create')"
                    title="Add Room"
                />
            </div>
            <RoomList :rooms="rooms" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps, computed } from "vue";
import LinkButton from "@/Components/LinkButton.vue";
import RoomList from "./RoomList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from '@/Components/Cards/Card.vue';

const props = defineProps({
    rooms: {
        type: Object,
        required: true,
    },
});

const totalRooms = computed(() => {
    return props.rooms.length;
});

const fullRooms = computed(() => {
    return props.rooms.filter((room) => room.status === 0).length;
});

const availableRooms = computed(() => {
    return props.rooms.filter((room) => room.status === 1).length;
});
</script>
