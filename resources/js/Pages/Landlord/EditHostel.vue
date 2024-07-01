<template>
    <Head title="Edit Hostel" />
    <AuthenticatedLayout>
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Edit Hostel
                </h2>
            </header>

            <form @submit.prevent="submitForm" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="number" value="Mobile Number" />
                    <TextInput
                        id="number"
                        type="number"
                        class="mt-1 block w-full rounded-none rounded-r-md"
                        v-model="form.number"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.number" />
                </div>
                <div>
                    <InputLabel for="location" value="Location" />
                    <TextInput
                        id="location"
                        type="text"
                        class="mt-1 block w-full rounded-none rounded-r-md"
                        v-model="form.location"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.location" />
                </div>
                <div>
                    <InputLabel for="description" value="Description" />
                    <TextareaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        placeholder="Enter Room Descriptions"
                        autocomplete="job-requirements"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.description"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="payment_method" value="Payment Method" />
                    <select
                        id="payment_method"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                        v-model="form.payment_method"
                    >
                        <option value="Visa">Visa</option>
                        <option value="Tigo Pesa">Tigo Pesa</option>
                        <option value="M-pesa">M-pesa</option>
                        <option value="Airtel Money">Airtel Money</option>
                        <option value="Halo Pesa">Halo Pesa</option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.payment_method"
                    />
                </div>
                <div>
                    <InputLabel for="payment_number" value="Payment Number" />
                    <TextInput
                        id="payment_number"
                        type="number"
                        class="mt-1 block w-full rounded-none rounded-r-md"
                        v-model="form.payment_number"
                        required
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.payment_number"
                    />
                </div>
                <div class="flex items-center gap-4">
                    <div>
                        <Button :disabled="form.processing"
                            >Update Hostel</Button
                        >
                    </div>

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
                            Hostel updated successfully.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Button from "@/Components/Button.vue";
import TextInput from "@/Components/TextInput.vue";
import TextareaInput from "@/Components/TextareaInput.vue";

const props = defineProps({
    hostels: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: ref(props.hostels.name),
    number: ref(props.hostels.number),
    location: ref(props.hostels.location),
    description: ref(props.hostels.description),
    payment_method: ref(props.hostels.payment_method),
    payment_number: ref(props.hostels.payment_number),
});

const submitForm = () => {
    form.put(route("landlord.hostel.update", props.hostels.id));
};
</script>
