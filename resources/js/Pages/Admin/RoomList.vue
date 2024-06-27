<template>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Hostel Name</th>
                    <th class="px-4 py-2">Room Type</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Duration</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(room, index) in rooms" :key="index">
                    <td class="border px-4 py-2">{{ room.hostel.name }}</td>
                    <td class="border px-4 py-2">{{ room.type }} Bed</td>
                    <td class="border px-4 py-2">
                        <span
                            :class="{
                                'text-green-600 bg-green-100/90': room.status,
                                'text-main-primary bg-main-secondary':
                                    !room.status,
                            }"
                            class="px-2 py-1 font-semibold leading-tight rounded-full"
                        >
                            {{ room.status ? "Available" : "Closed" }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">{{ room.price }}</td>
                    <td class="border px-4 py-2">Per {{ room.duration }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex items-center space-x-4 text-sm">
                            <Link
                                :href="route('admin.room.show', room.id)"
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
                                :href="route('admin.room.edit', room.id)"
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
                            <Button
                                type="danger"
                                @click="showConfirmationModal(room.id)"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-main-primary rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Delete"
                            >
                                <svg
                                    class="w-5 h-5"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </Button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <Modal :show="isDeleteModalOpen" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Are you sure you want to delete this Room?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                You will lose everything related to this Room.
            </p>

            <div class="mt-6 flex justify-end">
                <Button type="secondary" @click="closeModal"> Cancel </Button>

                <Button
                    type="danger"
                    class="ms-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="deletehostelPost(selectedhostelPost)"
                >
                    Delete Room
                </Button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import Button from "@/Components/Button.vue";

defineProps({
    rooms: {
        type: Object,
        required: true,
    },
});

const isDeleteModalOpen = ref(false);
const selectedhostelPost = ref(null);
const isVerifyModalOpen = ref(false);
const form = useForm({ id: null });

const showConfirmationModal = (room) => {
    isDeleteModalOpen.value = true;
    selectedhostelPost.value = room;
};

const closeModal = () => {
    isDeleteModalOpen.value = false;
    isVerifyModalOpen.value = false;
};

const deletehostelPost = (room) => {
    form.delete(route("admin.room.destroy", room), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};
</script>
