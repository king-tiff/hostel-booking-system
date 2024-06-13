<template>
    <div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                        >
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3 w-32">Created Date</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr
                            v-for="(user, index) in users"
                            :key="index"
                            class="text-gray-700 dark:text-gray-400"
                        >
                            <td class="px-4 py-3">
                                <p class="font-semibold">{{ user.name }}</p>
                            </td>
                            <td class="px-4 py-3 text-xs">{{ user.email }}</td>
                            <td class="px-4 py-3 text-xs">
                                {{ user.roles.length > 0 ? user.roles[0].name : 'No Role' }}
                            </td>
                            <td class="px-4 py-3 text-sm w-16">
                                {{ useFormatDate(user.created_at) }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm justify-end">
                                    <Link
                                        :href="route('admin.users.edit', user.id)"
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
                                    <Button type="secondary"
                                        @click="showResetPasswordModal(user.id)"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-main-primary rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete"
                                    >
                                        Reset Password
                                    </Button>
                                    <Button type="danger"
                                        @click="showDeleteModal(user.id)"
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
        </div>
        <!-- Delete modal -->
        <Modal :show="isDeleteModalOpen" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Confirm Delete</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Are you sure you want to delete this user?
                </p>
                <div class="mt-6 flex justify-end">
                    <Button type="secondary" @click="closeModal"> Cancel </Button>

                    <Button type="danger"
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser(selectedUser)"
                    >
                        Delete User
                    </Button>
                </div>
            </div>
        </Modal>
        <Modal :show="isResetPasswordModalOpen" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Confirm Delete</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Are you sure you want to reset this user's password?
                </p>
                <div class="mt-6 flex justify-end">
                    <Button type="secondary" @click="closeModal"> Cancel </Button>

                    <Button type="danger"
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="resetPassword(selectedUser)"
                    >
                        Reset Password
                    </Button>
                </div>
            </div>
        </Modal>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import Modal from '@/Components/Modal.vue';
    import Button from '@/Components/Button.vue';
    import { useFormatDate } from '@/Composables/format.js';


    const props = defineProps(['users']);
    const isDeleteModalOpen = ref(false);
    const selectedUser = ref(null);
    const isResetPasswordModalOpen = ref(false);

    // Form
    const form = useForm({ id: null });


    const showDeleteModal = (user) => {
        selectedUser.value = user;
        isDeleteModalOpen.value = true;
    };

    const showResetPasswordModal = (user) => {
        selectedUser.value = user;
        isResetPasswordModalOpen.value = true;
    };

    const closeModal = () => {
        isDeleteModalOpen.value = false;
        isResetPasswordModalOpen.value = false;
    };

    const deleteUser = (user) => {
        form.delete(route('admin.users.destroy', user), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
        });
    };

    const resetPassword = (user) => {
        form.patch(route('admin.users.reset', user), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
        });
    };
</script>
