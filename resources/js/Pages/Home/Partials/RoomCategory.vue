<template>
    <div class="bg-white py-10 px-5 lg:px-auto">
        <div class="bg-white max-w-screen-md mx-auto">
            <h2 class="font-black text-5xl">Find Your Perfect Room</h2>
            <p>
                We list rooms and accommodations that are hand-picked and
                verified by us. No more scams!
            </p>
            <div v-if="!isFromCategoryPage" class="my-4">
                <div class="flex w-full">
                    <TextInput
                        v-model="locationFilter"
                        placeholder="Search by room Location"
                        type="text"
                        class="block w-full rounded-md"
                    />
                </div>
                <div class="flex gap-x-1 mt-3">
                    <TextInput
                        v-model="priceFilter"
                        placeholder="Search by room Price"
                        type="number"
                        class="block rounded-md w-1/3"
                    />
                    <TextInput
                        v-model="locationFilter"
                        placeholder="Search by Location"
                        type="text"
                        class="block rounded-md w-1/3"
                    />
                    <select
                        v-model="typeFilter"
                        class="block border-gray-300 rounded-md w-1/3 rounded-r-md"
                    >
                        <option value="" disabled selected hidden>
                            Room Type
                        </option>
                        <option value="Self Contain">Self Contain Room</option>
                        <option value="shared">
                            Shared Contain Room
                        </option>
                    </select>
                </div>
                <div class="flex justify-end mt-3">
                    <Button
                        v-if="isFilterApplied"
                        type="danger"
                        @click="clearFilter"
                    >
                        Clear
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, computed, onMounted } from "vue";
import Button from "@/Components/Button.vue";
import TextInput from "@/Components/TextInput.vue";
import { router, Link } from "@inertiajs/vue3";

const props = defineProps({
    rooms: {
        type: Array,
        required: true,
    },
    filters: {
        type: Object,
        required: true,
    },
    componentRoute: {
        type: String,
        default: "welcome",
    },
});

let priceFilter = ref(props.filters.price || "");
let locationFilter = ref(props.filters.location || "");
let typeFilter = ref(props.filters.type || "");
let bedsFilter = ref(props.filters.num_of_beds || "");

function clearFilter() {
    priceFilter.value = "";
    locationFilter.value = "";
    typeFilter.value = "";
    bedsFilter.value = "";
}

let filterURL = computed(() => {
    let url = new URL(route(props.componentRoute));
    if (priceFilter.value) {
        url.searchParams.append("price", priceFilter.value);
    }
    if (locationFilter.value) {
        url.searchParams.append("location", locationFilter.value);
    }
    if (typeFilter.value) {
        url.searchParams.append("type", typeFilter.value);
    }
    if (bedsFilter.value) {
        url.searchParams.append("num_of_beds", bedsFilter.value);
    }
    return url;
});

watch(
    () => filterURL.value,
    (updatedFilterURL) => {
        router.visit(updatedFilterURL, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        });
    }
);

const isFromCategoryPage = ref(false);
const isFilterApplied = computed(() => {
    return (
        priceFilter.value ||
        locationFilter.value ||
        typeFilter.value ||
        bedsFilter.value
    );
});

onMounted(() => {
    const currentURL = new URL(window.location.href);
    isFromCategoryPage.value = currentURL.pathname.includes("/categories");
});
</script>
