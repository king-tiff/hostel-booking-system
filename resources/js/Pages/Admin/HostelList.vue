<template>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
          <table class="w-full table-auto">
              <thead>
                  <tr>
                      <th class="px-4 py-2 text-left">Hostel Owner</th>
                      <th class="px-4 py-2 text-left">Hostel Name</th>
                      <th class="px-4 py-2 text-left">Location</th>
                      <th class="px-4 py-2 text-left">Status</th>
                      <th class="px-4 py-2 text-left">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="(hostel, index) in hostels" :key="index">
                    <td class="border px-4 py-2">{{ hostel.user.name }}</td>
                      <td class="border px-4 py-2">{{ hostel.name }}</td>
                      <td class="border px-4 py-2">{{ hostel.location }}</td>
                      <td class="border px-4 py-2">
                          <span :class="{
                                  'text-green-600 bg-green-100/90': hostel.is_verified,
                                  'text-main-primary bg-main-secondary': !hostel.is_verified,
                              }"
                              class="px-2 py-1 font-semibold leading-tight rounded-full">
                              {{ hostel.is_verified ? "Verified" : "Pending" }}
                          </span>
                      </td>
                      <td class="border px-4 py-2">
                          <div class="flex items-center space-x-4 text-sm">
                            <Link class="px-2 py-2">
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
                                            class="feather feather-eye stroke-main-primary h-5 w-5"
                                        >
                                            <path
                                                d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                            ></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </Link>
                              <Link :href="route('admin.hostel.edit', hostel.id)"
                                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-main-primary rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                  aria-label="Edit">
                                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                      <path
                                          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                      </path>
                                  </svg>
                              </Link>
                              <Button type="danger" @click="showConfirmationModal(hostel.id)"
                                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-main-primary rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                  aria-label="Delete">
                                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd"
                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                          clip-rule="evenodd"></path>
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
                      Are you sure you want to delete this hostel?
                  </h2>
  
                  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                      You will lose everything related to this hostel.
                  </p>
  
                  <div class="mt-6 flex justify-end">
                      <Button type="secondary" @click="closeModal"> Cancel </Button>
  
                      <Button type="danger"
                          class="ms-3"
                          :class="{ 'opacity-25': form.processing }"
                          :disabled="form.processing"
                          @click="deletehostelPost(selectedhostelPost)"
                      >
                          Delete hostel
                      </Button>
                  </div>
              </div>
          </Modal>
  </template>
  
  <script setup>
  import { ref, defineProps } from "vue";
  import { Link, useForm } from "@inertiajs/vue3";
  import Modal from "@/Components/Modal.vue";
  import Button from "@/Components/Button.vue";
  
  defineProps({
      hostels: {
          type: Object,
          required: true,
      },
  });
  
  const isDeleteModalOpen = ref(false);
  const selectedhostelPost = ref(null);
  const isVerifyModalOpen = ref(false);
  const form = useForm({ id: null });
  
  const showConfirmationModal = (hostel) => {
      isDeleteModalOpen.value = true;
      selectedhostelPost.value = hostel;
  };
  
  const closeModal = () => {
      isDeleteModalOpen.value = false;
      isVerifyModalOpen.value = false;
  };
  
  const deletehostelPost = (hostel) => {
      form.delete(route('admin.hostel.destroy', hostel), {
          preserveScroll: true,
          onSuccess: () => closeModal(),
      });
  };
  </script>
  
  