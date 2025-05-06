<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-4 py-3 text-sm font-bold leading-5 bg-dark-green hover:bg-dark-green/50 tracking-wider text-white focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center px-4 py-3 text-sm leading-5 tracking-wider text-gray-200 hover:text-dark-green hover:bg-gray-100 font-medium transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
