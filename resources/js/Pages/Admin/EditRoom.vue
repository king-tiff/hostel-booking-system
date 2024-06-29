<template>
    <Head title="Edit Room" />
    <AuthenticatedLayout>
        <section class="mx-auto bg-white rounded p-10">
            <header>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Edit Room
                </h2>
            </header>

            <form @submit.prevent="submitForm" class="mt-6 space-y-6">
                <div class="mt-4">
                    <InputLabel for="hostelName" value="Hostel Name" />
                    <select
                        id="hostelName"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        v-model="form.hostel_id"
                    >
                        <option
                            v-for="(item, index) in hostels"
                            :key="index"
                            :value="item.id"
                        >
                            {{ item.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.hostel_id" />
                </div>
                <div class="mt-4">
                    <InputLabel for="roomType" value="Room Type" />
                    <select
                        id="roomType"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                        v-model="form.type"
                    >
                        <option value="Self Contain">Self Contain Room</option>
                        <option value="Shared">Shared Room</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>
                <div>
                    <InputLabel for="num_of_rooms" value="Number of Rooms" />
                    <TextInput
                        id="num_of_rooms"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.num_of_rooms"
                        required
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.num_of_rooms"
                    />
                </div>
                <div>
                    <InputLabel
                        for="num_of_beds_per_room"
                        value="Number of beds per Room"
                    />
                    <TextInput
                        id="num_of_beds_per_room"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.num_of_beds_per_room"
                        required
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.num_of_beds_per_room"
                    />
                </div>
                <div>
                    <InputLabel for="price" value="Price" />
                    <TextInput
                        id="price"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.price"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.price" />
                </div>
                <div class="mt-4">
                    <InputLabel for="duration" value="Duration" />
                    <select
                        id="duration"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                        v-model="form.duration"
                    >
                        <option value="Month">Per Month</option>
                        <option value="Semister">Per Semister</option>
                        <option value="Six Months">Per Six Months</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.duration" />
                </div>

                <div>
                    <InputLabel for="description" value="Description" />
                    <TextareaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        placeholder="Enter Room Descriptions"
                        autocomplete="description"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.description"
                    />
                </div>
                <div>
                    <InputLabel for="status" value="Room Status" />
                    <SelectInput
                        v-model="form.status"
                        class="mt-1 block w-full"
                    >
                        <option value="1">Available</option>
                        <option value="0">Close</option>
                    </SelectInput>

                    <InputError class="mt-2" :message="form.errors.status" />
                </div>

                <div class="flex items-center gap-4">
                    <div>
                        <Button :disabled="form.processing">Update Room</Button>
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
                            Room updated successfully.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Button from "@/Components/Button.vue";
import TextInput from "@/Components/TextInput.vue";
import TextareaInput from "@/Components/TextareaInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    room: {
        type: Object,
        required: true,
    },
    hostels: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    hostel_id: props.room.hostel_id,
    type: props.room.type,
    price: props.room.price,
    duration: props.room.duration,
    num_of_rooms: props.room.num_of_rooms,
    num_of_beds_per_room: props.room.num_of_beds_per_room,
    status: props.room.status,
    description: props.room.description,
});

const submitForm = () => {
    form.put(route("admin.room.update", props.room.id));
};
</script>
