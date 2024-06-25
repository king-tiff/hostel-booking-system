<template>
    <AuthenticatedLayout>
        <Head title="Edit Booking" />
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">
                    Edit Booking
                </h2>
            </header>
            <form @submit.prevent="submitForm" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="check_in_date" value="Check In Date" />
                    <TextInput
                        id="check_in_date"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.check_in_date"
                        required
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.check_in_date"
                    />
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
                    <InputError
                        class="mt-2"
                        :message="form.errors.check_out_date"
                    />
                </div>

                <div class="flex items-center gap-4">
                    <Button :disabled="form.processing">Update Booking</Button>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >
                            Booking updated successfully.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Button from "@/Components/Button.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    booking: Object,
});

const form = useForm({
    check_in_date: props.booking.check_in_date,
    check_out_date: props.booking.check_out_date,
    errors: {},
    processing: false,
    recentlySuccessful: false,
});

const submitForm = async () => {
    form.processing = true;
    form.put(route("bookings.update", props.booking.id));
    form.processing = false;
};
</script>
