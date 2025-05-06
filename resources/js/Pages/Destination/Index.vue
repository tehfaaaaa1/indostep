<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
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
    <AppLayout title="Admin|Destination List" atas="true">
        <div class="max-w-7xl mx-auto mt-10">
            <div class="p-2 grid grid-cols-4">
                <div class="w-xs border border-gray-200" v-for="(item, index) in selectedDestination" :key="index">
                    <img :src="lct + '/img/destination/' + item.image" alt="" class="w-full object-cover object-center">
                    <div class="p-3 space-y-2">
                        <h1 class="text-lg text-black-green font-semibold tracking-wide">{{ item.destination }}</h1>
                        <h2 class="font-medium text-xs tracking-wide uppercase">{{ getDay(item.itinerary) }} Days Starting
                            At</h2>
                        <h1 class="text-lg text-black-green font-medium tracking-wide"> Rp. {{ Number(item.expedition[0].double_occupancy).toLocaleString() }}</h1>
                        <h2 class="font-medium text-xs tracking-wide">Trip Type: {{ item.type.name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>