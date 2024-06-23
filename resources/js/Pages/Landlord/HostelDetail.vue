<template>
    <AuthenticatedLayout>
        <Head :title="`Hostel: ${hostel.name}`" />
        <div class="p-6 bg-white rounded-lg shadow-md mb-6">
            <h1 class="text-2xl font-bold mb-4">{{ hostel.name }}</h1>
            <p class="mb-4">{{ hostel.description }}</p>

            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Images</h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"
                >
                    <div
                        v-for="image in hostel.images"
                        :key="image.id"
                        class="relative"
                    >
                        <img
                            :src="`/storage/${image.image_path}`"
                            alt="Hostel Image"
                            class="w-full h-auto"
                        />
                        <button
                            @click="showConfirmationModal(image.id)"
                            class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                class="w-5 h-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <form
                @submit.prevent="submitForm"
                enctype="multipart/form-data"
                class="mb-4"
            >
                <div class="mb-4">
                    <InputLabel for="image" value="Add Images" />
                    <input
                        type="file"
                        id="image"
                        @change="handleFileUpload"
                        class="mt-1 block w-full"
                    />
                    <InputError class="mt-2" :message="form.errors.image" />
                </div>
                <Button :disabled="form.processing">Add Image</Button>
            </form>

            <Link :href="route('landlord.hostel.index')" class="text-blue-500"
                >Back to Hostels</Link
            >
        </div>
        <Modal :show="isDeleteModalOpen" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Are you sure you want to delete this Image?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    You will lose everything related to this image.
                </p>

                <div class="mt-6 flex justify-end">
                    <Button type="secondary" @click="closeModal">
                        Cancel
                    </Button>

                    <Button
                        type="danger"
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteImagePost(selectImagePost)"
                    >
                        Delete Image
                    </Button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Button from "@/Components/Button.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    hostel: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    image: null,
});

const handleFileUpload = (event) => {
    form.image = event.target.files[0];
};

const submitForm = () => {
    form.post(route("landlord.hostel.addImage", props.hostel.id));
};

const isDeleteModalOpen = ref(false);
const selectImagePost = ref(null);

const showConfirmationModal = (imageId) => {
    isDeleteModalOpen.value = true;
    selectImagePost.value = imageId;
};

const closeModal = () => {
    isDeleteModalOpen.value = false;
};

const deleteImagePost = (imageId) => {
    form.delete(route("landlord.hostel.deleteImage", imageId), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};
</script>
