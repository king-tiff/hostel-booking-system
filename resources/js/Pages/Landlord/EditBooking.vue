<template>
    <Head title="Edit Booking" />
    <AuthenticatedLayout>
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Edit Booking
                </h2>
            </header>

            <div class="mt-6 space-y-6">
                <div>
                    <InputLabel value="User Name" />
                    <div class="mt-1 block w-full">{{ booking.user.name }}</div>
                </div>
                <div>
                    <InputLabel value="Hostel Name" />
                    <div class="mt-1 block w-full">{{ booking.room.hostel.name }}</div>
                </div>
                <div>
                    <InputLabel value="Room Type" />
                    <div class="mt-1 block w-full">{{ booking.room.type }}</div>
                </div>
                <div>
                    <InputLabel value="Start Date" />
                    <div class="mt-1 block w-full">{{ booking.check_in_date }}</div>
                </div>
                <div>
                    <InputLabel value="End Date" />
                    <div class="mt-1 block w-full">{{ booking.check_out_date }}</div>
                </div>
                <div class="mt-4">
                    <InputLabel for="status" value="Booking Status" />
                    <select
                        id="status"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                        v-model="form.status"
                    >
                        <option value="Approved">Accepted</option>
                        <option value="Rejected">Reject</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.status" />
                </div>

                <div class="flex items-center gap-4">
                    <Button :disabled="form.processing" @click="submitForm">Update Booking</Button>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Button from '@/Components/Button.vue';

const props = defineProps({
    booking: Object,
});

const form = useForm({
    status: props.booking.status,
});

const submitForm = () => {
    form.put(route('landlord.bookings.update', props.booking.id));
};
</script>

