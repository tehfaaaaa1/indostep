<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import SearchInput from '../../Components/SearchInput.vue';
import { computed, ref } from 'vue';
import PrimaryButton from '../../Components/PrimaryButtonGua.vue';

const props = defineProps({
    destination: Object
})
function getDay(val) {
    const last = val[val.length - 1]
    const day = last.day.slice(-1)
    // console.log(day)
    return day
}
const searchVal = ref(null)
const selectedDestination = computed(() => {
    if (!props.destination) {
        return [];
    }
    return props.destination.filter(me => {
        const searchQueryLower = searchVal.value ? searchVal.value.toLowerCase() : '';
        const expertNameLower = me.name ? me.name.toLowerCase() : '';

        const searchMatch = expertNameLower.includes(searchQueryLower);

        return searchMatch;
    })
})
const lct = window.location.origin
</script>
<template>
    <AdminLayout title="Admin|Destination List" atas="true">
        <template #search>
            <SearchInput v-model="searchVal" plch="Search Here" />
        </template>
        <div class="p-8">
            <Link :href="route('admin.destinationCEF')"
                class="inline-flex items-center px-4 py-2.5 bg-light-green text-dark-green text-xs font-semibold rounded-sm tracking-wider leading-5 hover:bg-transparent hover:ring-1 hover:ring-dark-green transition ease-in-out duration-150">
            Create Destination</Link>
        </div>
        <div class="p-2 grid grid-cols-4">
            <div class="w-xs border border-gray-200" v-for="(item, index) in selectedDestination" :key="index">
                <img :src="lct + '/img/destination/' + item.image" alt="" class="w-full object-cover object-center">
                <div class="p-3 space-y-2">
                    <h1 class="text-lg text-black-green font-semibold tracking-wide">{{ item.destination }}</h1>
                    <h2 class="font-medium text-xs tracking-wide uppercase">{{ getDay(item.itinerary) }} Days Starting
                        At</h2>
                    <h1 class="text-lg text-black-green font-medium tracking-wide"> Rp. {{ item.destination }}</h1>
                    <h2 class="font-medium text-xs tracking-wide">Trip Type: {{ item.type.name }}</h2>
                    <div class="text-center">
                        <Link :href="route('admin.destinationCEF', item.id)">
                            <PrimaryButton>
                                Edit Data
                            </PrimaryButton>
                        </Link>

                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>