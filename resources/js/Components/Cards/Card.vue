<template>
    <div class="flex flex-col items-center justify-center text-center p-4 gap-y-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <div class="p-3 rounded-full dark:text-main-secondary dark:bg-main-primary">
        <slot name="icon"></slot>
      </div>
      <div>
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ label }}</p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ value }}</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      label: {
        type: String,
        required: true,
      },
      value: {
        type: [String, Number],
      },
    },
  };
  </script>
  