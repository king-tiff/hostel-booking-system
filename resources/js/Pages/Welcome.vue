<script setup>
import { Head, Link } from "@inertiajs/vue3";
import UnauthenticatedLayout from "@/Layouts/UnauthenticatedLayout.vue";
import Hero from "./Home/Partials/Hero.vue";
import RoomCategory from "./Home/Partials/RoomCategory.vue";
import RoomDetailsCard from "@/Components/Cards/RoomDetailsCard.vue";
import FeatureSection from "./Home/Partials/FeatureSection.vue";
import TestimonialSection from "./Home/Partials/TestimonialSection.vue";

({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
const props = defineProps({
    rooms: {
        type: Array,
        required: true,
    },
    filters: {
        type: Object,
        required: true,
    },
    componentRoute: {
        type: String,
        default: "home",
    },
});
</script>

<template>
    <Head title="Welcome" />

    <UnauthenticatedLayout>
        <div
            class="relative bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-main-primary selection:text-white min-h-screen"
        >
            <Hero />
            <FeatureSection />
            <RoomCategory
                :rooms="rooms"
                :filters="filters"
                :componentRoute="componentRoute"
            />
            <RoomDetailsCard :rooms="rooms" />
            <TestimonialSection />
        </div>
    </UnauthenticatedLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
