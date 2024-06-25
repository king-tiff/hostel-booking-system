<template>
    <div class="flex flex-wrap">
        <div
            v-for="room in rooms"
            :key="room.id"
            class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 mb-4"
        >
            <Link :href="route('room.show', room.id)">
                <div
                    class="relative rounded-lg overflow-hidden shadow-lg fruite-item transition-transform transform hover:scale-105 h-full"
                >
                    <div class="fruite-img h-64">
                        <img
                            :src="
                                room.images.length
                                    ? `/storage/${room.images[0].image_path}`
                                    : 'default-image-path.jpg'
                            "
                            class="w-full h-full object-cover"
                            alt="Room image"
                        />
                    </div>
                    <div
                        class="text-white bg-gray-800 bg-opacity-75 px-3 py-1 rounded absolute top-2 left-2"
                    >
                        {{ room.type }} Room
                    </div>
                    <div
                        class="p-4 border border-gray-200 rounded-b-lg bg-white flex flex-col h-full"
                    >
                        <div class="flex-grow">
                            <p class="text-gray-700 mb-4">
                                {{ room.hostel.name }} -
                                {{ room.hostel.location }}
                            </p>
                            <p class="text-black text-lg font-bold mb-0">
                                {{ room.price }}/ Per {{ room.duration }}
                            </p>
                            <a
                                :href="`/rooms/${room.id}`"
                                class="btn border border-gray-300 rounded-full px-3 py-2 text-blue-600 flex items-center hover:bg-gray-100"
                            >
                                <i
                                    class="fa fa-shopping-bag mr-2 text-blue-600"
                                ></i>
                                View More
                            </a>
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { Head } from "@inertiajs/vue3";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    rooms: {
        type: Array,
        required: true,
    },
});

const totalRooms = computed(() => props.rooms.length);
</script>

<style scoped>
.fruite-item {
    transition: transform 0.3s;
    height: 100%;
}

.fruite-img {
    height: 16rem; /* Adjust the height as needed */
}

.fruite-img img {
    object-fit: cover;
}
</style>
