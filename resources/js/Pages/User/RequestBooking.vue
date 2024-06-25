<template>
    <Head title="Request Booking" />
    <AuthenticatedLayout>
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">
                    Request Booking
                </h2>
            </header>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Applicant Name:</span> {{ user.name }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Room Type:</span> {{ room.type }} Room
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Room Price:</span> {{ room.price }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Duration:</span> Per {{ room.duration }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Hostel Name:</span> {{ room.hostel.name }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-bold">Hostel Location:</span> {{ room.hostel.location }}
                </p>
            </div>

            <form @submit.prevent="submitForm" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="check_in_date" value="Check in Date" />
                    <TextInput
                        id="check_in_date"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.check_in_date"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.check_in_date" />
                </div>

                <div>
                    <InputLabel for="check_out_date" value="Check Out Date" />
                    <TextInput
                        id="check_out_date"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.check_out_date"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.check_out_date" />
                </div>

                <div class="flex items-center gap-4">
                    <div>
                        <Button :disabled="form.processing">Request Booking</Button>
                    </div>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600"
                        >
                            Booking requested successfully.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/vue3";
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Button from "@/Components/Button.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    room: {
        type: Object,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    check_in_date: '',
    check_out_date: '',
});

const submitForm = () => {
    form.post(route('booking.store', { room_id: props.room.id }), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
