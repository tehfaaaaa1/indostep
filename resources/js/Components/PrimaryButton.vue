<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <div :type="type" class="px-3 py-2 bg-light-green rounded-sm cursor-pointer hover:bg-black hover:text-light-green transition">
        <slot></slot>
    </div>
</template>