<script setup>
import { computed } from 'vue';

const props = defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    active: Boolean,
});
const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-5 py-2.5 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-50 transition ease-in-out duration-150'
        : 'inline-flex items-center px-4 py-3 bg-light-green border border-transparent rounded-sm cursor-pointer font-semibold text-xs tracking-wide hover:bg-black hover:text-light-green transition ease-in-out duration-150';
});
</script>
<template>
    <div class="w-fit px-3 py-2 bg-light-green text-black-green rounded-sm cursor-pointer hover:bg-black hover:text-light-green transition">
        <slot></slot>
    </div>
</template>