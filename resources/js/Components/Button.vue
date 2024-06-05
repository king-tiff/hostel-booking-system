<script setup>
defineProps({
    textSize: {
        type: String,
        default: "small",
        validator(value) {
            return ["small", "large"].includes(value);
        },
    },
    type: {
        type: String,
        default: "primary",
        validator(value) {
            return ["primary", "secondary", "danger"].includes(value);
        },
    },
});
</script>
<template>
    <button
        class="inline-flex items-center px-4 justify-center py-2 border rounded-md font-semibold uppercase tracking-widest shadow-sm disabled:opacity-25 transition ease-in-out duration-150"
        :class="{
            'bg-main-primary text-white border-transparent hover:bg-main-primary-darker dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500':
                type === 'primary',
            'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800':
                type === 'secondary',
            'bg-red-600 border-transparent text-white uppercase hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800':
                type === 'danger',
            'text-xs': textSize === 'small',
            'text-sm lg:text-xl': textSize === 'large',
        }"
    >
        <slot />
    </button>
</template>
