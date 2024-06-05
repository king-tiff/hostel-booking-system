<script setup>
    import ToastListItem from './ToastListItem.vue';
    import { router, usePage } from '@inertiajs/vue3';
    import { ref, onUnmounted } from 'vue';

    const messages = ref([]);

    const page = usePage();

    function dismiss(index) {
        this.messages.splice(index, 1);
    }

    let removeFinishEventListener = router.on('finish', () => {
        if (page.props.flash) {
            messages.value.unshift({
                message: page.props.flash,
            });
        }
    });

    onUnmounted(() => removeFinishEventListener());
</script>
<template>
    <TransitionGroup
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs"
    >
        <ToastListItem
            v-for="(item, index) in messages"
            :key="index"
            :message="item.message"
            @dismiss="dismiss(index)"
        />
    </TransitionGroup>
</template>
