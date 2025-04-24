<script setup>
import Navbar from '../Components/Navbar.vue'
import { Head } from '@inertiajs/vue3';

defineProps({
    title: String,
})
</script>
<template>
    <Head :title="title" />

    <Navbar />

    <main>
        <slot></slot>
    </main>
</template>